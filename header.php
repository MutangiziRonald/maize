<?php 

include './dbinit.php';
session_start();

// if ($_SESSION['userName']) {
  
// }else {
//   header('location:./login.php');
// }
// if ( count($_SESSION)==0 && $_SERVER['PHP_SELF']=='/maize/profile.php') {
  
  
//   header('location: ./login.php');
// }
$languages = array(
 'english'=> array(
    'name'=>'english',
    'home'=>'Home',
    'buyers'=>'Buyers',
    'sellers'=>'Sellers',
    'services'=>'Service Providers',
    'blogs'=>'blogs',
    'products'=>'Products',
    'home1'=>'Invest Today,',
    'home2'=>'Harvest Tomorrow',
    'home3'=>'Enhancing the interaction of buyers, sellers and Service Providers',
    'descriptionHead'=>'Plantations of Gold.',
    'descriptionp1'=>'Explore more from our advisers on all tips and advice on how to start up small and end up big in the field of maize plantations.',
    'descriptionlist1'=>'Mentors on plantation set up and the technology required.',
    'descriptionlist2'=>'Touring all sellers and Buyers.',
    'descriptionlist3'=>'Enhancing e-commerce, online linkages of buyers, sellers, advisers and service providers across the nation',
    'descriptionp2'=>'Connect up with all maize buyers, Maize growers, knowlege and other service providers across the nation',
    'stories'=>'TOP STORIES',
    'popularBlogs'=>'POPULAR BLOGS',
    'order'=>'order now',
    'review'=>'Leave a review',
    'writereview'=>'write you review',

 ),
 'luganda'=>array(
    'name'=>'luganda',
    'home'=>'Ewaka',
    'buyers'=>'Abaguzi',
    'sellers'=>'Abatunzi',
    'services'=>'Service Providers',
    'blogs'=>'Amawulire',
    'products'=>'Ebyamaguzi',
    'home1'=>'Tekamu leero,',
    'home2'=>'Kungula Enkya',
    'home3'=>'Okwongera ku nkolagana y’abaguzi, abatunzi n’Abagaba Empeereza',
    'descriptionHead'=>'Plantations of Gold.',
    'descriptionp1'=>'Weekenneenye ebisingawo okuva mu bawabuzi baffe ku magezi gonna n’amagezi ku ngeri y’okutandika obutono n’omaliriza nga munene mu nnimiro z’akasoli.',
    'descriptionlist1'=>'Ababuulirizi ku nnimiro okuteekebwawo ne tekinologiya eyeetaagisa.',
    'descriptionlist2'=>'Okulambula abatunzi bonna n\'Abaguzi.',
    'descriptionlist3'=>'Okwongera okutumbula eby’obusuubuzi ku yintaneeti, enkolagana ku yintaneeti kw’abaguzi, abatunzi, abawabuzi n’abagaba empeereza okwetoloola eggwanga',
    'descriptionp2'=>'Yungagana n\'abaguzi b\'akasoli bonna, abalimi b\'akasoli, okumanya n\'abawa obuweereza obulala okwetoloola eggwanga',
    'stories'=>'STORY EZISINZE',
    'popularBlogs'=>'AMAWURILE',
    'order'=>'gula kati',
    'review'=>'Wa endowoza yo',
    'writereview'=>'Wandika endowoza yo',
 ),
 'swahili'=>array(
    'name'=>'swahili',
    'home'=>'Nyumbani',
    'buyers'=>'Wanunuzi',
    'sellers'=>'Wauzaji',
    'services'=>'Watoa Huduma',
    'blogs'=>'blogu',
    'products'=>'Bidhaa',
    'home1'=>'Wekeza Leo,',
    'home2'=>'Mavuno Kesho',
    'home3'=>'Kuboresha mwingiliano wa wanunuzi, wauzaji na Watoa Huduma',
    'descriptionHead'=>'Plantations of Gold.',
    'descriptionp1'=>'Gundua zaidi kutoka kwa washauri wetu juu ya vidokezo na ushauri wote wa jinsi ya kuanza ndogo na kuishia kubwa kwenye shamba la mashamba ya mahindi..',
    'descriptionlist1'=>'Washauri wa upandaji miti na teknolojia inayohitajika.',
    'descriptionlist2'=>'Kutembelea wauzaji na Wanunuzi wote.',
    'descriptionlist3'=>'Kuimarisha biashara ya mtandaoni, miunganisho ya mtandaoni ya wanunuzi, wauzaji, washauri na watoa huduma kote nchini.',
    'descriptionp2'=>'Ungana na wanunuzi wote wa mahindi, wakulima wa mahindi, ujuzi na watoa huduma wengine kote nchini',
    'stories'=>'HADITHI KUU',
    'popularBlogs'=>'BLOGU MAARUFU',
    'order'=>'agiza sasa',
    'review'=>'Acha ukaguzi',
    'writereview'=>'andika ukaguzi wako',
 ),
 'Runyankole'=>array(
    'name'=>'Runyankole',
    'home'=>'omuka',
    'buyers'=>'abagunzi',
    'sellers'=>'abashubuzi',
    'services'=>'Watoa Huduma',
    'blogs'=>' Obublogi',
    'products'=>'Ebyamaguzi',
    'home1'=>'Shomera N\'ekiro,',
    'home2'=>'Shaarura nyechakare',
    'home3'=>'Kuhwongera obushoborora bw\'okugurana, okutunda n\'abari bahereza obuhereza',
    'descriptionHead'=>'Ebihingwa by\'efenza.',
    'descriptionp1'=>'Rondoroa bwiji kurunga omubahabuzi beintu ebikorwa hamwe n’obuhabuzi kokuwakutandikaho musiri muche hamwe n’omugahi gw’ebicoori',
    'descriptionlist1'=>'Rondoroa bwiji kurunga omubahabuzi beintu ebikorwa hamwe n’obuhabuzi kokuwakutandikaho musiri muche hamwe n’omugahi gw’ebicoori.',
    'descriptionlist2'=>'kurambura abarikuguza hamwe  na abaguzi boona.',
    'descriptionlist3'=>' Konjera kuguza obwe turikukozeesa ebitibagaano yeryoma ryakarimagezi ebiri kuhikaniisa abaguzi, abashubuzi, abahabuzi hamwe Abari bahereza obuhereza omahanga goona.',
    'descriptionp2'=>'Buganiisa boona abaguzi bobuchoori , abahiigi babwo, abanyabwenje hamwe nabandi baheereza  beryobuheereza omuhanga goona',
    'stories'=>'OMUTWE GWAMAKURU',
    'popularBlogs'=>'OBUBLOGI BWABURINJO',
    'order'=>'order now',
    'review'=>'Ekyokuremberaho',
    'writereview'=>'Handiika ekyokurembeeraho kyawe ',
 ),
);

$language= count($_SESSION)==0 || !key_exists('lang',$_SESSION)?$languages['english']:$languages[$_SESSION['lang']];

$title=str_replace('/project/','',$_SERVER['PHP_SELF']);

if (isset($_GET['sign'])) {

  if (count($_SESSION)==0) {
    header('location: ./login.php');
  } else {
    session_unset();
  header('location: ./index.php');
  }
 
}
$message=0;
if (count($_SESSION)==0) {
 
}else{
  
  $id=$_SESSION['id'];
  $sql="SELECT * FROM messages WHERE receiver=$id AND seen=false";
  $results =mysqli_query($conn,$sql);
  $unread=mysqli_fetch_all($results,MYSQLI_ASSOC);
  $message=count($unread);

}



?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title ><?php echo str_replace('.php','',$title)=='index'?'home':str_replace('.php','',$title) ?> | Maize Market</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/maize harvesting.jpg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

 
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
  
<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between">

      <h1  class="logo me-auto"style="font-size: 3vw; text-wrap:nowrap;"><a style="text-decoration: none;" href="index.php">Ug Maize</a></h1>
      
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a style="text-decoration: none;" class="<?php  echo $_SERVER['PHP_SELF']=='/project/index.php'?'active':''  ?>" href="index.php"><?php echo $language['home'] ?></a></li>
          <li><a style="text-decoration: none;" class="<?php  echo $_SERVER['PHP_SELF']=='/project/buyers.php'?'active':''  ?>"href="buyers.php"><?php echo $language['buyers'] ?></a></li>
          <li><a style="text-decoration: none;"  class="<?php  echo $_SERVER['PHP_SELF']=='/project/sellers.php'?'active':''  ?>"href="sellers.php"><?php echo $language['sellers'] ?></a></li>
          
          <li><a style="text-decoration: none;"  class="<?php  echo $_SERVER['PHP_SELF']=='/project/services.php'?'active':''  ?>"href="services.php"><?php echo $language['services'] ?></a></li>
         
          <li><a style="text-decoration: none;" class="<?php  echo $_SERVER['PHP_SELF']=='/project/blogs.php'?'active':''  ?>"href="blogs.php"><?php echo $language['blogs'] ?></a></li>
          <li><a style="text-decoration: none;" class="<?php  echo $_SERVER['PHP_SELF']=='/project/products.php'?'active':''  ?>"href="products.php"><?php echo $language['products'] ?></a></li>

            <?php echo count($_SESSION)>0 && $_SESSION['admin']==1?'<li><a style="text-decoration: none;" href="dashboard.php">Dashboard</a></li>':'' ?>

            <?php echo count($_SESSION)==0?' <li>
            <a style="text-decoration: none;" href="?sign" class="">sign in  </a>
          </li>':''  ?> 
          
         
        
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>

      </nav>
      <?php  if (count($_SESSION)>0): ?>
        <a
        href='messages.php'
              style='margin-left: 10px; margin-right:10px;'
            class="btn btn-light position-relative">
            <span class="bx bx-message"></span>
            <?php if ($message>0) { ?>
              <span
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary"
            >
                <?php echo $message ?>
                <span class="visually-hidden">unread messages</span>
            </span>
            <?php } ?>
            
        </a>
        <?php endif ?>

      
     <?php echo count($_SESSION)==0?'':"<a style='text-decoration: none;' href='profile.php?products'  class='get-started-btn'><span class='bi bi-person'></span>".$_SESSION['userName'].'</a> '?> 
    
              
    </div>
  </header>


  