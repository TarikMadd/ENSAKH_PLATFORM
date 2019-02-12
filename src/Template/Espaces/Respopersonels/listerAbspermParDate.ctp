<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Absences des fonctionnaires
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Absences </h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              
            </form>
          </div>
            </div>

        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
                       <tr>
                          <th><?= $this->Paginator->sort('id') ?></th>
                          <th><?= $this->Paginator->sort('Nom profpermanent ') ?></th>
                          <th><?= $this->Paginator->sort('Prenom profpermanent ') ?></th>
                          <th><?= $this->Paginator->sort('Cause absence') ?></th> 
                           <th><?= $this->Paginator->sort('Date absence') ?></th>
						                                           
                        </tr>
      
<?php foreach ($absences as $absence): ?>
             
<tr>
<td><?php echo $absence['id']; ?></td> 
<td><?php echo $absence['nom_prof']; ?></td> 
<td><?php echo $absence['prenom_prof']; ?></td>
<td><?php echo $absence['cause']; ?></td> 
<td><?php echo $absence['date_ab']; ?></td>

</tr>
                
<tr>
<?php endforeach; ?>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
          </ul>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>