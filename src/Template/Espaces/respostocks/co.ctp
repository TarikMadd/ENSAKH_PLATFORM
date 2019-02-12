
<?php $this->layout = 'AdminLTE.print'; ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>
<body style="    margin-right: 75px;
    margin-left: 75px;">

<div style=" text-align: left;" >
<?php echo $this->Html->image('av.jpg', ['alt' => 'CakePH']); ?>
</div> 
N <?= h($commande->id) ?>   
<br />
    KHOURIBGA LE <?php  echo date('d\/ m \/ y'); ?>
 <br />
 <br />   
   <h5 style=" text-align: center ;">DEMANDE DE DEVIS</h5>
<table class="table table-hover" text>
   <thead> <!-- En-tête du tableau -->
       <tr bgcolor="silver">
           <th border="1px solid black">article</th>
           <th border="1px solid black">DESIGHANTION</th>
           <th border="1px solid black">Qte</th>
           <th border="1px solid black">P.U DH</th>
           <th border="1px solid black">Total DH</th>
       </tr>
   </thead>

   <tfoot> <!-- Pied de tableau -->
       <tr bgcolor="silver">
           <th>TOTAL HT</th>
           <th>TVA 20%</th>
           <th>TOTAL TTC</th>

       </tr>
        <tr bgcolor="silver">
           <th></th>
           <th>        </th>
           <th>        </th>

       </tr>
                <tr >
           <th></th>
           <th>        </th>
           <th>        </th>

       </tr>

   </tfoot>

   <tbody> <!-- Corps du tableau -->
           <td><?= h($commande->article->label_article) ?></td>
           <td><?= $commande->desciption ?></td>
           <td><?= $this->Number->format($commande->nbr_article) ?></td>
           <td></td>
           <td></td>

       </tr>
   </tbody>
</table>

</body>
</html>

