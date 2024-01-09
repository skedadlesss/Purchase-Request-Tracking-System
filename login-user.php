<?php 

include 'header.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="login-style.css"/>
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon"/>
    <title>PRTS</title>
</head>
<body>

<div>
<section class=" gradient-form" style="background-color: #eee;">
  <div class="container py-5 ">
    <div class="row d-flex justify-content-center align-items-center ">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="images/dost_banner.png"
                    style="width:50%;length:50%" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">Region 7</h4>
                </div>

                <form id="login" action="login.php" method="POST">
                  <p class="login-p" style="text-align:center;">Admin Login</p>

                  <div class="form-outline mb-4">
                    <input type="text" class="form-control" placeholder="username" name="username" required/>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" class="form-control" placeholder="Password" name="password" required />
                  
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <div>
                    <button type="submit" class="btn btn-bg gradient-custom-2 mb-3" type="button" style="color:white;">Log-in
                    </button>
</div>
                    
                  </div>

               

                </form> 

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4" style="text-align:center;">Purchase Request Tracking System</h4>
                <p class="small mb-0" style="text-align:center;">A tracking system, also known as a locating system, is used to observe moving people or objects and provide a timed ordered sequence of location data for further processing.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
    
</body>

<?php 

include 'footer.php';

?>
</html>