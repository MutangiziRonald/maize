<?php include './header.php'?>
<?php include './dbinit.php'?>
<?php include './resend.php'?>
<?php

    $err='';
    
    
        if (isset($_GET['back'])) {
        
        header('Location: products.php');
        exit();
    }
    
    

    $id=$_GET['product'];
    
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
    users.admin AS user_admin
  FROM 
    products
  JOIN 
    users ON products.userId = users.id
  WHERE 
    products.id = $id
  
  ";
    $results =mysqli_query($conn,$sql);
    $Products=mysqli_fetch_all($results,MYSQLI_ASSOC);
    $product=$Products[0];



    $sql="SELECT 
    reviews.*,
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
    users.admin AS user_admin
  FROM 
    reviews
  JOIN 
    users ON reviews.userId = users.id
  WHERE 
    reviews.productId = $id 
  
  ";
    $results =mysqli_query($conn,$sql);
    $reviews=mysqli_fetch_all($results,MYSQLI_ASSOC);
    
    

?>
    <?php 
        $msg='';
        if (isset($_POST['save'])) {
            // $to = 'muta.com';
    
            // $subject = 'Hello from PHP';
    
            // $message = 'This is a test email sent from PHP.';
    
            // $headers = 'From: cfontanella@hubspot.com';
    
            // $isSent = mail($to, $subject, $message, $headers);
    
            // if ($isSent) {
    
            // echo 'Email sent successfully.';
    
            // } else {
            // $err='<strong>error</strong> email not sent';
           
    
            // }
           
            $quantity=$_POST['quantity'];
            $sender=$_SESSION['id'];
            $senderName=$_SESSION['userName'];
            $receiver=$product['userId'];
           
            $units=$product['units'];
            $name=$product['name'];
            if ($sender==$receiver) {
                $err='<strong>error</strong> cant order your own product';
            }else {
                 $sql="INSERT INTO messages (message,sender,receiver) VALUES('i need $quantity $units (s) of  $name',$sender,$receiver)";
            if (mysqli_query($conn,$sql)) {
                sendEmail($product['user_email'],'new order'," $senderName needs $quantity $units(s) of  $name check your ug maize account for more details <a href='http://localhost/project/'>click here</a>",null);
                $msg='<strong>success</strong> order added succesfully';
            }
            }
            
           
        };
    ?>

    <?php 
    
    if (isset($_POST['addreview'])) {
        if (count($_SESSION)==0) {
            header('Location: login.php');
        }else {
            $review=$_POST['review'];
            $rating=$_POST['rating'];
            $userId=$_SESSION['id'];
            
            $sql="INSERT INTO reviews (review,userId,rating,productId) VALUES('$review',$userId,'$rating',$id)";
            if (mysqli_query($conn,$sql)) {
                header('Location: order.php?product='.$id);
            }
        }
        
    }
    
    
    
    ?>
 
 
 <main id="main" data-aos="fade-in" class='d-flex flex-column align-items-center bg-light' >
    
   
   
  
    <div
    class="breadcrumbs w-100 d-flex bg-light align-items-center justify-content-between p-2"
    style="top: 0; height: 0px; margin-bottom: 10px"></div>
    <?php if (strlen($err)>0) { ?>
        <div
        class="alert alert-danger alert-dismissible fade show"
        role="alert"
    >
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        ></button>
    
        <?php echo $err ?>
    </div>
    <?php } ?>
    <?php if (strlen($msg)>0) { ?>
        <div
        class="alert alert-success alert-dismissible fade show"
        role="alert"
    >
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        ></button>
    
        <?php echo $msg ?>
    </div>
    <?php } ?>
    <div   class='p-4'style='max-width:700px'>
 
        <div class="row">
            <div class="col-md-6">
                <img  src="products/<?php echo $product['image'] ?>" alt="Product Image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h2><?php echo $product['name'] ?></h2>
                <p><?php echo $product['description'] ?></p>
                <p><strong>Price: </strong>UGX.<?php echo $product['price'] ?>/<?php echo $product['units'] ?></p>
                <div class="d-flex align-items-center justify-content-between">
                    <a href="?back=back">back</a>
                    <?php echo count($_SESSION)===0?'<a  href="login.php" ><button class="btn btn-dark">Create order</button>
                                </a> ':' <a
                        class="btn btn-dark"
                        data-bs-toggle="modal"
                        href="#exampleModalToggle"
                        role="button"
                        >Create order</a
                        >'   ?>
                </div>
                
            </div>
        </div>
        <hr>
        <?php include 'map.php' ?>
        
        <hr>

        <div class="row">
            <div class="col-md-12">
                <h3><?php  echo $language['review'] ?></h3>
                <form method='POST'>
                   
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <select name='rating' class="form-control" id="rating">
                            <option>1 Star</option>
                            <option>2 Stars</option>
                            <option>3 Stars</option>
                            <option>4 Stars</option>
                            <option>5 Stars</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="review">Review</label>
                        <textarea class="form-control" name='review' id="review" rows="3" placeholder="<?php  echo $language['writereview'] ?>"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary m-1" name='addreview'>Submit Review</button>
                </form>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <h3>Reviews</h3>
                <?php foreach ($reviews as $review ) { ?>
                    <div class="media mb-4 d-flex">
                        <img src="imgs/<?php echo $review['user_image'] ?>" alt="User Image" class="mr-3 rounded-circle" style="width:40px; height:40px">
                        <div class="media-body m-1">
                            <h5><strong><?php echo $review['user_name'] ?> </strong><small>Posted on <?php echo $review['date'] ?></small></h5>
                            <p><?php echo $review['review'] ?></p>
                            <p> <strong><?php echo $review['rating'] ?></strong> </p>
                        </div>
                    </div>
                <?php } ?>
                
                
            </div>
        </div>
    </div>
</main>
<?php require 'footer.php'?>

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
                    Order
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form method='POST'>
            <div class="modal-body ">
                <div class="d-flex align-items-end justify-content-center w-100">
                   <div class="mb-3">
                    <label for="quantity" class="form-label">quantity</label>
                    <input
                        type="number"
                        name="quantity"
                        id="quantity"
                        class="form-control"
                        placeholder="quantity"
                        aria-describedby="helpId"
                    />
                    
                </div>
                <h5 class='m-1 text-center'><?php echo $product['units'] ?>(s)</h5> 
                </div>
                
                
            </div>
            <div class="modal-footer">
                <button
                type='submit'
                class="btn btn-primary"
                name='save'
                    
                    
                >
                    send order
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- <a
    class="btn btn-primary"
    data-bs-toggle="modal"
    href="#exampleModalToggle"
    role="button"
    >Open first modal</a
> -->
