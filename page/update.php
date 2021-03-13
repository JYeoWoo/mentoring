<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    $idx = $_POST['idx'];
    $sql = mq('SELECT * FROM board where idx="'.$idx.'"');
    $list = $sql -> fetch_array();
    $title = $list['title'];
    $content = $list['content'];
    $file = $list['file'];
?>

<!doctype html>
<head>
    <title>글쓰기</title>
    <meta charset="UTF-8">
</head>
<body>
    <form action="update_ok.php" method="post">
        <br>
        <textarea name="title" cols="80" rows="1"  maxlength="100"><?php echo $title?></textarea>
        <br>
        <textarea name="content" cols="80" rows="20"  maxlength="100"><?php echo $content?></textarea>
        <input type="hidden" name="idx" value="<?php echo $idx?>">
        <br>
        <input type="file" value="<?php echo $file ?>" name="file">
        <input type="submit" value="글 수정">
    </form>
</body>
</html>