<header>
    <div class="container">
        <div class="header">
            <div class="header-item">
                <div class="header-content">
                    <ul class="header-menu">
                        <a href="" class="header-link"><li>Контакты</li></a>
                        <?
                        if($session_uid = $_SESSION['uid']){
                            echo '<a href="kabinet.php" class="header-link"><li>Личный кабинет</li></a>';
                        }else{
                            echo '<a href="autoriz.php" class="header-link"><li>Вход</li></a>
                                <a href="registr.php" class="header-link"><li>Регистрация</li></a>';
                        }
                        ?>
                        <a href="" class="header-link"><li>О нас</li></a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-off -->