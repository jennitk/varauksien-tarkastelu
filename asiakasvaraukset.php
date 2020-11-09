<?php
session_start();
require_once "config.php";



$query = "SELECT CONCAT(DAY(k.kalenteri_pvm),'.',MONTH(k.kalenteri_pvm),'.',YEAR(k.kalenteri_pvm),' klo ',kalenteri_kellonaika) as aika, 
a.as_etunimi,a.as_sukunimi,a.as_osoite,a.as_email,a.as_puhnro
FROM asiakasvaraukset a LEFT JOIN terapeutin_kalenteri tk ON a.tpkalenteri_fk=tk.tpkalenteri_id
LEFT JOIN kalenteri k ON k.kalenteri_id=tk.kalenteri_fk";
$result = $link->query($query);
$asiakasvaraukset= mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
?>
<!doctype html>
<html lang="fi">
  <head>
    <!-- Tarvittavat metatagit -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="js/jquery-1.10.2.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<main role="main">
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #5A9089;">

<div class="nav-item">
    <a class="navbar-brand">
        <img src="Pictures\whitelogo_Larate.png" style=" height: 30px; width: 100 px; display: inline-block;">

    </a>
</div>

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
    aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarsExampleDefault">

    <ul class="navbar-nav mr-auto">
    </ul>

<a class="btn btn-light float-right" href="sessiondestroy.php" type="button" aria-haspopup="true" aria-expanded="false">
Kirjaudu ulos</a>
</nav>
<div class="container">
<h2 style="font-weight: lighter; text-align: center;" class="txtVaraus1">Tältä sivulta näet asiakasvaraukset, jotka on tehty Larate -palvelun kautta:</h2>

</div>
<?php
foreach($asiakasvaraukset as $row)
{
?>
<div class="container">
<h3 style= "margin-top:25px; font-weight:lighter;"> Uusi varaus: </h3>
<div class="AsiakasVaraukset">
<textarea class="form-control rounded-0 txaVaraukset" style="background-color:white;" readonly rows="5">
<?php echo $row['aika'];?>

<?php echo $row['as_etunimi'];?> <?php echo $row['as_sukunimi'];?>

<?php echo $row['as_osoite'];?>

<?php echo $row['as_email'];?>

<?php echo $row['as_puhnro'];?>
</textarea>

</div>
</div>

<?php } mysqli_close($link); ?>
<br>
<br>
<div class="container">
          <div class="row">
            <div class="col-sm-2">
            <a class="btn btn-danger btn-lg" style="width:300px;" href="terve_terapeutti.php" role="button">Palaa profiilisivullesi</a> 
            </div>
            <div class="col-sm-6"></div>
            <div class="col-sm-2">
           
            </div>
          </div>
        </div>
        <br>
<br>
</main>
<?php include('includes/footer.php')?>
</body>
</html>