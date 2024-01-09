<?php
include 'connect.php';

// Get the primary key value and status from the form
$id = $_POST['id'];
$status = $_POST['status'];

// Retrieve other fields from the form
$reference_number = $_POST['reference_number'];
$date = $_POST['date'];
$date_updated = $_POST['date_updated'];
$fund_name = $_POST['fund_name'];
$unit = $_POST['unit'];
$item_status = $_POST['item_status'];
$employee = $_POST['employee'];
$requested_by = $_POST['requested_by'];

// Check if a new image file was uploaded
if (isset($_FILES["new_image"]) && $_FILES["new_image"]["error"] == 0) {
    $targetDirectory = "images/uploads";
    $fileExtension = strtolower(pathinfo($_FILES["new_image"]["name"], PATHINFO_EXTENSION));

    // Generate a unique file name to prevent conflicts
    $fileName = uniqid() . "." . $fileExtension;
    $targetPath = $targetDirectory . '/' . $fileName;

    // Check if the uploaded file is allowed
    $allowedExtensions = array("pdf", "doc", "docx", "xls", "xlsx", "jpg", "jpeg", "png");
    if (in_array($fileExtension, $allowedExtensions)) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["new_image"]["tmp_name"], $targetPath)) {
            // Update the row in the approve table with the new image path, file type, status, and item_status
            $sql = "UPDATE approve SET reference_number='$reference_number', date='$date', date_updated='$date_updated', fund_name='$fund_name', unit='$unit', status='$status', item_status='$item_status', employee='$employee', requested_by='$requested_by', image_path='$targetPath', file_type='$fileExtension' WHERE id = $id";
            $result = mysqli_query($conn, $sql);

            // Check if the query executed successfully
            if ($result) {
                header("Location: admin-approve.php");
                exit();
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Only PDF, Word, Excel, and image files are allowed.";
    }
} else {
    // Update the row in the approve table without changing the image path, file type, status, and item_status
    $sql = "UPDATE approve SET reference_number='$reference_number', date='$date', date_updated='$date_updated', fund_name='$fund_name', unit='$unit', status='$status', item_status='$item_status', employee='$employee', requested_by='$requested_by' WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    // Check if the query executed successfully
    if ($result) {
        header("Location: admin-approve.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

?>
