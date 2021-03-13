<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    $idx = $_POST['idx'];
    $sql = mq('SELECT * FROM board where idx="'.$idx.'"');
    $list = $sql -> fetch_array();
    $name = $list['id'];

    if($_SESSION['id']==$name){
        mq('DELETE FROM board where idx = "'.$idx.'"');
    }
?>

<script>location.href="/";</script>