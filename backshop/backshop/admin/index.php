<?php 
    include_once('../db/connect.php'); 
    $username = $password = "";
    $username_err = $password_err = "";
    if (session_id()==='') {session_start();}
    //--- kiem tra cookie
    if (isset($_COOKIE["user_login"]))
    {
        $username = trim($_COOKIE["user_login"]);
    }
    if (isset($_COOKIE["user_password"]))
    {
        $password = trim($_COOKIE["user_password"]);
    }
    $sql = "SELECT admin_id,email,password,admin_name FROM tbl_admin WHERE email = '$username' AND password ='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_row($result);
        $_SESSION['admin_id'] = $row[0];
        $_SESSION['dangnhap'] = $row[3];
        $_SESSION['MyID'] = trim($row[1]);
        $_SESSION['MyFullname'] = trim($row[3]);
        header("Location: dashboard.php");
    }
?>
<?php 
//echo $control;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //-----
        if (empty($_POST["username"])) {
            $username_err = "Username is required";
         }else {
            $username = trim($_POST["username"]);
         }
        //-----
        if (empty($_POST["password"])) {
            $password_err = "Password is required";
         }else {
            $password = trim($_POST["password"]);
         }
         if (empty($username_err) && empty($password_err)) {
            $sql = "SELECT admin_id,email,password,admin_name FROM tbl_admin WHERE email = '$username'";
            $result = mysqli_query($conn, $sql);
            $curr_password = "";
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_row($result);
                $curr_password = trim($row[2]);
                $fullname = trim($row[3]);
                $admin_id=$row[0];
            }else{
                $username_err = "Incorrect account information!";
            }
            if($password <> $curr_password){
                $password_err = "Wrong password!";
            }
            //-----
            if (empty($username_err) && empty($password_err)) {
                $_SESSION['admin_id'] = $admin_id;
                $_SESSION['dangnhap'] = $fullname;
                $_SESSION['MyID']= $username;
                $_SESSION['MyFullname']= $fullname;
                mysqli_close($conn);
                //--- 
                if (!empty($_POST["keeplogin"]))
                {
                    // Username is stored as cookie for 1 years as
                    // 1years * 365days * 24hrs * 60mins * 60secs
                    setcookie("user_login", $username, time() + (1 * 365 * 24 * 60 * 60));
                    // Password is stored as cookie for 1 years as 
                    // 1years * 365days * 24hrs * 60mins * 60secs
                    setcookie("user_password", $password, time() + (1 * 365 * 24 * 60 * 60));
                    // After setting cookies the session variable will be set
                    $_SESSION['MyName']= $username;
                    $_SESSION['MyPassword']= $password;
                }
                else
                {
                    if (isset($_COOKIE["user_login"]))
                    {
                        setcookie("user_login", "");
                    }
                    if (isset($_COOKIE["user_password"]))
                    {
                        setcookie("user_password", "");
                    }
                }
                header("Location: dashboard.php");
            }
         }
    }
?>
<!-- HTML-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login</title>
     <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
     integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
     <link rel="stylesheet" type="text/css" href="../css/security.css">
</head>
<style>
  .error {color: #FF0000;}       
</style>
<body class="bodycenter">
    <!-- FORM NHAP THONG TIN -->
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="form1">
            <table width="60%" align=center cellspacing="0" cellpadding="0" border="0" >
                <tr valign="top">
                    <td>
                        <b><label class="font1 log">LOG IN(ADMIN)</label></b>
                    </td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                </tr>

                <tr valign="top">
                    <td>
                        <a href="resetp                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  assword.php" class="font1 log2 black">Forgotten Your Password</a>
                    </td>
                </tr>

                <tr valign="top">
                    <td>
                        <div class="form__group field">
                            <input type="text" class="form__field" placeholder="Email*" name="username" id='username' required />
                            <label for="username" class="form__label">Email*</label>
                            <span class="error font1 log1"><?php echo $username_err; ?></span>
                        </div>
                        <br>
                        <div class="form__group field">
                            <input type="password" class="form__field" placeholder="Password*" name="password" id='password' required />
                            <label for="password" class="form__label">Password*</label>
                            <span class="error font1 log1"><?php echo $password_err; ?></span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <br>
                        <input type="checkbox" name="keeplogin" value="login"> <label class="font1 log1">Keep me loggin</label>
                    </td>
                </tr>

                <tr>
                    <td>
                        <br>
                        <div class="buttons">
                            <a href="#" class="btn effect01" onclick="SubmitForm()"><span>LOGIN</span></a>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
