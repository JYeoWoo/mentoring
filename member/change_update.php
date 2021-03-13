<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";

    if(!isset($_SESSION['check']) || $_SESSION["check"] != 'true'){
        echo '<script>alert("수상한 접근입니다!");
        location.href ="/";
        </script>';
        exit;
    }

    $id=$_SESSION["id"];
    $sql = mq("select * from member where id='".$id."'");
    $list = $sql -> fetch_array();
    $name = $list['name'];
?>

<!doctype html>
<head>
    <title>회원 정보 수정</title>
    <meta charset="utf-8">
</head>
<body>
    <form action="/member/change_ok.php" method="post">
        닉네임 번경: <input type="text" id="uname" name="name" value=<?php echo $name;?>>
        <input type="button" value="닉네임 중복 확인" onclick="checkname();">
        비밀번호 변경: <input type="password" name="pw" placeholder="비밀번호">
        <input type="submit" value="수정">
    </form>
    <a href="/">취소</a>
</body>
</html>

<script>
    function checkname(){
        var username = document.getElementById("uname").value;
        if(username){
            var url = "/member/check.php?cusername="+username;
            window.open(url,"chkid","width=300,height=300");
        }
        else{
            alert("닉네임를 입력하세요.");
        }
    }
</script>