<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    $idx = $_POST['r_idx'];
    $return_idx = $_POST['idx'];
    $sql = mq('SELECT * FROM reply where idx="'.$idx.'"');
    $list = $sql -> fetch_array();
    $id = $list['id'];

    if($_SESSION['id']==$id){
        mq('DELETE FROM reply where idx = "'.$idx.'"');
    }
    echo '<script>
            location.href = "/page/read.php?idx='.$return_idx.'";
        </script>';
?>