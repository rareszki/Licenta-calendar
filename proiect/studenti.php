<?php
session_start();
// redirectionare la pagina de logare daca user-ul nu este logat
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <title> Student/examene  </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/style2.css">
</head>

<?php
    include('headerst.php');
?>
<body> 
   
<?php
//echo 'Id user logat: ' . get_current_user();
echo "Utilizator curent: ".$_SESSION['name'];
?>
</body>
</html>
