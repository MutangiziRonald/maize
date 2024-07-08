<?php include './header.php'?>
<?php

  include './dbinit.php';
  $sql="SELECT * FROM users WHERE role='seller'";
  $results =mysqli_query($conn,$sql);
  $users=mysqli_fetch_all($results,MYSQLI_ASSOC);
  $value='';
  if (isset($_GET['search'])) {
    $value=$_GET['value'];
      if (!empty($value)) {
    
    $sql="SELECT * FROM users WHERE role='seller' and company LIKE '%$value%' or name like '%$value%'  ;";
    $results =mysqli_query($conn,$sql);
    $users=mysqli_fetch_all($results,MYSQLI_ASSOC);

   
    
   }
    
  }
 

?>

  <main id="main" data-aos="fade-in">
  <div class="w-100" style="height:10px"></div>
    <!-- ======= Breadcrumbs ======= -->
    


      <div class="breadcrumbs d-flex align-items-center p-2 " style=" padding-top: 30px; height:50px;margin-bottom:10px;">
          <h2>Sellers </h2>
          <div class="d-flex align-items-center justify-content-end" style="flex:1">
          
            <div class="col-lg-4" style="position: relative;">
                <form action="" method="get">
                  <input type="search" name='value'  name='value' value='<?php echo $value ?>' style="outline: none;" autocomplete="off" class="form-control" name="search" placeholder="Search ...">

                  <button name='search' type='submit' value="search"   style="position: absolute; top: 1px; color: blue; right: 3px; cursor: pointer; padding: 0px; border: 0; "><span class="bi bi-search btn rounded  border-0"></span> </button>
                  </input>

                </form> 
            </div>
           
          </div>
      </div>
   

    <!-- ======= Courses Section ======= -->
    <section id="courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <?php foreach ($users as $user ) {?>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" >
            <div class="course-item w-100">
              <img src="imgs/<?php echo $user['image']  ?>"style="width:100%; height:235px;" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4><?php echo $user['company']  ?></h4>
                  
                </div>

                <h3><?php echo $user['motto']  ?></h3>
                <p><?php echo $user['description']  ?></p>
                <h4>
                  Tell:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span><?php echo $user['contact']  ?></span><br>
                  Location: &nbsp;&nbsp;<span><?php echo $user['location']  ?></span><br>
                  Website:&nbsp;&nbsp;&nbsp; <a href="https://www.bukoola.com" style="color:white;"><span><?php echo $user['website']  ?></span></a>

                </h4>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                    <img src="logos/<?php echo $user['logo']  ?>" class="img-fluid" alt="">
                    <span><?php echo $user['name']  ?></span>
                  </div>
                  <div class="trainer-rank d-flex align-items-center">
                     <?php if (count($_SESSION)>0 && $_SESSION['id']!=$user['id']) {?>
                      
                      <a href="chat.php?id=<?php echo $user['id']   ?>"><i style="color:blue; font-size: 30px;" title="message" class="bx bx-chat"></i></a>  <?php }?>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End Course Item-->

          <?php }  ?>
          
          <!-- End Course Item-->

        </div>

      </div>
    </section><!-- End Courses Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include './footer.php'?>
