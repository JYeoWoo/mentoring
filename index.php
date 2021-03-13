<?php
    include $_SERVER['DOCUMENT_ROOT']."/db.php";
?>
<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>
    <div>
        <h1>게시판</h1>
        <?php
            $_SESSION['check'] = 'false';
            if(isset($_SESSION['id'])){
            echo "<h4>{$_SESSION['name']}님 환영합니다. </h4>";

            echo '
                <form action="/member/logout.php" method="post">
                    <input type="submit" value="로그아웃">
                </form>

                <form action="/member/change_check.php" method="post">
                    <input type="submit" value="회원 정보 변경">
                </form>
            ';
            }
            else{
                echo '
                    <form action="/member/login.php" method="post">
                        <input type="text" name="id" placeholder ="아이디">
                        <input type="password" name="pw" placeholder ="비밀번호">
                        <input type="submit" name="subm" value="로그인"></input>
                    </form>
                    <a href="/member/sign_up.php">회원가입</a>
                ';
            }
        ?>
        <table class ="list-table">
            <thead>
                <tr>
                    <th width="70">번호</th>
                    <th width="500">제목</th>
                    <th width="120">글쓴이</th>
                    <th width="100">작성일</th>
                    <th width="100">조회수</th>
                </tr>
            </thead>

            <?php
                if(!isset($_GET['page'])){
                    $page = 1;
                }
                else{
                    $page = $_GET['page'];
                }

                $bo_mq = mq("select * from board");
                $row_num = mysqli_num_rows($bo_mq);

                $list = 5;
                $block_ct = 5;
                $block_num = ceil($page/$block_ct);
                $block_start = ($block_num-1)*$block_ct+1;
                $block_end = $block_start+$block_ct-1;
                $total_page=ceil($row_num/$list);
                if($block_end > $total_page) $block_end = $total_page;

                $total_block = ceil($total_page/$block_ct);
                $start_num=($page-1)*$list;
                
                $sql = mq("select * from board order by idx desc limit $start_num, $list");

                while($board = $sql->fetch_array()){
                    $title=$board['title'];
                    if(strlen($title)>30){
                        $title=str_replace($board['title'], mb_substr($board['title'],0,30,"utf-8")."...",$board['title']);
                    }
            ?>
            <tbody>
                <tr>
                    <td width"70"><?php echo $board["idx"]; ?></td>
                    <td width"500"><a href="/page/read.php?idx=<?php echo $board["idx"];?>">
                    <?php if($title==''){
                        echo '　';
                    }else{echo $title;} ?></a></td>
                    <td width"120"><?php echo $board["name"]; ?></td>
                    <td width"100"><?php echo $board["date"]; ?></td>
                    <td width"100"><?php echo $board["hit"]; ?></td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
        <ul>
            <?php 
                if($page<=1){
                    echo "<li>처음</li>";
                }else{
                    echo "<li><a href='?page=1'>처음</a></li>";
                }
                if($page<=1){}
                else{
                    $pre = $page-1;
                    echo "<li><a href='?page=$pre'>이전</a></li>";
                }
                for($i=$block_start; $i<=$block_end; $i++){
                    if($page == $i){
                        echo "<li>[$i]</li>";
                    }
                    else{
                        echo "<li><a href='?page=$i'>[$i]</a></li>";
                    }
                }
                if($block_num >= $total_block){
                }else{
                    $next = $page+1;
                    echo "<li><a href='?page=$next'>다음</a></li>";
                }
                if($page >= $total_page){
                    echo "<li>마지막</li>";
                }
                else{
                    echo "<li><a href ='/?page=$total_page'>마지막</a></li>";
                }
            ?>
        </ul>
        <div id="write_btn">
            <a href="/page/write.php"><button>글쓰기</button></a>
        </div>
    </div>
</body>
</html>