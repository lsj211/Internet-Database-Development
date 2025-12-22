<?php
/**
 * 一键部署工具（放在项目根目录 deploy/ 下）
 * 适配：common/config/main-local.php（你的格式），并支持 MySQL port（如 3307）
 *
 * 功能：
 * - 自动检测 XAMPP；找不到则弹窗输入
 * - 保存配置到 deploy/deploy-config.json
 * - 自动更新项目根目录 yii.bat 的 PHP_COMMAND
 * - 没有 composer 就下载 composer.phar 到项目根目录
 * - composer install / init / 写main-local db配置 / 建库 / 升级Yii / migrate / 建目录
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

$deployDir   = __DIR__;          // .../advanced/deploy
$projectRoot = dirname(__DIR__); // .../advanced

$logFile     = $deployDir . DIRECTORY_SEPARATOR . 'deploy.log';
$configPath  = $deployDir . DIRECTORY_SEPARATOR . 'deploy-config.json';

// 只允许本机访问（需要远程改 true 或自行加鉴权）
define('DEPLOY_ALLOW_REMOTE', false);
if (!DEPLOY_ALLOW_REMOTE) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    if (!in_array($ip, ['127.0.0.1', '::1'])) {
        http_response_code(403);
        echo "Forbidden: deploy tool only allows localhost.\n";
        exit;
    }
}

function logMessage($message) {
    global $logFile;
    $timestamp = date('Y-m-d H:i:s');
    @file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
    return $message;
}
function isWindows() { return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'; }
function normalizePath($p) { return rtrim(trim((string)$p), "\\/"); }

function loadDeployConfig() {
    global $configPath;
    if (file_exists($configPath)) {
        $cfg = json_decode(@file_get_contents($configPath), true);
        if (is_array($cfg)) return $cfg;
    }
    return [
        'xampp_root'  => '',
        'db_name'     => 'yii2advanced',
        'db_user'     => 'root',
        'db_password' => '',
        'db_host'     => 'localhost',
        'db_port'     => '3306',
        'db_charset'  => 'utf8',
        'init_env'    => 'dev', // dev|prod
    ];
}
function saveDeployConfig($cfg) {
    global $configPath;
    @file_put_contents($configPath, json_encode($cfg, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}
function getPhpExe($xamppRoot) {
    $xamppRoot = normalizePath($xamppRoot);
    $php = $xamppRoot . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'php.exe';
    return file_exists($php) ? $php : '';
}
function getMysqlExe($xamppRoot) {
    $xamppRoot = normalizePath($xamppRoot);
    $mysql = $xamppRoot . DIRECTORY_SEPARATOR . 'mysql' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'mysql.exe';
    return file_exists($mysql) ? $mysql : '';
}
function detectXamppRoot() {
    $path = getenv('PATH') ?: '';
    foreach (explode(';', $path) as $entry) {
        $entry = trim($entry);
        if (!$entry) continue;
        $low = strtolower($entry);
        if (strpos($low, 'xampp') !== false && strpos($low, 'php') !== false) {
            $phpExe = rtrim($entry, "\\/") . DIRECTORY_SEPARATOR . 'php.exe';
            if (file_exists($phpExe)) {
                $root = normalizePath(dirname($entry));
                if (file_exists($root . '\mysql\bin\mysql.exe')) return $root;
            }
        }
    }
    $candidates = ['C:\xampp','D:\xampp','E:\xampp','F:\xampp','G:\xampp','D:\Software\XAMPP','C:\Software\XAMPP'];
    foreach ($candidates as $root) {
        if (file_exists($root . '\php\php.exe') && file_exists($root . '\mysql\bin\mysql.exe')) return normalizePath($root);
    }
    return '';
}
function execCommand($cmd, $cwd = null) {
    $output = [];
    $return = 0;
    $old = null;
    if ($cwd) { $old = getcwd(); @chdir($cwd); }

    logMessage("执行命令: $cmd");
    @exec($cmd . ' 2>&1', $output, $return);
    logMessage("返回码: $return");
    logMessage("输出:\n" . implode("\n", $output));

    if ($cwd && $old !== null) @chdir($old);
    return ['output' => $output, 'return' => $return];
}

function getYiiVersionFromVendor($projectRoot) {
    $autoload = $projectRoot . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
    $yiiFile  = $projectRoot . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'yiisoft' . DIRECTORY_SEPARATOR . 'yii2' . DIRECTORY_SEPARATOR . 'Yii.php';

    // vendor 未安装
    if (!file_exists($autoload) || !file_exists($yiiFile)) {
        return '';
    }

    // 避免重复加载
    if (!class_exists('Yii', false)) {
        require_once $autoload;
        require_once $yiiFile;
    }

    // Yii 已加载则取版本
    if (class_exists('Yii') && method_exists('Yii', 'getVersion')) {
        return Yii::getVersion();
    }

    return '';
}


function updateYiiBat($projectRoot, $phpExe) {
    $bat = $projectRoot . DIRECTORY_SEPARATOR . 'yii.bat';
    if (!file_exists($bat)) return [false, '项目根目录 yii.bat 不存在'];

    $content = (string)@file_get_contents($bat);
    $phpExe = str_replace('/', '\\', $phpExe);

    $content2 = preg_replace(
        '/if\s+"%PHP_COMMAND%"\s*==\s*""\s+set\s+PHP_COMMAND=.*(\r?\n)/i',
        'if "%PHP_COMMAND%" == "" set PHP_COMMAND=' . $phpExe . '$1',
        $content,
        1
    );
    if ($content2 === null) return [false, '更新 yii.bat 失败：正则替换失败'];
    @file_put_contents($bat, $content2);
    return [true, '已更新 yii.bat 的 PHP_COMMAND'];
}
function ensureComposerPhar($phpExe, $projectRoot) {
    $composerPhar = $projectRoot . DIRECTORY_SEPARATOR . 'composer.phar';
    if (file_exists($composerPhar)) {
        $ver = execCommand("\"$phpExe\" composer.phar -V", $projectRoot);
        return [true, "composer.phar 已存在：\n" . implode("\n", $ver['output'])];
    }

    $installer = $projectRoot . DIRECTORY_SEPARATOR . 'composer-setup.php';
    $sigFile   = $projectRoot . DIRECTORY_SEPARATOR . 'installer.sig';

    $d1 = execCommand("\"$phpExe\" -r \"copy('https://getcomposer.org/installer', 'composer-setup.php');\"", $projectRoot);
    if ($d1['return'] !== 0 || !file_exists($installer)) {
        return [false, "下载 composer installer 失败（网络/SSL）。\n" . implode("\n", $d1['output'])];
    }

    $d2 = execCommand("\"$phpExe\" -r \"copy('https://composer.github.io/installer.sig', 'installer.sig');\"", $projectRoot);
    if ($d2['return'] !== 0 || !file_exists($sigFile)) {
        @unlink($installer);
        return [false, "下载 installer.sig 失败。\n" . implode("\n", $d2['output'])];
    }

    $expected = strtolower(trim((string)@file_get_contents($sigFile)));
    $actual   = strtolower(hash_file('sha384', $installer) ?: '');
    @unlink($sigFile);

    if (!$expected || !$actual || $expected !== $actual) {
        @unlink($installer);
        return [false, "Composer installer 校验失败（hash 不匹配）。expected=$expected actual=$actual"];
    }

    $install = execCommand("\"$phpExe\" composer-setup.php --install-dir=. --filename=composer.phar", $projectRoot);
    @unlink($installer);

    if ($install['return'] !== 0 || !file_exists($composerPhar)) {
        return [false, "安装 composer.phar 失败。\n" . implode("\n", $install['output'])];
    }

    $ver = execCommand("\"$phpExe\" composer.phar -V", $projectRoot);
    return [true, "Composer 安装完成：\n" . implode("\n", $ver['output'])];
}

/**
 * 只修改你的 common/config/main-local.php 中 db 组件
 * - 支持 dsn: mysql:host=...;port=...;dbname=...
 */
function updateMainLocalDb($projectRoot, $host, $port, $dbName, $dbUser, $dbPass, $charset) {
    $file = $projectRoot . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main-local.php';
    if (!file_exists($file)) return [false, '找不到 common/config/main-local.php（请先 init）'];

    $content = (string)@file_get_contents($file);

    $dsn = "mysql:host={$host};port={$port};dbname={$dbName}";

    // 只替换 db 数组里面的这几项
    $content2 = $content;

    // dsn
    $content2 = preg_replace("/'dsn'\s*=>\s*'mysql:host=.*?;port=.*?;dbname=.*?'/", "'dsn' => '{$dsn}'", $content2);
    // 如果原文件没有 port 字段，也兼容
    $content2 = preg_replace("/'dsn'\s*=>\s*'mysql:host=.*?;dbname=.*?'/", "'dsn' => '{$dsn}'", $content2);

    // username/password/charset
    $content2 = preg_replace("/'username'\s*=>\s*'.*?'/", "'username' => '" . addslashes($dbUser) . "'", $content2);
    $content2 = preg_replace("/'password'\s*=>\s*'.*?'/", "'password' => '" . addslashes($dbPass) . "'", $content2);
    $content2 = preg_replace("/'charset'\s*=>\s*'.*?'/", "'charset' => '" . addslashes($charset) . "'", $content2);

    if ($content2 === null) return [false, '更新 main-local.php 失败（正则替换失败）'];

    @file_put_contents($file, $content2);
    return [true, 'main-local.php 数据库配置已更新'];
}

function parseLastApplyingMigration($outputLines) {
    for ($i = count($outputLines) - 1; $i >= 0; $i--) {
        if (preg_match('/\*\*\*\s+applying\s+([a-zA-Z0-9_]+)/', $outputLines[$i], $m)) return $m[1];
    }
    return '';
}

// ----------------- AJAX -----------------
$action = isset($_POST['action']) ? (string)$_POST['action'] : '';
if ($action) {
    header('Content-Type: application/json; charset=utf-8');

    $cfg = loadDeployConfig();
    $detected = detectXamppRoot();
    $xampp = $cfg['xampp_root'] ?: $detected;

    $phpExe = $xampp ? getPhpExe($xampp) : '';
    $mysqlExe = $xampp ? getMysqlExe($xampp) : '';

    switch ($action) {
        case 'get_env':
            echo json_encode(['success'=>true,'data'=>[
                'detected_xampp_root'=>$detected,
                'using_xampp_root'=>$xampp,
                'php_exe'=>$phpExe,
                'mysql_exe'=>$mysqlExe,
                'php_version'=>PHP_VERSION,
                'yii_version'=>getYiiVersionFromVendor($projectRoot),
                'composer_phar'=>file_exists($projectRoot . DIRECTORY_SEPARATOR . 'composer.phar'),
                'vendor_exists'=>is_dir($projectRoot . DIRECTORY_SEPARATOR . 'vendor'),
                'has_main_local'=>file_exists($projectRoot . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main-local.php'),
                'cfg'=>$cfg,
            ]], JSON_UNESCAPED_UNICODE);
            break;

        case 'save_config':
            $cfg['xampp_root']  = normalizePath($_POST['xampp_root'] ?? '');
            $cfg['db_name']     = trim((string)($_POST['db_name'] ?? 'yii2advanced'));
            $cfg['db_user']     = trim((string)($_POST['db_user'] ?? 'root'));
            $cfg['db_password'] = (string)($_POST['db_password'] ?? '');
            $cfg['db_host']     = trim((string)($_POST['db_host'] ?? 'localhost'));
            $cfg['db_port']     = trim((string)($_POST['db_port'] ?? '3306'));
            $cfg['db_charset']  = trim((string)($_POST['db_charset'] ?? 'utf8'));
            $cfg['init_env']    = ($_POST['init_env'] ?? 'dev') === 'prod' ? 'prod' : 'dev';

            if (!$cfg['xampp_root'] || !getPhpExe($cfg['xampp_root']) || !getMysqlExe($cfg['xampp_root'])) {
                echo json_encode(['success'=>false,'message'=>'XAMPP 路径无效：必须存在 php\\php.exe 和 mysql\\bin\\mysql.exe'], JSON_UNESCAPED_UNICODE);
                break;
            }
            if (!preg_match('/^\d+$/', $cfg['db_port'])) {
                echo json_encode(['success'=>false,'message'=>'MySQL 端口必须是数字（如 3306/3307）'], JSON_UNESCAPED_UNICODE);
                break;
            }

            saveDeployConfig($cfg);
            echo json_encode(['success'=>true,'message'=>'配置已保存','data'=>$cfg], JSON_UNESCAPED_UNICODE);
            break;

        case 'update_yii_bat':
            if (!$phpExe) { echo json_encode(['success'=>false,'message'=>'未配置/未检测到 XAMPP PHP'], JSON_UNESCAPED_UNICODE); break; }
            [$ok,$msg] = updateYiiBat($projectRoot, $phpExe);
            echo json_encode(['success'=>$ok,'message'=>$msg], JSON_UNESCAPED_UNICODE);
            break;

        case 'install_composer':
            if (!$phpExe) { echo json_encode(['success'=>false,'message'=>'未配置/未检测到 XAMPP PHP'], JSON_UNESCAPED_UNICODE); break; }
            [$ok,$msg] = ensureComposerPhar($phpExe, $projectRoot);
            echo json_encode(['success'=>$ok,'message'=>$msg], JSON_UNESCAPED_UNICODE);
            break;

        case 'install_dependencies':
            if (!$phpExe) { echo json_encode(['success'=>false,'message'=>'未配置/未检测到 XAMPP PHP'], JSON_UNESCAPED_UNICODE); break; }
            if (!file_exists($projectRoot . DIRECTORY_SEPARATOR . 'composer.phar')) {
                echo json_encode(['success'=>false,'message'=>'缺少 composer.phar，请先安装 Composer'], JSON_UNESCAPED_UNICODE);
                break;
            }
            $cmd = "\"$phpExe\" composer.phar install --no-interaction";
            $res = execCommand($cmd, $projectRoot);
            echo json_encode([
                'success'=>$res['return']===0,
                'message'=>$res['return']===0?'依赖安装完成':'依赖安装失败',
                'output'=>implode("\n",$res['output']),
            ], JSON_UNESCAPED_UNICODE);
            break;

        case 'init_project':
            if (!$phpExe) { echo json_encode(['success'=>false,'message'=>'未配置/未检测到 XAMPP PHP'], JSON_UNESCAPED_UNICODE); break; }
            if (file_exists($projectRoot . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main-local.php')) {
                echo json_encode(['success'=>true,'message'=>'main-local.php 已存在，跳过 init'], JSON_UNESCAPED_UNICODE);
                break;
            }
            $envChoice = ($cfg['init_env'] ?? 'dev') === 'prod' ? '1' : '0';
            $cmd = isWindows()
                ? 'cmd /c "echo ' . $envChoice . ' | "' . $phpExe . '" init --interactive=0"'
                : 'sh -c "echo ' . escapeshellarg($envChoice) . ' | ' . escapeshellarg($phpExe) . ' init --interactive=0"';

            $res = execCommand($cmd, $projectRoot);
            echo json_encode([
                'success'=>$res['return']===0,
                'message'=>$res['return']===0?'项目初始化完成':'项目初始化失败',
                'output'=>implode("\n",$res['output']),
            ], JSON_UNESCAPED_UNICODE);
            break;

        case 'configure_db':
            [$ok,$msg] = updateMainLocalDb(
                $projectRoot,
                $cfg['db_host'],
                $cfg['db_port'],
                $cfg['db_name'],
                $cfg['db_user'],
                $cfg['db_password'],
                $cfg['db_charset']
            );
            echo json_encode(['success'=>$ok,'message'=>$msg], JSON_UNESCAPED_UNICODE);
            break;

        case 'create_database':
            if (!$mysqlExe) {
                echo json_encode(['success'=>false,'message'=>'未配置/未检测到 XAMPP MySQL'], JSON_UNESCAPED_UNICODE);
                break;
            }

            $dbName = $cfg['db_name'];
            $dbUser = $cfg['db_user'];
            $dbPass = (string)$cfg['db_password'];
            $host   = (string)$cfg['db_host'];
            $port   = (string)$cfg['db_port'];

            // 用临时 SQL 文件，避免 -e 引号/特殊字符问题
            $sql = "CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
            $tmpSql = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'yii2_create_db_' . time() . '.sql';
            file_put_contents($tmpSql, $sql);

            // 一定要给参数加引号
            $cmd = "\"$mysqlExe\" -h \"$host\" -P \"$port\" -u \"$dbUser\"";

            // Windows 下用 --password="..." 比 -pxxx 稳定得多
            if ($dbPass !== '') {
                $cmd .= " --password=\"" . str_replace('"', '\"', $dbPass) . "\"";
            }

            // 用输入重定向喂 SQL
            $cmd .= " < \"$tmpSql\"";

            $res = execCommand($cmd, $projectRoot);
            @unlink($tmpSql);

            echo json_encode([
                'success' => $res['return'] === 0,
                'message' => $res['return'] === 0 ? '数据库创建成功/已存在' : '数据库创建失败（请看输出）',
                'output'  => implode("\n", $res['output']),
                // 'cmd' => $cmd, // 不想暴露密码就别回显
            ], JSON_UNESCAPED_UNICODE);
            break;

        case 'ensure_yii':
            if (!$phpExe) { echo json_encode(['success'=>false,'message'=>'未配置/未检测到 XAMPP PHP'], JSON_UNESCAPED_UNICODE); break; }
            if (!file_exists($projectRoot . DIRECTORY_SEPARATOR . 'composer.phar')) {
                echo json_encode(['success'=>false,'message'=>'缺少 composer.phar，请先安装 Composer'], JSON_UNESCAPED_UNICODE);
                break;
            }

            $yiiVer = getYiiVersionFromVendor($projectRoot);
            $phpVer = PHP_VERSION;
            $needUpgrade = ($yiiVer !== '' && version_compare($phpVer,'8.0.0','>=') && version_compare($yiiVer,'2.0.40','<'));

            if (!$needUpgrade) {
                echo json_encode(['success'=>true,'message'=>"Yii 版本正常（Yii={$yiiVer}，PHP={$phpVer}），无需升级"], JSON_UNESCAPED_UNICODE);
                break;
            }

            $cmd = "\"$phpExe\" composer.phar require \"yiisoft/yii2:^2.0.53\" \"yiisoft/yii2-composer:^2.0.11\" -W --update-with-dependencies --no-interaction";
            $res = execCommand($cmd, $projectRoot);

            echo json_encode([
                'success'=>$res['return']===0,
                'message'=>$res['return']===0?'Yii 已升级（迁移更稳定）':'Yii 升级失败',
                'output'=>implode("\n",$res['output']),
            ], JSON_UNESCAPED_UNICODE);
            break;

        case 'run_migrations':
            if (!$phpExe) { echo json_encode(['success'=>false,'message'=>'未配置/未检测到 XAMPP PHP'], JSON_UNESCAPED_UNICODE); break; }
            $autoMark = ($_POST['auto_mark_on_exists'] ?? '1') === '1';

            $cmd = "\"$phpExe\" yii migrate --interactive=0";
            $res = execCommand($cmd, $projectRoot);

            if ($autoMark && $res['return'] !== 0) {
                $outText = implode("\n",$res['output']);
                if (stripos($outText,'already exists') !== false) {
                    $mig = parseLastApplyingMigration($res['output']);
                    if ($mig) {
                        execCommand("\"$phpExe\" yii migrate/mark {$mig} --interactive=0", $projectRoot);
                        $res2 = execCommand($cmd, $projectRoot);
                        echo json_encode([
                            'success'=>$res2['return']===0,
                            'message'=>$res2['return']===0?"迁移完成（自动 mark：{$mig}）":'迁移失败（已尝试自动 mark）',
                            'output'=>implode("\n",$res['output'])."\n\n--- 自动 mark 后重试 ---\n".implode("\n",$res2['output']),
                        ], JSON_UNESCAPED_UNICODE);
                        break;
                    }
                }
            }

            echo json_encode([
                'success'=>$res['return']===0,
                'message'=>$res['return']===0?'数据库迁移完成':'数据库迁移失败',
                'output'=>implode("\n",$res['output']),
            ], JSON_UNESCAPED_UNICODE);
            break;

        case 'create_directories':
            $dirs = [
                'frontend/web/uploads/heroes',
                'frontend/web/uploads/materials',
                'frontend/web/audio',
                'frontend/runtime',
                'backend/runtime',
                'console/runtime',
                'frontend/web/assets',
                'backend/web/assets',
            ];
            $created = [];
            foreach ($dirs as $dir) {
                $path = $projectRoot . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $dir);
                if (!is_dir($path)) {
                    @mkdir($path, 0777, true);
                    if (is_dir($path)) $created[] = $dir;
                }
            }
            echo json_encode(['success'=>true,'message'=>count($created)?('创建了 '.count($created).' 个目录'):'所有目录已存在','created'=>$created], JSON_UNESCAPED_UNICODE);
            break;

        default:
            echo json_encode(['success'=>false,'message'=>'未知操作'], JSON_UNESCAPED_UNICODE);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>项目一键部署工具</title>
  <link rel="stylesheet" href="./deploy.css?v=3" />
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>🚀 一键部署工具</h1>
      <p>请修改你的配置</p>
      <p class="warn">⚠️ 部署成功后建议删除整个 deploy 文件夹。</p>
    </div>

    <div class="info-box">
      <h3>📋 当前环境</h3>
      <div class="env-grid">
        <div><b>PHP</b><span id="env_php">-</span></div>
        <div><b>Yii</b><span id="env_yii">-</span></div>
        <div><b>XAMPP</b><span id="env_xampp">-</span></div>
        <div><b>composer.phar</b><span id="env_composer">-</span></div>
      </div>
      <div class="tiny">
        <button class="tiny-btn" id="openCfgBtn">⚙️ 修改配置</button>
        <button class="tiny-btn" id="refreshEnvBtn">🔄 刷新环境</button>
      </div>
    </div>

    <div class="progress-bar"><div class="progress-fill" id="progress" style="width:0%"></div></div>

    <div id="steps" class="steps">
      <div class="step" id="step1"><div class="step-header"><div class="step-title">1️⃣ 环境检查与配置</div><div class="step-status status-pending">等待中</div></div><div class="step-content">检测 XAMPP / PHP / MySQL，必要时弹窗输入 XAMPP 路径、DB host/port/name/user/pass</div></div>
      <div class="step" id="step2"><div class="step-header"><div class="step-title">2️⃣ 更新 yii.bat</div><div class="step-status status-pending">等待中</div></div><div class="step-content">把 XAMPP 的 php.exe 写入项目根目录 yii.bat</div></div>
      <div class="step" id="step3"><div class="step-header"><div class="step-title">3️⃣ 安装 Composer（项目本地 composer.phar）</div><div class="step-status status-pending">等待中</div></div><div class="step-content">若项目根目录没有 composer.phar，将自动下载并校验安装</div></div>
      <div class="step" id="step4"><div class="step-header"><div class="step-title">4️⃣ 安装依赖（composer install）</div><div class="step-status status-pending">等待中</div></div><div class="step-content">安装/更新 vendor 依赖</div></div>
      <div class="step" id="step5"><div class="step-header"><div class="step-title">5️⃣ 初始化项目（init）</div><div class="step-status status-pending">等待中</div></div><div class="step-content">生成 common/config/main-local.php（如果已存在则跳过）</div></div>
      <div class="step" id="step6"><div class="step-header"><div class="step-title">6️⃣ 写入 main-local.php DB 配置 + 创建数据库</div><div class="step-status status-pending">等待中</div></div><div class="step-content">写入 host/port/dbname/user/pass/charset，并创建数据库</div></div>
      <div class="step" id="step7"><div class="step-header"><div class="step-title">7️⃣ 确保 Yii 版本兼容（必要时升级）</div><div class="step-status status-pending">等待中</div></div><div class="step-content">PHP 8+ 且 Yii 太旧时自动升级到 2.0.53（同时升级 yii2-composer）</div></div>
      <div class="step" id="step8"><div class="step-header"><div class="step-title">8️⃣ 迁移 + 创建目录</div><div class="step-status status-pending">等待中</div></div><div class="step-content">执行迁移并创建 uploads/runtime/assets 等目录（表已存在会尝试自动 mark 重试）</div></div>
    </div>

    <button class="btn" id="deployBtn">🚀 开始部署</button>
    <div id="successBox" class="success-box" style="display:none;"></div>
  </div>

  <div id="configModal" class="modal" style="display:none;">
    <div class="modal-card">
      <h2>部署配置</h2>
      <p class="muted">XAMPP 示例：<code>G:\xampp</code> / <code>C:\xampp</code>（必须存在 php\php.exe 与 mysql\bin\mysql.exe）</p>

      <div class="form-group">
        <label>XAMPP 根目录</label>
        <input id="cfg_xampp" placeholder="G:\xampp" />
        <div class="hint">必须存在：<code>php\php.exe</code> 和 <code>mysql\bin\mysql.exe</code></div>
      </div>

      <div class="grid2">
        <div class="form-group">
          <label>DB Host</label>
          <input id="cfg_dbhost" value="localhost" />
        </div>
        <div class="form-group">
          <label>DB Port（你这里通常是 3307）</label>
          <input id="cfg_dbport" value="3307" />
        </div>
      </div>

      <div class="grid2">
        <div class="form-group">
          <label>数据库名</label>
          <input id="cfg_dbname" value="yii2advanced" />
        </div>
        <div class="form-group">
          <label>数据库用户</label>
          <input id="cfg_dbuser" value="root" />
        </div>
      </div>

      <div class="form-group">
        <label>数据库密码（无密码留空）</label>
        <input id="cfg_dbpass" type="password" />
      </div>

      <div class="grid2">
        <div class="form-group">
          <label>字符集</label>
          <input id="cfg_charset" value="utf8" />
        </div>
        <div class="form-group">
          <label>init 环境</label>
          <select id="cfg_initenv">
            <option value="dev">开发环境（Development）</option>
            <option value="prod">生产环境（Production）</option>
          </select>
        </div>
      </div>

      <div class="modal-actions">
        <button class="btn" id="saveCfgBtn">保存配置</button>
        <button class="btn btn-secondary" id="closeCfgBtn">关闭</button>
      </div>
    </div>
  </div>

  <script src="./deploy.js?v=3"></script>
</body>
</html>
