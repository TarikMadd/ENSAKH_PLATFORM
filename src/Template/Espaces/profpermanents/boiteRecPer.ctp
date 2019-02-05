Vous etes connécté en tant que <?= $role ?>

<!DOCTYPE html>
<html>

<body class="hold-transition skin-blue sidebar-mini">
<div>




    <!-- Content Wrapper. Contains page content -->
    <div class="content-wraper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Boîte aux lettres
                <!--   <small>13 new messages</small>-->
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
                <li class="active">Boîte aux lettres</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <a href="<?php echo $this->Url->build('/profpermanents/envoyerNvPer'); ?>" class="btn btn-primary btn-block margin-bottom">Composer un nouveau message</a>

                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dossiers</h3>

                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="active"><a href="<?php echo $this->Url->build('/profpermanents/boiteRecPer'); ?>"><i class="fa fa-inbox"></i> Boîte de réception
                                        <?php if(!isset($displaySent)){ ?>  <span class="label label-primary pull-right"> <?php $c =0; foreach ($mesMsgs as $m){ $c++; } echo $c; ?></span><?php } ?></a></li>
                                <li><a href="<?php echo $this->Url->build('/profpermanents/getMsgsEnvoye'); ?>"><i class="fa fa-envelope-o"></i> Messages envoyés</a></li>
                               <!-- <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                                <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
                                </li>
                                <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li> -->
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Labels</h3>

                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                                <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <?php if(!isset($displaySent)): ?>
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Boîte de réception</h3>

                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                    <input type="text" class="form-control input-sm" placeholder="Search Mail">
                                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                </div>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <form action="/Ensaksite/profpermanents/supprimerMsg" method="post">
                            <div class="box-body no-padding">
                                <div class="mailbox-controls">
                                    <!-- Check all button -->
                                    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                                    </button>
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-default btn-sm" onclick="return confirm('confirmer la suppression?')"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                    <!-- /.btn-group -->
                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                                    <div class="pull-right">
                                        1-50/200
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                        </div>
                                        <!-- /.btn-group -->
                                    </div>
                                    <!-- /.pull-right -->
                                </div>
                                <div class="table-responsive mailbox-messages">

                                    <table class="table table-hover table-striped">
                                        <tbody>
                                        <?php foreach ($mesMsgs as $msg): ?>
                                        <tr>
                                            <td><input type="checkbox" name="msgChecked[]" value="<?php echo $msg['id']; ?>"></td>
                                            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                            <td class="mailbox-name"><a href="<?php $id = $msg['username']; echo $this->Url->build('/profpermanents/lireMsgPer/'.$msg['id']); ?>"><?php  if(strcmp($msg['role'],'resposcolarite') == 0) echo 'SCOLARITE '.$msg['username']; else echo 'ETUDIANT '.$msg['username']; ?></a></td>
                                            <td class="mailbox-subject"><b><?php  echo $msg['sujet']; ?></b> <?php  echo substr($msg['contenu'], 0,50)."..."; ?>
                                            </td>
                                            <td class="mailbox-attachment"></td>
                                            <td class="mailbox-date"><?php if($msg['inttervale'] <= 86400){echo "il y a: ".gmdate("H:i",$msg['inttervale'])."min";}else{echo "reçu le:   ".$msg['date'];} ?></td>
                                        </tr>
                                        <?php endforeach; ?>

                                        </tbody>
                                    </table>

                                    <!-- /.table -->
                                </div>
                                <!-- /.mail-box-messages -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer no-padding">
                                <div class="mailbox-controls">
                                    <!-- Check all button -->
                                    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                                    </button>
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-default btn-sm" onclick="return confirm('confirmer la suppression?')"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                    <!-- /.btn-group -->
                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                                    <div class="pull-right">
                                        1-50/200
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                        </div>
                                        <!-- /.btn-group -->
                                    </div>
                                    <!-- /.pull-right -->
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /. box -->
                </div>
                <?php endif ?>


                <?php if(isset($displaySent)): ?>
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Mes messages envoyés</h3>

                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                    <input type="text" class="form-control input-sm" placeholder="Search Mail">
                                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                </div>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->

                            <div class="box-body no-padding">
                                <div class="mailbox-controls">
                                    <!-- Check all button -->


                                    <!-- /.btn-group -->
                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                                    <div class="pull-right">
                                        1-50/200
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                        </div>
                                        <!-- /.btn-group -->
                                    </div>
                                    <!-- /.pull-right -->
                                </div>
                                <div class="table-responsive mailbox-messages">

                                    <table class="table table-hover table-striped">
                                        <tbody>
                                        <?php foreach ($mesMsgsN as $msg): ?>
                                        <tr>
                                            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                            <td class="mailbox-name"><a href="<?php $id = $msg['username']; echo $this->Url->build('/profpermanents/lireMsgPer/readSN.'.$msg['id']); ?>"><?php  if(strcmp($msg['role'],'resposcolarite') == 0) echo 'SCOLARITE '.$msg['username']; else echo 'ETUDIANT '.$msg['username']; ?></a></td>
                                            <td class="mailbox-subject"><b><?php  echo $msg['sujet']; ?></b> <?php  echo substr($msg['contenu'], 0,50)."..."; ?>
                                            </td>
                                            <td class="mailbox-attachment"></td>
                                            <td class="mailbox-date"><?php echo "envoyé le:   ".$msg['date']; ?></td>
                                        </tr>
                                        <?php endforeach; ?>



                                        <?php foreach ($mesMsgsDiff as $msg): ?>
                                        <tr>
                                            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                            <td class="mailbox-name"><a href="<?php  echo $this->Url->build('/profpermanents/lireMsgPer/readSD.'.$msg['id']); ?>"><?php  if(strcmp($msg['role'],'resposcolarite') == 0) echo 'SCOLARITE '.$msg['username']; else echo 'ETUDIANT '.$msg['username']; ?></a></td>
                                            <td class="mailbox-subject"><b><?php  echo $msg['sujet']; ?></b> <?php  echo substr($msg['contenu'], 0,50)."..."; ?>
                                            </td>
                                            <td class="mailbox-attachment"></td>
                                            <td class="mailbox-date"><?php echo "envoyé le:   ".$msg['date']; ?></td>
                                        </tr>
                                        <?php endforeach; ?>

                                        </tbody>
                                    </table>

                                    <!-- /.table -->
                                </div>
                                <!-- /.mail-box-messages -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer no-padding">
                                <div class="mailbox-controls">

                                </div>
                            </div>
                      <!--  </form>
                    </div>
                    <!-- /. box -->
                </div>

                <!-- /.col -->
            </div>
                <?php endif ?>
            <!-- /.row -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- Page Script -->
<script>
    $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
                //Uncheck all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {
                //Check all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }
            $(this).data("clicks", !clicks);
        });

        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function (e) {
            e.preventDefault();
            //detect type
            var $this = $(this).find("a > i");
            var glyph = $this.hasClass("glyphicon");
            var fa = $this.hasClass("fa");

            //Switch states
            if (glyph) {
                $this.toggleClass("glyphicon-star");
                $this.toggleClass("glyphicon-star-empty");
            }

            if (fa) {
                $this.toggleClass("fa-star");
                $this.toggleClass("fa-star-o");
            }
        });
    });
</script>
<!-- AdminLTE for demo purposes -->
<script src="/webroot/js/demo.js"></script>

<?php
$this->Html->css('AdminLTE./plugins/fullcalendar/fullcalendar.min', ['block' => 'css']);
$this->Html->css('AdminLTE./plugins/fullcalendar/fullcalendar.print', ['block' => 'css', 'media' => 'print']);
$this->Html->css('AdminLTE./plugins/iCheck/flat/blue', ['block' => 'css']);

$this->Html->script([
'AdminLTE./plugins/iCheck/icheck.min',
],
['block' => 'script']);
?>

<?php $this->start('scriptBotton'); ?>
<script>
    $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
                //Uncheck all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {
                //Check all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }
            $(this).data("clicks", !clicks);
        });

        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function (e) {
            e.preventDefault();
            //detect type
            var $this = $(this).find("a > i");
            var glyph = $this.hasClass("glyphicon");
            var fa = $this.hasClass("fa");

            //Switch states
            if (glyph) {
                $this.toggleClass("glyphicon-star");
                $this.toggleClass("glyphicon-star-empty");
            }

            if (fa) {
                $this.toggleClass("fa-star");
                $this.toggleClass("fa-star-o");
            }
        });
    });
</script>
<?php $this->end(); ?>
</body>
</html>
