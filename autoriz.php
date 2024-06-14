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
if(isset($_POST['aut'])){
    $login = $_POST['login'];
    $pass_md5 = md5($_POST['pass']);
    
    if(empty($login)){
        $error .= '<p>Введите логин</p>';
    }else{
        $sql = "SELECT * FROM registr WHERE login = '$login'";
        $result = $connect -> query($sql);
        $num = $result -> num_rows;
        if(empty($num)){
            $error .= '<p>Вы зарегистрированы</p>';
        }else{
            $sql = "SELECT * FROM registr WHERE login = '$login' AND pass = '$pass_md5'";
            $result = $connect -> query($sql);
            $num = $result -> num_rows;
            if($num == 0){
                $error .= '<p class="text">Неверный логин или пароль</p>';
            }
        }
    }
   
    
    if(empty($error)){
        $row = $result->fetch_assoc();
        $_SESSION['uid'] = $row['id'];
        echo '<script> alert ("Вы авторизировались")</script>';
        echo '<script>document.location.href="kabinet.php"</script>';
    }
}
?>
<body>
    <section>
        <div class="form-main">
            <div class="form-content">
                <form method="POST" name="aut" class="form">
                    <input type="text" placeholder="Логин" name="login">
                    <input type="password" placeholder="Пароль" name="pass">
                    <? echo $error ?>
                    <input type="submit" value="Зарегистрироваться" name="aut">
                </form>
            </div>
        </div>
    </section>

<?
include('header.php');
?>   
</body>
</html>