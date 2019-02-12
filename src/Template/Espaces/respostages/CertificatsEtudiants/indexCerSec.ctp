<section class="content-header">
  <h1>
    Certificats demandé
  </h1>
   <div class="pull-right">
   
                <?= $this->Html->link(__('Réinitialiser'), ['action' => 'reinitialiserCertificatsEtudiants'], ['class'=>'btn btn-danger btn-xs']) ?>
      </div>
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
