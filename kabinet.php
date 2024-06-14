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
<body>
<?
include('header.php');
?>
<section>
    <div class="home">
        <div class="container">
            <div class="home-item">
                <div class="home-content">
                    <img src="<?=$user['img'];?>" alt="" class="avatar-img">
                    <? if (isset($_SESSION['uid'])) { ?>
                    <h3 class="name-title"><?=$user['name'];?></h3>
                    <p class="email-title"><?=$user['email'];?></p>
                    <? } ?>
                    <div class="kabinet-info-btn margin">
                        <a href="order.php" class="header-lin">Заказать авто</a>
                        <?php 
                        if($user['level'] == 1){?>
                            <a href="add.php" class="header-link">Добавить авто</a>
                            <a href="check-list.php" class="header-link">Заказы</a>
                        <?}?> 
                    </div>
                    <hr class="home-line">
                    <div class="tour-list">
                        <div class="tour-status">
                            <a href="?" class="tour-category">Мои заказы</a>
                            <?php
                            if ($user['level'] == 0) {
                                $sql = "SELECT * FROM `order_tovar` WHERE user_id = $userid";
                                $result = $connect->query($sql);
                                while ($row = $result -> fetch_assoc()) {
                                    $tovar = $row["tovar_id"];  
                                    $sq = "SELECT * FROM `tovars` WHERE id = '$tovar' ";
                                    $re = $connect -> query($sq);
                                    $tadd = $re -> fetch_assoc();
                                ?>
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <div class="main-section">
                                        <p class="section-info-left">Название товара:<?= $tadd['name'] ?><br><span class="color"></span></p>
                                            <p class="section-info-center">Адрес доставки:<?= $row['adress'] ?></p>
                                            <p class="section-info-center">Количество:<?= $row['num'] ?></p>
                                            <p class="section-info-right">Статус заказа:
                                                <?php 
                                                if($row['status'] == 0){ echo 'На модерации';}
                                                if($row['status'] == 1){ echo 'Отправлен';} 
                                                if($row['status'] >= 2){ echo 'Доставлен';} ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                }
                            ?>
                            <?php
                            if ($user['level'] == 1) {
                                $sql = "SELECT * FROM `order_tovar`";
                                $result = $connect->query($sql);
                                while ($row = $result -> fetch_assoc()) {
                                    $tovar = $row["tovar_id"];  
                                    $sq = "SELECT * FROM `tovars` WHERE id = '$tovar' ";
                                    $re = $connect -> query($sq);
                                    $tadd = $re -> fetch_assoc();
                                ?>
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <div class="main-section">
                                            <p class="section-info-left">Название товара:<?= $tadd['name'] ?><br><span class="color"></span></p>
                                            <p class="section-info-center">Адрес доставки:<?= $row['adress'] ?></p>
                                            <p class="section-info-center">Количество:<?= $row['num'] ?></p>
                                            <p class="section-info-right">Статус заказа:<?= $row['status'] ?></p>
                                            <a href="up.php?id=<?=$row['id']?>">Поднять статус</a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
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