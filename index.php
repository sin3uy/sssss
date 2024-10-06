<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفع الصور</title>
</head>
<body>
    <h1>رفع صورة</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <input type="submit" value="رفع الصورة">
    </form>

    <h2>الصور المرفوعة</h2>
    <div id="gallery">
        <?php
        if (file_exists('images.json')) {
            $images = json_decode(file_get_contents('images.json'), true);
            foreach ($images as $image) {
                echo "<img src='$image' alt='صورة' style='width: 200px; margin: 10px;'>";
            }
        }
        ?>
    </div>
</body>
</html>
