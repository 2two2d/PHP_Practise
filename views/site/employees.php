<?php error_reporting(E_ERROR | E_PARSE);?>
<div id="employeesBlock">
    <?php if($evgBirthday):?>
    <h2 style="margin-bottom: 20px">Средний возраст сотрудников: <?php echo $evgAge; ?></h2>
    <?php endif;?>
    <div id="searchBlock">
        <form action="" method="get">
            <label for="">Отдел: <select name="department" id="">
                    <?php foreach ($departments as $department){?>
                        <option value="<?= $department->name?>"><?= $department->name?></option>
                    <?php };?>
                </select></label>
            <input type="submit" value="Поиск">
        </form>
        <form action="" method="get">
            <label for="">Состав: <select name="staff" id="">
                    <?php foreach ($staffs as $staff){?>
                        <option value="<?= $staff->name?>"><?= $staff->name?></option>
                    <?php };?>
                </select></label>
            <input type="submit" value="Поиск">
        </form>
        <a class="changeBtn" href="<?= app()->route->getUrl('/employees') ?>">Показать всех сотрудников</a>
    </div>
    <?php if($employees[0]):?>
    <ul>
        <?php foreach ($employees as $employee){?>
            <li>
                <div class="employeeCard">
                    <p><?= $employee->surname?> <?= $employee->name?> <?= $employee->midlename?> (<?= $employee->post?>)</p>
                    <div>
                        <a class="changeBtn" href='<?= app()->route->getUrl("/employee_change?username=$employee->username")?>'>Изменить</a>
                        <a class="deleteBtn" href='<?= app()->route->getUrl("/employee_delete?username=$employee->username")?>'>Удалить</a>
                    </div>
                </div>
            </li>
        <?php };?>
    </ul>
    <?php else: ?>
    <h3 id="noEmployees">Здесь пока нет сотрудников!</h3>
    <?php endif;?>
</div>
<style>
    #noEmployees{
        margin: auto;
        margin-top: 100px;
    }
    #employeesBlock{
        margin-top: 100px;
        width: 100vw;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    #searchBlock{
        width: 80vw;
        margin: 10px auto 10px auto;
        height: 40px;
        border-bottom: 2px solid black;
        border-top: 2px solid black;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }
    .employeeCard{
        display: flex;
        width: 800px;
        justify-content: space-between;
    }
    .employeeCard > div{
        display: flex;
    }
    .changeBtn{
        display: block;
        padding: 5px;
        text-decoration: none;
        background-color: lightblue;
        color: black;
    }
    .deleteBtn{
        display: block;
        width: 70px;
        padding: 5px;
        text-decoration: none;
        background-color: orangered;
        color: black;
    }
</style>
