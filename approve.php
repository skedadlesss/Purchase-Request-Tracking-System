<?php

    include 'connect.php';
    include 'header.php';

?>

<!-- Start of Title -->
<div class="whole-container">
<section class="content">
      <div class="container my-3 py-5 text-center">
          <div class="row mb-5">
              <div class="col">
                <h1>Requestd Items</h1>
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
  
$query = "SELECT * FROM approve ORDER BY date DESC";
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
    echo "<td style='text-align:center;font-size:15px;'>" . $row['status'] . "</td>";
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
    // Data Tables
    $(document).ready(function() {
  // Initialize DataTables
  var table = $('#approve').DataTable({
    "paging": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "lengthMenu": [ [20, 50, 80, 100, -1], [20, 50, 80, 100, "All"] ]
  });

  // Add placeholder text to search input
  $('#approve_filter input').attr("placeholder", " Search Here...");

  // Update search placeholder on each search event
  $('#approve').on('search.dt', function() {
    var placeholder = table.search() === '' ? " Search Here..." : table.search();
    $('#approve_filter input').attr("placeholder", placeholder);
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

</div>
