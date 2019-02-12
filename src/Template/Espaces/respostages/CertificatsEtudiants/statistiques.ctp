<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vue global
        <small>Certificats</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Table des données</h3>
           

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Statistiques</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
           
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Filières</th>
                  <th>Certificats En Attente</th>
                  <th>Certificats En Cours</th>
                  <th>Certificats Prête</th>
                  <th>Certificats délivrés</th>
                  <th>Certificats Rejetés</th>
                </tr>
                </thead>
                <tbody>
              
                <?php for($i=0;$i<count($filiere);$i++): ?>
                <tr>

                  <td><?php echo $filiere[$i]['libile']; ?></td>
                  <td>
                  <?php echo $envoyeStat[$filiere[$i]['id']]; ?>
                  </td>
                  <td> <?php echo $enCoursStat[$filiere[$i]['id']]; ?></td>
                  <td>  <?php echo $preteStat[$filiere[$i]['id']]; ?></td>
                  <td> <?php echo $delivreStat[$filiere[$i]['id']]; ?></td>
                  <td> <?php echo $rejeterStat[$filiere[$i]['id']];  ?></td>
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
    $("#example1").DataTable({
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
