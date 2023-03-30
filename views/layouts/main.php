<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main site</title>
</head>
<body>
<nav>
    <a class="btn" href="<?= app()->route->getUrl('/about') ?>">Главная</a>
    <?php if(app()->auth->roleId() > 0):?>
        <a class="btn" href="<?= app()->route->getUrl('/personal_data') ?>">Личные данные</a>
        <?php if(app()->auth->roleId() >= 2):?>
            <a class="btn" href="<?= app()->route->getUrl('/employees') ?>">Сотрудники</a>
        <?php endif;?>
    <?php endif;?>
    <?php if(app()->auth->roleId() == 0):?>
        <a class="btn" href="<?= app()->route->getUrl('/login') ?>">Вход</a>
    <?php else:?>
        <a class="btn" href="<?= app()->route->getUrl('/logout') ?>">Выход</a>
    <?php endif;?>
    <?php if(app()->auth->roleId() >= 2):?>
        <a class="btn" href="<?= app()->route->getUrl('/employee_register') ?>">Регистарция сотрудника</a>
        <?php if(app()->auth->roleId() >= 3):?>
            <a class="btn" href="<?= app()->route->getUrl('/admin_register') ?>">Регистрация администратора</a>
        <?php endif;?>
    <?php endif;?>
</nav>
<?php if(app()->auth->roleId() != 0):?>
    <h3>Текущий пользователь: <?= app()->auth->user()->username ?? ''; ?></h3>
<?php endif;?>
<div>
    <?= $content ?? ''; ?>
</div>

</body>
<style>
    *{
        margin: 0;
        padding: 0;
    }

    nav{
        background-color: lightblue;
        width: 100vw;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .btn{
        text-decoration: none;
        color: black;
        font-size: 1.2em;
        font-weight: 900;
    }


</style>
</html>

