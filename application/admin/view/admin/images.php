<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="/static/bootstrap.min.css"></script>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data" class="form-control">
    <div class="form-group">
        <label for="exampleInputEmail1">高度</label>
        <input type="number" class="form-control" id="exampleInputEmail1"  name="width">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">宽度</label>
        <input type="number" name="height"  class="form-control" id="exampleInputPassword1" >
    </div>
    <div class="form-group">
        <label for="exampleInputFile">文件</label>
        <input type="file" id="exampleInputFile" name="image">
    </div>
    <button type="submit" class="btn btn-default">上传</button>
</form>
</body>
</html>