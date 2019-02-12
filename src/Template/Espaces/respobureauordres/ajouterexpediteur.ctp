
     <?= $this->Form->create($expediteur, array('role' => 'form')) ?>
          <div class="box-body">


          <div class="box box-info">
            <div class="box-header with-border">
              <h1 class="box-title"> <b>Nouveau expéditeur</b></h1>
            </div>
            <br>
            <div class="box-body">
            <h4>Nom complet de l'expéditeur</h4>

              <div class="input-group">
               <div class="input-group-addon">
                    <i class="fa fa-fw fa-user"></i>
                  </div> 
                
                <input type="text" name="nomComplet_expediteur" class="form-control" placeholder="nom complet de l'expediteur">
              </div>
              <br>


            <h4>Adresse de l'expéditeur</h4>
            
              <div class="input-group">
               
                <div class="input-group-addon">
                    <i class="fa fa-fw fa-location-arrow"></i>
                  </div>
                
                <input type="text" name="adresse_expediteur" class="form-control" placeholder="adresse de l'expediteur">
              </div>
              <br>
              

              <h4>Email de l'expéditeur</h4>

              <div class="input-group">
                <span class="input-group-addon">@</span>
                <input type="email" name="email_expediteur" class="form-control" placeholder="Email">
              </div>
              <br>

             
              <h4>Ville de l'expéditeur</h4>

              <div class="input-group">
              <div class="input-group-addon">
                    <i class="fa fa-fw fa-plane"></i>
                  </div>
              
                <input type="text" name="ville_expediteur" class="form-control" placeholder="ville">
              </div>
              <br>

              <h4>Pays de l'expéditeur</h4>

              <div class="input-group">
              <div class="input-group-addon">
                    <i class="fa fa-fw fa-plane"></i>
                  </div>
              
                <input type="text" name="pays_expediteur" class="form-control" placeholder="pays">
              </div>
              <br>


               <div class="form-group">
                <h4>Téléphone expéditeur</h4>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" name="telephone_expediteur" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->    
          </div>
         
          
<div class="box-footer">
            <?= $this->Form->button(__('Enregistrer')) ?>

          </div>
      
      
          
          </div>       
    

        <!-- /.box-body -->
        
      </div>

           <!-- /.box-body -->
       