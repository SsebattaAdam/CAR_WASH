<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
    
});
Route::get('/abt', function () {
    return view('about');
    
});
Route::get('/washing', function () {
    return view('washing-plans'); 
});
// Route::get('/userform', function () {
//     return view('userform'); 
// });


Route::get('/location', function () {
    return view('location');
    
});
Route::get('/contact', function () {
    return view('contact2');
    
});

Route::get('/admin', function () {
    return view('/admin/index');
});

Route::get('/adminD', function () {
    return view('/admin/dashboard');
});

Route::post('/login', function(){
    session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$uname=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
return view('/admin/dashboard');
} else{
    
	
	echo "<script>alert('Invalid Details');</script>";

}

}
   
});



Route::get('/all-bookings', function () {
    return view('/admin/all-bookings');
});

Route::get('/new-booking', function () {
    return view('/admin/new-booking');
});



Route::get('/completed-booking', function () {
    return view('/admin/completed-booking');
});

Route::get('/manage-enquires', function () {
    return view('/admin/manage-enquires');
});


Route::get('/managecar-washingpoints', function () {
    return view('/admin/managecar-washingpoints');
});



Route::get('/dashboard', function () {


    session_start();
    include('includes/config.php');

  
    return view('/admin/dashboard');
});

Route::get('/about', function () {

  
    return view('/admin/about');
});
Route::get('/contact2', function () {
    return view('/admin/contact');
});


Route::get('/addcar-washpoint', function () {

  
    return view('/admin/addcar-washpoint');
});

Route::get('/add', function () {

  
    return view('/admin/addcar-washpoint');
});


Route::get('/add-booking', function () {

  
    return view('/admin/add-booking');
});


Route::post('/basicCleaning', function () {
    // session_start();
    include('includes/config.php');
    
   $packagetype= $_POST["packagetype"];
  $washingpoint = $_POST["washingpoint"];
  $fname = $_POST["fname"];
  $contactno = $_POST["contactno"];
  $washdate = $_POST["washdate"];
  $washtime  = $_POST["washtime"];
  $message = $_POST["message"];
  

  $sql = "INSERT INTO bookingtbs (packagetype,washingpoint,fname,contactno,washdate,washtime,message) values ($packagetype,'$washingpoint','$fname','$contactno','$washdate','$washtime','$message')";
  $statement = $dbh->prepare($sql);

  $statement->execute();
  
  echo"Your booking is submitted successfully, you can take you car!";
  return redirect('/washing');
});

Route::post('/contacttb', function () {
    
    include('includes/config.php');

    $name = $_POST["name"];
    $email =$_POST["email"];
    $subject =$_POST["subject"];
    $message = $_POST["message"];

    $sql = "INSERT INTO contacttb (name,email,subject,message) values ('$name','$email','$subject','$message')";
    $statement = $dbh->prepare($sql);


    $statement->execute();

    echo"Ycontact submitted successfull";

    return redirect("/contact");


});


Route::post('/washpoint', function () {
    include('includes/config.php');

    $wpname = $_POST['washingpointname'];
    $wpaddress = $_POST['address'];	
    $wpcnumber = $_POST['contactno'];
    
    $sql = "INSERT INTO tblwashingpoints (washingPointName, washingPointAddress, contactNumber) VALUES (:wpname, :wpaddress, :wpcnumber)";
    $statement = $dbh->prepare($sql);
    $statement->bindParam(':wpname', $wpname);
    $statement->bindParam(':wpaddress', $wpaddress);
    $statement->bindParam(':wpcnumber', $wpcnumber);
    $statement->execute();
    
echo"success";
return redirect("/addcar-washpoint");



});

Route::get('/logout', function () {
    return view('/admin/logout');

});


Route::get('/change-password', function () {
    return view('/admin/change-password');

});









