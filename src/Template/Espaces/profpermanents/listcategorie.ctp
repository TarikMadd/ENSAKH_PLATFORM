
    <button class="btn btn-primary btn-lg btn-block "><h1>MATHEMATIQUE<h1></button>


    <div id="products" class="row list-group  col-xs-12"><br>
            <?php foreach ($books1 as $book): ?>
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
                                                       <form method="post" action=" <?php echo $this->Url->build('/Profpermanents/detailbook', true) ?>"">
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

    <button class="btn btn-primary btn-lg btn-block "><h1>PHYSIQUE<h1></button>


    <div id="products" class="row list-group  col-xs-12"><br>
            <?php foreach ($books2 as $book): ?>
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
                                                       <form method="post" action=" <?php echo $this->Url->build('/Profpermanents/detailbook', true) ?>"">
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
    <button class="btn btn-primary btn-lg btn-block "><h1>INFORMATIQUE<h1></button>


    <div id="products" class="row list-group  col-xs-12"><br>
            <?php foreach ($books3 as $book): ?>
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
                                                       <form method="post" action=" <?php echo $this->Url->build('/Profpermanents/detailbook', true) ?>"">
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

    <button class="btn btn-primary btn-lg btn-block "><h1>ECONOMIE DE L'ENTREPRISE<h1></button>


    <div id="products" class="row list-group  col-xs-12"><br>
            <?php foreach ($books4 as $book): ?>
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
                                                       <form method="post" action=" <?php echo $this->Url->build('/Profpermanents/detailbook', true) ?>"">
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
    <button class="btn btn-primary btn-lg btn-block "><h1>CHIMIE <h1></button>


    <div id="products" class="row list-group  col-xs-12"><br>
            <?php foreach ($books5 as $book): ?>
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
                                                        <form method="post" action=" <?php echo $this->Url->build('/Profpermanents/detailbook', true) ?>"">
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
    <button class="btn btn-primary btn-lg btn-block "><h1>LANGUES ET COMMUNICATION</h1></button>

    <div id="products" class="row list-group  col-xs-12"><br>
            <?php foreach ($books6 as $book): ?>
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
                                                      <form method="post" action=" <?php echo $this->Url->build('/Profpermanents/detailbook', true) ?>"">
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
