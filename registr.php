<?
include('connect.php');
session_start();
if(isset($_SESSION['uid'])){
    $session_uid = $_SESSION['uid'];
    $sql = "SELECT * FROM registr WHERE id = $session_uid";
    $result = $connect -> query($sql);
    $user = $result -> fetch_assoc();
    $userid = $user['id'];
}
if($_GET['do'] == 'exit'){
    session_unset();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>CarForMe</title>
</head>
<?
include('header.php');
?>
<?
if(isset($_POST['reg'])){
    $name = $_POST['name'];
    $login = $_POST['login'];
    $number = $_POST['number'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];
    
    if(empty($name)){
        $error .= '<p>Введите имя</p>';
    }
    if(empty($login)){
        $error .= '<p>Введите логин</p>';
    }
    if(empty($number)){
        $error .= '<p>Введите номер телефона</p>';
    }
    if(empty($pass)){
        $error .= '<p>Введите пароль</p>';
    }
    if(empty($pass2)){
        $error .= '<p>Введите повторите пароль</p>';
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $error .= '<p>Неверный формат почты</p>';
    }
    $sql = "SELECT * FROM registr WHERE login = '$login'";
    $result = $connect -> query($sql);
    $num = $result -> num_rows;
    if($num){
        $error .= '<p>Вы зарегистрированы</p>';
    }
    if($pass != $pass2){
        $error .= '<p>Пароли не совпадают</p>';
    }
    if(empty($error)){
        $pass_md5 = md5($pass);
        $sql = "INSERT INTO registr (name,number,login,pass,level) VALUES ('$name','$number','$login','$pass_md5','0')";
        $connect -> query($sql);
        echo '<script> alert ("Вы зарегистрированы")</script>';
        echo '<script>document.location.href="index.php"</script>';
    
    }
}
?>
<body>
    <section>
        <div class="form-main">
            <div class="form-content">
                <form method="POST" name="reg" class="form">
                    <input type="text" placeholder="Имя" name="name">
                    <input type="text" placeholder="Логин" name="login">
                    <input type="tel" autocomplete="tel" placeholder="8(000)000-00-00" name="number" id="number" >
                    <input type="password" placeholder="Пароль" name="pass">
                    <input type="password" placeholder="Повторите пароль" name="pass2">
                    <? echo $error ?>
                    <input type="submit" value="Зарегистрироваться" name="reg">
                </form>
            </div>
        </div>
    </section>

<?
include('header.php');
?>
<script src="./assets/js/main.js"></script>
</body>
</html>