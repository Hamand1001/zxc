<?
    $connect = new mysqli('localhost','root','','zxc');

    if($connect -> connect_errno){
        echo '-';
    }else{
        echo '';
    }
    if(!$connect -> set_charset("utf8")){
        echo 'Ошибка кодировки';
    }
?>