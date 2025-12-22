<?php
/**
 * 抗战纪念队项目 - 网页可视化部署工具
 * Development Team: DBIS, NKU
 * Coding by: chengna 2311828
 */

// 设置错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 项目根目录
$rootDir = __DIR__;

// 执行部署步骤
$step = isset($_GET['step']) ? intval($_GET['step']) : 0;
$action = isset($_POST['action']) ? $_POST['action'] : '';

// 日志文件
$logFile = $rootDir . '/deploy.log';

// 辅助函数
function logMessage($message) {
    global $logFile;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
    return $message;
}

function checkCommand($cmd) {
    $output = [];
    $return = 0;
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        exec("where $cmd 2>nul", $output, $return);
    } else {
        exec("which $cmd 2>/dev/null", $output, $return);
    }
    return $return === 0;
}

function execCommand($cmd) {
    $output = [];
    $return = 0;
    exec($cmd . ' 2>&1', $output, $return);
    logMessage("执行命令: $cmd");
    logMessage("返回码: $return");
    logMessage("输出: " . implode("\n", $output));
    return ['output' => $output, 'return' => $return];
}

// 处理 AJAX 请求
if ($action) {
    header('Content-Type: application/json; charset=utf-8');
    
    switch ($action) {
        case 'check_env':
            $result = [
                'php' => PHP_VERSION,
                'composer' => checkCommand('composer'),
                'mysql' => checkCommand('mysql') || file_exists('D:/Software/XAMPP/mysql/bin/mysql.exe'),
                'vendor_exists' => is_dir($rootDir . '/vendor'),
                'config_exists' => file_exists($rootDir . '/common/config/main-local.php'),
            ];
            echo json_encode(['success' => true, 'data' => $result]);
            break;
            
        case 'install_dependencies':
            if (is_dir($rootDir . '/vendor')) {
                echo json_encode(['success' => true, 'message' => '依赖已存在，跳过安装']);
            } else {
                $cmd = checkCommand('composer') ? 'composer install' : 'php composer.phar install';
                chdir($rootDir);
                $result = execCommand($cmd);
                echo json_encode([
                    'success' => $result['return'] === 0,
                    'message' => $result['return'] === 0 ? '依赖安装成功' : '依赖安装失败',
                    'output' => implode("\n", $result['output'])
                ]);
            }
            break;
            
        case 'init_project':
            if (file_exists($rootDir . '/common/config/main-local.php')) {
                echo json_encode(['success' => true, 'message' => '项目已初始化，跳过此步骤']);
            } else {
                chdir($rootDir);
                $result = execCommand('echo 0 | php init --interactive=0');
                echo json_encode([
                    'success' => $result['return'] === 0,
                    'message' => $result['return'] === 0 ? '项目初始化成功' : '项目初始化失败',
                    'output' => implode("\n", $result['output'])
                ]);
            }
            break;
            
        case 'configure_db':
            $password = isset($_POST['db_password']) ? $_POST['db_password'] : '';
            $configFile = $rootDir . '/common/config/main-local.php';
            
            if (!file_exists($configFile)) {
                echo json_encode(['success' => false, 'message' => '配置文件不存在，请先初始化项目']);
                break;
            }
            
            $content = file_get_contents($configFile);
            $content = preg_replace(
                "/'password' => '.*?'/",
                "'password' => '" . addslashes($password) . "'",
                $content
            );
            file_put_contents($configFile, $content);
            
            echo json_encode(['success' => true, 'message' => '数据库配置已更新']);
            break;
            
        case 'create_database':
            $password = isset($_POST['db_password']) ? $_POST['db_password'] : '';
            $mysqlCmd = checkCommand('mysql') ? 'mysql' : 'D:/Software/XAMPP/mysql/bin/mysql.exe';
            
            $sql = "CREATE DATABASE IF NOT EXISTS yii2advanced CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
            $cmd = $password ? 
                "$mysqlCmd -u root -p$password -e \"$sql\"" : 
                "$mysqlCmd -u root -e \"$sql\"";
            
            $result = execCommand($cmd);
            echo json_encode([
                'success' => $result['return'] === 0,
                'message' => $result['return'] === 0 ? '数据库创建成功' : '数据库创建失败，可能已存在',
            ]);
            break;
            
        case 'run_migrations':
            chdir($rootDir);
            $result = execCommand('php yii migrate --interactive=0');
            echo json_encode([
                'success' => $result['return'] === 0,
                'message' => $result['return'] === 0 ? '数据库迁移完成' : '数据库迁移失败',
                'output' => implode("\n", $result['output'])
            ]);
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
                $path = $rootDir . '/' . $dir;
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                    $created[] = $dir;
                }
            }
            
            echo json_encode([
                'success' => true,
                'message' => count($created) > 0 ? '创建了 ' . count($created) . ' 个目录' : '所有目录已存在',
                'created' => $created
            ]);
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => '未知操作']);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>抗战纪念队项目 - 一键部署工具</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Microsoft YaHei', 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 800px;
            width: 100%;
            padding: 40px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .header p {
            color: #666;
            font-size: 14px;
        }
        
        .step {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .step.active {
            background: #e3f2fd;
            border-left-color: #2196F3;
        }
        
        .step.success {
            background: #e8f5e9;
            border-left-color: #4CAF50;
        }
        
        .step.error {
            background: #ffebee;
            border-left-color: #f44336;
        }
        
        .step-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .step-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        
        .step-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .status-pending {
            background: #e0e0e0;
            color: #666;
        }
        
        .status-running {
            background: #2196F3;
            color: white;
            animation: pulse 1.5s infinite;
        }
        
        .status-success {
            background: #4CAF50;
            color: white;
        }
        
        .status-error {
            background: #f44336;
            color: white;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }
        
        .step-content {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .step-output {
            margin-top: 10px;
            padding: 10px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            max-height: 150px;
            overflow-y: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            display: block;
            width: 100%;
            margin-top: 20px;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }
        
        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            transition: width 0.5s ease;
        }
        
        .info-box {
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .info-box h3 {
            color: #856404;
            margin-bottom: 10px;
            font-size: 16px;
        }
        
        .info-box p {
            color: #856404;
            font-size: 14px;
            line-height: 1.6;
            margin: 5px 0;
        }
        
        .success-box {
            background: #d4edda;
            border: 1px solid #28a745;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            margin-top: 20px;
        }
        
        .success-box h2 {
            color: #155724;
            margin-bottom: 15px;
        }
        
        .success-box a {
            display: inline-block;
            margin: 10px;
            padding: 12px 30px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            transition: background 0.3s;
        }
        
        .success-box a:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎖️ 抗战纪念队项目部署工具</h1>
            <p>Development Team: DBIS, NKU </p>
        </div>
        
        <div class="info-box">
            <h3>📋 部署说明</h3>
            <p>• 请确保已启动 XAMPP 的 Apache 和 MySQL 服务</p>
            <p>• 部署过程需要几分钟，请耐心等待</p>
            <p>• 如遇到问题，请查看详细日志</p>
        </div>
        
        <div class="progress-bar">
            <div class="progress-fill" id="progress" style="width: 0%"></div>
        </div>
        
        <div id="steps">
            <div class="step" id="step1">
                <div class="step-header">
                    <div class="step-title">1️⃣ 环境检查</div>
                    <div class="step-status status-pending">等待中</div>
                </div>
                <div class="step-content">检查 PHP、Composer、MySQL 等必要组件</div>
            </div>
            
            <div class="step" id="step2">
                <div class="step-header">
                    <div class="step-title">2️⃣ 安装依赖</div>
                    <div class="step-status status-pending">等待中</div>
                </div>
                <div class="step-content">使用 Composer 安装项目依赖包</div>
            </div>
            
            <div class="step" id="step3">
                <div class="step-header">
                    <div class="step-title">3️⃣ 初始化项目</div>
                    <div class="step-status status-pending">等待中</div>
                </div>
                <div class="step-content">创建配置文件和必要的环境设置</div>
            </div>
            
            <div class="step" id="step4">
                <div class="step-header">
                    <div class="step-title">4️⃣ 配置数据库</div>
                    <div class="step-status status-pending">等待中</div>
                </div>
                <div class="step-content">
                    <div class="form-group" style="display: none;" id="db-form">
                        <label>MySQL Root 密码（无密码请留空）</label>
                        <input type="password" id="db_password" placeholder="输入 MySQL root 密码">
                    </div>
                    <div>设置数据库连接信息</div>
                </div>
            </div>
            
            <div class="step" id="step5">
                <div class="step-header">
                    <div class="step-title">5️⃣ 创建数据库</div>
                    <div class="step-status status-pending">等待中</div>
                </div>
                <div class="step-content">创建 yii2advanced 数据库</div>
            </div>
            
            <div class="step" id="step6">
                <div class="step-header">
                    <div class="step-title">6️⃣ 数据库迁移</div>
                    <div class="step-status status-pending">等待中</div>
                </div>
                <div class="step-content">创建数据表并插入初始数据</div>
            </div>
            
            <div class="step" id="step7">
                <div class="step-header">
                    <div class="step-title">7️⃣ 创建目录</div>
                    <div class="step-status status-pending">等待中</div>
                </div>
                <div class="step-content">创建上传、缓存等必要目录</div>
            </div>
        </div>
        
        <button class="btn" id="deployBtn" onclick="startDeploy()">🚀 开始部署</button>
        
        <div id="successBox" style="display: none;">
            <!-- 成功提示将在这里显示 -->
        </div>
    </div>
    
    <script>
        let currentStep = 0;
        const totalSteps = 7;
        
        function updateProgress() {
            const progress = (currentStep / totalSteps) * 100;
            document.getElementById('progress').style.width = progress + '%';
        }
        
        function updateStepStatus(stepNum, status, message = '') {
            const step = document.getElementById('step' + stepNum);
            const statusEl = step.querySelector('.step-status');
            
            step.className = 'step';
            statusEl.className = 'step-status';
            
            if (status === 'running') {
                step.classList.add('active');
                statusEl.classList.add('status-running');
                statusEl.textContent = '执行中...';
            } else if (status === 'success') {
                step.classList.add('success');
                statusEl.classList.add('status-success');
                statusEl.textContent = '✓ 完成';
            } else if (status === 'error') {
                step.classList.add('error');
                statusEl.classList.add('status-error');
                statusEl.textContent = '✗ 失败';
            }
            
            if (message) {
                let outputDiv = step.querySelector('.step-output');
                if (!outputDiv) {
                    outputDiv = document.createElement('div');
                    outputDiv.className = 'step-output';
                    step.querySelector('.step-content').appendChild(outputDiv);
                }
                outputDiv.textContent = message;
            }
        }
        
        async function ajax(action, data = {}) {
            data.action = action;
            const formData = new FormData();
            for (let key in data) {
                formData.append(key, data[key]);
            }
            
            const response = await fetch(window.location.href, {
                method: 'POST',
                body: formData
            });
            
            return await response.json();
        }
        
        async function startDeploy() {
            const btn = document.getElementById('deployBtn');
            btn.disabled = true;
            btn.textContent = '部署中...';
            
            try {
                // Step 1: 检查环境
                currentStep = 1;
                updateProgress();
                updateStepStatus(1, 'running');
                const envCheck = await ajax('check_env');
                if (envCheck.success) {
                    const info = `PHP: ${envCheck.data.php}\n` +
                                `Composer: ${envCheck.data.composer ? '已安装' : '未安装'}\n` +
                                `MySQL: ${envCheck.data.mysql ? '已安装' : '未安装'}`;
                    updateStepStatus(1, 'success', info);
                    
                    if (!envCheck.data.composer && !envCheck.data.mysql) {
                        throw new Error('缺少必要组件：Composer 和 MySQL');
                    }
                } else {
                    throw new Error('环境检查失败');
                }
                
                // Step 2: 安装依赖
                currentStep = 2;
                updateProgress();
                updateStepStatus(2, 'running');
                const deps = await ajax('install_dependencies');
                updateStepStatus(2, deps.success ? 'success' : 'error', deps.message);
                if (!deps.success) throw new Error(deps.message);
                
                // Step 3: 初始化项目
                currentStep = 3;
                updateProgress();
                updateStepStatus(3, 'running');
                const init = await ajax('init_project');
                updateStepStatus(3, init.success ? 'success' : 'error', init.message);
                if (!init.success) throw new Error(init.message);
                
                // Step 4: 配置数据库
                document.getElementById('db-form').style.display = 'block';
                currentStep = 4;
                updateProgress();
                updateStepStatus(4, 'running');
                const dbPassword = document.getElementById('db_password').value;
                const config = await ajax('configure_db', { db_password: dbPassword });
                updateStepStatus(4, config.success ? 'success' : 'error', config.message);
                if (!config.success) throw new Error(config.message);
                
                // Step 5: 创建数据库
                currentStep = 5;
                updateProgress();
                updateStepStatus(5, 'running');
                const createDb = await ajax('create_database', { db_password: dbPassword });
                updateStepStatus(5, createDb.success ? 'success' : 'error', createDb.message);
                if (!createDb.success) throw new Error(createDb.message);
                
                // Step 6: 运行迁移
                currentStep = 6;
                updateProgress();
                updateStepStatus(6, 'running');
                const migrate = await ajax('run_migrations');
                updateStepStatus(6, migrate.success ? 'success' : 'error', migrate.message);
                if (!migrate.success) throw new Error(migrate.message);
                
                // Step 7: 创建目录
                currentStep = 7;
                updateProgress();
                updateStepStatus(7, 'running');
                const dirs = await ajax('create_directories');
                updateStepStatus(7, dirs.success ? 'success' : 'error', dirs.message);
                if (!dirs.success) throw new Error(dirs.message);
                
                // 全部完成
                currentStep = 7;
                updateProgress();
                showSuccess();
                
            } catch (error) {
                alert('部署失败：' + error.message);
                btn.disabled = false;
                btn.textContent = '🚀 重新部署';
            }
        }
        
        function showSuccess() {
            const baseUrl = window.location.href.replace('/deploy.php', '');
            document.getElementById('successBox').innerHTML = `
                <div class="success-box">
                    <h2>🎉 部署成功！</h2>
                    <p style="margin: 20px 0; color: #155724;">
                        项目已成功部署，您现在可以访问网站了！
                    </p>
                    <div>
                        <a href="${baseUrl}/frontend/web/" target="_blank">访问前端网站</a>
                        <a href="${baseUrl}/backend/web/" target="_blank">访问后端管理</a>
                    </div>
                    <p style="margin-top: 20px; font-size: 14px; color: #666;">
                        默认账号：程娜 | 密码：123456
                    </p>
                </div>
            `;
            document.getElementById('successBox').style.display = 'block';
            document.getElementById('deployBtn').style.display = 'none';
        }
    </script>
</body>
</html>
