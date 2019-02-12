<?php $this->layout = 'AdminLTE.print';?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>
<header>
<div id="pageHeader">
<?php echo $this->Html->image('hassan100.jpg', ['alt' => 'CakePHP', 'align' => 'left']); ?>
<!--<p style="text-align: center;">Ecole Nationale Des Sciences Appliquees <br/> Khouribga </p>-->
<?php echo $this->Html->image('ensa100.jpg', ['alt' => 'CakePHP', 'align' => 'right']); ?> 
<p style="text-align: center;">Ecole Nationale Des Sciences Appliquees <br/> Khouribga </p>
</div>
</header>
<body style="    margin-right: 90px;
    margin-left: 120px;">
<br/><BR>
<!--<p style=" text-align: left;"> <?= "N°" .$devisdemande['id'] ."/" .date("y") ?></p>-->
<br/><BR>
<br/><BR>
<br/><BR>
<br/><BR>

<!--<p style=" text-align: right;">    KHOURIBGA le <?php  echo date("d/m/Y"); ?></p>-->

<br />
   <!-- <h4 style=" text-align: center;">Le Directeur de l’Ecole Nationale des</h4>
     <h4 style=" text-align: center;">Sciences Appliquées Khouribga</h4>
     <h4 style=" text-align: center;">A</h4>
<br />
     <h4 style=" text-align: center;">MONSIEUR  LE GERANT DE LA SOCIETE  <?php   echo $devisdemande['nom_fournisseur'];   ?></h4>-->
  <!--<h4 style=" text-align: center;"><?= $devisdemande['adresse_fournisseur']; ?>   </h4> 
<br />
     <h5>
            Objet : DEMANDE DE DEVIS 
</h5>  
     <h5>
        MONSIEUR,
</h5>  -->
<div style="margin-left: 20px";>

<p>
    le Directeur de l'Ecole National Des Sciences Appliquees de khouribga atteste que 
    Mr(Mme):</br>

    Nom: <?= h($books[0]['nom_vacataire']);   ?><br/>
    Prenom:<?=     h($books[0]['prenom_vacataire']);?>
    <br/>
    CIN:<?=     h($books[0]['CIN']);?><br/>
    N de P.P.N:<?=     h($books[0]['somme']);?><br/>
    date Recrutement:<?=     h($books[0]['dateRecrut']);?><br/>
    
   
    Lieu de travail:KHOURIBGA
    <br/>

    la presente attestation est delivree a l'interesse pour servir et valoir ce que de droit.<br/>

    KHOURIBGUA Le           <?php  echo date("d/m/Y"); ?>
</p>
<!--<p >J’ai l’honneur de vous demander de bien vouloir nous faire parvenir un devis
<br />
concernant la liste des articles ci-jointe, par courrier ou le déposer directement à l’école.
<br /> 
Dans l’attente de votre offre, veuillez agréer, Monsieur l’expression de nos 
<br />
considérations les plus distinguées.
<br /><br\>Veuillez nous retourner notre lettre de consultation bien cachetée par votre soin.
</p></div>
<br/><br/>-->

<!--<div style="    margin-right: 120px;
    margin-left: 120px;">
 <table class = "table table-hover" >
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Desigantion
                                    </th>
                                        
                                                                    
                                    <th>
                                    Quantite
                                    </th>
                                        
                                                                    
                                    <th>
                                    Prix Unitaire Ht
                                    </th>
                            </tr>

                            <?php foreach ($devisdemande->articleevents as $articleevents): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($articleevents->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($articleevents->desigantion)?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($articleevents->quantite) ?>
                                    </td>
                                                                        
                                    <td>
                                   
                                    </td>
                                                                      
                                </tr>
                            <?php endforeach; ?>                        
                                    
                        </tbody>
                    </table>
                    <table class="table table-hover">
                        <tbody>
                         <tr>
                              <th><center>TVA</center></th><td>20%</td>
                            </tr>
                            <tr>
                              <th><center>PRIX TOTAL TTC</center></th><td></td>
                            </tr>
                            </tbody></table></div>


<br/><br/>-->
</body>
<footer><div style=" text-align: center;"  >
<?php echo $this->Html->image('footer.jpg', ['alt' => 'CakePHP']); ?>
</div> </footer>
</html>