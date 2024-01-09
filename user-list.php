<?php
    include 'check-login.php';
    include 'user-header.php';
?>

<div class="whole-container">
<section class="content">
      <div class="container my-3 py-5 text-center">
          <div class="row mb-5">
              <div class="col">
                <h1>User List</h1>
                <p>All accounts for this system listed here</p>
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
<i class="fas fa-users"></i> Add Account
</button>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog custom-modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <!-- FORMS -->

      <form action="update_user" method="POST" enctype="multipart/form-data">

<div class="mb-3">    
          <label for="username" class="form-label" id="username">username</label>
           <input type="text" class="form-control"  placeholder="Enter No." name="username" autocomplete="off" required>
 </div>



 <div class="col-md-6 mb-3">  
          <label for="password" class="form-label" id="password">password</label>
           <input type="text" class="form-control"  placeholder="Enter Password" autocomplete="off" name="password" required>
 </div>

 <div class="col-md-6 mb-3">  
          <label for="fullname" class="form-label" id="unit">Full name</label>
           <input type="text" class="form-control"  placeholder="Enter Full name" autocomplete="off" name="fullname" required>
 </div>
 
</div>



<div class="col-md-6 mb-3"> 
<label for="user_type" class="form-label">Choose a role</label>
<select id="user_type" class="form-control" name="user_type" required>
<option value="" disabled selected>Choose one below</option>
<option value="Staff">Staff</option>
<option value="Admin">Admin</option>
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
    <th style="text-align: center;font-size:15px;">Id Seq</th>
      <th style="text-align: center;font-size:15px;">Username</th>
      <th style="text-align: center;font-size:15px;" >FullName</th>
      <th style="text-align: center;font-size:15px;">Staff Role</th>
      <th style="text-align: center;font-size:15px;">Action</th>
     
    </tr>
  </thead>

  <tbody>
  <?php

$query = "SELECT * FROM user ORDER BY id DESC";
$result = mysqli_query($conn, $query);
$search_result = false;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td style='text-align:center;font-size:15px;'>" . $row['id'] . "</td>";
        echo "<td style='text-align:center;font-size:15px;'>" . $row['username'] . "</td>";
        echo "<td style='text-align:center;font-size:15px;'>" . $row['password'] . "</td>";
        echo "<td style='text-align:center;font-size:15px;'>" . $row['fullname'] . "</td>";
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
                        <form action="update_user.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="' . $row['id'] . '">
    
                            <div class="mb-3">    
                                <label for="username" class="form-label" id="username">Username</label>
                                <input type="text" class="form-control" placeholder="Enter No." name="username" value="' . $row['username'] . '" autocomplete="off" required>
                            </div>
    
                            <div class="col-md-6 mb-3">  
                            <label for="password" class="form-label" id="password">Password</label>
                            <input type="text" class="form-control" placeholder="Enter New Password" autocomplete="off" name="unit" value="' . $row['password'] . '" required>
                        </div>
                    </div>
    
                                <div class="col-md-6 mb-3">  
                                    <label for="fullname" class="form-label" id="fullname">Full Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Full Name" autocomplete="off" name="fullname" value="' . $row['fullname'] . '"required>
                                </div>
    
    
                            <div class="row">
                                <div class="col-md-6 mb-3">  
                                    <label for="user_type" class="form-label">Choose a Role</label>
                                    <select id="user_type" class="form-control" name="user_type" value="' . $row['user_type'] . '" required>
                                        <option value="" disabled selected>Choose one below</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Staff">Staff</option>
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
    "order": [[2, "asc"]], // Order by the Date Received column in ascending order
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

<!-- end for script table -->

</div>
</div>

</div>
<?php include 'footer.php' ?>