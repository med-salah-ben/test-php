<html>
<head>
	<title>Formulaire</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">	
</head>
<body>
<table border="1">
<tr><td>	
<form method="POST" action="Examen.php" >
<h1 align="center">Formulaire d'inscription</h1>
<table>


<tr>
<td>Nom:</td>
<td><input type="text" name="Nom"></td>
</tr>
<tr>
<td>Prenom:</td>
<td><input type="text" name="Prenom"></td>
</tr>
<tr>
<td>Email:</td>
<td><input type="text" name="Email"></td>
</tr>
<tr>
<td>Sexe:</td>
<td><input type="radio" name="sexe"> Masculin 
	<input type="radio" name="sexe"> Féminin </td>
</tr>
<tr>
	<td>Pays</td>
	<td>
	<SELECT height="20" name="Pays">
	<option>France</option>
	<option>Tunisie</option>
	<option>Belgique</option>
	</SELECT>
</td>
</tr>
<tr>
	<td>Les langages préférés</td>
	<td>
	<SELECT height="20" name="Langages">
	<option>C</option>
	<option>Java</option>
	<option>Python</option>
	</SELECT>
    <label>(pour faire plusieur choix la touche CTRL enfoncé)</label>
</td>
</tr>
<tr>
	<td>Domaine d'activité</td>
	<td>
    <input type="checkbox" name="Activité" />
    <label>Informatique</label>
    <input type="checkbox" name="Activité" />
    <label>Gestion</label>
    <input type="checkbox" name="Activité" />
    <label>Pédagogie</label>
</td>
</tr>
<tr></tr>
<tr>
	<td></td>
<td><input type="submit" value="Ajouter" name="envoi"><input type="Reset" value="Annuler"></td>
</tr>
</table>
</form></td>
</tr>
</table>

<?php
$con=new mysqli("localhost", "root","","examen");
$con = new mysqli("localhost", "root", "", "examen");

if (isset($_POST['envoi'])) {
    $Nom = $_POST['Nom'];
    $Prenom = $_POST['Prenom'];
    $Email = $_POST['Email'];
    $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : '';
    $Pays = $_POST['Pays'];
    $Langages = $_POST['Langages'];
    $Activité = isset($_POST['Activité']);

    $errors = array();

    if (empty($Nom)) {
        $errors[] = "Il faut saisir votre matricule.";
    }

    if (empty($Prenom)) {
        $errors[] = "Il faut saisir votre nom et prénom.";
    }

    if (empty($Email)) {
        $errors[] = "Il faut saisir votre Email.";
    }

    if (empty($sexe)) {
        $errors[] = "Il faut saisir votre sexe.";
    }

    if (empty($Pays)) {
        $errors[] = "Il faut saisir votre Pays.";
    }

    if (empty($Langages)) {
        $errors[] = "Il faut saisir votre Langages.";
    }

    if (empty($Activité)) {
        $errors[] = "Il faut saisir votre Activité.";
    }

    if (empty($errors)) {
        mysqli_select_db($con, "examen");
        $req = "INSERT INTO etudiant (Nom, Prenom,Email, sexe, Pays , Langages , Activité)
                VALUES ('$Nom', '$Prenom', '$Email' , $sexe', '$Pays' , '$Langages' , '$Activité')";
        mysqli_query($con, $req);
        echo "Inscription a été effectué avec succès.<br>";
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}

$con=new mysqli("localhost", "root","","examen");
mysqli_select_db($con,"examen");
$RES= "SELECT * FROM etudiant";
$req2=mysqli_query($con,$RES);


if(mysqli_num_rows($req2)>0){
	echo "<table border=1 width=80%>";
	echo "<tr><th>Nom</th><th>Nom et Prenom </th><th> Email</th><th> Sexe</th><th> Pays</th><th> Les langages préférés</th><th> Domaines d'activité</th></tr>";
    while($data = mysqli_fetch_array($req2)){
       echo "<tr>";
		echo "<td>".$data["Nom"]."</td><td>".$data["Prenom"]."</td><td>".$data["Email"]."</td><td>".$data["sexe"]."</td><td>".$data["Pays"]."</td><td>".$data["langages"]."</td><td>".$data["Activité"]."</td>";
		echo "</tr>";
    }
	echo "</table>";
}else{
	echo "<br>";
     echo "No Inscription Found!";
}

mysqli_close($con);
?>
</body>	
</html>