<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
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
  </head>
  <body>
   
    <?php
    if(isset($_POST['annee']))
    {
             echo '
             <table>
                    <tr>
                          <th>Nom</th>
                          <th>Prenom</th>
                          <th>tel</th>

                    </tr>

             ';

                  $dbb=new PDO('mysql:dbname=ensaksite', 'root','');
                  $requ=$dbb->query('SELECT nom_fr,prenom_fr,numero_tel from etudiants where annee_sortie='.$_POST['annee'].'');


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

    }
    ?>

  </body>
</html>
