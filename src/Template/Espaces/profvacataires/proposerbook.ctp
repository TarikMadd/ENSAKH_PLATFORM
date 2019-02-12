<div class="container">
    <div class="well well-sm">
        <?php echo $this->Html->image('../../img/books/contact.jpg',['alt' =>'CakePHP']); ?>

        <form class="form-horizontal" method="post" action="<?php echo $this->Url->build('/Profvacataires/proposerbook', true) ?> " enctype="multipart/form-data">
            <?php foreach ($coord as $coord): ?>
                <fieldset>
                    <h2>Contactez nous pour améliorer votre bibliothèque </h2>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Nom</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="nom" value="<?php echo $coord['nom']; ?> "   required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Prenom</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"     name="prenom" value="<?php echo $coord['prenom']; ?>"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >CNE/SOM</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="cne" value="<?php echo $coord['somme']; ?>"   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"   name="email" value=" "  required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"  >votre Propostion * </label>
                        <div class="col-sm-3">
                            <textarea rows="4" cols="90" name="champ" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >charger un fichier </label>
                        <div class="col-sm-3">
                            <input type="file"  accept=".png, .jpg, .jpeg" name="fichier" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Ce portail est :</label>
                        <div class="col-sm-3">
                            <select name="choix" >
                                <option value="Bon">Bon</option>
                                <option value="Assez bien">Assez bien</option>
                                <option value="Mauvais">Mauvais</option>
                            </select>            </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <input type="submit"  value="Envoyer les données" class="btn btn-success">
                            <button type="button" class="btn btn-danger"><a href="<?php echo $this->Url->build('/Profvacataires/proposerbook'); ?>"><font color="white" >Reset</font></a></button>
                        </div>
                    </div>

                </fieldset>
            <?php endforeach; ?>
        </form>

        </div>
    </div>



































