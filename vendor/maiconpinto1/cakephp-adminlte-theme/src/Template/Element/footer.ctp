<?php
$file = $theme['folder'] . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'footer.ctp';

if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Site Administratif d'ENSA Khouribga</b>
    </div>
    <strong>Copyright &copy; 2017 <em>Promo GI 4 eme annee 2016-2017</em>.</strong> All rights
    reserved.
</footer>
<?php } ?>
