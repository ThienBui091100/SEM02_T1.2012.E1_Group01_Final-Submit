<?php
$con = mysqli_connect("localhost","root","","backshop");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
	  // Change character set to utf8
	mysqli_set_charset($con,"utf8");

	
?>
<?php
    $db_server = "localhost";
    //$db_server = "backshop.ddns.net";
    $db_username = "root";
    $db_password = "";
    $db_database = "backshop";
    $uploadFoler = "C:\\xampp\\htdocs\\mau_php\\uploads\\";
    $linkUpload = "http://localhost/mau_php/uploads/";
    $avatarDefault = "https://iupac.org/wp-content/uploads/2018/05/default-avatar.png";
    $conn = mysqli_connect($db_server, $db_username, $db_password, $db_database);
    if(!$conn){
        die("Connection Failed: " . mysqli_connect_error());
    }
    //---
    $control="";
    if(array_key_exists('submit_', $_POST)) {
        $control="SUBMIT";
    }
    if(array_key_exists('reset_', $_POST)) {
        $control="RESET";
    }
    if(array_key_exists('cancel_', $_POST)) {
        $control="CANCEL";
    }
    if(array_key_exists('delete_', $_POST)) {
        $control="DELETE";
    }
    //---
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }
    function phpAlertUrl($msg,$url) {
        echo '<script type="text/javascript">alert("' . $msg . '") </script>';
        echo '<script type="text/javascript">window.location.href = "' .$url. '" </script>';
    }
    function phpConfirn($msg) {
        echo '<script type="text/javascript">Confirn("' . $msg . '")</script>';
    }
    function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
     function random_string($input, $strength) {
        $input_length = strlen($input);
        $generate_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $generate_string .= $random_character;
        }
        return $generate_string;
    }


?>
<script language="JavaScript">
    function checkDelete(){
        return confirm("Are you sure you want to delete?");
    }
    function checkLogout(){
        return confirm("Are you sure you want to sign out?");
    }
    function SubmitForm(){
        form1.submit();
    }
</script>
