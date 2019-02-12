
<footer>
    <div class="container">
        <div class="col-md-10 col-md-offset-1 text-center">

            <h6>Toutes le droits réservés: <b><font color="#084B8A">ENSA KHOURIBGA</b></h6>
        </div>
    </div>
</footer>

<div class="container">
    <div class="well well-sm">
        <h2><strong>résultats de recherche</strong></h2>
                        <button type="button" class="btn btn-warning"><a href="<?php echo $this->Url->build('/Profvacataires/listbook'); ?>"><font color="white" >revenir au menu principale </font></a></button>

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
                            <input class="btn btn-success" value="Détails" type="submit">
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

                                        <?php endforeach; ?>
</div>
</div>



