<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Certificats
       <div class="pull-right"><?= $this->Html->link(__(''), ['action' => 'addCertificats'], ['class'=>'btn fa fa-plus btn-success btn-xs']) ?></div>
      </h1>
    </section>
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Table de donnees</h3>
           

          <div class="box">
            <div class="box-header">
          
            </div>
            <!-- /.box-header -->
            <div class="box-body">
           
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>certificat</th>
                  <th>Nom</th>
                  <th>Filiere</th>
                  <th>Actions</th>
              
                </tr>
                </thead>
                <tbody>
              
                  <?php for($i=0;$i<count($donne_enCour);$i++): ?>
                <tr>
                <td><?= h($donne_demande[$i]['type']) ?></td>
                
                <td><?= h($donne_demande[$i]['nom_fr'].$donne_demande[0]['prenom_fr']) ?></td>
                <td><?= h($donne_demande[$i]['libile'])?></td>
                <td> <span class="badge bg-yellow" ><?= h($donne_demande[$i]['etat']) ?></span></td> <td>
                <?= $this->Html->link(__('Commentaire'), ['action' => 'cmntCertificatsEtudiants', $donne_demande["$i"]['id_certif']], ['class'=>'btn btn-block btn-info btn-xs']) ?>
                </td>
              </tr>
            <?php endfor; ?>
         
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
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
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<?php $this->end(); ?>
