<!-- Content Header (Page header) -->

<section class="content-header">
  <h1>
    Statistics Laureate
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'ajouterLaureats'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Statistics Laureate</h3>
          <div class="box-tools">

          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id',array('label'=>"ID")) ?></th>
              <th><?= $this->Paginator->sort('annee',array('label'=>"Promotion")) ?></th>
              <th><?= $this->Paginator->sort('nombresTravailles',array('label'=>"Number of successful candidates who landed a job")) ?></th>
              <th><?= $this->Paginator->sort('nombresNonTravailles',array('label'=>"Number of unemployed laureates")) ?></th>
              <th><?= $this->Paginator->sort('filieres',array('label'=>"Industry")) ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($laureats as $laureat): ?>
              <tr>
                <td><?= $this->Number->format($laureat->id) ?></td>
                <td><?= h($laureat->annee) ?></td>
                <td><?= $this->Number->format($laureat->nombresTravailles) ?></td>
                <td><?= $this->Number->format($laureat->nombresNonTravailles) ?></td>
                <td><?= h($laureat->filieres) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'viewLaureats', $laureat->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'modifierLaureats', $laureat->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'supprimerLaureats', $laureat->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
<style>
.button {
    border-radius: 10px;
    background-color: red;
    border: none;
    color: #FFFFFF;
    text-align: center;
    font-size: 10px;
    padding: 10px;
    width: 140px;
    cursor: pointer;
    margin: 10px;
}
</style>
<?php echo '<h3>  Type a year and you will have informations about the laureats of this year: </h3>';?>


<!-- /.content -->

    <script type="text/javascript">
      function showHint()
      {

        var str=document.getElementsByName('text')[0].value;
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange=function(){
          if(this.readyState == 4 && this.status == 200)
          {
            document.getElementById("resultat").innerHTML = this.responseText;
          }

        }
        xmlhttp.open("GET","liste2?q="+str,true);
        xmlhttp.send();

      }

    </script>


    <input type="text" name="text" onkeyup="showHint(this.value)">
  
    <div id="resultat"></div>
