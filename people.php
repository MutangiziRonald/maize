<?php

include './dbinit.php';

session_start();
$err='';

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


if (isset($_GET['deleteid'])) {
    
  $id=$_GET['deleteid'];
 
  if ($_SESSION['id']==$id) {
    $err='you cant delete your self';
  } else {
     $sql="DELETE FROM users WHERE id='$id' ";
  if (mysqli_query($conn,$sql)) {header('location:./people.php');}else{echo 'failed'; }
  }
    
    

}


  
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>UG Maize- Blog|Home</title>
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

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block" style="color: #5fcf80;">UG MAIZE</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    <?php  if (strlen($err) >0): ?>
       <div
    class="alert alert-danger alert-dismissible fade show"
    role="alert">
    
    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close"
    ></button>

    <strong>Error!</strong> <?php echo $err ?>
</div>
    <?php endif ?>
    
     
    

    

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
          <!-- <button style="background: #5fcf80;
           padding: 4px; margin:5px;
           border: 2px solid #5fcf80;
           color: white;" data-bs-toggle="modal" data-bs-target="#basicModal">
         Add blog</button>
 -->

        </li><!-- End Notification Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->
             



  </header><!-- End Header -->
<?php include 'sidebar.php'  ?>
  <!-- ======= Sidebar ======= -->
  <!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1 style="color: #5fcf80;">people</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          
        </ol>
      </nav>
    </div><!-- End Page Title -->



    <!-- Model -->

  <div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="color: #5fcf80">Add Blog</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" enctype="multipart/form-data">
                <label>Image</label>
                  <input type="file" name="image" placeholder="Image" title="Image" class="form-control"><br>

                  <input type="text" name="title" placeholder="Title" title="Title" class="form-control"><br>
               
                  <input type="text" name="sub" placeholder="Sub title" title="Sub title" class="form-control"><br>
               
                  <input type="text" placeholder="Blog Text" name="text" title="message" class="form-control"><br>
              
                <input type="text" placeholder="Author" name="Author" title="Name" class="form-control">
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" style="background: #5fcf80; border: none;" class="btn btn-success">Add</button>
        </div>
      </div>
    </div>
  </div><!-- End Basic Modal-->



 <!-- data -->



    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <p>Buyers <?php echo $users[0]['Buyer']  ?></p>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                   
                    <th scope="col">Image</th>
                    <th scope="col">name</th>
                    <th scope="col">company</th>
                    <th scope="col">contact</th>
                    <th scope="col">admin</th>
                    <th scope="col">date added</th></th>
                    <th scope="col">operations</th></th>

                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($buyers as $buyer) {?>
                     <tr>
                    <th scope="row">
                      <img src="imgs/<?php echo $buyer['image']  ?>" style="width: 80px; height: 80px;">
                    </th>
                    <td><?php echo $buyer['name']  ?></td>
                    <td><?php echo $buyer['company']  ?></td>
                    <td><?php echo $buyer['contact']  ?></td>
                    <td><?php echo $buyer['admin']==0?'no':'yes'  ?></td>
                    <td><?php echo $buyer['dateAdded']  ?></td>
                    <td class="d-flex">
                      <a
                        class="btn btn-info position-relative"
                        
                        href="admin.php?admin=<?php echo $buyer['admin']==0?false:true  ?> && id=<?php echo $buyer['id']?>"
                        role="button"
                        
                        >
                        <span class="bi bi-person m-0 p-0"></span><br>
                        <span class="m-0 p-0 position-absolute" style="font-size: 8px; bottom: 3px; left: 9px;">admin</span>
                        </a>
                    
                       <a href="?deleteid=<?php echo $buyer['id']?>" class="btn btn-danger"><span class="bi bi-trash"></span></a>
                    </td>
                  </tr>
                  <?php }  ?>
                 
                  
                  


              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div><!-- end card -->
          <div class="card">
            <div class="card-body">
              <p>Sellers <?php echo $users[0]['Seller']  ?></p>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                   
                    <th scope="col">Image</th>
                    <th scope="col">name</th>
                    <th scope="col">company</th>
                    <th scope="col">contact</th>
                    <th scope="col">admin</th>
                    <th scope="col">date added</th></th>
                    <th scope="col">operations</th></th>

                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($sellers as $seller) {?>
                     <tr>
                    <th scope="row">
                      <img src="imgs/<?php echo $seller['image']  ?>" style="width: 80px; height: 80px;">
                    </th>
                    <td><?php echo $seller['name']  ?></td>
                    <td><?php echo $seller['company']  ?></td>
                    <td><?php echo $seller['contact']  ?></td>
                    <td><?php echo $seller['admin']==0?'no':'yes'  ?></td>
                    <td><?php echo $seller['dateAdded']  ?></td>
                    <td>
                      <a
                        class="btn btn-info position-relative"
                        
                        href="admin.php?admin=<?php echo $seller['admin']==0?false:true  ?> && id=<?php echo $seller['id']?>"
                        role="button"
                        
                        >
                        <span class="bi bi-person m-0 p-0"></span><br>
                        <span class="m-0 p-0 position-absolute" style="font-size: 8px; bottom: 3px; left: 9px;">admin</span>
                        </a>
                      
                       <a href="?deleteid=<?php echo $seller['id']?>" class="btn btn-danger"><span class="bi bi-trash"></span></a>
                    </td>
                  </tr>
                  <?php }  ?>
                 
                  
                  


              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div><!-- end card -->
          <div class="card">
            <div class="card-body">
              <p>Service Providers <?php echo $users[0]['Provider']  ?></p>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                   
                    <th scope="col">Image</th>
                    <th scope="col">name</th>
                    <th scope="col">company</th>
                    <th scope="col">contact</th>
                    <th scope="col">admin</th>
                    <th scope="col">date added</th></th>
                    <th scope="col">operations</th></th>

                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($providers as $provider) {?>
                     <tr>
                    <th scope="row">
                      <img src="imgs/<?php echo $provider['image']  ?>" style="width: 80px; height: 80px;">
                    </th>
                    <td><?php echo $provider['name']  ?></td>
                    <td><?php echo $provider['company']  ?></td>
                    <td><?php echo $provider['contact']  ?></td>
                    <td><?php echo $provider['admin']==0?'no':'yes'  ?></td>
                    <td><?php echo $provider['dateAdded']  ?></td>
                    <td>
                      <a
                        class="btn btn-info position-relative"
                        
                        href="admin.php?admin=<?php echo $provider['admin']==0?false:true  ?> && id=<?php echo $provider['id']?>"
                        role="button"
                        
                        >
                        <span class="bi bi-person m-0 p-0"></span><br>
                        <span class="m-0 p-0 position-absolute" style="font-size: 8px; bottom: 3px; left: 9px;">admin</span>
                        </a>
                       <a href="?deleteid=<?php echo $provider['id']?>" class="btn btn-danger"><span class="bi bi-trash"></span></a>
                    </td>
                  </tr>
                  <?php }  ?>
                 
                  
                  


              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div><!-- end card -->
        </div>
      </div>
    </section>

  






  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<div
    class="modal fade"
    id="exampleModalToggle"
    aria-hidden="true"
    aria-labelledby="exampleModalToggleLabel"
    tabindex="-1"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">
                    Modal 1
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                Show a second modal and hide this one with the button
                below.
            </div>
            <div class="modal-footer">
                <button
                    class="btn btn-primary"
                    data-bs-target="#exampleModalToggle2"
                    data-bs-toggle="modal"
                >
                    Open second modal
                </button>
            </div>
        </div>
    </div>
</div>
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

</html>