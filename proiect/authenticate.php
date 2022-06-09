<?php

//Variabile pentru baza de date

include ('dbcon.php');

//verificam daca s-au completat campurile cu email si parola din pagina de login
//if(!isset($_POST['email'], $_POST['password'])){
 //exit('Va rugam introduceti email-ul si parola');
   
//}
if (isset($_POST['login'])) {
    
    if (empty($_POST['email'])) { array_push($errors, "Introduceti adresa de email institutionala"); }
    if (empty($_POST['password'])) { array_push($errors, "Introduceti parola"); }
}



//pregatim SQL-ul
if($stmt = $con->prepare('SELECT * FROM users  WHERE email = ?')){
    //legam parametrii s = string pentru email
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    //stocarea rezultatului pentru a verifica daca mail-ul exista in baza de date
    $stmt->store_result();
}

if($stmt->num_rows > 0){
    $stmt->bind_result($id, $nume, $email, $password, $functie);
    $stmt->fetch();
   
    // $stmt->close();
    //mail-ul exista, verificam parola
    if($_POST['password'] === $password && $_POST['email'] === $email){
        //verificare cu succes
        //crearea sesiunii, pentru a stii ca user-ul este logat
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        //$_SESSION['name'] = $_POST['email'];
        $_SESSION['name'] = $nume;
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;
        $_SESSION['functie'] = $functie;
        $_SESSION['password'] = $password;
        

        //trimitere catre pagina corespunzatoare rolului atribuit in baza de date
        
        if($_SESSION['functie'] == 'student')
        
		    header('Location: studenti.php');

        if($_SESSION['functie'] == 'profesor')
            header('Location: profesori.php');  
              
    } else{
        if (isset($_POST['login']))
        if($_POST['password'] && $_POST['email'])
                 array_push($errors, "Parola sau adresa de email gresita");
    }
}else{
    if (isset($_POST['login']))
        if($_POST['password'] && $_POST['email'])
                 array_push($errors, "Parola sau adresa de email gresita");  
              
} 



