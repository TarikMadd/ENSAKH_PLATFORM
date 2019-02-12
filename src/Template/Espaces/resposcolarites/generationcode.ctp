<section class="content">
<?php
  if($_SESSION['is']=='yes')
  { ?>
  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i>L'action a été effectuée avec succès</h4>
                   
                  </div>
 <?php }
?>
  <div class="box box-primary">
      <div class="box-header with-border center-block">
        <i class="fa fa-fw fa-key"></i>
          <h3 class="box-title">Generation de code</h3>
      </div>  
      <div class="box-body center-block">
        <div class="col-md-4">
          <?php
                echo $this->form->create();
          ?>
            <div class="form-group center-block">
              <label>Choisir semestre:</label>
              <?php $sessions = ['1'=>'Normale','2'=>'Rattrapage','3'=>'PV'];
              echo $this->Form->select('session', $sessions, ['empty' => 'Session']); ?>
            </div>
            <div class="form-group center-block">
              <label>Choisir semestre:</label>
              <?php $semestres = ['1'=>'Semestre 1','2'=>'Semestre 2'];
              echo $this->Form->select('semestre', $semestres, ['empty' => 'Semestre','onchange' =>"this.form.submit();"]); ?>
            </div>
            <?php
              echo $this->form->end();
                      echo $this->form->create();

              if($_SESSION['prof']=='yes')
              { ?>
                    <div class="form-group">
                        <label>Choisir un professeur:</label>
                        <select name="prof"  class="form-control selectpicker" data-live-search="true">
                        <option value="0" selected="true">Tous les professeurs</option>
                        <?php 
                          foreach ($_SESSION['prop'] as $profp) 
                          {
                            echo '<option value='.$profp['id'].'>'.$profp['nom_prof'].' '.$profp['prenom_prof'].'</option>';
                          }
                          foreach ($_SESSION['prov'] as $profv) 
                          {
                            echo '<option value='.$profv['id'].'>'.$profv['nom_vacataire'].' '.$profv['prenom_vacataire'].'</option>';
                          }
                        ?>
                        </select>
                      </div>
                       
                      
                     
                      <div class="row">
                          <div class="col-md-12">
                      <div class="form-group">
                      <label>Code valable jusqu'au:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" placeholder="aaaa-mm-jj" name="date">
                      </div><!-- /.input group -->
                    </div>
                      </div>
                       </div>
                      <button class="btn btn-block btn-primary" name="code"><i class="fa fa-fw fa-key"></i>Génération de code</button>
                     <?php echo $this->form->end();
                      ?>
                
              
             <?php }
            ?>

                        
        </div>
      </div>
    </div>
</section>

