 <section class="content-header">
         
          <ol class="breadcrumb" style="margin-right: 20px;margin-top: -18px; font-size: 15px;">
          
            <li><i class="fa fa-fw fa-sitemap"></i><?php echo "Classes"?></li>
            <li><a href="../aitsaidAfficherClasse" style="color: #337ab7;"><i class="fa fa-fw fa-book"></i><?php echo "Modules"?></a></li>
            <li><?php echo $element['0']['n']." ".$element['0']['f']?></li>
            <li class="breadcrumb-item active"><?php echo $element['0']['m']?></li>
            
          </ol>
        </section>
        <section class="content">
        <?php if($_SESSION['is'] == 'yes')
        { ?>
          <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i>L'action a été effectuée avec succès</h4>
                   
                  </div>
        <?php } ?>
<div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-primary">
            <div class="panel-heading">
            <div class="row">
             <h3 class="panel-title"><i class="fa fa-fw fa-chain"></i>EDITER</h3> 
            </div>
             
            </div>
            <div class="panel-body">
              <div class="row">
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><strong>Module:</strong></td>
                        <td><i><?php echo $element['0']['m']?></i></td>
                      </tr>
                      <tr>
                        <td><strong>Elèment de Module:</strong></td>
                        <td><i><?php echo $element['0']['e']?></i></td>
                      </tr>
                      <tr>
                        <td><strong>Semestre</strong></td>
                        <td><i><?php echo $element['0']['s']?></i></td>
                      </tr>
                   <tr>
                        <td><strong>Professeur en charge:</strong></td>
                        <td>
                        <div class="form-group">
                        <?php  echo $this->form->create();
                        ?>
                        <select name="profp"  class="form-control selectpicker" data-live-search="true">
                        <option value="0" selected="true" disabled="disabled">Professeur Permanent</option>
                        <?php 
                          foreach ($_SESSION['profp'] as $profp) 
                          {
                            echo '<option value='.$profp['id'].'>'.$profp['nom_prof'].' '.$profp['prenom_prof'].'</option>';
                          }
                          
                        ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <?php  echo $this->form->create();
                        ?>
                        <select name="profv"  class="form-control selectpicker" data-live-search="true">
                        <option value="0" selected="true" disabled="disabled">Professeur Vacataire</option>
                        <?php 
                          
                          foreach ($_SESSION['profvac'] as $profv) 
                          {
                            echo '<option value='.$profv['id'].'>'.$profv['nom_vacataire'].' '.$profv['prenom_vacataire'].'</option>';
                          }
                        ?>
                        </select>
                      </div>
                        </td>
                           
                      </tr>
                         
                    </tbody>
                  </table>
                </div>
                <button class="btn btn-block btn-primary" name="code"><i class="fa fa-fw fa-chain"></i>Affectation</button>
              </div>
            </div>
                
            <?php echo $this->form->end();
                      ?>
          </div>
        </div>
      </div>
</div>

        </section>
