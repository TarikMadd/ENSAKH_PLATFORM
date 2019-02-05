<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"
      xmlns="http://www.w3.org/1999/html">
<link rel="stylesheet" href="http://cdn.bootcss.com/animate.css/3.5.1/animate.min.css">
            <h6><b><font color="#084B8A"></b></h6>

<div class="container">
    <div class="well well-sm">

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
        <?php foreach ($books as $book): ?>

        <div class="row">
            <div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
                <div class="well profile">
                    <div class="col-sm-12">
                        <div class="col-xs-12 col-sm-8">
                            <h2><font color="brown"><?php echo $book['titre'];  ?></font></h2>
                            <p><strong>Auteur: </strong><?php echo $book['auteur']; ?></p>
                            <p><strong>Edition: </strong><?php echo $book['edition']; ?></p>
                            <p><strong>Rubrique: </strong><?php echo $book['nom'] ?></p>
                            <p><strong>Résumé : </strong> <?php echo $book['resumer']; ?></p>
                            <?php
                            $n=$book['nbExemplaire']-$nombrereserve1-$nombremprunte1;
                            if($n!=0) {?>
                            <p><strong> Etat: Disponible
                                    <?php   }else{ ?>

                            <p><strong> Etat: pas Disponible </strong>
                                    <?php }?>

                        </div>
                        <div class="col-xs-12 col-sm-4 text-center">
                            <figure>
                                <figcaption class="ratings">
                                    <?php echo $this->Html->image('../../img/books/'.$book['image'],['height' =>'100'],['width' =>'200'],['alt' =>'CakePHP']); ?>

                                    <p><?php


                                       $v=$nombrereserve1/10;
                                        if($v<5)
                                        {

                                        for($i=0;$i<=$v;$i++) {?>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <?php }
                                            for($i=$v+1;$i<5;$i++){
                                            ?>
                                        <span class="glyphicon glyphicon-star-empty"></span>

                                   <?php }}else{?>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                     <?php }?>
                                    </p>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <div class="col-xs-12 divider text-center">
                        <div class="col-xs-12 col-sm-4 emphasis">
                            <h2><strong><?php echo  $n; ?></strong></h2>
                            <p><small> Non Réservé</small></p>
                            <form method="post"  name="reserver" action=" <?php echo $this->Url->build('/profpermanents/reserverbook', true) ?>"">
                            <?php if($reserve[0]['sum']==0) { ?>
                            <button class="btn btn-success btn-block"><span class="fa fa-plus-circle"></span> Réserver</button>
                            <?php } else {?>
                            <button class="btn btn-success btn-block" disabled><span class="fa fa-plus-circle"></span> Réserver</button>
                            <?php }?>
                            </form>
                        </div>
                        <div class="col-xs-12 col-sm-4 emphasis">
                            <h2><strong><?php echo  ($v*20); ?>%</strong></h2>
                            <p><small>Recommander</small></p>
                            <form method="post"  name="add" action=" <?php echo $this->Url->build('/profpermanents/votebook', true) ?>"">
                            <input type="hidden" name="id_book" value="<?php echo $book['id'];  ?>">
                            <input type="hidden" name="vote" value="1">
                           <?php foreach ($vote as $vote):
                                if($vote['vote']==0){ ?>
                                <button  name="add"  id="add" type="submit" class="btn btn-info btn-block"><span class="fa fa-user"></span>Voter</button>
                                <?php }else{?>
                             <button  type="button"  class="btn btn-info btn-block"><span class="fa fa-user"></span> Déja Voté</button>
                       <?php }?>
                                 <?php ?>
                            <?php endforeach; ?>

                            </form>


                        </div>
                        <div class="col-xs-12 col-sm-4 emphasis">
                      <h2><strong><?php echo $book['nbExemplaire']; ?></strong></h2>
                            <p><small>ouvrages existants </small></p>
                            <div class="btn-group dropup btn-block">
                                <button type="button" class="btn btn-primary"><span class="fa fa-gear"></span> Options </button>
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu text-left" role="menu">
                                    <li><a href="<?php echo $this->Url->build('/profpermanents/listbook', true) ?>"><span class="fa fa-th-list pull-right"></span> Liste des ouvrages  </a></li>
                                    <li><a href="<?php echo $this->Url->build('/profpermanents/listcategorie', true) ?>"><span class="fa fa-windows pull-right"></span> Liste par catégories </a></li>
                                    <li><a href="<?php echo $this->Url->build('/profpermanents/proposerbook', true) ?>"><span class="fa fa-eyedropper pull-right"></span> Proposer des ouvrages</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    </div>    </div>
