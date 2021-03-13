<!doctype html>
<head>
    <title>글쓰기</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/style.css" />>
</head>
<body>
    <form action="write_ok.php" method="post" enctype="multipart/form-data">
        <br>
        <textarea name="title" cols="80" rows="1" placeholder="제목" maxlength="100"></textarea>
        <br>
        <textarea name="content" cols="80" rows="20" placeholder="내용" maxlength="100"></textarea>
        <br>
        <input type="file" value="1" name="file">
        <input type="submit" value="글 작성">
    </form>
</body>
</html>