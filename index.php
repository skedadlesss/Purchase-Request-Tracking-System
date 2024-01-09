<?php

include 'connect.php';
include 'header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css"/>
  <link rel="icon" href="./images/favicon.ico" type="image/x-icon"/>
  <title>PRTS</title>
</head>
<body>
  

  <!-- Start of Title -->
<div class="whole-container">
<section class="content">
      <div class="container my-3 py-5 text-center">
          <div class="row mb-5">
              <div class="col">
                <h1>Purchase Tracking System</h1>
                <p>All pending, approved, and declined request items from all units are listed here.</p>
              </div>
          </div>
      </div>
      </section>
<!-- end of title -->

<!-- Table -->
<div class="table-container">
<table id="approve" class="table table-striped" >
<thead class="table-dark">
    <tr>
      <th style="text-align: center;font-size:15px;">Reference Number</th>
      <th style="text-align: center;font-size:15px;" >Requested By</th>
      <th style="text-align: center;font-size:15px;">Date Received</th>
      <th style="text-align: center;font-size:15px;">Date Updated</th>
      <th style="text-align: center;font-size:15px;" >Fund Name</th>
      <th style="text-align: center;font-size:15px;" >Unit Name</th>
      <th style="text-align: center;font-size:15px;" >Particular</th>
      <th style="text-align: center;font-size:15px;" >Employee Name</th>
      <th style="text-align: center;font-size:15px;" >Item Status</th>
      <th style="text-align: center;font-size:15px;" >Status</th>
    </tr>
  </thead>

  <tbody>
 <?php
  
$query = "SELECT * FROM approve ORDER BY date_updated DESC";
$result = mysqli_query($conn, $query);
$search_result = false;


if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td style='text-align:center;font-size:15px;' '>" . $row['reference_number'] . "</td>";
    echo "<td style='text-align:center;font-size:15px;' >" . $row['requested_by'] . "</td>";
    $timestamp = strtotime($row['date']);
    $formatted_date = date("F d, Y", $timestamp);
    echo "<td style='text-align:center;font-size:15px;' '>" . $formatted_date . "</td>";
    $timestamp = strtotime($row['date_updated']);
    $formatted_date = date("F d, Y", $timestamp);
    echo "<td style='text-align:center;font-size:15px;' '>" . $formatted_date . "</td>";
    echo "<td style='text-align:center;font-size:15px;' ' >" . $row['fund_name'] . "</td>";
    echo "<td style='text-align:center;font-size:15px;' '>" . $row['unit'] . "</td>";
    echo "<td style='text-align:center;font-size:15px;'>";
        if (isset($row['image_path'])) {
            $fileType = pathinfo($row['image_path'], PATHINFO_EXTENSION);
            if (in_array($fileType, array('jpg', 'jpeg', 'png'))) {
                echo "<button class='btn btn-link btn-sm' onclick=\"showImage('" . $row['image_path'] . "')\"><i class='fas-file fa-sm'>Click here to show file</button>";
            } elseif (in_array($fileType, array('pdf', 'doc', 'docx', 'xls', 'xlsx'))) {
                echo "<button class='btn btn-link btn-sm' onclick=\"showFile('" . $row['image_path'] . "')\"><i class='fas-file fa-sm'>Click here to show file</i></button>";
            }
        }
        echo "</td>";
    echo "<td style='text-align:center;font-size:15px;' >" . $row['employee'] . "</td>";
    echo "<td style='text-align:center;font-size:15px;'>" . $row['item_status'] . "</td>";
    echo "<td style='text-align:center;font-size:15px;'>";

        // Add conditional statements to set the background color based on the status value
        if ($row['status'] == 'Pending') {
            echo "<span class='badge bg-warning text-dark'>" . $row['status'] . "</span>";
        } elseif ($row['status'] == 'Approved') {
            echo "<span class='badge bg-success'>" . $row['status'] . "</span>";
        } elseif ($row['status'] == 'Declined') {
            echo "<span class='badge bg-danger'>" . $row['status'] . "</span>";
        } else {
            echo $row['status'];
        }

        echo "</td>";
  }
} else {
  echo "<tr><td colspan='11' style='text-align:center;'>No data available</td></tr>";
}
?>

  </tbody>
</table>

</div>

<div>
<script>
$(document).ready(function() {
  // Initialize DataTables
  var table = $('#approve').DataTable({
    // DataTables options
    "paging": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "lengthMenu": [[20, 50, 80, 100, -1], [20, 50, 80, 100, "All"]],
    "order": [[0, "desc"]], // Order by the Date Received column in ascending order
    "columnDefs": [
      { "targets": [0, 1, 5, 6, 7, 8, 9], "searchable": false },
      { "targets": [2, 3], "searchable": true,
        "render": function(data, type, row) {
          // Convert the date string to a JavaScript Date object
          var date = new Date(data);

          // Format the date as "Month DD, YYYY"
          var options = { year: 'numeric', month: 'long', day: '2-digit' };
          var formattedDate = date.toLocaleDateString('en-US', options);

          // Return the formatted date for rendering and searching
          return formattedDate;
        }
      },
    ],
  });

  // Add placeholder text to search input
  $('#approve_filter input').attr("placeholder", "Search Here...");

  // Update search placeholder on each search event
  $('#approve').on('search.dt', function() {
    var placeholder = table.search() === '' ? "Search Here..." : table.search();
    $('#approve_filter input').attr("placeholder", placeholder);
  });

  // Handle month and year filtering
  $('#month, #year').on('change', function() {
    var selectedMonth = $('#month').val();
    var selectedYear = $('#year').val();

    table.column(2).search(selectedMonth, true, false);
    table.column(3).search(selectedMonth, true, false);
    table.draw();
  });
});



// For Image Page
  function showImage(imagePath) {
    window.open(imagePath, '_blank');
  }

  function showFile(filePath) {
    window.open(filePath, '_blank');
  }
</script>
</div>
<?php

    include 'footer.php';
?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
</body>
</html>
