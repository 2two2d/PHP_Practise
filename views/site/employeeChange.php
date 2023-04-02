<?php
    if(gettype($message) == 'string'){
        echo '<p style="color: limegreen">'.$message.'</p>';
    }else{
        foreach($message as $key => $value){
            foreach($value as $error){
                echo '<p style="color: red">'.$error.'</p>';
            }
        }
    }
?>
<div>
    <form action="" method="POST" enctype="multipart/form-data">
        <img src="<?= '/PHP_PRACTICE/public/Images/'.$employee->ava;?>" alt="img" width="150" height="150" style="margin: 25px auto 25px auto">
        <label for="">Изменить аватарку<input name="ava" type="file"></label>
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <label for="">Имя<br><input type="text" name="name" value="<?=$employee->name;?>"></label><br>
        <label for="">Фамилия<br><input type="text" name="surname" value="<?=$employee->surname;?>"></label><br>
        <label for="">Отчество<br><input type="text" name="midlename" value="<?=$employee->midlename;?>"></label><br>
        <label for="">Пол<br>
            <select name="sex" id="">
                <option <?php if($employee->sex == 'м'): echo 'selected'; endif;?> value="м">Мужчина</option>
                <option <?php if($employee->sex == 'ж'): echo 'selected'; endif;?> value="ж">Женщина</option>
            </select></label><br>
        <label for="">Дата рождения<br><input type="date" name="birthday" value="<?=$employee->birthday;?>"></label><br>
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