 
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
            Certificats
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Certificats demandés:</h3>
            </div>
            <!-- /.box-header -->
            <div id="" class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
              <tr>
                <th><?= $this->Paginator->sort('certificat') ?></th>
                <th><?= $this->Paginator->sort('Envoyé') ?></th>
                <th><?= $this->Paginator->sort('Modifié') ?></th>
                <th><?= $this->Paginator->sort('etat') ?></th>
                <th><?= $this->Paginator->sort('commentaire') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
                </thead>
                <tbody>
                <?php foreach ($certificatsEtudiants as $certificatsEtudiant): ?>
              <tr>
                <td><?= h($certificatsEtudiant->certificat->type) ?></td>
                <td><?= h($certificatsEtudiant->created) ?></td>
                <td><?= h($certificatsEtudiant->modified) ?></td>
                <td><?php switch ($certificatsEtudiant->etat){
                            case 'Rejeter' : 
                            echo "<span class=\"badge bg-red \" >";
                            break;
                            case 'En cours de traitement' : 
                            echo "<span class=\"badge bg-yellow\" >";
                            break;
                            case 'Demande envoyé' : 
                            echo "<span class=\"badge bg-light-blue\" >";
                            break;
                            case 'Prête' : 
                            echo "<span class=\"badge bg-green\" >";
                            break;
                            case 'Délivré' : 
                            echo "<span class=\"badge bg-navy\" >";
                            break;
                 } 
                 echo h($certificatsEtudiant->etat);
                 ?></td>              
                <td><?=h($certificatsEtudiant->commentaire)?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Form->postLink(__('Annuler'), ['conroller'=>'Etudiants','action' => 'deleteCertificats', 
                  $certificatsEtudiant->id], ['confirm' => __('Etes vous sures d\'annuler ?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
                </tbody>
              </table>
                    </div>
                            
              <form action="<?= $this->Url->build(); ?>" method="POST">
                  <select style="margin: 0 0 1% 3%;" id="choixSelect" class="btn btn-default dropdown-toggle" name="demande_certif_choix">
                      <?php foreach ($optionsCertificats as  $optionsCertificat):?>
                          <?php if(strstr($optionsCertificat->type,"stage") || strstr($optionsCertificat->type,"Retrait")): ?>
                              <option><?=$optionsCertificat->type;?></option>
                          <?php else : ?>
                              <option value="<?=$optionsCertificat->id?>"><?=$optionsCertificat->type;?></option>
                          <?php endif; ?> 
                      <?php endforeach; ?>
                  </select>
                  <input class="btn btn-block btn-primary btn-lg" style="display: inline-block;width:auto;margin: 0 0 1% 5%;padding: 5px 10px;" 
                  name="demande_certif_envoie" value="Demander" type="submit">
                            <div id="test" > </div>
              </form>  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->         
      <!-- /.row -->
    </section>
    <!-- /.content -->

<?php
$this->Html->css([
    'AdminLTE./plugins/datatables/dataTables.bootstrap',
  ],
  ['block' => 'css']);

$this->Html->script([
  'AdminLTE./plugins/datatables/jquery.dataTables.min',
  'AdminLTE./plugins/datatables/dataTables.bootstrap.min',
],
['block' => 'script']);
?>

<?php $this->start('scriptBotton'); ?>
<?= $this->Html->script('pdfmake.min.js');
$this->Html->script('vfs_fonts.js'); ?>
<script>
$(document).ready(function () {
    var table = $("#example1").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "order": [[ 2, "desc" ]],
        "info": false,
        "autoWidth": true,  
        "language": {
            "paginate": {
            "next": "Suivant",
            "previous": "Précédent",
            },
            "search": "Rechercher: ",
            "zeroRecords": "Aucun critère ne correspond à ce que vous avez tapé.",
            "emptyTable": "Rien à afficher.",
            "lengthMenu": "Afficher _MENU_ lignes"
        },
        buttons: [ 'copy', {
                  extend: 'exel',
                  exportOptions: {
                    columns: [0,1,2]
                  }
                  },'pdf','colvis']
    });
    $("#example1").append(table.table().buttons);
    
});
</script>
<?php $this->end(); ?>
