<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $targetDir = 'uploads/';
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFile = $targetDir . basename($_FILES['image']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // التأكد من أن الصورة ليست صورة وهمية
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check !== false) {
        // نقل الملف المرفوع إلى الدليل المستهدف
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // تحديث ملف JSON
            $images = [];
            if (file_exists('images.json')) {
                $images = json_decode(file_get_contents('images.json'), true);
            }
            $images[] = $targetFile;
            file_put_contents('images.json', json_encode($images));

            header('Location: index.php');
            exit();
        } else {
            echo "حدث خطأ أثناء رفع الصورة.";
        }
    } else {
        echo "الملف المرفوع ليس صورة.";
    }
} else {
    header('Location: index.php');
    exit();
}
