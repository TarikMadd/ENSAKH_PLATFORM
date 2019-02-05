
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://cdn.bootcss.com/animate.css/3.5.1/animate.min.css">

<div id="first-slider">
    <div id="carousel-example-generic" class="carousel slide carousel-fade">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <!-- Item 1 -->
            <div class="item active slide1">
                <div class="row"><div class="container">

                    <div class="col-md-9 text-left">
                        <h3 data-animation="animated bounceInDown">Bienvenue dans votre bibilothèque!</h3>
                        <h4 data-animation="animated bounceInUp">Un portail de la pensée pure</h4>
                     </div>
                </div></div>
             </div>
            <!-- Item 2 -->
            <div class="item slide2">
                <div class="row"><div class="container">
                    <div class="col-md-9 text-left"">
                        <h3 data-animation="animated bounceInDown">Réserver ,Chercher ,Voter pour vos ouvrages</h3>
                            <h4 data-animation="animated bounceInUp">autant d'ouvrages que vous cherchez  </h4>
                     </div>

                </div></div>
            </div>
            <!-- Item 3 -->
            <div class="item slide3">
                <div class="row"><div class="container">
                    <div class="col-md-9 text-left">
                        <h3 data-animation="animated bounceInDown">   on attend Votre demande de réservation </h3>
                        <h4 data-animation="animated bounceInUp">Nos reponsables seront ravi de vous emprunter les ouvrages </h4>
                     </div>
                </div></div>
            </div>
            <!-- Item 4 -->
            <div class="item slide4">
                <div class="row"><div class="container">
                    <div class="col-md-9 text-left">
                        <h3 data-animation="animated bounceInDown">      </h3>
                        <h4 data-animation="animated bounceInUp">Success doesn't come with chance</h4>
                     </div>

                </div></div>
            </div>
            <!-- End Item 4 -->

        </div>
        <!-- End Wrapper for slides-->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <i class="fa fa-angle-left"></i><span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <i class="fa fa-angle-right"></i><span class="sr-only">Next</span>
        </a>
    </div>
</div>


<footer>
    <div class="container">
        <div class="col-md-10 col-md-offset-1 text-center">

            <h6>Toutes le droits réservés: <b><font color="#084B8A">ENSA KHOURIBGA</b></h6>
        </div>
    </div>
</footer>

<div class="container">
    <div class="well well-sm">
<?php echo $this->Form->create('Post',array('id' => 'textBox', 'type' => 'post','url' => array('controller' => 'Profvacataires', 'action' => 'recherchebook'))); ?>
                <?php echo $this->Form->input('search', array('label'=>"",'placeholder'=>'veuillez  taper un mot clé pour trouver votre ouvrage ','id'=>'search','required'=>'required')); ?>
                <?php  echo $this->Form->button(__(' cliquez ici pour chercher')) ;?>
                        <button type="button" class="btn btn-warning"><a href="<?php echo $this->Url->build('/Profvacataires/listcategorie'); ?>"><font color="white" >Lister les ouvrage par Catégorie</font></a></button>

         <?php echo $this->Form->end(); ?>
        <?php

        ?>
<div class="visits options">


<form   method="post" action=" <?php echo $this->Url->build('/Profvacataires/recherchecatbook', true) ?>">
    <select name="choix" >
        <?php foreach ($choix as $choix): ?>
        <option value="<?php echo $choix['nom']; ?>"><?php echo $choix['nom']; ?></option>
        <?php endforeach; ?>
</select>
    <button type="submit" >cliquez ici pour chercher </button>
</form>
</div>



        <div class="btn-group">
        </div>
    </div>

    <div id="products" class="row list-group  col-xs-12"><br>
                <?php foreach ($books as $book): ?>
            <tr>
            <div class="item  col-xs-3">
                <div class="thumbnail">
                    <td ><?php echo $this->Html->image('../../img/books/'.$book['image'],['alt' =>'CakePHP']); ?></td>
                    <div class="caption">
                        <h4 class="group inner list-group-item-heading">
                                         <font color="brown"><td><?php echo $book['titre']; ?></td></font>
                  </h4>
                        <p class="group inner list-group-item-text">
                           <td><?php echo $book['resumer']; ?></td><br>
                                       <b> <td><?php echo $book['auteur']; ?></td><br>
    </b></p>

                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <p class="lead">
                                   <td><?php echo $book['edition']; ?></td></p>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <form method="post" action=" <?php echo $this->Url->build('/Profvacataires/detailbook', true) ?>"">
                                <input  name="detail" type="hidden" value=" <?php echo $book['id']; ?>">
                                <input class="btn btn-primary" value="Détails" type="submit">
                                </form>
                            </div>


                        </div>
                    </div>

                </div>

            </div>

                                            <?php endforeach; ?>
    </div>
    </div>
