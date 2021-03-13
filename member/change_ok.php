<?php
    include $_SERVER['DOCUMENT_ROOT']."/db.php";
    $id=$_SESSION["id"];
    $pw=password_hash($_POST["pw"], PASSWORD_DEFAULT);
    $name=$_POST["name"];

    if(!(isset($pw) && isset($name))){
        echo '<script>alert("빈 칸이 있습니다.");
        history.go(-1);
        </script>';
        exit;
    }

    $name_sql = mq("select * from member where name='".$name."'");
    $name_member = mysqli_num_rows($name_sql);

    if($name_member>1){
        echo '<script>alert("사용 중인 닉네임 입니다.");
        history.go(-1);</script>';
        exit;
    }
    else{
        $sql = mq("UPDATE member SET pw = '".$pw."', name = '".$name."' WHERE id = '".$id."' ");
    }


?>

<script>
    alert("수정이 완료되었습니다.");
    location.href='/';
</script>
<meta charset="utf-8">