<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    // $uid = $_GET["userid"];
    // $uname = $_GET["username"];

    if(isset($_GET["userid"])){
        $uid = $_GET["userid"];
        $sql = mq("select * from member where id='".$uid."'");
        $member = $sql -> fetch_array();
        if($member==0){
            echo $uid."는 사용 가능한 아이디 입니다.";
        }
        else{
            echo $uid."는 이미 사용중인 아이디 입니다.";
        }
    }

    if(isset($_GET["username"])){
        $uname = $_GET["username"];
        $sql = mq("select * from member where name='".$uname."'");
        $member = $sql -> fetch_array();
        if($member==0){
            echo $uname."는 사용 가능한 닉네임 입니다.";
        }
        else{
            echo $uname."는 이미 사용중인 닉네임 입니다.";
        }
    }

    if(isset($_GET["cusername"])){
        $uname = $_GET["cusername"];
        $sql = mq("select * from member where name='".$uname."'");
        $member = mysqli_num_rows($sql);
        if($member<2){
            echo $uname."는 사용 가능한 닉네임 입니다.";
        }
        else{
            echo $uname."는 이미 사용중인 닉네임 입니다.";
        }
    }
    
?>