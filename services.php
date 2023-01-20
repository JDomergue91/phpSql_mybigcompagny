<?php
include 'includes/db.php';
?>

<?php 
if(!empty($_POST["Enregistrer"]) and !empty($_POST["name"])) {
    $insert = $db->prepare('INSERT INTO departments SET name = :name');
    $insert->bindValue(':name', $_POST["name"], PDO::PARAM_STR);
    $insert->execute();
    $insert_id = $db->lastInsertId();
  //  var_dump($insert_id);
}
?>

<?php 
if(!empty($_POST["Editer"]) and !empty($_POST["name"])) {
    $insert = $db->prepare('update departments SET name = :name WHERE id = :id');
    $insert->bindValue(':name', $_POST["name"], PDO::PARAM_STR);
    $insert->bindValue(':id', $_POST["id"], PDO::PARAM_INT);
    // ,id = :id
    $insert->execute();
}
?>



<?php 
if(!empty($_GET["id"]) and !empty($_GET["action"]) and $_GET["action"] == "effacer" and $_GET["id"] > 0) {
    $delete = $db->prepare('DELETE FROM departments WHERE id = :id');
    $delete->bindValue(':id', $_GET["id"], PDO::PARAM_INT);
    $delete->execute();
}
?>

<?php

$getDepartments = $db->query('select * from departments');
// $allDepartments = $getDepartments->fetchAll();
// var_dump($allDepartments);

// print_r($allDepartments);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php sql</title>
</head>
<body>
    <a href="/index.php">GESTION EMPLOYES</a>&nbsp;<a href="/services.php">GESTION SERVICES</a>
    <h1>Listes des services</h1>
    <?php
    while ($departments = $getDepartments->fetchObject()) {
 echo "$departments->id $departments->name";
 echo " <a href=\"services.php?action=effacer&id=$departments->id\">effacer</a>&nbsp;";
 echo '<a href="services.php?action=editer&id='.$departments->id.'">editer</a><br>';
}

?>
<?php if(!empty($_GET["action"]) and $_GET["action"] == "editer"){
$titre = "Editer";
$edit = $db->prepare('select * FROM departments WHERE id = :id');
$edit->bindValue(':id', $_GET["id"], PDO::PARAM_INT);
$edit->execute();
$departmentsData = $edit->fetch();
} else {
    $titre = "Enregistrer";
    $departmentsData["id"] = "none";
    $departmentsData["name"] = "";
}
?>
<h1><?php echo $titre ?> un service</h1>

<form method="post" action="services.php">
<input type="hidden" name="id" value="<?php echo $departmentsData["id"] ?>">
<input type="text" name="name" placeholder="service" value="<?php echo $departmentsData["name"] ?>"><br>
<input type="submit" name="<?php echo $titre ?>" value="<?php echo $titre ?>">



</form>
</body>
</html>