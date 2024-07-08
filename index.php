<?php include './header.php'?>
<?php

include './dbinit.php';

function timeElapsedString($datetime, $full = false) {
  $now = new DateTime();
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'minute',
      's' => 'second',
  );
  foreach ($string as $k => &$v) {
      if ($diff->$k) {
          $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
          unset($string[$k]);
      }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ago' : 'just now';
}

  $sql="SELECT * FROM users";
  $results =mysqli_query($conn,$sql);
  $users=mysqli_fetch_all($results,MYSQLI_ASSOC);
  
  
  $sql="select(select count(*) from users where role = 'Seller') as Seller,
  (select count(*) from users where role = 'Service Provider') as Provider,
  (select count(*) from users where role = 'Buyer') as Buyer";
  $results =mysqli_query($conn,$sql);
  $amount=mysqli_fetch_all($results,MYSQLI_ASSOC);
  
 
  $sql="select blogs.blog_id, blogs.title, blogs.body, blogs.date, blogs.image, blogs.addedBy,
  users.name, users.company from blogs
  INNER JOIN users ON blogs.addedBy = users.id";
  $results =mysqli_query($conn,$sql);
  $blogs=mysqli_fetch_all($results,MYSQLI_ASSOC);


  $sql="SELECT 
  products.*,
  users.name AS user_name,
  users.email AS user_email,
  users.role AS user_role,
  users.image AS user_image,
  users.company AS user_company,
  users.description AS user_description,
  users.logo AS user_logo,
  users.motto AS user_motto,
  users.website AS user_website,
  users.contact AS user_contact,
  users.location AS user_location,
  users.dateAdded AS user_dateAdded,
  users.admin AS user_admin,
  (SELECT COUNT(*) FROM reviews WHERE reviews.productId = products.id) AS reviews
FROM 
  products
JOIN 
  users ON products.userId = users.id order by id desc
";
  $results =mysqli_query($conn,$sql);
  $Products=mysqli_fetch_all($results,MYSQLI_ASSOC);


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

    <section id="hero" class="d-flex justify-content-center align-items-center">
  
      <div
        class="container position-relative"
        data-aos="zoom-in"
        data-aos-delay="100">
       
        <h1><?php echo $language['home1'] ?><br /><?php echo $language['home2'] ?></h1>
        <h2>
        <?php echo $language['home3'] ?>
        </h2>
        <a href="login.php" class="btn-get-started">Get Started</a>
      </div>
    </section>
    <!-- End Hero -->

    <main id="main">
      <!-- ======= About Section ======= -->
      <section id="about" class="about">
        <div class="container" data-aos="fade-up">
          <div class="row">
            <div
              class="col-lg-6 order-1 order-lg-2"
              data-aos="fade-left"
              data-aos-delay="100">
              <img
                src="img/images (6).jpeg"
                style="width: 100%; height: 100%"
                class="img-fluid"
                alt="" />
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
              <h3><?php echo $language['descriptionHead'] ?></h3>
              <p class="fst-italic">
              <?php echo $language['descriptionp1'] ?>
              </p>
              <ul>
                <li>
                  <i class="bi bi-check-circle"></i><?php echo $language['descriptionlist1'] ?>
                </li>
                <li>
                  <i class="bi bi-check-circle"></i><?php echo $language['descriptionlist2'] ?>
                </li>
                <li>
                  <i class="bi bi-check-circle"></i><?php echo $language['descriptionlist3'] ?>
                </li>
              </ul>
              <p>
              <?php echo $language['descriptionp2'] ?>
              </p>
            </div>
          </div>
        </div>
      </section>
      <!-- End About Section -->

      <!-- ======= Counts Section ======= -->
      <section id="counts" class="counts section-bg">
        <div class="container">
          <div class="row counters">
            <div class="col-lg-4 col-6 text-center">
              <span
                id='sellers'
                data-purecounter-start="0"
                data-purecounter-end="<?php echo $amount[0]['Seller']  ?>"
                data-purecounter-duration="1"
                
                class="purecounter"></span>
              <p><a href="./services.php">Sellers</a></p>
            </div>

            <div class="col-lg-4 col-6 text-center">
              <span
                data-purecounter-start="0"
                data-purecounter-end="<?php echo $amount[0]['Buyer']  ?>"
                data-purecounter-duration="1"
                class="purecounter"></span>
              <p><a href="./buyers.php">Buyers</a></p>
            </div>

            <div class="col-lg-4 col-6 text-center">
              <span
                data-purecounter-start="0"
                data-purecounter-end="<?php echo $amount[0]['Provider']  ?>"
                data-purecounter-duration="1"
                class="purecounter"></span>
              <p><a href="./services.php">Service Providers</a></p>
            </div>

            <!-- <div class="col-lg-3 col-6 text-center">
              <span
                data-purecounter-start="0"
                data-purecounter-end="15"
                data-purecounter-duration="1"
                class="purecounter"></span>
              <p>Trainers</p>
            </div> -->
          </div>
        </div>
      </section>
      <!-- End Counts Section -->

      <!-- ======= Features Section ======= -->
      <section id="features" class="features">
        <div class="container" data-aos="fade-up">
          <div class="section-title">
            <p><br /></p>
            <h2>Top Services</h2>
          </div>

          <div class="row" data-aos="zoom-in" data-aos-delay="100">
            <div class="col-lg-3 col-md-4">
              <div class="icon-box">
                <i class="ri-store-line" style="color: #ffbb2c"></i>
                <h3><a href="services.php">Stores</a></h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
              <div class="icon-box">
                <i class="ri-bar-chart-box-line" style="color: #5578ff"></i>
                <h3><a href="services.php">Analytics</a></h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
              <div class="icon-box">
                <i class="ri-calendar-todo-line" style="color: #e80368"></i>
                <h3><a href="services.php">Calender</a></h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
              <div class="icon-box">
                <i
                  class="bi bi-currency-exchange"
                  style="color: lightgreen"></i>
                <h3><a href="">Prices</a></h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4">
              <div class="icon-box">
                <i class="ri-database-2-line" style="color: #47aeff"></i>
                <h3><a href="services.php">Data Sets</a></h3>
              </div>
            </div>

            <div class="col-lg-3 col-md-4 mt-4">
              <div class="icon-box">
                <i class="ri-file-list-3-line" style="color: #11dbcf"></i>
                <h3><a href="services.php">Documentations</a></h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4">
              <div class="icon-box">
                <i class="ri-price-tag-2-line" style="color: #4233ff"></i>
                <h3><a href="services.php">Notes</a></h3>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Features Section -->

      <!-- ======= Popular blogs Section ======= -->
      <section id="popular-courses" class="courses">
        <div class="container" data-aos="fade-up">
          <div class="section-title">
            <h2><?php echo $language['stories'] ?></h2>
            <p><?php echo $language['popularBlogs'] ?></p>
          </div>

          <div class="row" data-aos="zoom-in" data-aos-delay="100">
            <?php for ($i=0; $i < count($blogs) ; $i++) { ?>
            <?php if ($i>5) {
              break;
            } ?>
              <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
              <div class="course-item">
                <img src="blogs/<?php echo $blogs[$i]['image']  ?>" style="width:100%;  height:235px;" class="img-fluid" alt="...">
                <div class="course-content">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4><?php echo $blogs[$i]['company']  ?></h4>
                    <!-- <p class="price">$169</p> -->
                  </div>

                <h3><?php echo $blogs[$i]['title']  ?></h3>
                <p><?php echo $blogs[$i]['body']  ?>.</p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                   
                    <span><?php echo $blogs[$i]['name']  ?></span>
                      
                  </div>
                  <a href="like.php?page=<?php echo($_SERVER['PHP_SELF'])?>? && id=<?php echo base64_encode($blogs[$i]['blog_id'])   ?>" class="" style=" margin-right:10px;">
                  <span class="badge badge-pill badge-dark text-dark"><?php echo getLikes($blogs[$i]['blog_id'])  ?>
                <span class="bi bi-heart-fill <?php echo count($_SESSION)>0 && liked($blogs[$i]['blog_id'])>0?"text-info":"text-dark" ?> text-info"></span>
                </span>
                  
                </a>
                </div>
              </div>
            </div>
          </div>
          
        <?php }  ?>


          





           
            
          </div>
        </div>
      </section>
      <section id="popular-courses" class="courses">
        <div class="container" data-aos="fade-up">
          <div class="section-title">
            <h2>Top products</h2>
            <p>quick access to products</p>
          </div>
        </div>
        <main id="main" data-aos="fade-in" class=''>
        <div class="row p-1">
          <?php foreach ($Products as $product) { ?> 
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="card border-0">
              <div class="overflow-hidden" style="height:200px;">
                <img class="card-img-top" style="object-fit:cover;" src="products/<?php echo $product['image'] ?>" alt="">
              </div>
                
                <div class="card-body">
                  <h4 class="card-title" style="text-transform: capitalize;"><?php echo $product['name'] ?></h4>
                  <p class="card-text"><?php echo $product['description'] ?></p>
                  <p><i class="bi bi-phone"></i> <strong><a href="tel:<?php echo htmlspecialchars($product['quickcontact']); ?>"><?php echo $product['quickcontact'] ?></a></strong></p>
                  <p><i class="bi bi-geo-alt"></i> <strong><?php echo $product['location'] ?></strong></p>
                  <p class="d-flex align-items-center justify-content-between w-100"> <span><i class="bi bi-wallet2"></i> <strong>UGX.<?php echo $product['price'] ?> / <?php echo $product['units'] ?></strong> </span>
                  <a href="order.php?product=<?php echo $product['id'] ?>" class="" style="text-decoration: none;font-size:20px;"><strong>order now</strong></a>
                
                
                  </p>
                      <div class="d-flex align-items-center">
                        <img
                  src="imgs/<?php echo $product['user_image'] ?>"
                  class="img-fluid rounded-circle"
                  alt=""
                  height='30'
                  width='30'
                  />
                  <div class="flex-1" style="margin-left:5px;flex:1;">
                    <strong class='m-0'><?php echo $product['user_name'] ?></strong><br>
                    <small ><?php echo $product['user_company'] ?></small>
                  </div>
                  
                </div>
                <p class="card-text text-end w-100 d-flex align-items-center justify-content-between p-1"><a href='order.php?product=<?php echo $product['id'] ?>'><?php echo $product['reviews'] ?><i class='bi bi-chat-square-text m-1'></i></a><small class="text-muted"><?php echo timeElapsedString($product['dateadded']);   ?></small></p>
                  </div>
                
              </div>
            </div>
      <?php } ?> 
          </div>
        </main>
      </section>
      
    </main>
  <script src='fetch.js'></script>
<?php include './footer.php'?>