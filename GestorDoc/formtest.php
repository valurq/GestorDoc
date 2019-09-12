<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>VALURQ SRL</title>
</head>
<body>
    <form action="upload.php" method="post" multipart="" enctype="multipart/form-data">
        <input type="file" name="img[]" multiple>
        <input type="submit" value="Subir"><br><br>
<?php echo mt_rand() ; ?>

    </form>
</body>



</html>
