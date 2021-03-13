<!doctype html>
<head>
    <title>회원가입</title>
    <meta charset="utf-8">
    <link rel="stylesheet" tpye="text/css" href="/css/style.css" />>
</head>

<body>
    <form action="/member/sign_up_ok.php" method="post">
        ID <input type="text" id="uid" name="id" placeholder ="아이디">
        <input type="button" value="ID 중복 확인" onclick="checkid();">
        PW <input type="password" name="pw" placeholder ="비밀번호">
        NAME <input type="text" id ="uname" name="name" placeholder ="닉네임">
        <input type="button" value="닉네임 중복 확인" onclick="checkname();">
        <input type="submit" value="제출">
    </form>
</body>

<script>
function checkid(){
    var userid = document.getElementById("uid").value;
    if(userid){
        var url = "/member/check.php?userid="+userid;
        window.open(url,"chkid","width=300,height=300");
    }
    else{
        alert("아이디를 입력하세요.");
    }
}

function checkname(){
    var username = document.getElementById("uname").value;
    if(username){
        var url = "/member/check.php?username="+username;
        window.open(url,"chkid","width=300,height=300");
    }
    else{
        alert("닉네임를 입력하세요.");
    }
}

</script>