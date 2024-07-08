<?php include './header.php'?>
<!-- End Header -->
<?php include './dbinit.php'  ?>
<?php
if (isset($_POST['submit'])) {


  $folder = './blogs/';
  $target=$folder.basename($_FILES['image']['name']);
  $image=basename($_FILES['image']['name']);

  $title=$_POST['title'];
  $body=$_POST['body'];
  $addedby=$_SESSION['id'];


  $sql="INSERT INTO blogs (body,title,image,addedBy) VALUES('$body','$title','$image',$addedby)";
    if (mysqli_query($conn,$sql)) {
		move_uploaded_file($_FILES['image']['tmp_name'],$target);
		
      	
    }else {
      echo 'failed';
    }
}



  $sql="select blogs.blog_id, blogs.title, blogs.body, blogs.date, blogs.image, blogs.addedBy,
  users.name, users.company from blogs
  INNER JOIN users ON blogs.addedBy = users.id";
  $results =mysqli_query($conn,$sql);
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

?>


<div class="w-100" style="height:10px"></div>
    <div class="breadcrumbs d-flex align-items-center p-2" style="height:50px;">
      
        <div class="d-flex justify-content-between align-items-center w-100 ">
          <h2>Blogs</h2>
          <?php echo count($_SESSION)===0?'<a  href="login.php" ><button class="btn btn-dark">sign in to Add blog</button>
         </a> ':'<button class="btn btn-dark " data-bs-toggle="modal" data-bs-target="#basicModal">
         Add blog</button> '   ?>
        

        </div>
        
     
    </div><!-- End Breadcrumbs -->



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

                  <input type="text" name="title"  placeholder="Title" title="Title" class="form-control"><br>
               
                  <textarea name="body" id="" class='form-control w-100'  rows="5"></textarea>
               
              
                
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
          <input type="submit" name='submit' style="background: #5fcf80; border: none; "
          value='add' class="btn btn-success"></input>
        </div></form>
      </div>
    </div>
  </div><!-- End Basic Modal-->



<section id="courses" class="courses">
  <div class="container" data-aos="fade-up">
	<div class="row" data-aos="zoom-in" data-aos-delay="100">

  <?php foreach ($blogs as $blog) {?>
      <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="course-item">
              <img src="blogs/<?php echo $blog['image']  ?>" style="width:100%;  height:235px;" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4><?php echo $blog['company']  ?></h4>
                  <!-- <p class="price">$169</p> -->
                </div>

                <h3><?php echo $blog['title']  ?></h3>
                <p><?php echo $blog['body']  ?>.</p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                   
                    <span><?php echo $blog['name']  ?></span>
                    
                    
                  </div>
                  
                  <a href="like.php?page=<?php echo($_SERVER['PHP_SELF'])?>? && id=<?php echo base64_encode($blog['blog_id'])   ?>" class="" style=" margin-right:10px;">
                  <span class="badge badge-pill badge-dark text-dark"><?php echo getLikes($blog['blog_id'])  ?>
                <span class="bi bi-heart-fill <?php echo count($_SESSION)>0 && liked($blog['blog_id'])>0?"text-info":"text-dark" ?> text-info"></span>
                </span>
                  
                </a>
                </div>
              </div>
            </div>
          </div>
  <?php }  ?>


         <!-- End Course Item-->

          
    </div>
 </div>

</section>


         <!-- ======= Footer ======= -->
         <?php include './footer.php'?>