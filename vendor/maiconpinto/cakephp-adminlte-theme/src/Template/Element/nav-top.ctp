<?php
$file = $theme['folder'] . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'nav-top.ctp';
$session = $this->request->session();
if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
    
} else {
?>

<?= $this->Html->script('notifications'); ?>
<div id="actualiserNotif" hidden="hidden"> <?= $this->Url->build(['action'=>'updateNotifications']); ?> </div>
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- Notifications: style can be found in dropdown.less-->
            <li id="notifMenu" class="dropdown messages-menu">
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown  user-menu">

                       <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                       <?php echo $this->Html->image($session->read('img_user'), array('class' => 'user-image', 'alt' => 'User Image')); ?>
                                   </a>
                                   <ul class="dropdown-menu">
                                       <!-- User image -->
                                       <li class="user-header">
                                           <?php echo $this->Html->image($session->read('role').'/'.md5(md5($session->read('user_id'))).'.png', array('class' => 'img-circle', 'alt' => 'User Image')); ?>

                                           <p>
                                               <?= h($session->read('nom_user')); ?>
                                               <small><?= $session->read('role') ?></small>
                                           </p>
                                       </li>
                                       <!-- Menu Body -->
                                       <li class="user-footer">
                                           <div class="row">
                                               <div class=" pull-left text-center">
                                                   <a href="<?= $this->Url->build(['action'=>'profil']) ?>" class="btn btn-default btn-flat">Profile</a>
                                               </div>
                                               <div class="pull-right  text-center">
                                                   <?php   // user is logged in, show logout..user menu etc
                                                         echo $this->Html->link('Deconnexion', array('controller' => 'users', 'action' => 'logout'),['class' => 'btn btn-default btn-flat']);
                                                   ?>
                                               </div>
                                           </div>
                                        </li>
                                        </ul>

            </li>
    </div>
</nav>
<?php } ?>

