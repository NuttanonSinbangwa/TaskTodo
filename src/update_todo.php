<?php
include "config.php";

$id = $_POST['id'];

$category = $_POST['category'];
$title = $_POST['title'];
$description = $_POST['description'];
$remark = $_POST['remark'];
$date = $_POST['due_date'];
$time = $_POST['due_time'];

$sql = "UPDATE todos SET 
        category='$category',
        title='$title',
        description='$description',
        remark='$remark',
        due_date='$date',
        due_time='$time'
        WHERE id=$id";

if ($conn->query($sql)) {
    echo "OK";
} else {
    echo "ERROR: ".$conn->error;
}
?>
