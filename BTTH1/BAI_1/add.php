<?php include "connect.php" ?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kiểm tra xem dữ liệu có được gửi đi không
    if (isset($_POST['name']) && isset($_POST['description']) && isset($_FILES['image'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $imagePath = "images/" . $image;

        // Kiểm tra tệp có được tải lên không
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $sql = "INSERT INTO flowers (name, description, image_path) VALUES ('$name', '$description', '$imagePath')";
            if ($conn->query($sql) === TRUE) {
                header("Location: admin.php");
                exit();
            } else {
                echo "Lỗi khi thêm dữ liệu: " . $conn->error;
            }
        } else {
            echo "Không thể tải tệp lên.";
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm loại hoa</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="icon/bootstrap-icons.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header text-black text-center">
                        <h4>Thêm loại hoa</h4>
                    </div>
                    <div class="card-body">
                        <form action="add.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên loài hoa</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <button type="submit" class="btn btn-success">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php $conn->close(); ?>