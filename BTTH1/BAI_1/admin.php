<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="icon/bootstrap-icons.min.css">


</head>
<main>
    <div class="d-flex flex-column align-items-center mb-3">
        <h3>Danh sách các loài hoa</h3>
    </div>
    <div class="container">
        <form action="add.php" method="post">
            <button type="submit" class="btn btn-success">Thêm</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Tên hoa</th>
                    <th>Mô tả</th>
                    <th>Ảnh</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "connect.php";

                $sql = "select * from flowers";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $row['name'] ?> </td>
                        <td><?php echo $row['description'] ?> </td>
                        <td>
                            <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['name']; ?>" style="width: 100px; height: auto;">
                        </td>
                        <td><a href="edit.php?edit_id=<?php echo $row['id']; ?>" class="text-primary "><i class="bi bi-pencil-square"></i></a></td>
                        <td><a href="delete.php?delete_id=<?php echo $row['id']; ?>" class="text-primary"><i class="bi bi-trash-fill"></i></a></td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</main>

<body>