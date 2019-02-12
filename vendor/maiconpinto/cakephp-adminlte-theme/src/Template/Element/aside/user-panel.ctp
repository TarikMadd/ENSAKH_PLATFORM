<?php
$file = $theme['folder'] . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'aside' . DS . 'user-panel.ctp';
$session = $this->request->session();
if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<div class="user-panel">
    <div class="pull-left image">
        <?php echo $this->Html->image($session->read('img_user'), array('class' => 'img-circle', 'alt' => 'User Image')); ?>
    </div>
    <div class="pull-left info">
        <p><?= h($session->read('nom_user')) ?></p>
        <small><?= h($session->read('role')) ?></small>
    </div>
</div>
<?php } ?>