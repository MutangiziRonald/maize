<?php




include './dbinit.php';

$sql="select(select count(*) from users where role = 'Seller') as Seller,
  (select count(*) from users where role = 'Service Provider') as Provider,
  (select count(*) from users where role = 'Buyer') as Buyer";
  $results =mysqli_query($conn,$sql);
  $users=mysqli_fetch_all($results,MYSQLI_ASSOC);



  $sql="select blogs.blog_id, blogs.title, blogs.body, blogs.date, blogs.image, blogs.addedBy,
  users.name, users.company from blogs
  INNER JOIN users ON blogs.addedBy = users.id";
  $results =mysqli_query($conn,$sql);
  $blogs=mysqli_fetch_all($results,MYSQLI_ASSOC);

  

  if (isset($_GET['deleteid'])) {
    
    $id=$_GET['deleteid'];
    
     
    
      $sql="DELETE FROM blogs WHERE blog_id='$id' ";
    if (mysqli_query($conn,$sql)) {header('location:./blog.php');}else{echo 'failed'; }
      
    
    
    
      

  }


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>UG Maize- Blog</title>
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



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
          <!-- <button style="background: #5fcf80;
           padding: 4px; margin:5px;
           border: 2px solid #5fcf80;
           color: white;" data-bs-toggle="modal" data-bs-target="#basicModal">
         Add blog</button> -->


        </li><!-- End Notification Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->
             



  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include 'sidebar.php'  ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1 style="color: #5fcf80;">Blogs</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="blogs.php">blogs</a></li>
          
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

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                   
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Sub Title</th>
                    <th scope="col">date added</th>
                    <th scope="col">Author</th>
                    <th scope="col">company</th>
                    <th scope="col">Operations</th>

                  </tr>
                </thead>
                <tbody>
                 
                  
                  <?php foreach ($blogs as $blog) {?>
                    <tr>
                    <th scope="row">
                      <img src="blogs/<?php echo $blog['image']?>" style="width: 80px; height: 80px;">
                    </th>
                    <td><?php echo $blog['title']?></td>
                    <td><?php echo $blog['body']?></td>
                    <td><?php echo $blog['date']?></td>
                    <td><?php echo $blog['name']?></td>
                    <td><?php echo $blog['company']?></td>
                    <td class='d-flex'>
                      
                       <a href="?deleteid=<?php echo $blog['blog_id']?>" class="btn btn-danger"><span class="bi bi-trash"></span></a>
                    </td>
                  </tr>
                  <?php } ?>



              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
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

</html>