<?php error_reporting(E_ERROR | E_PARSE);?>
<?php foreach($message as $key => $value){
    foreach($value as $error){
        echo '<p style="color: red">'.$error.'</p>';
    }
}?>
<form action="" method="POST">
    <input type="text" name="role_id" value="<?= $role_id ?>" hidden>
    <div id="pointOne">
        <label for="">Имя пользователя</br><input name="username" type="text"></label></br>
        <label for="">Почта</br><input name="email" type="text"></label></br>
        <label for="">Пароль</br><input name="password" type="password"></label></br>
        <button type="button" onclick="setPointTwo()">Дальше</button>
    </div>
    <div id="pointTwo">
        <?php if($role_id == 2): ?>
            <input type="text" hidden value="Кадровый отдел" name="department">
            <input type="text" hidden value="Кадровые менеджеры" name="staff">
            <input type="text" hidden value="Младший кадровый менеджер" name="post">
        <?php endif;?>
        <label for="">Фамилия</br><input name="surname" type="text"></label></br>
        <label for="">Имя</br><input name="name" type="text"></label></br>
        <label for="">Отчество</br><input name="midlename" type="text"></label></br>
        <label for="">Пол</br><select name="sex" id="">
                <option value="м">Мужчина</option>
                <option value="ж">Женщина</option>
            </select></label></br>
        <label for="">Дата рождения</br><input name="birthday" type="date"></label></br>
        <label for="">Адрес прописки</br><input name="adress" type="text"></label></br>
        <div>
            <button type="button" onclick="setPointOne()">Назад</button>
            <?php if($role_id == 1):?>
                <button type="button" onclick="setPointThree()">Дальше</button>
            <?php else:?>
                <input type="submit" value="Зерегестрировать">
            <?php endif;?>
        </div>
    </div>
    <div id="pointThree">
        <label for="">Отдел</br><select name="department" id="">
                <?php foreach ($departments as $depatment){?>
                    <option value="<?= $depatment->name?>"><?= $depatment->name?></option>
                <?php };?>
            </select></label></br>
        <label for="">Состав</br><select name="staff" id="">
                <?php foreach ($staffs as $staff){?>
                    <option value="<?= $staff->name?>"><?= $staff->name?></option>
                <?php };?>
            </select></label></br>
        <label for="">Должность</br><select name="post" id="">
                <?php foreach ($posts as $post){?>
                    <option value="<?= $post->name?>"><?= $post->name?></option>
                <?php };?>
            </select></label></br>
        <div>
            <button type="button" onclick="setPointTwo()">Назад</button>
            <input type="submit" value="Зерегестрировать">
        </div>
    </div>
</form>
<script type="text/javascript">
    let pointOne = document.querySelector('#pointOne')
    let pointTwo = document.querySelector('#pointTwo')
    let pointThree = document.querySelector('#pointThree')

    function setPointOne(){
        pointOne.style.display = 'flex'
        pointTwo.style.display = 'none'
        pointThree.style.display = 'none'
    }

    function setPointTwo(){
        pointOne.style.display = 'none'
        pointTwo.style.display = 'flex'
        pointThree.style.display = 'none'
    }

    function setPointThree(){
        pointOne.style.display = 'none'
        pointTwo.style.display = 'none'
        pointThree.style.display = 'flex'
    }

    setPointOne()
</script>
<style>
    form{
        display: flex;
        flex-direction: column;
        width: 100vw;
        align-items: center;
    }
    form > div{
        margin-top: 100px;
        width: 300px;
        padding: 5px;
        background-color: lightblue;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
    }
    form > div > label, form > div > div{
        margin: 10px 0 10px 0;
    }
</style>
