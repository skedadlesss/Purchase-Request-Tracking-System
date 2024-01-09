<?php
include 'connect.php';

// Code for uploading file //
if(isset($_POST['submit'])){
    // File upload code here
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $targetDirectory = "images/uploads";
        $fileExtension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));

        // Generate a unique file name to prevent conflicts
        $fileName = uniqid() . "." . $fileExtension;
        $targetPath = $targetDirectory . '/' . $fileName;

        // Check if the uploaded file is allowed
        $allowedExtensions = array("pdf", "doc", "docx", "xls", "xlsx", "jpg", "jpeg", "png");
        if (in_array($fileExtension, $allowedExtensions)) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath)) {
                // File uploaded successfully
                echo "File uploaded successfully.";

                // Form submission code here
                $reference_number = $_POST['reference_number'];
                $date = $_POST['date'];
                $date_updated = $_POST['date_updated'];
                $fund_name = $_POST['fund_name'];
                $unit = $_POST['unit'];
                $status = $_POST['status'];
                $item_status = $_POST['item_status'];
                $employee = $_POST['employee'];
                $requested_by = $_POST['requested_by'];

                if ($status == "Approved") {
                    $sql = "INSERT INTO approve (reference_number, date, date_updated, fund_name, unit, status, employee, requested_by, image_path, file_type) VALUES ('$reference_number', '$date', '$date_updated', '$fund_name', '$unit', '$status', '$employee', '$requested_by', '$targetPath', '$fileExtension')";
                } elseif ($status == "Decline") {
                    $sql = "INSERT INTO approve (reference_number, date, date_updated, fund_name, unit, status, employee, requested_by, image_path, file_type) VALUES ('$reference_number', '$date', '$date_updated', '$fund_name', '$unit', '$status', '$employee', '$requested_by', '$targetPath', '$fileExtension')";
                } elseif ($status == "Pending") {
                    $sql = "INSERT INTO approve (reference_number, date, date_updated, fund_name, unit, status, item_status, employee, requested_by, image_path, file_type) VALUES ('$reference_number', '$date', '$date_updated', '$fund_name', '$unit', '$status', '$item_status', '$employee', '$requested_by', '$targetPath', '$fileExtension')";
                }

                if(isset($sql)){
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        echo "Data inserted";
                        header("Location: admin-approve.php");
                        exit();
                    } else {
                        die(mysqli_error($conn));
                    }
                }
            } else {
                // Failed to move the uploaded file
                echo "<script>alert('Error uploading file.');</script>";
                echo "<script>window.history.back();</script>";
            }
        } else {
            // Invalid file format
            echo "<script>alert('Only PDF, Word, Excel, and image files are allowed.');</script>";
            echo "<script>window.history.back();</script>";
        }
    } else {
        // No file uploaded or an error occurred during upload
        echo "<script>alert('Error uploading file.');</script>";
        echo "<script>window.history.back();</script>";
    } 
}
?>
