<?php
  
    include 'check-login.php';
    include 'user-header.php';

?>
  
<div class="whole-container">

  <section class="content-main">
    <div class="container my-3 py-5 text-center">
        <div class="row mb-5">
            <div class="col">
              <h1>Purchase Request Tracking System</h1>
              <p>Department of Science and Technology Region 7</p>
            </div>
        </div>
    </div>
    </section>


<!-- start of card row 1-->
    <main class="container">  
      <div class="row container">

    
        <div class="col-lg-6 col-md-6 mx-auto">
          <div class="card text-center">

            <div class="card-header" id="approved-request-header" style="background-color:#3B5828; color: white;">
              List of Request <i class="fa-sharp fa-solid fa-caret-down" style="float:right;font-size: 25px;" ></i>
            </div>

            <div class="card-body d-none">
              <h5 class="card-title"><i class="fas fa-check-circle" style="color:#3B5828;"></i>Request Items</h5>
              <p class="card-text">All pending, approved, and declined request items from all units are listed here.</p>
              <a href="admin-approve.php" class="btn btn-sm btn-primary">Enter Here</a>
            </div>

            <div class="card-footer text-muted"></div>

          </div>
        </div>
    
   
  <div class="col-lg-6 col-md-6 mx-auto">
    <div class="card text-center">

      <div class="card-header" id="own-request-header" style="background-color:#014C63; color: white;">
       User list <i class="fa-sharp fa-solid fa-caret-down" style="float:right;font-size: 25px;" ></i>
      </div>

      <div class="card-body d-none">
        <h5 class="card-title"><i class="fa-solid fa-users" style="color:#014C63"></i> User list</h5>
        <p class="card-text"> The employees who have registered with the Purchase Tracking System (PRTS) are listed here.</p>
        <a href="user-list.php" class="btn btn-sm btn-primary">Enter Here</a>
      </div>

      <div class="card-footer text-muted"></div>

    </div>
  </div>

</div>
</div>

<script>



const approvedRequestHeader = document.getElementById('approved-request-header');
const approvedRequestBody = document.querySelector('#approved-request-header + .card-body');
approvedRequestHeader.addEventListener('click', () => {
  approvedRequestBody.classList.toggle('d-none');
});

const OwnRequestHeader = document.getElementById('own-request-header');
const OwnRequestBody = document.querySelector('#own-request-header + .card-body');
OwnRequestHeader.addEventListener('click', () => {
  OwnRequestBody.classList.toggle('d-none');
});

</script>
      </main>


<?php
  include 'footer.php'
?>