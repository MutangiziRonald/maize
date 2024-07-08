<?php include './header.php'?>
<?php   
 include 'dbinit.php';


  $id=$_SESSION['id'];
  $sql="SELECT * FROM users WHERE id=$id";
  $results=mysqli_query($conn,$sql);
  $users=mysqli_fetch_all($results,MYSQLI_ASSOC);
  $user=$users[0];
  
  $sql="SELECT * FROM blogs WHERE addedBy=$id";
  $results=mysqli_query($conn,$sql);
  $blogs=mysqli_fetch_all($results,MYSQLI_ASSOC);
  
  

?>
<?php

 function  getLikes($BlogId)
  {include './dbinit.php';
    $sql="SELECT * FROM likes WHERE blogId=$BlogId";
    $results =mysqli_query($conn,$sql);
    $likes=mysqli_fetch_all($results,MYSQLI_ASSOC);
   
    return count($likes);
    

    
  }
  function liked($blogId){
    include './dbinit.php';
    $id=$_SESSION['id'];
    $sql="SELECT * FROM likes WHERE blogId=$blogId AND userId=$id";
    $results =mysqli_query($conn,$sql);
    $likes=mysqli_fetch_all($results,MYSQLI_ASSOC);
    return count($likes);

  }


if (isset($_GET['deleteid'])) {
    
    $id=$_GET['deleteid'];
    
     
    
      $sql="DELETE FROM blogs WHERE blog_id='$id' ";
    if (mysqli_query($conn,$sql)) {header('location:./profile.php');}else{echo 'failed'; }
      
    
    
    
      

  }
?>
  <main id="main" data-aos="fade-in" class="position-relative  ">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center p-2 " style=" top: 0; height:50px;margin-bottom:10px;">
      <div class="d-none d-md-block">
        <h2><?php echo $user['role']  ?> Profile</h2>
        
      </div>
      <div class="d-flex justify-content-end align-items-center" style="flex:1;">
        <div class="dropdown">
          <button
            class="btn btn-secondary dropdown-toggle"
            type="button"
            id="triggerId"
            data-bs-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            language
          </button>
          <div class="dropdown-menu" aria-labelledby="triggerId">
            <?php foreach ($languages as $language) {?>
              <a class="dropdown-item" href="lang.php?language=<?php echo $language['name'] ?>"><?php echo $language['name'] ?></a>
            <?php } ?> 
          </div>
        </div>
        
      <a href="?products" style="text-decoration: none;margin-right:10px;" class=" m-1 <?php  echo $_SERVER['QUERY_STRING']=='products'?'text-light':'text-secondary'  ?>">
        products
      </a>
      <a href="?blogs" style="text-decoration: none;" class=" m-1 <?php  echo $_SERVER['QUERY_STRING']=='blogs'?'text-light':'text-secondary'  ?>">
        your blogs
      </a>
      <a href="?sign">
        <button class="btn btn-dark m-1"> sign out</button>
      </a>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Courses Section ======= -->
    <div id="courses" class="courses row overflow-auto bg-light w-100 h-auto" style="position: relative; top: 0; height: 90vh;" >
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">

          
          <div class="col-md-4 col-sm-12 d-flex align-items-stretch" >
            <div class="course-item w-100">
              <img src="imgs/<?php echo $user['image']  ?>"style="width:100%; height:235px;" class="img-contain" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4><?php echo $user['company']  ?></h4>
                </div>

                <h3><?php echo $user['motto']  ?></h3>
                <p><?php echo $user['description']  ?></p>
                <h4>
                  Tel:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span><?php echo $user['contact']  ?></span><br>
                  Location: &nbsp;&nbsp;<span><?php echo $user['location']  ?></span><br>
                  Email:&nbsp;&nbsp;&nbsp; <a href="https://<?php echo $user['email']  ?>" style="color:white;"><span><?php echo $user['email']  ?></span></a>

                </h4>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                    <img src="logos/<?php echo $user['logo']  ?>" class="img-fluid" alt="">
                    <span><?php echo $user['name']  ?></span>
                  </div>
                  <div class="trainer-rank d-flex align-items-center">

                     <a href="#" data-bs-toggle="modal" data-bs-target="#basicModal"><i style="color:blue; font-size: 30px;" title="Edit profile" class="bx bx-pencil"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End Course Item-->

          <div class="col-md-8 border d-grid col-sm-12 p-2" style="grid-template-columns: repeat(2,1fr);">
            
            
            <?php foreach ($blogs as $blog) {?>
              <div class=" d-flex align-items-stretch">
              <div class="course-item">
              <img src="blogs/<?php echo $blog['image']  ?>" style="width:100%;  height:235px;" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                 
                  <!-- <p class="price">$169</p> -->
                </div>

                <h3><?php echo $blog['title']  ?></h3>
                <p><?php echo $blog['body']  ?>.</p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                   
                    
                    
                    
                  </div>
                  <div>
                  <a href="?deleteid=<?php echo $blog['blog_id']?>"><i class="bi bi-trash"></i> </a>
                  <a href="like.php?page=<?php echo($_SERVER['PHP_SELF'])?>? && id=<?php echo base64_encode($blog['blog_id'])   ?>" class="" style=" margin-right:10px;">
                  <span class="badge badge-pill badge-dark text-dark"><?php echo getLikes($blog['blog_id'])  ?>
                <span class="bi bi-heart-fill <?php echo count($_SESSION)>0 && liked($blog['blog_id'])>0?"text-info":"text-dark" ?> text-info"></span>
                </span>
                  
                </a></div>
                </div>
              </div>
            </div>
          </div>
          <?php }  ?>
          </div>


 


      </div>
    </div><!-- End Courses Section -->

  </main><!-- End #main -->





               <!-- Model -->

  <div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="color: #5fcf80">Edit Profile</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" action='./editprofile.php'>
                <label>Image</label>
                  <!-- <input type="file" value="<?php echo $user['image']  ?>" name="image" placeholder="Image" title="Image" class="form-control"> -->

                  <input type="text" value="<?php echo $user['name']  ?>" name="name" placeholder="Company Name" title="Name" value="" class="form-control">

                  <input type="text" value="<?php echo $user['company']  ?>" name="company" placeholder="Company Name" title="Name" value="" class="form-control">
               
                  <input type="text" value="<?php echo $user['motto']  ?>" name="motto" placeholder="Motto/Slogan" title="motto" class="form-control">
               
                  <input type="text" value="<?php echo $user['description']  ?>" placeholder="About" name="text" title="About" class="form-control">

                  <input type="number" value="<?php echo $user['contact']  ?>" placeholder="Contact" name="contact" title="Contact" class="form-control">

                  <input type="text" value="<?php echo $user['location']  ?>" placeholder="Location" name="location" title="Location" class="form-control">

                  <input type="text" value="<?php echo $user['website']  ?>" placeholder="Website/ Optional" name="website" title="Website" class="form-control">

                  <div class="field input" >
                 
                 
                </div>

                 <label>Logo</label>
                <!-- <input type="file" name="logo" placeholder="Logo" title="logo" class="form-control"> -->
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
          <input type="submit" name='submit' style="background: #5fcf80; border: none;" class="btn btn-success"></inp>
        </div></form>
      </div>
    </div>
  </div><!-- End Basic Modal-->

  <!-- ======= Footer ======= -->
  <?php include './footer.php'?>