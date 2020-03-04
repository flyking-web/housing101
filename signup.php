<?php
require 'config.php';
require 'header.php';


$firstname=$lastname=$phone=$email=$password='';
$firstname_err=$lastname_err=$email_err=$password_err='';

//process data
if(isset($_POST['btn_signup'])){
//    grab data from form
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $password=$_POST['password'];

//    check if user exists
    $sql="SELECT * FROM `customers` WHERE email='$email'";
    $results=mysqli_query($connection,$sql);
    if(mysqli_num_rows($results)>0){
//        user exists
        header("location:login.php");
        exit();
    }
//    hash user password
    $password=md5($password);
    echo $password.'<br>';
//    add user to and take to login
    $sql="INSERT INTO `customers`(`id`, `firstname`, `lastname`, `email`, `password`) VALUES (NULL,'$firstname','$lastname','$email','$password')";
    if(mysqli_query($connection,$sql)){
//        if user has been successfully
        header("location:login.php");
        exit();
    }else{
        echo "ERROR:".mysqli_error($connection);
    }
}
?>

<!--start signing up form-->
<div class="container">
    <h1 style="text-align: center;">Sign Up as Customer</h1>
    <div class="row">
        <div class="col-md-3 col-lg-3 col-xl-3"></div>
        <div class="col-md-6 col-lg-6 col-xl-6">
            <div id="auth-form">
                <form action=""<?php echo htmlspecialchars(@$_SERVER['PHP_SELF'])?> method="post">
                    <fieldset>

                        <div class="form-group">
                            <label for="">Firstname</label>
                            <input type="text" name="firstname" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Lastname</label>
                            <input type="text" name="lastname" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="number" name="phone" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">email</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-info btn-block" name="btn_signup">Signup</button>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-xl-3"></div>
    </div>
</div>
