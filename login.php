<?php
require 'config.php';
require 'header.php';
//<!--create variables that store data-->
$email=$password='';
$email_err=$password_err='';
//process data
if (isset($_POST['btn_login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

//    check if user exists
    $sql = "SELECT * FROM `users` WHERE email=$email";
    $results = mysqli_query($connection,$sql);
    if (mysqli_num_rows($results) > 0){
//        user exists
        header("location:login.php");
        exit();
    }
//    hash user password
    $password = md5($password);
//    add user to db and take to login page
    $sql = "INSERT INTO `users`(`id`, `email`, `password`) VALUES (NULL ,'$email','$password')";
//    code to execute
    if (mysqli_query($connection,$sql)){
//    if user is successful
        header("location:login.php");
        exit();
    }else{
//    if user is not successful
        echo "ERROR:".mysqli_error($connection);
    }




}





?>



<!--start sign up form-->
<div class="container">
    <div class="row">
        <div class="col col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
        <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div id="auth-form">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="">email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <button class="btn btn-info btn-block" name="btn_login">login</button>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="col col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
    </div>
</div>

<!--end sign up-->
<?php
require 'footer.php';
?>
