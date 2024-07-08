<?php include './header.php'?>
<?php include './dbinit.php'?>
<?php
$value='';

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



?>


<?php 

  if (isset($_POST['submit'])) {
    print_r($_POST);
    
  $folder = './products/';
  $target=$folder.basename($_FILES['image']['name']);
  $image=basename($_FILES['image']['name']);

  $negotiable=$_POST['negotiable']?1:0;
  $units=$_POST['units'];
  $price=$_POST['price'];
  $contact=$_POST['contact'];
  $location=$_POST['location'];
  $name=$_POST['name'];
  $description=$_POST['description'];
  $addedby=$_SESSION['id'];




  $sql="INSERT INTO products (userId, name, description, price, image, negotiable, location, quickcontact,units)
  VALUES ( $addedby,'$name', '$description', $price, '$image', '$negotiable', '$location', '$contact','$units')
  ";
    if (mysqli_query($conn,$sql)) {
		  move_uploaded_file($_FILES['image']['tmp_name'],$target);
		
      	
    }else {
      echo 'failed';
    }
  }

 if (count($_SESSION)>0) {
    $id=$_SESSION['id'];
    $sql="SELECT * FROM users WHERE id=$id";
    $results=mysqli_query($conn,$sql);
    $users=mysqli_fetch_all($results,MYSQLI_ASSOC);
    $user=$users[0];
 }

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
  
  if (isset($_GET['search'])) {

    $value=$_GET['value'];
  
      if (!empty($value)) {
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
  users ON products.userId = users.id   where products.name like '%$value%' or products.location like '%$value%' or products.price like '%$value%' order by id desc
";
      $results =mysqli_query($conn,$sql);
      $Products=mysqli_fetch_all($results,MYSQLI_ASSOC);
    
    }
  
  
    
  }

?>
<main id="main" data-aos="fade-in" class=''>
  <div class="w-100" style="height:10px"></div>
  <div
    class="breadcrumbs d-flex  align-items-center justify-content-between p-2"
    style="top: 0; height: 50px; margin-bottom: 10px">
     <h2>products</h2>
     <div class="col-lg-4" style="position: relative;">
                <form action="" method="get">
                  <input type="search" name='value'  name='value' value='<?php echo $value ?>' style="outline: none;" autocomplete="off" class="form-control" name="search" placeholder="Search product...">

                    <button name='search' type='submit' value="search"   style="position: absolute; top: 1px; color: blue; right: 3px; cursor: pointer; padding: 0px; border: 0; "><span class="bi bi-search btn rounded  border-0"></span> </button>
                  </input>

                </form> 
            </div>
     <?php echo count($_SESSION)===0?'<a  href="login.php" ><button class="btn btn-dark">Sign in to add product</button>
         </a> ':' <a
          class="btn btn-dark"
          data-bs-toggle="modal"
          href="#exampleModalToggle"
          role="button"
          >Add product</a
        >'   ?>
     

    
    
   
  </div>
  <div class="row p-1">
    
    <!-- [
    
] -->

  <?php foreach ($Products as $product) { ?> 
     <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="card border-0">
      <div class="overflow-hidden" style="height:200px;">
        <img class="card-img-top" style="object-fit:cover;" src="products/<?php echo $product['image'] ?>" alt="">
      </div>
        
        <div class="card-body">
          <h4 class="card-title" style="text-transform: capitalize;"><?php echo $product['name'] ?></h4>
          <p class="card-text"><?php echo $product['description'] ?></p>
          <p><i class="bi bi-phone"></i> <strong><a href="tel:<?php echo '+256'. htmlspecialchars($product['quickcontact']); ?>"><?php echo '+256'.$product['quickcontact'] ?></a></strong></p>
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
<?php include './footer.php'?>

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
          Add product
        </h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>  
      <form enctype="multipart/form-data" method="POST">
      <div class="modal-body">
      
      <div class="form-group">
        <label for="name">product Name</label>
        <input required type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="name">
        
      </div>
      <div class="form-group">
        <label for="description">description</label>
        <input required type="text" class="form-control" name="description" id="description" aria-describedby="helpId" placeholder="description">
        
      </div>
      <div class="form-group">
        <label for="location">location</label>
        <input required type="text" value='<?php echo $user['location'] ?>' class="form-control" name="location" id="location" aria-describedby="helpId" placeholder="location">
        <small id="helpId" class="form-text text-muted">actual product location</small>
      </div>
      <div class="form-group">
        <label for="contact">quick contact</label>
        <input type="number" value='<?php echo $user['contact'] ?>' class="form-control" name="contact" id="contact" aria-describedby="helpId" placeholder="contact">
        
      </div>
      <div class="d-flex align-items-end justify-content-evenly">
      <div class="form-group">
        <label for="price">price</label>
        <input required type="number"  class="form-control" name="price" id="price" aria-describedby="helpId" placeholder="price">
        
      </div>
      <h4 class="text-end">/</h4>
      <div class="form-group">
        <label for="units">units</label>
        <input required type="text"  class="form-control" name="units" id="units" aria-describedby="helpId" placeholder="units">
        
      </div>
      </div>
    


        <div class="form-check form-check-inline">
          <input
            class="form-check-input"
            type="checkbox"
            id=""
            name='negotiable'
            value="negotiable"
          />
          <label class="form-check-label" for="">negotiable</label>
        </div>

        <div class="mb-3">
          <label for="image" class="form-label">product image</label>
          <input
            type="file"
            class="form-control"
            name="image"
            id="image"
            placeholder=""
            aria-describedby="fileHelpId"
          />
          
        </div>
        
       
       
        
        
      </div>
      <div class="modal-footer">
        <button
          type="submit"
          class="btn btn-primary"
          name="submit"
        >
          Add product
        </button>
        
      </div>
    </form>
    </div>
  </div>
</div>




<div
  class="modal fade"
  id="exampleModalToggle2"
  aria-hidden="true"
  aria-labelledby="exampleModalToggleLabel2"
  tabindex="-1"
>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">
          Modal 2
        </h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        Hide this modal and show the first with the button below.
      </div>
      <div class="modal-footer">
        <button
          class="btn btn-primary"
          data-bs-target="#exampleModalToggle"
          data-bs-toggle="modal"
        >
          Back to first
        </button>
      </div>
    </div>
  </div>
</div>



