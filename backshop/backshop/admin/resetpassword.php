<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/security.css">
     <title>Forgotpass</title>
</head>
<style>
              
</style>
<body class="bodycenter">
<!-- FORM NHAP THONG TIN -->
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="form1">
            <table width="50%" align=center cellspacing="1" cellpadding="2" border="0" >
                <tr valign="top">
                    <td>
                        <b><label class="font1 log4">PLEASE CONTACT YOUR MANAGER FOR PASSWORD REGISTRATION</label></b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br>
                        <div class="buttons">
                            <a href="index.php" class="btn effect01"><span>BACK</span></a>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
