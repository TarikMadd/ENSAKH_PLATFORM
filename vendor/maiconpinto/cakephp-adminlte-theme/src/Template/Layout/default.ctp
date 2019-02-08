<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo isset($theme['title']) ? $theme['title'] : 'AdminLTE 2'; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <?php echo $this->Html->css('AdminLTE./bootstrap/css/bootstrap'); ?>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <?php echo $this->Html->css('AdminLTE.AdminLTE.min'); ?>
<!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <?php echo $this->Html->css('AdminLTE.skins/skin-blue'); ?>
    <?php echo $this->Html->css('jquery-ui') ?>

    <?php echo $this->Html->css('style') ?>

    <?php echo $this->fetch('css'); ?>

    <?php echo $this->Html->css('AdminLTE.dataTables.bootstrap'); ?>

    <?php echo $this->Html->script('AdminLTE./plugins/jQuery/jQuery-2.1.4.min'); ?>
    <?php echo $this->Html->script('jquery-ui'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo $this->Url->build('/'); ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><?php echo $theme['logo']['mini'] ?></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><?php echo $theme['logo']['large'] ?></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <?php echo $this->element('nav-top') ?>
        </header>

        <!-- Left side column. contains the sidebar -->
        <?php echo $this->element('aside-main-sidebar'); ?>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <?php echo $this->Flash->render(); ?>
            <?php echo $this->Flash->render('auth'); ?>
            <?php echo $this->fetch('content'); ?>

        </div>
        <!-- /.content-wrapper -->

        <?php echo $this->element('footer'); ?>

        <!-- Control Sidebar -->
        <?php echo $this->element('aside-control-sidebar'); ?>

        <!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- Bootstrap 3.3.5 -->
<?php echo $this->Html->script('AdminLTE./bootstrap/js/bootstrap'); ?>
<!-- SlimScroll -->
<?php echo $this->Html->script('AdminLTE./plugins/slimScroll/jquery.slimscroll.min'); ?>
<!-- FastClick -->
<?php echo $this->Html->script('AdminLTE./plugins/fastclick/fastclick'); ?>
<!-- AdminLTE App -->
<?php echo $this->Html->script('AdminLTE.AdminLTE.min'); ?>

<?php echo $this->Html->script('jquery.canvasjs.min'); ?>

<?php echo $this->Html->script('jsFile'); ?>

<?php echo $this->Html->script('style'); ?>

<?php echo $this->Html->script('jquery.highchartTable'); ?>
<!-- AdminLTE for demo purposes -->
<?php echo $this->fetch('script'); ?>
<?php echo $this->fetch('scriptBotton'); ?>

    <!-- DataTables -->
    <?php echo $this->Html->script('AdminLTE./plugins/datatables/jquery.dataTables.min'); ?>
    <?php echo $this->Html->script('AdminLTE./plugins/datatables/dataTables.bootstrap.min'); ?>
    <!-- page script -->
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
<script type="text/javascript">
    $(document).ready(function(){
        $(".navbar .menu").slimscroll({
            height: "200px",
            alwaysVisible: false,
            size: "3px"
        }).css("width", "100%");

        var a = $('a[href="<?php echo $this->request->webroot . $this->request->url ?>"]');
        if (!a.parent().hasClass('treeview')) {
            a.parent().addClass('active').parents('.treeview').addClass('active');
        }
    });
</script>
    <script type="text/javascript">

        $(document).ready(function(){
            $('#submet2').click(function(){
                //alert($('#dropDownId :selected').val());
                $('.modulid').val($('#dropDownId :selected').val());
            });
        });
    </script>S
    <script type="text/javascript">
        $(document).ready(function(){
            $('#impression').click(function(){
                $('#header_botton').hide();
                $('#confirmer').hide();
                $('#save').hide();
                $('#impression').hide();
                $('.main-footer').hide();
                $('#exporter').hide();
                $("#ensa_img").show();
                $("#search_box").hide();
                $("#exporter_html").hide();
                window.print();
                $("#exporter_html").show();
                $('#header_botton').show();
                $("#search_box").show();
                $('#confirmer').show();
                $('#save').show();
                $('#impression').show();
                $('.main-footer').show();
                $('#exporter').show();
                $("#ensa_img").hide();
            });
        });


</script>
    <script type="text/javascript" >
        $(document).ready(function(){
            $("#note_input").focusout(function() {
                var note = $(this).val();
                if (note > 20) {
                    $(this).css('border','2px solid red');
                }
                else{
                    $(this).css('border','1px solid #ccc');
                }
            });
        });

    </script>

    <script type="text/javascript" >
        $(document).ready(function(){
            $("#ensa_img").hide();
            var doc  = "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><style>";
            doc += ".txt-annee{margin-top: -130px;float: right;} .box-info{width: 100%; margin-left: 0;}";
            doc += "body{font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-weight: 400; overflow-x: hidden; overflow-y: auto;font-size: 14px; line-height: 1.42857143; color: #333; background-color: #fff;}";
            doc += "table { border-spacing: 0; border-collapse: collapse; width: 100%;}";
            doc += "td{padding-right:15px}";
            doc += "th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }";
            doc += "tr:nth-child(even) { background-color: #eee; }";
            doc += "tr:nth-child(odd) { background-color: #fff; }";
            doc += "</style></head><body>";
            doc += "<div style='WIDTH: 100%;margin-top: 50px;margin-left: 0;'>";
            doc += $("#main_table").html();
            doc += $("#table_content").html();
            doc += "</div></body></html>";
            $("#html_content_input").val(doc);

        });

    </script>

    <script type="text/javascript" >
        $(document).ready(function(){
            $('#key-normal').click(function(){
                $('#key_type_container').val("NORMAL");
            });
            $('#key-pv').click(function(){
                $('#key_type_container').val("PV");
            });
        });
    </script>


</body>
</html>
