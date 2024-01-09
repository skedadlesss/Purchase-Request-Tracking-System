<?php
    include 'check-login.php';
    include 'user-header.php';
?>

<div class="whole-container">
<section class="content">
      <div class="container my-3 py-5 text-center">
          <div class="row mb-5">
              <div class="col">
                <h1>Requested Items</h1>
                <p>All pending, approved, and declined request items from all units are listed here.</p>
              </div>
          </div>
      </div>
      </section>


  
       
<!-- Main -->

<!-- Table -->
<div class="table-container">
<div>
  <!-- Button trigger modal -->
<button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin:10px">
<i class="fas fa-shopping-basket"></i>  Add Purchase
</button>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog custom-modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Purchase / Request </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <!-- FORMS -->

      <form action="purchase_add.php" method="POST" enctype="multipart/form-data">

<div class="mb-3">    
          <label for="reference_number" class="form-label" id="reference_number">Reference No.</label>
           <input type="text" class="form-control"  placeholder="Enter No." name="reference_number" autocomplete="off" required>
 </div>



 <div class="row">
 <div class="col-md-6 mb-3">   
          <label for="date" class="form-label" id="date">Date</label>
           <input type="date" class="form-control"  placeholder="Enter Acronym" name="date" autocomplete="off" required>
 </div>

 <div class="col-md-6 mb-3">   
          <label for="date_updated" class="form-label" id="date">Date Updated</label>
           <input type="date" class="form-control"  placeholder="Enter Acronym" name="date_updated" autocomplete="off">
 </div>

 <div class="col-md-6 mb-3">  
          <label for="fund_name" class="form-label" id="fund_name">Fund Name</label>
           <input type="text" class="form-control"  placeholder="Enter Fund Name" autocomplete="off" name="fund_name" required>
 </div>

 <div class="col-md-6 mb-3">  
          <label for="unit" class="form-label" id="unit">Office Section</label>
           <input type="text" class="form-control"  placeholder="Enter Division" autocomplete="off" name="unit" required>
 </div>
 
</div>

 <div class="mb-3">
        <label for="file" class="form-label">Upload File</label>
        <input class="form-control" type="file" name="file">
        <small class="form-text text-muted">Only PDF, Word, Excel, and image files are allowed.</small>
    </div>
    

<div class="row">
 <div class="col-md-6 mb-3">   
          <label for="requested_by" class="form-label" id="requested_by">Requested By </label>
           <input type="text" class="form-control"  placeholder="Requested By" autocomplete="off" name="requested_by" required>
 </div>

 <div class="col-md-6 mb-3">  
<label for="item_status" class="form-label">Item Status</label>
<select id="item_status" class="form-control" name="item_status" required>
<option value="" disabled selected>Status Option</option>
<option value="For Approval">For Approval</option>
<option value="PO Issued">PO Issued</option>
<option value="For Deliver">For Delivery</option>
<!-- <option value="For Inspection">For Inspection</option> -->
<option value="RFQ">RFQ</option>
<option value="Replacement">Replacement</option>
<option value="Replacement">Done</option>
</select>
</div>
</div>



<div class="row">

<div class="col-md-6 mb-3">  
<label for="employee" class="form-label">Employee Name</label>
<select id="status" class="form-control" name="employee" required>
<option value="" disabled selected>Employee Name</option>
<option value="Emmanuel Romagos">Emmanuel Romagos</option>
<option value="April Occo">April Occo</option>
<option value="Roland">April Occo</option>
</select>
</div>



<div class="col-md-6 mb-3"> 
<label for="status" class="form-label">Enter Status</label>
<select id="status" class="form-control" name="status" required>
<option value="" disabled selected>Select Status</option>
<option value="Pending">Pending</option>
<option value="Approved">Approved</option>
<option value="Declined">Declined</option>
</select>
</div>
</div>


</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  <button type="submit" name="submit" class="btn btn-primary">Add</button>
</div>
</form>

<!-- end of forms -->
    </div>
  </div>
</div>



<table id="approve" class="table table-striped" >
    <thead class="table-dark">
    <tr>
      <th style="text-align: center;font-size:15px;">Reference Number</th>
      <th style="text-align: center;font-size:15px;" >Requested By</th>
      <th style="text-align: center;font-size:15px;">Date Received</th>
      <th style="text-align: center;font-size:15px;">Date Updated</th>
      <th style="text-align: center;font-size:15px;" >Fund Name</th>
      <th style="text-align: center;font-size:15px;" >Unit Name</th>
      <th  style="text-align: center;font-size:15px;">Particular Image / PDF</th>
      <th style="text-align: center;font-size:15px;" >Employee Name</th>
      <th style="text-align: center;font-size:15px;" >Item Status</th>
      <th style="text-align: center;font-size:15px;" >Status</th>
      <th style="text-align: center;font-size:15px;" >Action</th>  
    </tr>
  </thead>

  <tbody>
  <?php
$query = "SELECT *, IF(LOCATE('.', image_path) > 0, SUBSTRING_INDEX(image_path, '.', -1), '') AS file_type FROM approve ORDER BY date_updated DESC";
$result = mysqli_query($conn, $query);
$search_result = false;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td style='text-align:center;font-size:15px;'>" . $row['reference_number'] . "</td>";

        echo "<td style='text-align:center;font-size:15px;'>" . $row['requested_by'] . "</td>";
        $timestamp = strtotime($row['date']);
        $formatted_date = date("F d, Y", $timestamp);

        echo "<td style='text-align:center;font-size:15px;'>" . $formatted_date . "</td>";
        $timestamp = strtotime($row['date_updated']);
        $formatted_date = date("F d, Y", $timestamp);

        echo "<td style='text-align:center;font-size:15px;'>" . $formatted_date . "</td>";

        echo "<td style='text-align:center;font-size:15px;'>" . $row['fund_name'] . "</td>";

        echo "<td style='text-align:center;font-size:15px;'>" . $row['unit'] . "</td>";

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

        echo "<td style='text-align:center;font-size:15px;'>" . $row['employee'] . "</td>";
        echo "<td style='text-align:center;font-size:15px;'>" . $row['item_status'] . "</td>";
        echo "<td style='text-align:center;font-size:15px;'>";

        // Add conditional statements to set the background color based on the status value
        if ($row['status'] == 'Pending') {
            echo "<span class='badge bg-warning text-dark'>" . $row['status'] . "</span>";
        } elseif ($row['status'] == 'Approved') {
            echo "<span class='badge bg-success'>" . $row['status'] . "</span>";
        } elseif ($row['status'] == 'Approve') {
            echo "<span class='badge bg-success'>" . $row['status'] . "</span>";
        } elseif ($row['status'] == 'Decline') {
            echo "<span class='badge bg-danger'>" . $row['status'] . "</span>";
        } else {
            echo $row['status'];
        }

        echo "</td>";
        echo "<td style='width:5%;text-align:center;'>";

        echo '
        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updatePurchase'.$row['id'].'">
            <i class="fas fa-edit"></i>
        </button>
        

        <!-- Modal -->
        <div class="modal fade" id="updatePurchase'.$row['id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="text-align:left;">
            <div class="modal-dialog custom-modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Purchase / Request </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- FORMS -->
                        <form action="update-approve.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="' . $row['id'] . '">
    
                            <div class="mb-3">    
                                <label for="reference_number" class="form-label" id="reference_number">Reference No.</label>
                                <input type="text" class="form-control" placeholder="Enter No." name="reference_number" value="' . $row['reference_number'] . '" autocomplete="off" required>
                            </div>
    
                            <div class="row">
                                <div class="col-md-6 mb-3">   
                                    <label for="date" class="form-label" id="date">Date</label>
                                    <input type="date" class="form-control" placeholder="Enter Acronym" name="date" value="' . $row['date'] . '" autocomplete="off" required>
                                </div>
    
                                <div class="col-md-6 mb-3">   
                                    <label for="date_updated" class="form-label" id="date">Date Updated</label>
                                    <input type="date" class="form-control" placeholder="Enter Acronym" name="date_updated" value="' . $row['date_updated'] . '" autocomplete="off">
                                </div>
    
                                <div class="col-md-6 mb-3">  
                                    <label for="fund_name" class="form-label" id="fund_name">Fund Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Fund Name" autocomplete="off" name="fund_name" value="' . $row['fund_name'] . '"required>
                                </div>
    
                                <div class="col-md-6 mb-3">  
                                    <label for="unit" class="form-label" id="fund_name">Division / Section Unit</label>
                                    <input type="text" class="form-control" placeholder="Enter Division" autocomplete="off" name="unit" value="' . $row['unit'] . '" required>
                                </div>
                            </div>
    
                            <div class="mb-3">
                            <label for="current_image" class="form-label">Current Image</label>
                            <br>
                            <input type="text" class="form-control" readonly value="' . basename($row['image_path']) . '">
                        </div>
                        
                        <div class="mb-3">
                            <label for="new_image" class="form-label">New Image</label>
                            <input type="file" class="form-control" name="new_image">
                            <small class="form-text text-muted">Only image files are allowed.</small>
                        </div>
                        
    
                            <div class="row">
                                <div class="col-md-6 mb-3">   
                                    <label for="requested_by" class="form-label" id="requested_by">Requested By</label>
                                    <input type="text" class="form-control" placeholder="Requested By" autocomplete="off" name="requested_by" value="' . $row['requested_by'] . '" required>
                                </div>
    
                                <div class="col-md-6 mb-3">  
                                    <label for="item_status" class="form-label">Item Status</label>
                                    <select id="item_status" class="form-control" name="item_status" value="' . $row['item_status'] . '">
                                    <option value="" disabled selected>Status Option</option>
                                    <option value="For Approval">For Approval</option>
                                    <option value="PO Issued">PO Issued</option>
                                    <option value="For Deliver">For Delivery</option>
                                    <option value="For Inspection">For Inspection</option>
                                    <option value="RFQ">RFQ</option>
                                    <option value="Replacement">Replacement</option>
                                    <option value="Done">Done</option>
                                    </select>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-md-6 mb-3">  
                                    <label for="employee" class="form-label">Employee Name</label>
                                    <select id="status" class="form-control" name="employee" value="' . $row['employee'] . '" required>
                                        <option value="" disabled selected>Employee Name</option>
                                        <option value="Emmanuel Romagos">Emmanuel Romagos</option>
                                        <option value="April">April Occo</option>
                                    </select>
                                </div>
    
                                <div class="col-md-6 mb-3"> 
                                    <label for="status" class="form-label">Status</label>
                                    <select id="status" class="form-control" name="status" value="' . $row['status'] . '" required>
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Decline">Decline</option>
                                    </select>
                                </div>
                            </div>
    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form> 
    
                    <!-- end of forms -->
                </div>
            </div>
        </div>
    </div>
    
    ';
    
    echo '<button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop'.$row['id'].'"><i class="fas fa-trash-alt"></i>
    </button>
   
    <div class="modal fade" id="staticBackdrop'.$row['id'].'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Purchase</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger"><a href="delete_approve.php?deleteid='.$row['id'].'" class="text-light">Delete</a></button>
                </div>
            </div>
        </div>
    </div>';
  }
} else {
  echo "<tr><td colspan='12' style='text-align:center;'>No data available</td></tr>";
}
?>


  </tbody>
</table>



<!-- script for table -->

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
      { "targets": [0, 9], "orderable": true },
      { "targets": [2, 3, 4, 5, 6, 7, 8], "orderable": false}
    ],
  });

  // Add placeholder text to search input
  $('#approve_filter input').attr("placeholder", "Search Here...");

  // Update search placeholder on each search event
  $('#approve').on('search.dt', function() {
    var placeholder = table.search() === '' ? "Search Here..." : table.search();
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

<!-- end for script table -->

</div>
</div>

</div>
<?php include 'footer.php' ?>