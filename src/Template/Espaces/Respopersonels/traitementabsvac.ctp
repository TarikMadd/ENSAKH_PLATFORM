<div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
        <?php if($_SESSION['refus'] == 'yes')
        { ?>
          <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>  <i class="icon fa fa-check"></i>Refus</h4>
                    Votre demande a été refusée !
                  </div>
        <?php }
        ?>
     <div class="panel panel-primary">
            <div class="panel-heading">
            <div class="row">
             <h3 class="panel-title"><i class="fa fa-fw fa-info-circle"></i>INFORMATION</h3> 
            </div>
             
            </div>
            <div class="panel-body">
              <div class="row">
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><strong>NOM & PRENOM :</strong></td>
                        <td><i><?php echo $_SESSION['demandes'][0]['nom_vacataire']." ".$_SESSION['demandes'][0]['prenom_vacataire']?></i></td>
                      </tr>
                      <tr>
                        <td><strong>GRADE :</strong></td>
                        <td><i><?php echo $_SESSION['demandes'][0]['sous_grade']?></i></td>
                      </tr>
                   <tr>
                        <td><strong>Durée d'Absence :</strong></td>
                        <td>
                        <i><?php echo $_SESSION['demandes'][0]['duree_ab']."jour(s)"?></i>
                        </td>
                           
                      </tr>
                         <tr>
                             <tr>
                        <td><strong>A partir de la date :</strong></td>
                        <td><i><?php echo $_SESSION['demandes'][0]['date_ab']?></i></td>
                      </tr>
                        <tr>
                        <td><strong>OU A l'heure :</strong></td>
                        <td><i><?php if($_SESSION['demandes'][0]['time_ab']=='00:00:00') echo '-'; else echo $_SESSION['demandes'][0]['time_ab']; ?></i></td>
                      </tr>
                      <tr>
                        <td><strong>Cause :</strong></td>
                        <td><i><?php if(empty($_SESSION['demandes'][0]['cause']))
                        {
                          echo "Non justifié";
                        }
                        else
                        {
                          echo $_SESSION['demandes'][0]['cause'];
                        }?></i></td>
                      </tr>
                        <td><strong>Nombre d'absences demandé avant: </strong></td>
                        <td>
                        <i><?php echo $_SESSION['nbr_abs'].' jours';?></i>
                        </td>
                           
                      </tr>
                    </tbody>
                  </table>
                   <?php
                echo $this->form->create();
          ?>
                  <div class="pull-right" >
             <a href="#"><button class="btn btn-block btn-danger" name="refuser"><i class="fa fa-fw fa-remove"></i>Refuser</button></a>
                
              </div>
                  <div class="pull-right" style="margin-right: 10px;">
             
            <a href="imprimer"><button class="btn btn-block btn-success" name="valider"><i class="fa fa-fw fa-check"></i>Valider</button></a>
                
              </div>
              
              
              <?php
              echo $this->form->end();
            ?>

                </div>
              </div>

            </div>
                
            
          </div>
          <?php 
          if($_SESSION['print']=='yes')
          { ?>
              <div class="alert alert-dismissable" style="background-color: rgb(252,198,124);">
                    <div class="pull-right col-md-4">
             
            <a href="../imprimerabsvac"><button class="btn btn-block" name="valider" style="background-color: #efefef; color: black;"><i class="fa fa-fw fa-print"></i>Imprimer</button></a>
                
              </div>
                    <h4><i class="icon fa fa-info"></i>Veuillez imprimer la demande:</h4>

                  </div>
          <?php }
          ?>
        </div>
      </div>
</div>
