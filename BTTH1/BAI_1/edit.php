<?php
include "connect.php";

// Kiểm tra có tham số 'edit_id' trong URL
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    // Lấy thông tin hoa từ cơ sở dữ liệu
    $sql = "SELECT * FROM flowers WHERE id = $edit_id";
    $result = mysqli_query($conn, $sql);
    $flower = mysqli_fetch_array($result);

    // Kiểm tra xem form có được gửi không
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $imagePath = "images/" . $image;

        // Nếu có ảnh mới, tải ảnh lên
        if (!empty($image)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            $sql_update = "UPDATE flowers SET name = '$name', description = '$description', image_path = '$imagePath' WHERE id = $edit_id";
        } else {
            // Nếu không có ảnh mới, giữ nguyên ảnh cũ
            $sql_update = "UPDATE flowers SET name = '$name', description = '$description' WHERE id = $edit_id";
        }

        // Cập nhật thông tin vào cơ sở dữ liệu
        if ($conn->query($sql_update) === TRUE) {
            header("Location: admin.php"); // Chuyển hướng về trang admin sau khi cập nhật
            exit();
        } else {
            echo "Lỗi khi cập nhật dữ liệu: " . $conn->error;
        }
    }
} else {
    echo "Không có ID để sửa.";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin hoa</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="icon/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-5">
        <h4>Sửa thông tin hoa</h4>
        <form action="edit.php?edit_id=<?php echo $flower['id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Tên loài hoa</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $flower['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $flower['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="file" class="form-control" id="image" name="image">
                <img src="<?php echo $flower['image_path']; ?>" width="100" height="100" class="mt-2">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
