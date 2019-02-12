<script language="JavaScript" src="https://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
<script language="JavaScript" src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script language="JavaScript" src="https://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css">
<body>

    <div class="container">

        <div class="well well-sm">
            <h2><strong>Liste des suggestions des utilisateurs</strong></h2>
</div>
    <div class="row">

        <div class="col-md-11">


            <table id="datatable" class="table table-striped" cellspacing="0" width="100%">
                <thead>


                <tr>
                    <th>N°</th>
                    <th>Nom </th>
                    <th>Prenom </th>
                    <th>CNE/SOM</th>
                    <th>Role</th>
                    <th>email</th>
                    <th>resumé</th>
                    <th>fichier</th>
                    <th>Date</th>
                    <th>jugement</th>
                    <th>état</th>

                </tr>
                </thead>

                <?php $i=1; foreach ($propositions as $propositions): ?>

                <tbody>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $propositions['prenom']; ?></td>
                    <td><?php echo $propositions['nom']; ?></td>
                    <td><?php echo $propositions['code']; ?></td>
                    <td><?php echo $propositions['role']; ?></td>
                    <td><?php echo $propositions['email']; ?></td>
                    <td><?php echo $propositions['resumer']; ?></td>
                    <div class="col-md-6 img-wrapper">
                    <td><?php echo $this->Html->image('../../img/books/'.$propositions['fichier'],['height' =>'100'],['width' =>'100'],['alt' =>'CakePHP']); ?></td>
                        </div>

                        <td><?php echo $propositions['date']; ?></td>
                    <td><?php echo $propositions['jugement']; ?></td>

                          <div class="col-sm-offset-3 col-sm-9">
                    <td>
                      <?php  if($propositions['etat']=="valider/ignorer"){?>
                          <form method="post"  name="add" action=" <?php echo $this->Url->build('/respobiblios/etatproposition', true) ?>"">
                          <input type="hidden" name="id" value="<?php  echo $propositions['id'];?>">
                          <input type="hidden" name="etat" value="validé">
                          <input  type="submit"  value="valider" class="btn btn-success">
                            </form>
                          <form method="post"  name="add" action=" <?php echo $this->Url->build('/respobiblios/etatproposition', true) ?>"">
                          <input type="hidden" name="id" value="<?php echo $propositions['id'];?>">
                          <input type="hidden" name="etat" value="ignoré">
                          <input   type="submit"  value="ignorer" class="btn btn-danger">
                          </form>
                        <?php   }else {  if($propositions['etat']=="validé") { ?>
                        <input type="button"  value="validé" class="btn btn-info">
                        <?php } else { ?>

                            <input type="button"  value="ignoré" class="btn btn-warning">

                        <?php  }}?>
                        <form method="post"  name="add" action=" <?php echo $this->Url->build('/respobiblios/detailproposition', true) ?>"">
                        <input type="hidden" name="id" value="<?php echo $propositions['id'];?>">
                        <input   type="submit"  value="détail" class="btn btn-default">
                        </form>
                    </td>

                          </div>

                </tr>
                </tbody>
                <?php $i++; endforeach; ?>

            </table>
        </div>
    </div>
</div>


    <!-- /.modal-dialog -->
</div>
</body>