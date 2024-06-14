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
if(isset($_POST['order'])){
    $adress = $_POST['adress'];
    $num = $_POST['num'];
    $tovar_id = $_POST['tovar_id'];
    $user_id = $userid;
    if(empty($adress)){
        $error .= '<p>Введите адрес</p>';
    }
    if(empty($num)){
        $error .= '<p>Введите количество</p>';
    }
    
    if(empty($error)){
        $sql = "INSERT INTO order_tovar (adress,num,tovar_id,user_id,status) VALUES ('$adress','$num','$tovar_id','$user_id','0')";
        $connect -> query($sql);
        echo '<script> alert ("Вы заказ отправлен на рассмотрение")</script>';
        echo '<script>document.location.href="index.php"</script>';
        
    
    }
}
?>
<body>
    <section>
        <div class="form-main">
            <div class="form-content">
                <form method="POST" name="order" class="form">
                    <input type="text" placeholder="Адрес" name="adress">
                    <input type="number" placeholder="Количество" name="num">
                    <select name="tovar_id" id="select" style="color: black;">
                        <option value="0" style="color: black;">Выберите товар</option>
                        <?php
                            $sq = "SELECT * FROM tovars";
                            $res = $connect -> query($sq);
                            while($cat = $res -> fetch_assoc()){?>
                                <option value="<?=$cat['id']?>" style="color: black;"><?=$cat['name']?></option>
                            <?}
                        ?>
                    </select>
                    <? echo $error ?>
                    <input type="submit" value="Отправить" name="order">
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