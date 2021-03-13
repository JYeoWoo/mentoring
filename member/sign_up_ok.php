<?php
    include $_SERVER['DOCUMENT_ROOT']."/db.php";

    $id=$_POST["id"];
    $pw=password_hash($_POST["pw"], PASSWORD_DEFAULT);
    $name=$_POST["name"];

    if(!(isset($id) && isset($pw) && isset($name))){
        echo '<script>alert("빈 칸이 있습니다.");
        history.go(-1);
        </script>';
        exit;
    }


    $id_sql = mq("select * from member where id='".$id."'");
    $id_member = $id_sql -> fetch_array();
    
    if($id_member!=0){
        echo '<script>alert("사용 중인 아이디 입니다.");
        history.go(-1);</script>';
        exit;
    }

    $name_sql = mq("select * from member where name='".$name."'");
    $name_member = $name_sql -> fetch_array();

    if($name_member!=0){
        echo '<script>alert("사용 중인 닉네임 입니다.");
        history.go(-1);</script>';
        exit;
    }

    else{
    $sql = mq("INSERT INTO member(id, pw, name) VALUES('".$id."', '".$pw."', '".$name."')");
    }
?>
<script>
    alert("회원가입이 완료되었습니다.");
    location.href='/';
</script>
<meta charset="utf-8">