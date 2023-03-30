<div id="employeesBlock">
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
        width: 70px;
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
