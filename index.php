
<?php 
    session_start();
    require 'conn/konneksi.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MEAS</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-center">

            <div class="col-xl-5 col-lg-5 col-md-2">

                <div class="card o-hidden border-5 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                       
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome</h1>
                                    </div>
                                    <form action="index.php" method="post" class="user">
                                        <div class="form-group">
                                            <input type="number"  name="npk" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Npk">
                                        </div>
                                        <div class="form-group">
                                            <input type="password"  name="password" class="form-control form-control-user"
                                                id="" placeholder="Password">
                                        </div>
                                       
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div> -->
                                        <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">login</button>
                                                                                                                      
                                    </form>

                                    <br>
                               
                                    <?php
                                    if(isset($_POST['submit'])){
                                        $npk = $_POST['npk'];
                                        $password =$_POST['password'];
                                        // $sh1pass = sha1($password);
                                        // $pass = strlen($sh1pass);
                                        
                                        $query= mysqli_query($cnts,"SELECT ua.id_area,us.password,us.nama,us.npk, ru.role_user
                                        FROM user us LEFT JOIN role_user ru ON us.npk=ru.npk 
                                        LEFT JOIN user_area ua ON us.npk=ua.id_user
                                        WHERE us.npk='$npk'");
                                        $count= mysqli_num_rows($query);
                                      
                                        if($count > 0){
                                       
                                        $as=mysqli_fetch_array($query);

                                        if($password==$as['password']){
                                        // if(password_verify($pass, $as['password'])){

                                        $_SESSION["npk"]=$npk;
                                        $_SESSION["nama"]=$as["nama"];
                                        $_SESSION["id_area"]=$as["id_area"];
                                        $_SESSION["role_user"]=$as["role_user"];
                                        
                                        if($as['role_user']=="management"){                                                                                  
                                            $_SESSION['logged_in']=true;
                                            header("location:dc_management.php");

                                          }else if($as['role_user']=="admin"){                                           
                                            $_SESSION['logged_in']=true;
                                            header("location:dc_admin.php");

                                        }else{                                           
                                            $_SESSION['logged_in']=true;
                                            header("location:data-control.php");                                                                        
                                        }
                                    
                                    }else{
                                        echo "your password is incorect";
                                    }                                 
                                    }else{
                                        echo "your account not exists";
                                    }
                                    }
                                ?>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    
                                </div>
                            </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>