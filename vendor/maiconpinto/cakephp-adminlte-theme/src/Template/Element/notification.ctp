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
        <li class="body">
            <!-- inner menu: contains the actual data -->
            <div class="slimScrollDiv" >
            <ul id="menuNotif" class="menu">
            
                    <?php foreach ($notif_afficher as $key => $value): ?>
                <li class="label-default" style="display: block;border: 3px solid white;"><!-- start message -->
                    <a class="label" href="<?= $this->Url->build(['action' => $value['lien']]) ?>">
                        <div class="pull-left">
                            <span class="<?= $value['style'] ?>"><?= h($value['titre']);?></span>
                        </div>
                        
                            <small class="label bg-maroon pull-right"><i class="fa fa-clock-o"></i><?= h($value['created']) ?></small>
                        <br/><br/> <small class="pull-right">Voir notification...</small>                  
                                         </a>
                            <p  style="text-align: center;"><?= h($value['principale']) ?> <br/>
                <small><?= h($value['commentaire']) ?></small></p>
                </li>
                <?php endforeach; ?>
                <!-- end message -->
            </ul>
            </div>
        </li>
        <li class="footer"><a href="#"></a></li>
    </ul>