
<?php
//$user = 'root';
//$password = 'root';
//$db_name = 'fred';
//$host = 'localhost:8889';
 $user = 'phpform';
 $password = 'VCna1I0tFOGp';
 $db_name = 'ngclick';
 $host = 'localhost';

function connect_db($user, $password, $db_name, $host){
  $link = mysqli_connect($host, $user, $password, $db_name);
  if (mysqli_connect_errno())
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
  return $link;
}

function insta_user_exists($user, $db){
  $pseudos = mysqli_query($db, "SELECT * FROM user WHERE pseudo = '". $user . "';");
  if (!$pseudos) {
   die("Error description: " . mysqli_error($db));
  }
  if (mysqli_num_rows($pseudos) == 1)
    return true;
  return false;
}

function insert_user($db, $db_name, $pseudo, $nbfollowers, $languages, $gender, $official, $categories, $email, $kik, $twitter, $facebook, $country, $city){
 $query = "INSERT INTO `".$db_name."`.`user` (`id`, `pseudo`, `nbfollowers`, `languages`, `gender`, `official`, `categories`, `email`, `kik`, `twitter`, `facebook`, `country`, `city`) VALUES (NULL, '". $pseudo . "', '". $nbfollowers . "', '" . $languages. "', '" . $gender . "', '" . $official . "', '".$categories."', '".$email."', '".$kik."', '".$twitter."', '".$facebook."', '".$country."', '".$city."');";
 $result = mysqli_query($db, $query);
 if (!$result) {
    die('Invalid request : ' . mysqli_error($db));
  }
}

function clean_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

$db = connect_db($user, $password, $db_name, $host);
$pseudo_insta = "";
$user_added = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if( isset($_POST['pseudo-insta']) ){
       if (empty($_POST["pseudo-insta"])) {
         $nameErr = "Pseudo insta is required";
       } else {
         $pseudo_insta2 = $pseudo_insta = clean_input($_POST["pseudo-insta"]);
         $user_exists = insta_user_exists($pseudo_insta, $db);
         if ($user_exists)
            $pseudo_insta = '';
         else if (isset($_POST['nb-followers'])){
          insert_user($db, $db_name, clean_input($_POST['pseudo-insta']), clean_input($_POST['nb-followers']), clean_input($_POST['languages']), clean_input($_POST['gender']), clean_input($_POST['official']), clean_input($_POST['categories']), clean_input($_POST['email']), clean_input($_POST['kik']), clean_input($_POST['twitter']), clean_input($_POST['facebook']), clean_input($_POST['country']), clean_input($_POST['city']));
  	   $user_added = true; 
         $pseudo_insta = '';
        }
         
       }
  }
}

?>

<!DOCTYPE HTML> 
<html>
<head>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="static/bootstrap-tagsinput/bootstrap-tagsinput.css">
<link rel="stylesheet" href="static/bootstrap-formhelpers/css/bootstrap-formhelpers.min.css">
<style>
.bootstrap-tagsinput {
  width: 100%;
}
.bfh-countries .bfh-selectbox-options, .bfh-countries .bfh-selectbox-options ul[role='option'] {
   width: 100%;
   max-width:100%;
}
</style>
</head>
<body> 
<div class="container" style="margin-top:100px; margin-bottom:100px;">
  <div class="col-md-offset-3 col-md-6">
  <?php if ($user_exists): ?>
  <h2 style="color:red;">User '<?php echo $pseudo_insta2 ?>' already exists</h2>
  <?php endif; ?>
<?php if ($user_added): ?>
  <h2 style="color:green;">User '<?php echo $pseudo_insta2 ?>' added succesfully.</h2>
  <?php endif; ?>
<form method="post" action="/">
  <div class="form-group">
    <label for="pseudo-insta"><span style="color:red;">* </span>Instagram username</label>
    <?php if ($pseudo_insta): ?>
    
      <p><?php echo $pseudo_insta ?></p>
      <input type="hidden" name="pseudo-insta" value="<?php echo $pseudo_insta ?>" required>
    <? else: ?>
      
      <input type="text" class="form-control" name="pseudo-insta" required>
    <?php endif; ?>
  </div>
<?php if ($pseudo_insta): ?>
  <div class="form-group">
    <label for="nb-followers"><span style="color:red;">* </span>Followers</label>
    <input type="number" class="form-control" name="nb-followers" required>
  </div>
  <div class="form-group">
    <label for="languages"><span style="color:red;">* </span>Languages (select at least one)</label>
    <p class="languages"></p>
    <input type="text" data-role="tagsinput" class="col-md-6 form-control languages" name="languages" required>
  </div>
  <div class="form-group">
  <label for="languages-list">Add a language:</label>
  <select class="form-control" name="languages-list" id="languages-list">
      <option></option>
      <option>FRENCH</option>
      <option>ENGLISH</option>
      <option>GREEK</option>
      <option>GERMAN</option>
      <option>SWEDISH</option>
      <option>xx-Qaai</option>
      <option>PORTUGUESE</option>
      <option>INDONESIAN</option>
      <option>PERSIAN</option>
      <option>zzp</option>
      <option>GALICIAN</option>
      <option>IRISH</option>
      <option>DANISH</option>
      <option>CHINESE</option>
      <option>CHINESET</option> 
      <option>TURKISH</option>
      <option>JAPANESE</option>
      <option>ARABIC</option>
      <option>SPANISH</option>
      <option>HEBREW</option>
      <option>ITALIAN</option>
      <option>KOREAN</option>
      <option>SLOVAK</option>
      <option>RUSSIAN</option>
      <option>OROMO</option>
      <option>SINDHI</option>
      <option>ZULU</option>
      <option>AFRIKAANS</option>
      <option>SERBIAN</option>
      <option>CHEROKEE</option>
      <option>FINNISH</option>
      <option>BULGARIAN</option>
      <option>ALBANIAN</option>
      <option>BELARUSIAN</option>
      <option>SISWANT</option>
      <option>CZECH</option>
      <option>CATALAN</option>
      <option>SESOTHO</option>
      <option>MALAY</option>
      <option>ROMANIAN</option>
      <option>GUARANI</option>
      <option>MANX</option>
      <option>SANSKRIT</option>
      <option>TURKMEN</option>
      <option>ESTONIAN</option>
      <option>QUECHUA</option>
      <option>LATIN</option>
      <option>KINYARWANDA</option>
      <option>XHOSA</option>
      <option>GUJARATI</option>
      <option>DUTCH</option>
      <option>SOMALI</option>
      <option>SCOTS</option>
      <option>GEORGIAN</option>
      <option>ICELANDIC</option>
      <option>UKRAINIAN</option>
      <option>GREENLANDIC</option>
      <option>ARMENIAN</option>
      <option>MALAGASY</option>
      <option>NORWEGIAN</option>
      <option>LITHUANIAN</option>
      <option>THAI</option>
      <option>FRISIAN</option>
      <option>SAMOAN</option>
      <option>SESELWA</option>
      <option>WARAY_PHILIPPINS</option> 
      <option>TSONGA</option>
      <option>TATAR</option>
      <option>UZBEK</option>
      <option>OCCITAN</option>
      <option>VOLAPUK</option>
      <option>SINHALESE</option>
      <option>LUXEMBOURGISH</option>
      <option>POLISH</option>
      <option>SHONA</option>
      <option>KURDISH</option>
      <option>SCOTS_GAELIC</option>
      <option>RUNDI</option>
      <option>VENDA</option>
      <option>AFAR</option>
      <option>RHAETO_ROMANE</option> 
      <option>SWAHILI</option>
      <option>WOLOF</option>
      <option>SLOVENIAN</option>
      <option>tlh</option>
      <option>FIJIAN</option>
      <option>MAURITIAN_CREOLE</option> 
      <option>WELSH</option>
      <option>HINDI</option>
      <option>ESPERANTO</option>
      <option>BASQUE</option>
      <option>PEDI</option>
      <option>AZERBAIJANI</option>
      <option>KHASI</option>
      <option>INUKTITUT</option>
      <option>TAGALOG</option>
      <option>MAORI</option>
      <option>BOSNIAN</option>
      <option>CORSICAN</option>
      <option>PASHTO</option>
      <option>JAVANESE</option>
      <option>INTERLINGUA</option>
      <option>AKAN</option>
  </select>
</div>
<div class="form-group">
   <label for="gender"><span style="color:red;">* </span>Gender</label>
<div class="radio">
  <label>
    <input type="radio" name="gender" value="Male">
    Male
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="gender"  value="Female">
    Female
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="gender" value="Company">
    Company
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="gender" value="Other">
    Other
  </label>
</div>
</div>

<label for="official"><span style="color:red;">* </span>Official</label>
  <div class="radio">
  <label>
    <input type="radio" name="official" value="yes">
    Yes
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="official" value="no">
    No
  </label>
</div>
  <label for="categories"><span style="color:red;">* </span>Categories (select at least one)</label>
  <p class="categories"></p>
  <input type="text" data-role="tagsinput" class="form-control categories" name="categories" required>
  <div class="form-group">
  <label for="categories">Add a category:</label>
  <select class="form-control" id="categories-list">
    <option></option>
    <option>Sports</option>
    <option>Health & Fitness</option>
    <option>Architecture & Design</option>
    <option>Photography</option>
    <option>Entertainment</option>
    <option>Food</option>
    <option>Travel</option>
    <option>Lifestyle</option>
    <option>Automotive</option>
    <option>Fashion</option>
    <option>Family</option>
    <option>Women Beauty</option>
    <option>Youth</option>
    <option>Technology</option>
    <option>Weddings</option>
    <option>Adventure</option>
    <option>Luxury</option>
    <option>Tattoos</option>
    <option>Provocative</option>
    <option>Pets</option>
    <option>Adult</option>
    <option>Girly</option>
    <option>Personal development</option>
    <option>Movies</option>
    <option>TV Shows</option>
    <option>Childs</option>
    <option>Quotes</option>
    <option>Books</option>
    <option>Art</option>
    <option>Interior Design</option>
    <option>Men Beauty</option>
    <option>Vegan</option>
    <option>Music</option>
    <option>Tobacco / Chicha / Weed</option>
    <option>Hip Hop / Street</option>
    <option>Surf</option>
    <option>Skateboard</option>
    <option>Sneakers</option>
    <option>Motorbikes</option>
    <option>Army</option>
    <option>Golf</option>
    <option>Football</option>
    <option>Women Fashion</option>
    <option>Men Fashion</option>
    <option>Men Lifestyle</option>
    <option>Women Lifestyle</option>
  </select>
</div>
   <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email">
  </div> 
  <div class="form-group">
    <label for="kik">Kik</label>
    <input type="text" class="form-control" name="kik">
  </div>  
   <div class="form-group">
    <label for="twiter">Twitter</label>
    <input type="text" class="form-control" name="twitter">
  </div>
  <div class="form-group">
    <label for="facebook">Facebook</label>
    <input type="text" class="form-control" name="facebook">
  </div>
  <div class="form-group">
    <label for="country">Country</label>
    <div class="bfh-selectbox bfh-countries" data-flags="true" data-name="country">
  </div>
  <div class="form-group">
    <label for="city">City</label>
    <input type="text" class="form-control" name="city">
  </div>
  <?php endif; ?>
   <button type="submit" class="btn btn-lg btn-success btn-block">Submit</button>
</div>
</form>
</div>
</div>

<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="static/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="static/bootstrap-formhelpers/js/bootstrap-formhelpers.min.js"></script>
<script>
<!-- add language -->
$("#languages-list").change(function(){
  $('input.languages').tagsinput('add', this.value);
})

<!-- add category -->
$("#categories-list").change(function(){
  $("input.categories").tagsinput('add', this.value);
})
</script>
</body>
</html>

<?php mysqli_close($db); ?>
