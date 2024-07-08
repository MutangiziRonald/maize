

<?php

  include './dbinit.php';
  session_start();

  if ( count($_SESSION)==0) {
  
  
    header('location: ./login.php');
  };


  $sql="SELECT * FROM users WHERE admin =1";
  $results =mysqli_query($conn,$sql);
  $admins=mysqli_fetch_all($results,MYSQLI_ASSOC);

  if (count($admins)==0) {
    
  }
  $id=$_SESSION['id'];
   if (isset($_GET['continue'])) {
    $sql="UPDATE users SET admin=true WHERE id= $id";
    if (mysqli_query($conn,$sql)) {
      
      header('location: ./dashboard.php');
          
      }else {
        echo 'failed';
      }
   }


  

   $sql="select(select count(*) from users where role = 'Seller') as Seller,
   (select count(*) from users where role = 'Service Provider') as Provider,
   (select count(*) from users where role = 'Buyer') as Buyer, 
   (select count(*) from blogs) as Blogs ";
   $results =mysqli_query($conn,$sql);
   $amount=mysqli_fetch_all($results,MYSQLI_ASSOC);

   


  

$sql="select(select count(*) from users where role = 'Seller') as Seller,
  (select count(*) from users where role = 'Service Provider') as Provider,
  (select count(*) from users where role = 'Buyer') as Buyer";
  $results =mysqli_query($conn,$sql);
  $users=mysqli_fetch_all($results,MYSQLI_ASSOC);




$sql="SELECT * FROM users WHERE role='seller'";
$results =mysqli_query($conn,$sql);
$sellers=mysqli_fetch_all($results,MYSQLI_ASSOC);


$sql="SELECT * FROM users WHERE role='buyer'";
$results =mysqli_query($conn,$sql);
$buyers=mysqli_fetch_all($results,MYSQLI_ASSOC);


$sql="SELECT * FROM users WHERE role='service provider'";
$results =mysqli_query($conn,$sql);
$providers=mysqli_fetch_all($results,MYSQLI_ASSOC);


$sql="SELECT count(*) as Blogs FROM blogs";
$results =mysqli_query($conn,$sql);
$providers=mysqli_fetch_all($results,MYSQLI_ASSOC);

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>UG Maize- Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/" rel="icon">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets2/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets2/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets2/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets2/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets2/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets2/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets2/css/style.css" rel="stylesheet">
</head>
 <?php if (count($admins)==0) {?>
    <body class='vh-100 vw-100 d-flex align-items-center justify-content-center'>
      <div class="h-50 w-75 bg-light rounded  text-center">
        <p>this is the administrotor to manage every thing in the website <br>
        other adminstotors will be added manuary by you. <br>
        click continue to prceed to your admin dashboard
      </p>
      <a href="?continue" class="btn btn-primary btn-lg">continue</a>
      </div>
    </body>
  <?php } else{ ?>
<body>
 <?php  if ($_SESSION['admin']==0) {
    header('location: ./index.php');
   } ?>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block" style="color: #5fcf80;">UG MAIZE</span>
        
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">



        </li><!-- End Notification Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include 'sidebar.php' ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1 style="color: #5fcf80;">Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-lg-4 col-md-4">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Sellers</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $amount[0]['Seller']  ?></h6>
                      
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-lg-4 col-md-4">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Buyers</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $amount[0]['Buyer']  ?></h6>
                      
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

             <!-- Revenue Card -->
            <div class="col-xxl-4 col-lg-4 col-md-4">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Service Providers</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $amount[0]['Provider']  ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4  col-lg-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Blogs</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-chat"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $amount[0]['Blogs']  ?></h6>
                     
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class=" col-sm-12 col-xl-12">
              <div class="card">

                <!-- Bar Chart -->
              <canvas id="barChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#barChart'), {
                    type: 'bar',
                    data: {
                      labels: ['Users', 'Sellers', 'Buyers','Service Providers', 'Blogs',],
                      datasets: [{
                        label: 'Bar Chart',
                        data: [<?php echo $amount[0]['Buyer']+$amount[0]['Seller']+$amount[0]['Provider']?>, <?php echo $amount[0]['Seller']  ?>, <?php echo $amount[0]['Buyer']  ?>, <?php echo $amount[0]['Seller']  ?>,<?php echo $amount[0]['Blogs']  ?>],
                        backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(255, 159, 64, 0.2)',
                          'rgba(255, 205, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          
                          
                        ],
                        borderColor: [
                          'rgb(255, 99, 132)',
                          'rgb(255, 159, 64)',
                          'rgb(255, 205, 86)',
                          'rgb(75, 192, 192)',
                          'rgb(54, 162, 235)',
                         
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                });
              </script>
              <!-- End Bar CHart -->

              </div>
            </div><!-- End Reports -->

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                


              </div>
            </div><!-- End Recent Sales -->



          </div>
        </div><!-- End Left side columns -->






        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets2/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets2/vendor/chart.js/chart.umd.js"></script>
  <script src="assets2/vendor/echarts/echarts.min.js"></script>
  <script src="assets2/vendor/quill/quill.min.js"></script>
  <script src="assets2/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets2/vendor/tinymce/tinymce.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets2/js/main.js"></script>

</body>
    <?php }?>


</html>