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
    $name=$_SESSION["id"];
    $content=$_POST["content"];

    if (isset($_FILES)){
        $tmpfile = $_FILES['file']['tmp_name'];
        $o_name = $_FILES['file']['name'];
        $filename = iconv("UTF-8", "EUC-KR", $_FILES['file']['name']);
        $folder = "../upload/".$filename;
        move_uploaded_file($tmpfile, $folder);
    }

    $date=date('Y-m-d');
    if($title!='' && $content!=''){
        if (isset($_FILES)){
            $mqq = mq("alter table board auto_increment =1");
        // $sql = mq("INSERT INTO board(title, content, name, date) VALUES('".$title."', '".$content."', '".$name."', '".$date."')");
            $sql = mq("INSERT INTO board(title, content, name, date, file) VALUES('$title', '$content', '$name', '$date' , '$o_name')");

        }
        else{
            echo "됐낭";
            $mqq = mq("alter table board auto_increment =1");
        // $sql = mq("INSERT INTO board(title, content, name, date) VALUES('".$title."', '".$content."', '".$name."', '".$date."')");
            $sql = mq("INSERT INTO board(title, content, name, date) VALUES('$title', '$content', '$name', '$date')");
        }
        echo '<script>alert("글쓰기에 성공하였습니다.");</script>';
        echo '<script>
            location.href = "/";
        </script>';

    }
    else{
        echo '
        <script>alert("글쓰기에 실패하였습니다.");
            history.go(-1);
        </script>
        ';
    }
?>
