<div id="personalDataBlock">
    <p>Имя: <?= $employee->name;?></p>
    <p>Фамилия: <?= $employee->surname;?></p>
    <p>Отчество: <?= $employee->midlename;?></p>
    <p>Пол: <?= $employee->sex;?></p>
    <p>Дата рождения: <?= $employee->birthday;?></p>
    <p>Адрес проживания: <?= $employee->adress;?></p>
    <p>Отделение: <?= $employee->department;?></p>
    <p>Состав: <?= $employee->staff;?></p>
    <p>Должность: <?= $employee->post;?></p>
</div>
<style>
    #personalDataBlock{
        margin: 100px auto 0 auto;
        width: 500px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: start;
        justify-content: space-around;
        border: 2px solid black;
        border-radius: 20px;
    }

    #personalDataBlock > p{
        display: block;
        margin-bottom: 20px;
    }
</style>
