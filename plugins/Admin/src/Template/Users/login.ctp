<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if (isset($systemData['systemlogin'])) {echo $systemData['systemlogin'];}?></title>
    <?php echo $this->Html->meta('icon');?>
    <?php echo $this->Html->css('admin/login.css');?>
</head>
<body>
<header class="home-header">
    <?php
        if (isset($systemData['systemlogo']) && is_file($systemData['systemlogo'])) {
            ?>
            <a href="<?php echo $this->request->base;?>/">
                <img class="logo" src="<?php echo $this->request->base . DS . $systemData['systemlogo'];?>">
            </a>
            <?php
        }
    ?>
</header>
<section class="box vertical home-wrapper">
    <div class="login-body">
        <div class="text-center login-title"><?php if (isset($systemData['systemlogin'])) {echo $systemData['systemlogin'];}?></div>
        <div class="box">
            <div class="box-aw login-box">
                <div class="account-login tab-box">
                    <form action="<?php echo $this->request->here();?>" autocomplete="off" method="post">
                        <div class="login-form form-wrapper">
                            <?php
                            $flash = $this->Flash->render('tip');
                            if (!empty($flash)) {
                                ?><div class="form-tips"><?php echo $flash;?></div><?php
                            }
                            ?>
                            <div class="form-item">
                                <input type="text" name="username" placeholder="用户名">
                            </div>
                            <div class="form-item">
                                <input type="password" name="password" placeholder="请输入密码">
                            </div>
                            <div class="form-item form-button">
                                <button type="submit" class="btn btn-green block">登录</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>