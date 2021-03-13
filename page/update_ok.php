<?php
    include $_SERVER['DOCUMENT_ROOT']."/db.php";
    if(!isset($_SESSION["id"])){
        echo '<script>
            alert("회원이 아닙니다.");
            history.go(-1);
        </script>';
        exit;
    }
    $title=$_POST["title"];
    $idx=$_POST["idx"];
    $content=$_POST["content"];

    if($title!='' && $content!=''){
        $sql = mq("UPDATE board SET title = '".$title."', content = '".$content."' WHERE idx = '".$idx."' ");
        echo '<script>alert("글 수정에 성공하였습니다.");</script>';
        echo '<script>
            location.href="/page/read.php?idx='.$idx.'";
        </script>';
    }
    else{
        echo '
        <script>alert("글 수정에 실패하였습니다.");
        </script>';
        echo '<script>
            location.href="/page/read.php?idx='.$idx.'";
        </script>';
    }
?>
