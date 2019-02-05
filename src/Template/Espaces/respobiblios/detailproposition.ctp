<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"
      xmlns="http://www.w3.org/1999/html">
<link rel="stylesheet" href="http://cdn.bootcss.com/animate.css/3.5.1/animate.min.css">
<h6><b><font color="#084B8A"></b></h6>

<div class="container">
    <div class="well well-sm">

        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
        <div class="container">
            <?php foreach ($detail as $detail): ?>

            <div class="row">
                <div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
                    <div class="well profile">
                        <div class="col-sm-12">
                            <div class="col-xs-12 col-sm-8">
                                <h2><font color="brown">Proposition N°<?php echo $detail['id'];  ?></font></h2>
                                <p><strong>DATE: </strong><?php echo $detail['date'] ?></p>
                                <p><strong>Utulisateur: </strong><?php echo $detail['nom'];echo $detail['prenom']; ?></p>
                                <p><strong>Role: </strong><?php echo $detail['role']; ?></p>
                                <p><strong>CNE/SOM: </strong><?php echo $detail['code'] ?></p>
                                <p><strong>Email: </strong><?php echo $detail['email'] ?></p>
                                <p><strong>Résumé : </strong> <?php echo $detail['resumer']; ?></p>
                                <p><strong>Ce portail est : </strong> <?php echo $detail['jugement']; ?></p>

                            </div>
                            <div class="col-xs-12 col-sm-4 text-center">
                                <figure>
                                    <figcaption class="ratings">
                                        <?php echo $this->Html->image('../../img/books/'.$detail['fichier'],['height' =>'200'],['width' =>'200'],['alt' =>'CakePHP']); ?>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                        <?php
                        if($detail['etat']=="valider/ignorer")
                        {?>
                        <div class="col-xs-12 divider text-center">
                            <div class="col-xs-12 col-sm-4 emphasis">
                                <form method="post"  name="reserver" action=" <?php echo $this->Url->build('/respobiblios/etatproposition2', true) ?>"">
                                <input type="hidden" name="id" value="<?php  echo $detail['id'];?>">
                                <input type="hidden" name="etat" value="validé">
                                <button class="btn btn-success btn-block"><span class="fa fa-plus-circle"></span> Valider</button>
                                </form>
                            </div>
                            <div class="col-xs-12 col-sm-4 emphasis">
                                <form method="post"  name="add" action=" <?php echo $this->Url->build('/respobiblios/etatproposition2', true) ?>"">
                                <input type="hidden" name="id" value="<?php  echo $detail['id'];?>">
                                <input type="hidden" name="etat" value="ignoré">
                                <button  name="add"  id="add" type="submit" class="btn btn-danger btn-block"><span class="fa fa-user"></span>Ignorer</button>
                                </form>

                                <?php }else
                                {
                                    if($detail['etat']=="validé")
                                    {?>
                                <div class="col-xs-12 col-sm-4 emphasis">
                                <button  class="btn btn-success btn-block"><span class="fa fa-user"></span>Validée</button>
                                   <?php  }else {?>
                                    <div class="col-xs-12 col-sm-4 emphasis">
                                    <button  class="btn btn-danger btn-block"><span class="fa fa-user"></span>Ignorée</button>
                                        <?php
                                    }
                                }?>
                                    </div>
                                    <?php endforeach; ?>
                            <div class="col-xs-12 col-sm-4 emphasis">
                                <div class="btn-group dropup btn-block">
                                    <button type="button" class="btn btn-primary"><span class="fa fa-gear"></span> Options </button>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu text-left" role="menu">
                                        <li><a href="<?php echo $this->Url->build('/respobiblios/listproposition', true) ?>"><span class="fa fa-th-list pull-right"></span> Liste des propositions  </a></li>
                                        <li><a href="<?php echo $this->Url->build('/respobiblios/home', true) ?>"><span class="fa fa-th-list pull-right"></span>menu principale </a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    </div>
