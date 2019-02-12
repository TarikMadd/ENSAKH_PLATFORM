<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo isset($theme['title']) ? $theme['title'] : 'AdminLTE 2 | Log in'; ?></title>
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
  <!-- iCheck -->
  <?php echo $this->Html->css('AdminLTE./plugins/iCheck/square/blue'); ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo $this->Url->build(array('controller' => 'pages', 'action' => 'display', 'home')); ?>"><?php echo $theme['logo']['large'] ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="box-header" style="background: #000; height: 75px">
    <center><br><p class="box-title" style="color: #fff; font-size: 23px">SIGN IN</p></center>
  </div>
  <div class="login-box-body">
    <!--<p class="login-box-msg"><?php echo __('Sign in to start your session') ?></p>-->
    <div>
    </div>
    <p> <?php echo $this->Flash->render(); ?> </p>
    <p> <?php echo $this->Flash->render('auth'); ?> </p>

<?php echo $this->fetch('content'); ?>

  </div>
</div>
<div>
<center>
  <ul style="list-style: none;">
    <li style="display: inline;"><button class="btn btn-sm btn-primary">Admin</button></li>
    <li style="display: inline;"><button class="btn btn-sm btn-info">scolarité</button></li>
    <li style="display: inline;"><button class="btn btn-sm btn-warning">Stock</button></li>
    <li style="display: inline;"><button class="btn btn-sm btn-success">Etudiant</button></li>
    <li style="display: inline;"><button class="btn btn-sm btn-danger">Professeurs</button></li>
    <li style="display: inline;"><button class="btn bg-maroon btn-sm btn-default" >Bibliothèque</button></li>
    <li style="display: inline;"><button class="btn bg-purple btn-sm btn-default" >Economique</button></li>
    <li style="display: inline;"><button class="btn btn-sm btn-default" >Personnel</button></li>
    <li style="display: inline;"><button class="btn btn-sm btn-primary">Bureau d'ordre</button></li>
  </ul>
</center>
</div>
<!-- jQuery 2.1.4 -->
<?php echo $this->Html->script('/plugins/jQuery/jQuery-2.1.4.min'); ?>
<!-- Bootstrap 3.3.5 -->
<?php echo $this->Html->script('/bootstrap/js/bootstrap'); ?>
<!-- iCheck -->
<?php echo $this->Html->script('/plugins/iCheck/icheck.min'); ?>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>

