<?php

include $_SERVER['DOCUMENT_ROOT']."/db.php";

$date = date('Y-m-d');
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$sql = mq("insert into board(name,pw,title,content,date) values('".$_POST['ame']."','".$userpw."','".$_POST['title']."','".$_POST['content']."','".$date."')"); 
if($sql==0){
    echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='/';</script>";
}else{
    echo $sql;
    echo "<script>
    alert('글쓰기에 실패했습니다.');
    history.back();</script>";
}
?>
