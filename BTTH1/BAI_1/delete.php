<?php
include "connect.php";

// Kiểm tra xem có tham số 'delete_id' trong URL không
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Xóa hoa khỏi cơ sở dữ liệu
    $sql_delete = "DELETE FROM flowers WHERE id = $delete_id";
    if ($conn->query($sql_delete) === TRUE) {
        header("Location: admin.php"); // Chuyển hướng về trang admin sau khi xóa
        exit();
    } else {
        echo "Lỗi khi xóa dữ liệu: " . $conn->error;
    }
} else {
    echo "Không có ID để xóa.";
}

$conn->close();
?>