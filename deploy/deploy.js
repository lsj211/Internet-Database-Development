let currentStep = 0;
const totalSteps = 8;

function $(id){ return document.getElementById(id); }

function updateProgress() {
  const p = (currentStep / totalSteps) * 100;
  $('progress').style.width = `${p}%`;
}

function updateStepStatus(stepNum, status, message = '') {
  const step = $('step' + stepNum);
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
  } else {
    statusEl.classList.add('status-pending');
    statusEl.textContent = '等待中';
  }

  if (message) {
    let out = step.querySelector('.step-output');
    if (!out) {
      out = document.createElement('div');
      out.className = 'step-output';
      step.querySelector('.step-content').appendChild(out);
    }
    out.textContent = message;
  }
}

async function ajax(action, data = {}) {
  const fd = new FormData();
  fd.append('action', action);
  Object.keys(data).forEach(k => fd.append(k, data[k]));
  const resp = await fetch(window.location.href, { method:'POST', body: fd });
  return await resp.json();
}

function showModal(show) {
  $('configModal').style.display = show ? 'flex' : 'none';
}

function fillEnvBox(env) {
  $('env_php').textContent = env.php_version || '-';
  $('env_yii').textContent = env.yii_version || '(未安装/未检测)';
  $('env_xampp').textContent = env.using_xampp_root || '(未配置)';
  $('env_composer').textContent = env.composer_phar ? '已存在（项目根目录）' : '未安装（将自动下载）';
}

async function loadEnvAndMaybeAskConfig(forceModal = false) {
  const env = await ajax('get_env');
  if (!env.success) throw new Error('获取环境信息失败');
  fillEnvBox(env.data);

  const cfg = env.data.cfg || {};
  $('cfg_xampp').value = env.data.using_xampp_root || cfg.xampp_root || env.data.detected_xampp_root || '';
  $('cfg_dbname').value = cfg.db_name || 'yii2advanced';
  $('cfg_dbuser').value = cfg.db_user || 'root';
  $('cfg_dbpass').value = cfg.db_password || '';
  $('cfg_initenv').value = cfg.init_env || 'dev';

  const missing = !env.data.php_exe || !env.data.mysql_exe;
  if (forceModal || missing) {
    showModal(true);
    if (missing) throw new Error('未检测到有效的 XAMPP 路径，请在弹窗中填写后保存');
  }
  return env.data;
}

async function saveConfig() {
  const xampp_root  = $('cfg_xampp').value;

  const db_host     = $('cfg_dbhost').value;
  const db_port     = $('cfg_dbport').value;
  const db_charset  = $('cfg_charset').value;

  const db_name     = $('cfg_dbname').value;
  const db_user     = $('cfg_dbuser').value;
  const db_password = $('cfg_dbpass').value;
  const init_env    = $('cfg_initenv').value;

  const r = await ajax('save_config', {
    xampp_root,
    db_host, db_port, db_charset,
    db_name, db_user, db_password,
    init_env
  });
  if (!r.success) throw new Error(r.message || '保存配置失败');

  const b = await ajax('update_yii_bat');
  if (!b.success) throw new Error('写入 yii.bat 失败：' + b.message);

  showModal(false);

  const env = await ajax('get_env');
  if (env.success) fillEnvBox(env.data);

  return '配置已保存，并已更新 yii.bat';
}


function showSuccess() {
  // 当前页面：.../deploy/deploy.php  => base：.../
  const url = window.location.href;
  const base = url.replace(/\/deploy\/deploy\.php(\?.*)?$/i, '');
  $('successBox').innerHTML = `
    <h2>🎉 部署成功！</h2>
    <p>依赖安装、初始化、数据库配置、建库、升级检查、迁移、目录创建已完成。</p>
    <div class="success-links">
      <a href="${base}/frontend/web/" target="_blank">访问前端网站</a>
      <a href="${base}/backend/web/" target="_blank">访问后端管理</a>
    </div>
    <p style="margin-top:10px;color:#155724;">建议：部署成功后删除整个 deploy 文件夹</p>
  `;
  $('successBox').style.display = 'block';
  $('deployBtn').style.display = 'none';
}

async function startDeploy() {
  const btn = $('deployBtn');
  btn.disabled = true;
  btn.textContent = '部署中...';

  try {
    // Step 1: 环境检查与配置
    currentStep = 1; updateProgress();
    updateStepStatus(1, 'running');
    await loadEnvAndMaybeAskConfig(false);
    updateStepStatus(1, 'success', '环境信息已读取。若需修改配置，可点“⚙️ 修改配置”');

    // Step 2: 更新 yii.bat
    currentStep = 2; updateProgress();
    updateStepStatus(2, 'running');
    const bat = await ajax('update_yii_bat');
    if (!bat.success) throw new Error(bat.message || '更新 yii.bat 失败');
    updateStepStatus(2, 'success', bat.message);

    // Step 3: 安装 Composer（项目本地 composer.phar）
    currentStep = 3; updateProgress();
    updateStepStatus(3, 'running');
    const composer = await ajax('install_composer');
    if (!composer.success) throw new Error(composer.message || '安装 Composer 失败');
    updateStepStatus(3, 'success', composer.message);

    // Step 4: 安装依赖
    currentStep = 4; updateProgress();
    updateStepStatus(4, 'running');
    const deps = await ajax('install_dependencies');
    if (!deps.success) throw new Error(deps.message || '依赖安装失败');
    updateStepStatus(4, 'success', deps.output ? deps.output : deps.message);

    // Step 5: 初始化项目
    currentStep = 5; updateProgress();
    updateStepStatus(5, 'running');
    const init = await ajax('init_project');
    if (!init.success) throw new Error(init.message || '初始化失败');
    updateStepStatus(5, 'success', init.output ? init.output : init.message);

    // Step 6: 配置数据库 + 建库
    currentStep = 6; updateProgress();
    updateStepStatus(6, 'running');
    const cfg = await ajax('configure_db');
    if (!cfg.success) throw new Error(cfg.message || '写入数据库配置失败');

    const cdb = await ajax('create_database');
    if (!cdb.success) throw new Error(cdb.message || '创建数据库失败');
    updateStepStatus(6, 'success', cfg.message + "\n" + (cdb.output || cdb.message));

    // Step 7: 确保 Yii 版本（必要时升级）
    currentStep = 7; updateProgress();
    updateStepStatus(7, 'running');
    const ensure = await ajax('ensure_yii');
    if (!ensure.success) throw new Error(ensure.message || '升级 Yii 失败');
    updateStepStatus(7, 'success', ensure.output ? ensure.output : ensure.message);

    // Step 8: 迁移 + 建目录
    currentStep = 8; updateProgress();
    updateStepStatus(8, 'running');
    const mig = await ajax('run_migrations', { auto_mark_on_exists: '1' });
    if (!mig.success) throw new Error(mig.message || '迁移失败');

    const dirs = await ajax('create_directories');
    if (!dirs.success) throw new Error(dirs.message || '创建目录失败');

    updateStepStatus(8, 'success', (mig.output || mig.message) + "\n\n" + (dirs.message || ''));
    showSuccess();

  } catch (e) {
    alert('部署失败：' + (e.message || e));
    btn.disabled = false;
    btn.textContent = '🚀 重新部署';
  }
}

window.addEventListener('DOMContentLoaded', async () => {
  $('deployBtn').addEventListener('click', startDeploy);

  $('saveCfgBtn').addEventListener('click', async () => {
    try {
      const msg = await saveConfig();
      alert(msg);
    } catch (e) {
      alert('保存失败：' + (e.message || e));
    }
  });

  $('closeCfgBtn').addEventListener('click', () => showModal(false));
  $('openCfgBtn').addEventListener('click', async () => {
    try { await loadEnvAndMaybeAskConfig(true); } catch (_) {}
  });
  $('refreshEnvBtn').addEventListener('click', async () => {
    try { await loadEnvAndMaybeAskConfig(false); } catch (_) {}
  });

  // 页面加载先刷新环境；检测不到 XAMPP 会自动弹窗
  try { await loadEnvAndMaybeAskConfig(false); } catch (_) {}
});
