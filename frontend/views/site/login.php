<?php
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = '后台登录';
?>

<div class="site-login container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h1 class="h4 text-gray-900">抗战纪念队后台管理</h1>
                    </div>
                    <form id="loginForm">
                        <div class="form-group">
                            <input type="text" class="form-control" id="username" placeholder="用户名" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" placeholder="密码" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="captcha" placeholder="验证码" required>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <img src="img/captcha.jpg" alt="验证码" style="height:40px;margin-right:10px;">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">记住我</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">登录</button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?= Url::to(['site/forgot-password']) ?>">忘记密码？</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="<?= Url::to(['site/index']) ?>">返回前台</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const loginForm = document.getElementById('loginForm'); if(loginForm){ loginForm.addEventListener('submit', function(e){ e.preventDefault(); const username = document.getElementById('username').value; const password = document.getElementById('password').value; const captcha = document.getElementById('captcha').value; if(username === 'admin' && password === 'admin123' && captcha === '1234'){ window.location.href = 'admin.html'; } else { alert('用户名、密码或验证码错误！'); } }); }
</script>
