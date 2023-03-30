<div>
    <form action="" method="POST">
        <label for="">Имя пользователя<br><input type="text" name="username" value="<?=$employee->username;?>"></label><br>
        <label for="">Имя<br><input type="text" name="name" value="<?=$employee->name;?>"></label><br>
        <label for="">Фамилия<br><input type="text" name="surname" value="<?=$employee->surname;?>"></label><br>
        <label for="">Отчество<br><input type="text" name="midlename" value="<?=$employee->midlename;?>"></label><br>
        <label for="">Пол<br>
            <select name="sex" id="">
                <option <?php if($employee->sex == 'м'): echo 'selected'; endif;?> value="м">Мужчина</option>
                <option <?php if($employee->sex == 'ж'): echo 'selected'; endif;?> value="ж">Женщина</option>
            </select></label><br>
        <label for="">Дата рождения<br><input type="text" name="birthday" value="<?=$employee->birthday;?>"></label><br>
        <label for="">Адрес<br><input type="text" name="adress" value="<?=$employee->adress;?>"></label><br>
        <label for="">Отдел</br><select name="department" id="">
                <?php foreach ($departments as $depatment){?>
                    <option value="<?= $depatment->name?>" <?php if($depatment->name == $employee->depatmant): echo 'selected'; endif;?>><?= $depatment->name?></option>
                <?php };?>
            </select></label></br>
        <label for="">Состав</br><select name="staff" id="">
                <?php foreach ($staffs as $staff){?>
                    <option value="<?= $staff->name?>" <?php if($staff->name == $employee->staff): echo 'selected'; endif;?>><?= $staff->name?></option>
                <?php };?>
            </select></label></br>
        <label for="">Должность</br><select name="post" id="">
                <?php foreach ($posts as $post){?>
                    <option value="<?= $post->name?>" <?php if($post->name == $employee->post): echo 'selected'; endif;?>><?= $post->name?></option>
                <?php };?>
            </select></label></br>
        <input type="submit" value="Изменить данные">
    </form>
</div>
<style>
    div{
        display: flex;
        flex-direction: column;
        width: 100vw;
        align-items: center;
    }
    div > form{
        margin-top: 20px;
        width: 300px;
        padding: 5px;
        background-color: lightblue;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: start;
        justify-content: space-around;
    }
</style>