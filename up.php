<?php
include('connect.php');

 if(isset($_GET['id'])){
    $get_id = $_GET['id'];
        $wer = "SELECT * FROM order_tovar WHERE id=$get_id";
        $rew = $connect -> query("$wer");
        $rev = $rew -> fetch_assoc();
        $pop = $rev["status"];
        $pop = $pop + 1;
        $sql = "UPDATE order_tovar SET status = '$pop' WHERE id=$get_id";
        $connect -> query($sql);
        echo '<script>document.location.href="kabinet.php"</script>';
    }
?>