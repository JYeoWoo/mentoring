<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    $id = $_SESSION['id'];
    $pw = $_POST['pw'];

    $sql = mq("SELECT * from member where id = '"."$id"."'");
    $member = $sql -> fetch_array();
    $c_pw = $member["pw"];

    if(password_verify($pw, $c_pw)){
        $_SESSION["check"] = 'true';
        
        echo '<script>location.href = "/member/change_update.php";</script>';
    }
    else{
        echo '<script>alert("비밀번호가 틀렸습니다.")
            history.go(-1);
        </script>';
    }
?>
