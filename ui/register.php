<?php
require('connection.php');
if($_SERVER['REQUEST_METHOD']=="POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if (empty($name)) {
        $error = "Enter your fullname !";
        $code = 1;
    }
    if (empty($name)) {
        $error = "Enter your fullname !";
        $code = 1;
    } else if (empty($mobile)) {
        $error = "Enter your mobile number !";
        $code = 2;
    } else if (!is_numeric($mobile)) {
        $error = "Mobile number must be numeric only!";
        $code = 2;
    } else if (strlen($mobile) != 10) {
        $error = "Mobile number should be 10 digit only!";
        $code = 2;
       // echo $error;
    } else if (empty($email)) {
        $error = "Enter your email !";
        $code = 3;
      //  echo $error;
    } else if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
        $error = "Enter valid email id !";
        $code = 3;
      //  echo $error;
    } else if (empty($password)) {
        $error = "Enter your password";
        $code = 4;
       // echo $error;
    } else if (strlen($password) < 8) {
        $error = "Password must be 8 characters long !";
        $code = 4;
       // echo $error;
    } else if (empty($cpassword)) {
        $error = "Enter your confirm password";
        $code = 5;
       // echo $error;
    } else if (strlen($cpassword) < 8) {
        $error = "Confirm Password must be 8 characters long !";
        $code = 5;
       // echo $error;
    } else if ($cpassword != $password) {
        $error = "Password and Confirm Password doesnot match";
        $code = 5;
       // echo $error;

    }
    else {
                     //Checking emailid and mobile number if already registered
        $ret = $conn->query("select id from register where email='$email' || mobile='$mobile'");
       $result = mysqli_fetch_array($ret);
        if ($result > 0) {
            echo "<script>alert('This email already associated with another account');</script>";
        }
        else {
            $query = $conn->query("INSERT INTO register(name,mobile,email,password,cpassword) values('$name','$mobile','$email','$password','$cpassword')");
            if ($query) {
                echo "<script>alert('Data submitted')</script>";
                echo "<script>window.location.href='dashbord.php';</script>";
            } else {
                echo "<script>alert('Something went wrong. Please try again.')</script>";
                echo "<script>window.location.href='register.php';</script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          rel="stylesheet"  crossorigin="anonymous">
</head>
<body>

<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                <form class="mx-1 mx-md-4" method="POST" action="register.php">

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" name="name" id="form3Example1c" class="form-control" />
                                            <label class="form-label" for="form3Example1c">Your Name</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="email" name="email" id="form3Example3c" class="form-control" />
                                            <label class="form-label" for="form3Example3c">Your Email</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="number" name="mobile" placeholder="" id="form3Example3c" class="form-control" />
                                            <label class="form-label" for="form3Example3c">Your mobile</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" name="password" id="form3Example4c" class="form-control" />
                                            <label class="form-label" for="form3Example4c">Password</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" name="cpassword" id="form3Example4cd" class="form-control" />
                                            <label class="form-label" for="form3Example4cd">Repeat your password</label>
                                        </div>
                                    </div>

<!--                                    <div class="form-check d-flex justify-content-center mb-5">-->
<!--                                        <input-->
<!--                                                class="form-check-input me-2"-->
<!--                                                type="checkbox"-->
<!--                                                value=""-->
<!--                                                id="form2Example3c"-->
<!--                                        />-->
<!--                                        <label class="form-check-label" for="form2Example3">-->
<!--                                            I agree all statements in <a href="#!">Terms of service</a>-->
<!--                                        </label>-->
<!--                                    </div>-->

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-primary btn-lg">Register</button>
                                    </div>

                                </form>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>

</html>