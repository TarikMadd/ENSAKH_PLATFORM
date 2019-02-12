<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Boite Email
      </h1>
      <ol class="breadcrumb">
        <li><a href="indexDepart1"><i class="fa fa-dashboard"></i> courrier depart</a></li>
        <li class="active">Boite Email</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
<form method="post" action="envoyer" enctype="multipart/form-data">
<div class="box-body">
              <div class="form-group">
                <input name="email" class="form-control" placeholder="à:">
              </div>
              <div class="form-group">
                <input name="subject" class="form-control" placeholder="Objet:">
              </div>
              <div class="form-group">
              <label>Message:</label>
                    <textarea name="msg" class="form-control" style="height: 200px">

                    </textarea>
              </div>
              <div class="form-group">
    <label>Courrier:</label>
    <input type="file" name="attach1"/>
    <br>
                <p class="help-block">Max. 32MB</p>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button name="submit" type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Envoyer</button>
              </div>
            </div>


  </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

<?php
$this->Html->css('AdminLTE./plugins/fullcalendar/fullcalendar.min', ['block' => 'css']);
$this->Html->css('AdminLTE./plugins/fullcalendar/fullcalendar.print', ['block' => 'css', 'media' => 'print']);
$this->Html->css('AdminLTE./plugins/iCheck/flat/blue', ['block' => 'css']);
$this->Html->css('AdminLTE./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min', ['block' => 'css']);

$this->Html->script([
  'AdminLTE./plugins/iCheck/icheck.min',
  'AdminLTE./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min',
],
['block' => 'script']);
?>
