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
    <title>Carforme</title>
</head>
<body>
<?
include('header.php');
?>
    <!-- banner -->
    <section>
        <div class="banner">
            <div class="container">
                <div class="banner-item">
                    <div class="banner-content">
                        <div class="banner-txt">
                            <h2>CarForMe</h2>
                            <p>Вы выбрали нас, а мы выбираем авто для вас</p>
                        </div>
                        <div class="banner-img"><img src="" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?
include('header.php');
?>
</body>
</html>