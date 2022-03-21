<?php 
    include_once "db/connect.php";
    define("APPPATH", "src/");
    include APPPATH . "PHPMailer.php";
    include APPPATH . "Exception.php";
    include APPPATH . "OAuth.php";
    include APPPATH . "POP3.php";
    include APPPATH . "SMTP.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    $email = $email_err= "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
         //----- test email
         if (empty($_POST["email"])) {
          $email_err = "Email is required";
       }else {
          $email = trim($_POST["email"]);
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 $email_err = "The email you just entered is in the wrong format";
          }
      }
      if (empty($email_err)) {
        $sql = "SELECT email,name FROM tbl_khachhang WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) <= 0) {
            $email_err = "Email address does not exist on the system";
        }else{
          $row = mysqli_fetch_row($result);
          $fullname = trim($row[1]);

          $m_email=$email;
          $sql = "DELETE FROM reset_pass WHERE m_email='$m_email'";
          $update = mysqli_query($conn,$sql);
          $m_token=random_string($permitted_chars,16);
          $m_time=time();
          $sql = "INSERT INTO reset_pass (m_email,m_token,m_time) VALUES ('$m_email','$m_token','$m_time')";
          $update = mysqli_query($conn,$sql);
          mysqli_close($conn);
          //--
          $email_encode = base64_encode($m_email);
          $to      = $m_email;
          $subject = "Password recovery";
          $message = '<html><body>';
          $message .= '<h1 style="color:#f40;">Hello '.$fullname.'!</h1>';
          $message .= '<p style="color:#f40;font-size:18px;">We have sent you a password reset link.</p>';
          $chuoilink='<a href="http://backfashion.ddns.net/backshop/resetpassword.php?email='.$email_encode.'&token='.$m_token.'">Click here to proceed with the password reset.</a>';
          $message .= '<p style="color:#f40;font-size:18px;">'.$chuoilink.'</p>';
          $message .= '</body></html>';

          //---
          $receiver = $m_email;
          $subject = "Back Fashion Password recovery";
          //#2 https://myaccount.google.com/
          $mail = new PHPMailer;
          $mail->isSMTP();
          $mail->SMTPDebug = SMTP::DEBUG_OFF;
          $mail->Host = 'smtp.gmail.com';
          $mail->Port = 587;
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->SMTPAuth = true;
          //$mail->Username = 'backfashion2021@gmail.com';
          //$mail->Password = 'qwhbuljkrxsgknuf'; // sử dụng mật khẩu ứng dụng

          $mail->Username = 'anhthuhunganh@gmail.com';
          $mail->Password = 'mdoafhmaqprefjql'; // sử dụng mật khẩu ứng dụng 

          $mail->FromName = "Forgot Pasword";
          //#3
          $mail->setFrom('backfashion2021@gmail.com');
          $mail->addAddress($receiver);
          $mail->Subject = $subject;
          $mail->msgHTML($message);
          //#4
          if (!$mail->send()) {
            phpAlertUrl("Email cannot be sent!","index.php");
            //echo "Email cannot be sent!";
          }
          else {
            //echo $message;
            phpAlertUrl("Hi ".$fullname.", we have sent password reset information to your email, please check your email and follow the instructions.!","index.php");
          }
        }
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="css/security.css">
    <link rel="shortcut icon" href="admin/giaodien/images/favicon.png" />
</head>
<style>
    .error {color: #FF0000;}          
</style>
<body class="bodycenter">
  <div class="containerlogin">
    <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="form1">
      <table width="40%" align=center cellspacing="1" cellpadding="2" style="BORDER-RIGHT: #696969 2px solid; BORDER-LEFT: #dcdcdc 2px solid; BORDER-BOTTOM: #696969 2px solid; BORDER-TOP: #dcdcdc 2px solid">
        <tr align="center"><td><br><br><img src="images/lock.jpg" width="120" height="120"></td></tr>
        <tr valign="top" align="center">
          <td>
              <br>
              <br>
              <label class="font1 log1">Forgot Password?</label>
          </td>
        </tr>
        <tr><td></td></tr>
        <tr valign="top" align="center">
          <td>
            <label class="font1 log1">You can reset your password here.</label>
          </td>
        </tr>
        <tr><td></td></tr>
        <tr align="center">
          <td>
          
          <div class="form__group1 field">
            <input type="input" class="form__field font1" placeholder="email address*" name="email" id='email' value="<?php echo $email; ?>" required />
              <label for="username" class="form__label font1">email address*</label>
              <span class="error font1 log1"><?php echo $email_err; ?></span>
            </div>
          </td>
        </tr>        
        <tr><td></td></tr>
        <tr align="center">
            <td>
                <br>
                <div class="buttons1">
                    <a href="#" class="btn effect01 font1" onclick="SubmitForm()"><span>NEXT</span></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="index.php" class="btn effect01 font1"><span>CANCEL</span></a>
                </div>
                <br>
                <br>
              </td>
        </tr>
      </table>
    </form>
  </div>
</body>
</html>