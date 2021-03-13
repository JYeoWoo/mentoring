<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";

    if(!isset($_SESSION["id"])){
        echo '<script>
            alert("회원이 아닙니다.");
            history.go(-1);
        </script>';
        exit;
    }

    $content = $_POST['reply'];
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $idx = $_POST['idx'];

    if($content!=''){
        $mqq = mq("alter table reply auto_increment =1");
        $sql = mq("INSERT INTO reply(id, con_num, content, name) VALUES('$id', '$idx','$content', '$name')");
        echo '<script>alert("댓글 작성에 성공하였습니다.");</script>';
        echo '<script>
            location.href = "/page/read.php?idx='.$idx.'";
        </script>';

    }
    else{
        echo '
        <script>alert("댓글 작성에 실패하였습니다.");
            history.go(-1);
        </script>
        ';
    }


?>