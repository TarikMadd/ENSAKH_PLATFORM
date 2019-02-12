
<?php $this->layout = 'AdminLTE.print'; ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>
<body style="    margin-right: 50px;
    margin-left: 50px;">

<div style=" text-align: left;" >
<?php echo $this->Html->image('av.jpg', ['alt' => 'CakePH']); ?>
</div> 
N <?= h($prete[0]['commande_id']) ?>   
<br />
    KHOURIBGA LE <?php  echo date('d\/ m \/ y'); ?>
 <br />
 <br />   
   <h5 style=" text-align: center ;">DEMANDE DE DEVIS</h5>
   <table border="1px solid black">
       <tr bgcolor="silver">
           <th border="1px solid black">article</th>
           <th border="1px solid black"    style="width:250px; " >DESIGHANTION</th>
           <th border="1px solid black">Qte</th>
           <th border="1px solid black">P.U DH</th>
           <th border="1px solid black">Total DH</th>
       </tr>
            <?php $i=0;  ?> 
            <?php foreach ($prete as $prete):  ?>  
            <tr>    
           <td><?= ($var[$i][0]['label_article']) ?></td>
            <?php $i++;  ?>   
           <td style="width:250px;"><?= ($prete['description']) ?></td>
           <td><?= $this->Number->format($prete['quantite']) ?></td>
           <td></td>
           <td></td>
           </tr>
            <?php endforeach; ?>
       <tr bgcolor="silver">
           <th>TOTAL HT</th>
           <th>TVA 20%</th>
           <th>TOTAL TTC</th>

       </tr>
       <tr >
           <th height="50" ></th>
           <th height="50"   >        </th>
           <th height="50"  >        </th>

       </tr>       



</table>
</body>
</html>

