<div id="message">
    <h2>Сотрудник - [<?= $employee->surname;?> <?= $employee->name;?> <?= $employee->midlename;?>] успешно удалён!</h2>
    <a class="changeBtn" href="<?= app()->route->getUrl('/employees')?>">Назад</a>
</div>
<style>
    #message{
        margin: 100px auto 0 auto;
        width: 800px;
        height: 20px;
    }
    .changeBtn{
        display: block;
        width: 70px;
        padding: 5px;
        text-decoration: none;
        background-color: lightblue;
        color: black;
    }
</style>