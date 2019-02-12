<section class="content">
  <?php  if ($_SESSION['yes'] ==0) 
  { ?>
    <div class="col-md-12">
              <div class="box box-primary box-solid">
                <div class="box-header with-border center-block">
                <i class="fa fa-fw fa-book"></i>
                  <h3 class="box-title">Modules</h3>
                  <!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                   <div class="row">
                   <div class="col-md-4"></div>
                     <div class="col-md-4"><?php
echo $this->form->create('');
for($i=0;$i<12;$i++)
{
  $optionss[$i] = $niveaus[$i]['libile']." ".$niveaus2[$i]['libile'];
}
echo $this->Form->select('classe', $optionss, ['empty' => 'Choisir une classe','onchange' =>"this.form.submit();"]);
?> 
<?php
echo $this->form->end();
?></div>
                   </div>

                </div>
 <!-- /.box-body -->

              </div><!-- /.box -->
            </div>
  <?php }
  ?>
<?php 
if (isset($res) && count($res)!=0)
{?>

<div class="row">
            <div class="col-md-12">
              <div class="box box-primary box-solid">
                <div class="box-header with-border">
                
                <i class="fa fa-fw fa-book"></i>
                 <h3 class="box-title">Modules</h3>
                </div><!-- /.box-header -->
                <div class="form-group center-block col-md-3 pull-right">
              <?php
echo $this->form->create('');
for($i=0;$i<12;$i++)
{
  $optionss[$i] = $niveaus[$i]['libile']." ".$niveaus2[$i]['libile'];
}
echo $this->Form->select('classe', $optionss, ['empty' => 'Choisir une classe','onchange' =>"this.form.submit();"]);
?> 
<?php
echo $this->form->end();
?>
            </div>
          
                <div class="box-body">
                  <table class="table table-bordered table-striped">
                    <tr>
                      <th style="text-align: center">#</th>
                      <th style="text-align: center">Module</th>
                      <th style="text-align: center">Elèment de Module</th>
                      <th style="text-align: center">Semestre</th>
                      
                      <th style="text-align: center">Action</th>
                    </tr>
                    <tr>
                    <?php $i=1; foreach ($modules as $module) 
                   {?>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $module['m']?></td>
                      <td><?php echo $module['libile']?></td>
                      <td><?php echo $module['s']?></td>
                      
                      <td style="text-align: center"> <a href="view/<?php echo $module['id']; ?>" class="skin-black">
                    <span class="label label-primary">Afficher</span>
                  </a>
                  <a href="edit/<?php echo $module['id']; ?>" class="skin-black"><span class="label label-warning">Modifier</span></a></td>
                    </tr>
                    <?php $i++; } ?>
                  </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->

             <!-- /.box -->
            </div>
</div>

  <?php
}?>
</section>



         