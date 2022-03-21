<?php 
    include_once "../db/connect.php";
    $username     = $password     = $cfpassword     = $newpassword     = "";
    $username_err = $password_err = $cfpassword_err = $newpassword_err = "";
    if (session_id()==='') {session_start();}
    if (isset($_SESSION["MyID"])) {
        $username = $_SESSION['MyID'];
    }else{
        $username = "";
    }
    if ($username=="") {
        //header("Location: ../security/login.php");
    }
?>
<?php 
//echo $control;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //----- Test username
        if (empty($_POST["username"])) {
            $username_err = "Username is required";
         }else {
            $username = trim($_POST["username"]);
         }
         //----- test password
        if (empty($_POST["password"])) {
            $password_err = "Curent password is required";
         }else {
            $password = trim($_POST["password"]);
         }

         $sql = "SELECT password FROM tbl_khachhang WHERE username='$username' AND password='$password'";
         $result = mysqli_query($conn, $sql);
         if (mysqli_num_rows($result) <= 0) {
             $password_err = "The current username or password is invalid";
         }

        //----- test newpassword
        if (empty($_POST["newpassword"])) {
            $newpassword_err = "New Password is required";
         }else {
            $newpassword = trim($_POST["newpassword"]);
         }
         //----- test Confirm password
         if (empty($_POST["cfpassword"])) {
            $password_err = "Confirm Password is required";
         }else {
            $cfpassword = trim($_POST["cfpassword"]);
         }
         if ($newpassword<>$cfpassword) {
            $newpassword_err = "New password and confirm password do not match!";
         }
        //-----
        if (empty($username_err) && empty($password_err) && empty($newpassword_err) && empty($cfpassword_err)) {
            $sql = "UPDATE userlog SET password='$newpassword' WHERE username='$username' AND password='$password'";
            $update = mysqli_query($conn,$sql);
            if ($update) {
                phpAlertUrl("Password change successful! Please login again with the new password.","login.php");
            }else {
                phpAlert("Password change failed! Please do it again.");
                $username     = $password     = $cfpassword     = $newpassword     = "";
                $username_err = $password_err = $cfpassword_err = $newpassword_err = "";
            }
            mysqli_close($conn);
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
     <title>ChangePass</title>
     <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
     integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
     <link rel="stylesheet" type="text/css" href="../css/security.css">
     <script type="text/javascript" src="nav.js" ></script>
     <link rel="shortcut icon" href="admin/giaodien/images/favicon.png" />
</head>
<style>
    .error {color: #FF0000;}          
</style>
<body class="bodycenter">
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="form1">
            <table width="50%" align=center cellspacing="1" cellpadding="2" border="0" >
                <tr valign="top">
                    <td>
                        <b><label class="font1 log4">CHANGE THE PASWORD</label></b>
                    </td>
                </tr>

                <tr valign="top">
                    <td>
                        <br>
                    </td>
                </tr>

                <tr valign="top">
                    <td><label class="font1 log1">Enter your current password, enter your new password, and re-enter it to confirm.</label></td>
                </tr>

                <tr valign="top">
                    <td><label class="font1 log1">After saving, you may need to re-enter your username and password and log in again. You will be notified when your password is successfully changed.</label></td>
                </tr>

                <tr valign="top">
                    <td>
                        <div class="form__group field">
                            <input type="input" class="form__field font1" placeholder="Username*" name="username" id='username' value="<?php echo $username; ?>"  readonly required />
                            <label for="username" class="form__label font1">Username*</label>
                            <span class="error font1 log1"><?php echo $username_err; ?></span>
                        </div>
                        <br>
                        <div class="form__group field">
                            <input type="password" class="form__field font1" placeholder="Password*" name="password" id='password' value="<?php echo $password; ?>" required />
                            <label for="password" class="form__label font1">Current password*</label>
                            <span class="error font1 log1"><?php echo $password_err; ?></span>
                        </div>
                        <br>
                        <div class="form__group field">
                            <input type="password" class="form__field font1" placeholder="Newpassword*" name="newpassword" id='mewpassword' value="<?php echo $newpassword; ?>" required />
                            <label for="newpassword" class="form__label font1">A new password*</label>
                            <span class="error font1 log1"><?php echo $newpassword_err; ?></span>
                        </div>
                        <br>
                        <div class="form__group field">
                            <input type="password" class="form__field font1" placeholder="Confirm Password*" name="cfpassword" id='cfpassword' value="<?php echo $cfpassword; ?>" required />
                            <label for="cfpassword" class="form__label font1">Confirm new password*</label>
                            <span class="error font1 log1"><?php echo $cfpassword_err; ?></span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <br>
                        <div class="buttons">
                            <a href="#" class="btn effect01 font1" onclick="SubmitForm()"><span>ACCEPT</span></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="../connectiondb/viewProduct.php" class="btn effect01 font1"><span>CANCEL</span></a>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
