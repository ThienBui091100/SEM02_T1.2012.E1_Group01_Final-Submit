<?php 
    include_once "db/connect.php";
    $cfpassword     = $newpassword     = "";
    $cfpassword_err = $newpassword_err = "";
    $m_email = $m_token = "";
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (session_id()==='') {session_start();}
        $m_email = base64_decode($_GET['email']);
        $_SESSION['MyEmail']= $m_email;
        $m_token = $_GET['token'];
        $sql = "SELECT m_email,m_token,m_time,m_numcheck FROM reset_pass WHERE m_email='$m_email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_row($result);
            $m_time=$row[2];
            $m_numcheck=$row[3];
            if ($m_token==trim($row[1])) {
                if (time()-$m_time > 24*60*60) {
                    $sql = "DELETE FROM reset_pass WHERE m_email='$m_email'";
                    $update = mysqli_query($conn,$sql);
                    phpAlertUrl("Time out ! Please re-enter the information.","checkemail.php");
                }
            }else{
                $m_numcheck++ ;
                $sql = "UPDATE reset_pass SET m_numcheck=$m_numcheck WHERE m_email='$m_email'";
                $update = mysqli_query($conn,$sql);
                if ($m_numcheck<=3) {
                    phpAlertUrl("The system could not find any matching information!","checkemail.php");
                }else{
                    $sql = "DELETE FROM reset_pass WHERE m_email='$m_email'";
                    $update = mysqli_query($conn,$sql);
                    phpAlertUrl("Too many links asking for password recovery!","checkemail.php");
                }
            }
        }else{
            phpAlertUrl("The system could not find any matching information!","checkemail.php");
        }
    }
?>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        if (empty($newpassword_err) && empty($cfpassword_err)) {
            if (session_id()==='') {session_start();}
            $m_email=$_SESSION['MyEmail'];
            $newpassword = md5($newpassword);
            $sql = "UPDATE tbl_khachhang SET password='$newpassword' WHERE email='$m_email'";
            //echo $sql;
            $update = mysqli_query($conn,$sql);
            if ($update) {
                $sql = "DELETE FROM reset_pass WHERE m_email='$m_email'";
                $update = mysqli_query($conn,$sql);
                if(isset($_SESSION["MyEmail"]) && $_SESSION["MyEmail"] != null){
                    unset($_SESSION["MyEmail"]);
                }
                phpAlertUrl("Password change successful! Please login again with the new password.","index.php");
            }else {
                phpAlert("Password change failed! Please do it again.");
                $cfpassword     = $newpassword     = "";
                $cfpassword_err = $newpassword_err = "";
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
     <title>ResetPass</title>
     <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
     integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
     <link rel="stylesheet" type="text/css" href="css/security.css">
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
                        <b><label class="font1 log4">PASSWORD RECOVERY</label></b>
                    </td>
                </tr>

                <tr valign="top">
                    <td>
                        <br>
                    </td>
                </tr>

                <tr valign="top">
                    <td><label class="font1 log1">Enter your new password, and re-enter it to confirm.</label></td>
                </tr>

                <tr valign="top">
                    <td><label class="font1 log1">After saving, you may need to re-enter your username and password and log in again. You will be notified when your password is successfully changed.</label></td>
                </tr>

                <tr valign="top">
                    <td>
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
                            <a href="index.php" class="btn effect01 font1"><span>CANCEL</span></a>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
