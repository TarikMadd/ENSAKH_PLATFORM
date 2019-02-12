<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mailbox
      </h1>
      <ol class="breadcrumb">
        <li><a href="indexCommandes"><i class="fa fa-dashboard"></i> back</a></li>
        <li class="active">Mailbox</li>
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
<form method="post" action="envoieCom" enctype="multipart/form-data">
<div class="box-body">
              <div class="form-group">
                <input name="email" class="form-control" placeholder="To:">

              </div>
              <div class="form-group">
                <input name="subject" class="form-control" placeholder="Subject:">
              </div>
              <div class="form-group">
              <label>Message:</label>
                    <textarea name="msg" class="form-control" style="height: 200px">

                    </textarea>
              </div>
              <div class="form-group">
    <label>Liste des articles:</label>
    <input type="file" name="attach1"/>
    <br>
    <label>Demande devis:</label>
    <input type="file" name="attach2"/>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button name="submit" type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
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
