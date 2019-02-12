

<!-- ********************************************************************************************************************** -->
<!-- Content Header (Page header) -->
<section class="content-header">
<h1> Certificats demandé </h1>
<table align="right">
<tr>
<td>
 <div class="pull-right"><?= $this->Html->link(__('Statistiques'), ['action' => 'statiqtiquesCertificatsEtudiants'],
 ['class'=>'btn btn-info btn-xs']) ?></div>

 </td>
<td width=10% ></td>
 <td>
<div class="pull-right"><?= $this->Html->link(__('Réinitialiser'), ['action' => 'reinitiliserCertificatsEtudiants'],
 ['confirm' => __('Vous allez réinitialiser touts les demandes'),'class'=>'btn btn-danger btn-xs']) ?></div>
 </td>
 <td width=10% ></td>
 <td>
<div class="pull-right"><div class="pull-right"><?= $this->Html->link(__('graphes'), ['action' => 'graphesCertificatsEtudiants'],
 ['class'=>'btn btn-info btn-xs']) ?></div>
 </td>
 </tr>
 </table>
 <br/>
</section>  
<!-- Envoye -->
       <?php include'afficherTableEnvoye.ctp'; ?>
<!-- En cours -->
       <?php include'afficherTableEncours.ctp'; ?>
<!-- Prete -->
       <?php include'afficherTablePrete.ctp'; ?>
<!-- Delivré -->
       <?php include'afficherTableDelivrer.ctp'; ?>
<!-- Rejeter -->
       <?php include'afficherTableRejeter.ctp'; ?>
<!-- ***************************************************************************************************************************** -->
