<?php $this->layout = '' ?>
<!DOCTYPE html>

<style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even) {
    background-color: #dddddd;
  }
  .button {
    border-radius: 10px;
    background-color: red;
    border: none;
    color: #FFFFFF;
    text-align: center;
    font-size: 10px;
    padding: 10px;
    width: 140px;
    cursor: pointer;
    margin: 10px;
  }

</style>


<?php
$q = $_REQUEST["q"];
echo '
<table>
  <tr>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Telephone</th>

  </tr>

  ';

  $dbb=new PDO('mysql:dbname=ensaksite;host=127.0.0.1', 'root','');
  $requ=$dbb->query('select nom_fr,prenom_fr,numero_tel from etudiants where annee_sortie='.$q.'');


  while ($daba=$requ->fetch())
  {

   echo '
   <tr>
    <td>'.$daba['nom_fr'].'</td>
    <td>'.$daba['prenom_fr'].'</td>
    <td>'.$daba['numero_tel'].'</td>

  </tr>';



}
echo '</table>';


?>
