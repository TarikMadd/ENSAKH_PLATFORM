<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Tables
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
           

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
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
