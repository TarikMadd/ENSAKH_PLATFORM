<section class="content">
  <div class="col-md-12">
              <div class="box box-primary box-solid">
                <div class="box-header with-border center-block">
                <i class="fa fa-edit"></i>
                  <h3 class="box-title">Modules</h3>
                  <!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                   <div class="row">
                   <div class="col-md-4"></div>
                     <div class="col-md-4"><label>Choisir une classe:</label><?php
echo $this->form->create('');
for($i=0;$i<12;$i++)
{
  $optionss[$i] = $niveaus[$i]['libile']." ".$niveaus2[$i]['libile'];
}
echo $this->Form->select('classe', $optionss, ['empty' => '(choisissez)']);
?> 
<div></div><input value="Submit" type="submit" class="btn btn-block btn-primary "><?php
echo $this->form->end();
?></div>
                   </div>

                </div>
 <!-- /.box-body -->

              </div><!-- /.box -->
            </div>
<?php 
if (isset($res) && count($res)!=0)
{?>

<div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Listes de Modules </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered table-striped">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Element de Module</th>
                      <th>Semestre</th>
                      <th>CM</th>
                      <th>TD</th>
                      <th>TP</th>
                      <th>AP</th>
                      <th>Eval</th>
                      <th>Action</th>
                    </tr>
                    <tr>
                    <?php $i=1; foreach ($modules as $module) 
                   {?>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $module['libile']?></td>
                      <td><?php echo $module['s']?></td>
                      <td><?php echo $module['CM']?></td>
                      <td><?php echo $module['TD']?></td>
                      <td><?php echo $module['TP']?></td>
                      <td><?php echo $module['AP']?></td>
                      <td><?php echo $module['Eval']?></td>
                      <td> <a href="view/<?php echo $module['id']; ?>" class="skin-black">
                    <i class="fa fa-edit " style="color:red"></i>
                  </a></td>
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




         