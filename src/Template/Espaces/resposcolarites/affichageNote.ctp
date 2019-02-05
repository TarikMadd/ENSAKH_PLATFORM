<section class="content">
  <div class="box box-primary">
      <div class="box-header with-border center-block">
        <i class="fa fa-fw fa-file-text"></i>
          <h3 class="box-title">Affichage des notes</h3>
      </div>  
      <div class="box-body center-block">
        <div class="col-md-4">
          <?php
                echo $this->form->create();
          ?>
            <div class="form-group center-block">
              <label>Choisir semestre:</label>
              <?php $semestres = ['1'=>'Semestre 1','2'=>'Semestre 2'];
              echo $this->Form->select('semestre', $semestres, ['empty' => 'Semestre']); ?>
            </div>
            <div class="form-group">
              <label>Choisir classe:</label><?php
              for($i=0;$i<12;$i++)
              {
                $classe[$i] = $classes[$i]['n']." ".$classes[$i]['f'];
              }
echo $this->Form->select('classe', $classe, ['empty' => 'Classe','onchange' =>"this.form.submit();"]);
?> 
              
            </div><?php
              echo $this->form->end();
            ?>
            <?php if (isset($class) && count($class)!=0 && isset($sem) && count($sem)!=0)
            { echo $this->form->create(null, [
    'url' => ['controller' => 'Resposcolarites', 'action' => 'listenote']]);?>
              <div class="form-group">
              <label>Choisir module:</label>
              <select name="module"  class="form-control">
              <option value="0" selected="true">Module</option>
              <?php 
                foreach ($modules as $module) 
                {
                  echo '<option value='.$module['id'].'>'.$module['libile'].'</option>';
                }
              ?>
              </select>
              </div>
              <div class="form-group center-block">
              <label>Choisir session:</label>
              <select name="session" class="form-control" onchange="this.form.submit();">
                <option value="0" selected="true" disabled="disabled">Session</option>
                <option value="1">Normale</option>
                <option value="2">Rattrapage</option>
              </select>
            </div>
            <?php 
            } 
            ?>
                        
        </div>
      </div>
    </div>
</section>
