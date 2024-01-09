<?php
include 'connect.php';
     
// Get the primary key value and status from the form
$id = $_POST['id'];
$status = $_POST['status'];

if ($status == 'Approve') {
  // Retrieve other fields from the form
  $reference_number = $_POST['reference_number'];
  $date = $_POST['date'];
  $date_updated = $_POST['date_updated'];
  $fund_name = $_POST['fund_name'];
  $unit = $_POST['unit'];
  $total_amount = $_POST['total_amount'];
  $particular = $_POST['particular'];
  $remarks = $_POST['remarks'];
  $employee = $_POST['employee'];
  $requested_by = $_POST['requested_by'];

  // Insert the row into the pending table
  $sql = "INSERT INTO approve (reference_number, date, date_updated, fund_name, unit, total_amount, particular, status, pending_status, remarks, employee, requested_by)
          VALUES ('$reference_number', '$date', '$date_updated', '$fund_name', '$unit', '$total_amount', '$particular', '$pending_status', '$status', '$remarks', '$employee', '$requested_by')";
  $result = mysqli_query($conn, $sql);

  // Delete the row from the approve table
  $delete_sql = "DELETE FROM decline WHERE id = $id";
  $delete_result = mysqli_query($conn, $delete_sql);

  // Check if both queries executed successfully
  if ($result && $delete_result) {
    // echo "Record updated successfully";
    header("Location: admin-decline.php");
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
} elseif ($status == 'Pending') {
  // Insert the row into the decline table
  $sql = "INSERT INTO pending (reference_number, date, date_updated, fund_name, unit, total_amount, particular, status, pending_status, remarks, employee, requested_by)
          SELECT reference_number, date, date_updated, fund_name, unit, total_amount, particular, status, pending_status, remarks, employee, requested_by
          FROM decline
          WHERE id = $id";
  $result = mysqli_query($conn, $sql);

  // Delete the row from the approve table
  $delete_sql = "DELETE FROM approve WHERE id = $id";
  $delete_result = mysqli_query($conn, $delete_sql);

  // Check if both queries executed successfully
  if ($result && $delete_result) {
    // echo "Record updated successfully";
    header("Location: admin-decline.php");
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
} elseif ($status == 'Decline') {
  // Retrieve other fields from the form
  $reference_number = $_POST['reference_number'];
  $date = $_POST['date'];
  $date_updated = $_POST['date_updated'];
  $fund_name = $_POST['fund_name'];
  $unit = $_POST['unit'];
  $total_amount = $_POST['total_amount'];
  $particular = $_POST['particular'];
  $remarks = $_POST['remarks'];
  $employee = $_POST['employee'];
  $pending_status = $_POST['pending_status'];
  $requested_by = $_POST['requested_by'];

  // Insert the row into the approve table
  $sql = "UPDATE decline SET reference_number='$reference_number', date='$date', date_updated='$date_updated', fund_name='$fund_name', unit='$unit', total_amount='$total_amount', particular='$particular', status='$status', remarks='$remarks', employee='$employee', pending_status='$pending_status', requested_by='$requested_by' WHERE id = $id";
  $result = mysqli_query($conn, $sql);

// Check if the query executed successfully
if ($result) {
  // echo "Record updated successfully";
  header("Location: admin-decline.php");
} else {
  echo "Error updating record: " . mysqli_error($conn);
}
}
