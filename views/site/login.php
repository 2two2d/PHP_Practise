<h3><?= $message ?? ''; ?></h3>

<h3><?= app()->auth->user()->username ?? ''; ?></h3>
<?php
if (!app()->auth::check()):
    ?>
    <form method="post">
        <label>Имя пользователя <br><input type="text" name="username"></label>
        <label>Пароль <br><input type="password" name="password"></label>
        <button>Войти</button>
    </form>
<?php endif;?>
<style>
    form{
        margin: auto;
        margin-top: 100px;
        width: 300px;
        height: 300px;
        background-color: lightblue;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
    }
</style>
