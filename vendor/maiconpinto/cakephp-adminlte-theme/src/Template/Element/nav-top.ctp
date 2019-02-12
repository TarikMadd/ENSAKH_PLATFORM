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
            <li class="dropdown user user-menu">

                    <?php   // user is logged in, show logout..user menu etc
                    echo $this->Html->link('Deconnexion', array('controller' => 'users', 'action' => 'logout'),['class' => 'btn btn-danger btn-flat']);
                    ?>


            </li>
        </ul>
    </div>
</nav>
<?php } ?>

