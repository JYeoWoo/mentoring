<?php
    include $_SERVER['DOCUMENT_ROOT']."/db.php";

    $id = $_POST['id'];
    $pw = $_POST['pw'];

    if(!(isset($id)&&(isset($pw)))){
        echo '<script>alert("아이디나 패스워드를 입력하세요.");
            history.go(-1);
        </script>';
    }
    else{
        $sql = mq("SELECT * from member where id = '"."$id"."'");
        $member = $sql -> fetch_array();
        $c_pw = $member["pw"];

        if(password_verify($pw, $c_pw)){
            $_SESSION["id"] = $id;
            $_SESSION['name'] = $member['name'];
            
            echo '<script>alert("반갑습니다.");
                location.href = "/";
            </script>';
        }
        else{
            echo '<script>alert("아이나 혹은 비밀번호가 틀렸습니다.")
                history.go(-1);
            </script>';
        }

    }
  
?>
<meta charset="utf-8">