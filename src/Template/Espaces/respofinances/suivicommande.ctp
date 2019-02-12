<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
SUIVI DES COMMANDES
    <div class="pull-right"><?= $this->Html->link(__('Nouvelle'), ['action' => 'addyassir'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('Liste des ') ?> Commandes</h3>
          <div class="box-tools">
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('N°') ?></th>
              <th><?= $this->Paginator->sort('Nom de la commande') ?></th>
              <th><?= $this->Paginator->sort('Intitulé') ?></th>
              <th><?= $this->Paginator->sort('Nom du fournisseur') ?></th>
              <th><?= $this->Paginator->sort('etat') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($devisdemandes as $devisdemande): ?>
              <tr>
                <td><?= $this->Number->format($devisdemande->id) ?></td>
                <td><?= h($devisdemande->nom_devis) ?></td>
                <td><?= h($devisdemande->intitule) ?></td>
                <td><?= h($devisdemande->nom_fournisseur) ?></td>
                <td><?= h($devisdemande->etat) ?></td>
                <td class="actions" style="white-space:nowrap">
                <div class="btn-group">
                  <button type="button" class="btn btn-info">Documents à imprimer</button>
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                  <li><?= $this->Html->link(__('Lettre De Consultation'), ['action' => 'consultation', $devisdemande->id]) ?></li>
                  <li><?= $this->Html->link(__('Demande De Devis'), ['action' => 'imprimerdemandedevis', $devisdemande->id]) ?></li>
                  <li><?= $this->Html->link(__('Bon De Commande'), ['action' => 'boncommande', $devisdemande->id]) ?></li>
                  <li><?= $this->Html->link(__('Bon De Reception'), ['action' => 'imprimerbonreception', $devisdemande->id]) ?></li>
                  <li><?= $this->Html->link(__('Ordre De Paiement'), ['action' => 'ordrepaiement', $devisdemande->id]) ?></li>
                  <li><?= $this->Html->link(__('Ordre De Virement'), ['action' => 'imprimerordrevirement', $devisdemande->id]) ?></li>
                  </ul>
                </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <?php echo $this->Paginator->numbers(); ?>
          </ul>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
