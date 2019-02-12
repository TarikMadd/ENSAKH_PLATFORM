<?php $this->layout = 'AdminLTE.print';?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>

<body>

<header class="row">
<?php echo $this->Html->image('headerleft.jpg', ['alt' => 'CakePHP', 'align' => 'left']); ?> 
<?php echo $this->Html->image('headerright.jpg', ['alt' => 'CakePHP', 'align' => 'right']); ?> 
<br/><br/>
</header>
<section style="margin-left: 60px;">
<br/>
<br/>
<div class="row">
<div style= "text-align:center; font-size: 250%;">
<strong > DEMANDE DE DEVIS <?= "N°" .$devisdemande['id'] ."/" .date("y") ?></strong>
</div>
</div>
<br/><br/>
<br/>    




<div>
 <style type="text/css">
 table, th, td {
   border: 1.25px solid black;
}
table {
	  width: 650px;
	   
}
th, td {
    padding: 15px;
    text-align: left;
    height: 40px;

}	<?php $num=0; ?>
 </style>   
 <center>
 <table>

                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Article N°
                                    </th>
                                        
                                                                    
                                    <th>
                                    Désigantion
                                    </th>
                                        
                                                                    
                                    <th>
                                    Quantité
                                    </th>
                                        
                                                                    
                                    <th>
                                    Prix Unitaire Ht
                                    </th>
                                    <th>
                                    Prix Totale Ht
                                    </th>
                            </tr>

                            <?php foreach ($devisdemande->articleevents as $articleevents): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?php $num++; echo $num; ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($articleevents->desigantion)?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($articleevents->quantite) ?>
                                    </td>
                                                                        
                                    <td>
                                    </td>
                                    <td>
                         
                                    </td>
                                                                      
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td></td><td></td><td></td>
                              <td><center><strong>TOTAL HT</strong></center></td>
                              <td></td>
                            </tr>
                         <tr>
                         		<td></td><td></td><td></td>
                              <td><center><strong>DONT TVA 20%</strong></center></td>
                              <td></td>
                            </tr>
                            <tr>
                            <td></td><td></td><td></td>
                              <td><center><strong>TOTAL TTC</strong></center></td>
                              <td></td>
                            </tr>                        
                                    
                        </tbody>
                    </table>
</div>
<br/>
</center>
<div class="row">
<div><strong> Arrêté le présent bordereau des prix à la somme de : .......................................................... </strong>
</div>
</div>
<br/><br/>
</section>
</body>
<footer><div class="row">
<div style= "text-align:right;">
<strong > Khouribga, le <?php  echo date("d/m/Y"); ?>&nbsp;&nbsp;&nbsp;</strong>
</div>
</div> </footer>
</html>


