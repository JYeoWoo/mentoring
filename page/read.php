<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    $idx = $_GET['idx'];
    $sql = mq('SELECT * FROM board where idx="'.$idx.'"');
    $list = $sql -> fetch_array();
    $title = $list['title'];
    $content = $list['content'];
    $name = $list['name'];
    $date = $list['date'];
    $hit = $list['hit'] +1;
    mq('UPDATE board SET hit= "'.$hit.'" WHERE idx = "'.$idx.'" ');

    $r_sql = mq("SELECT * FROM reply WHERE con_num='$idx'");
?>
<!doctype html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>제목: <?php echo $title; ?></h2>
    <div>
        글쓴이: <?php echo $name;?>
        작성시간: <?php echo $date;?>
        조회수: <?php echo $hit;?>
        </br></br>
        내용: <?php echo $content;?>
        <br>
        <br>
        
        파일: <a href="../upload/<?php echo $list['file'];?>" download><?php echo $list['file']; ?></a>
    </div>

    <?php if($_SESSION['id']==$name){?>
    <form action="/page/update.php" method="post">
        <input type="hidden" name="idx" value=<?php echo $idx; ?>>
        <input type="submit" value="글 수정">
    </form>
    <form action="/page/delete.php" method="post">
        <input type="hidden" name="idx" value=<?php echo $idx; ?>>
        <input type="submit" value="글 삭제">
    </form>
    <?php } ?>
    <br>
    <br>
    <?php if(isset($_SESSION['id'])){?>
    <form action ="/page/reply.php" method ="post">
        <?php echo $_SESSION['id'];?>
        <textarea name="reply" cols="80" rows="5" placeholder="댓글 내용" maxLength="100"></textarea>
        <input type="hidden" name="idx" value=<?php echo $idx;?>>
        <input type="submit" value="댓글 작성">
    </form>
    <table>
            <thead>
                <tr>
                    <th width="120">닉네임</th>
                    <th width="500">댓글</th>
                    <th width="100">작성 시간</th>
                </tr>
            </thead>
    <?php } while($reply = $r_sql->fetch_array()){  ?> 
            <tbody>
                <tr>
                    <td width"120"><?php echo $reply["name"]; ?></td>
                    <td width"500"><?php echo $reply["content"]; ?></td>
                    <td width"100"><?php echo $reply["date"]; ?></td>
                    <?php if(isset($_SESSION['id']) && ($reply["id"] == $_SESSION['id'])){ ?>
                    <td witdh"30">
                        <form action="/page/reply_delete.php" method="post">
                            <input type="button" onclick="update(<?php echo $idx;?>, <?php echo $reply['idx'];?>);" value="댓글 수정">
                            <!-- <?php echo "<input type='button' onclick='update({$reply['content']}, {$idx}, {$reply['idx']})'>"; ?> -->
                            <input type="submit" value="댓글 삭제">
                            <input type="hidden" name="idx" value=<?php echo $idx; ?>>
                            <input type="hidden" name="r_idx" value=<?php echo $reply['idx'];?>>
                        </form>
                    </td>
                    <?php } ?>
                </tr>
            </tbody>
    <?php } ?>
    </table>
</body>
</html>

<script>
    function update(idx, r_idx){
        
        if(typeof check == 'undefined' || check == 0){
            check =1;
            
            var f = document.createElement("form");
            f.setAttribute('id', "rupdate");
            f.setAttribute('method', "post");
            f.setAttribute('action', "/page/reply_update.php");

            var value1 = document.createElement("input");
            value1.setAttribute('type', "textarea");
            value1.setAttribute('name', "content");
            value1.setAttribute('placeholder', "수정 할 내용을 입력하세요.");
            
            var value2 = document.createElement("input");
            value2.setAttribute('type', "hidden");
            value2.setAttribute('name', "idx");
            value2.setAttribute('value', idx);
            
            var value3 = document.createElement("input");
            value3.setAttribute('type', "hidden");
            value3.setAttribute('name', "r_idx");
            value3.setAttribute('value', r_idx);
            
            var value4 = document.createElement("input");
            value4.setAttribute('type', "submit");
            value4.setAttribute('value', "댓글 수정 완료");
            
            

            f.appendChild(value1);
            f.appendChild(value2);
            f.appendChild(value3);
            f.appendChild(value4);

            document.getElementsByTagName('body')[0].appendChild(f);
            console.log(document.getElementsByTagName('body')[0]);
            console.log(document.getElementById('rupdate'));
            // document.body.appendChild(f);
        }
        else{
            check = 0;
            document.getElementById('rupdate').remove();
            // document.body.removeChild(f);
        }

    }
</script>