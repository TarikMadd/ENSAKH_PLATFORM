<?php 
        $session = $this->request->session();
        $notif_afficher = $session->read('notifications');
        $nombre = count($notif_afficher);
?>
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bullhorn"></i>
        <span id="nombreNotif" 
        <?php if($nombre>0): ?>
            class="label label-danger"><?= h($nombre) ?>
        <?php endif; ?>
        </span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">Vous avez <?= h($nombre) ?> nouvelle(s) notification(s)</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul id="menuNotif" class="menu">
            
                    <?php foreach ($notif_afficher as $key => $value): ?>
                <li><!-- start message -->
                    <a class="label label-default" href="<?= $this->Url->build(['action' => $value['lien'] , $value['id']]) ?>">
                        <div class="pull-left">
                            <span class="<?= $value['style'] ?>"><?= h($value['principale']);?></span>
                        </div>
                        <h4><br/><br/>
                            <?= h($value['titre']) ?>
                            <small class="label bg-maroon"><i class="fa fa-clock-o"></i><?= h($value['date']) ?>
</small>
                        </h4>
                        <p><?= h($value['commentaire']) ?></p>
                    </a>
                </li>
                <?php endforeach; ?>
                <!-- end message -->
            </ul>
        </li>
        <li class="footer"><a href="#"></a></li>
    </ul>