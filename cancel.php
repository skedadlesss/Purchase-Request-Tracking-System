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
                <h1>Decline</h1>
                <p>Revoked, Dissaproved or Suspended</p>
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
      <th style="text-align: center;font-size:15px;">Date Received</th>
      <th style="text-align: center;font-size:15px;">Date Updated</th>
      <th style="text-align: center;font-size:15px;" >Fund Name</th>
      <th style="text-align: center;font-size:15px;" >Unit Name</th>
      <th  style="text-align: center;font-size:15px;">Particular</th>
      <th style="text-align: center;font-size:15px;" >Total Amount</th>
      <th style="text-align: center;font-size:15px;" >Remarks</th>   
      <th style="text-align: center;font-size:15px;" >Employee Name</th>
      <th style="text-align: center;font-size:15px;" >Requested By</th>
      <th style="text-align: center;font-size:15px;" >Status</th>
    </tr>
  </thead>

  <tbody>
 <?php

$query = "SELECT * FROM decline ORDER BY date DESC";
$result = mysqli_query($conn, $query);
$search_result = false;

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td style='text-align:center;font-size:15px;' '>" . $row['reference_number'] . "</td>";
    $timestamp = strtotime($row['date']);
    $formatted_date = date("F d, Y", $timestamp);
    echo "<td style='text-align:center;font-size:15px;' '>" . $formatted_date . "</td>";
    $timestamp = strtotime($row['date_updated']);
    $formatted_date = date("F d, Y", $timestamp);
    echo "<td style='text-align:center;font-size:15px;' '>" . $formatted_date . "</td>";
    echo "<td style='text-align:center;font-size:15px;' ' >" . $row['fund_name'] . "</td>";
    echo "<td style='text-align:center;font-size:15px;' '>" . $row['unit'] . "</td>";
    echo "<td><ul><li>" . str_replace("-", "</li><li>", $row['particular']) . "</li></ul></td>";
    echo "<td style='text-align:center;font-size:15px;' '>" . "Php " . number_format($row['total_amount'], 2) . "</td>";
    echo "<td style='text-align:center;font-size:15px;' >" . $row['employee'] . "</td>";
    echo "<td style='text-align:center;font-size:15px;' >" . $row['requested_by'] . "</td>";
    echo "<td style='text-align:center;font-size:15px;'>" . $row['pending_status'] . "</td>";
  }
} else {
  echo "<tr><td colspan='11' style='text-align:center;'>No data available</td></tr>";
}
?>

  </tbody>
</table>


    </div>
</div>
</div>  

<script>
$(document).ready(function() {
  $('#approve').DataTable({
    "paging": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "lengthMenu": [ [3, 5, 10, 100, -1], [3, 5, 10, 100, "All"] ]
  });
});

</script>

<?php

    include 'footer.php';
?>

</div>