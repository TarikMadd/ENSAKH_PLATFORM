<section class="content">
    <div class="row">
        
        <div class="col-md-6" style="width: 90% !important; margin-left: 5% !important;">
            <form method="POST" action="showClass">
                <button style=" background-color: #fff; margin-bottom: 2px; " type="submit" class="btn btn-block btn-default">Liste Classes</button>
            </form>
            <form method="POST" action="showModel">
                <button style=" background-color: #fff; margin-bottom: 2px; " type="submit" class="btn btn-block btn-default">Liste Modules</button>
            </form>
            <form method="POST" action="addDemandeKey">
                <input id="key_type_container" name="key_type" type="hidden" />
                <input type="hidden" value="<?php echo $module_id; ?>" name="module_id" />
                <div class="btn-group" style="width : 100%;">
                      <button style=" background-color: #fff; margin-bottom: 15px;  width: 97%;" type="submit" class="btn btn-block btn-default">Demander un code</button>
            
                      <button type="button" style=" background-color: #fff;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu" style="top: 70%; left: 82.099%;">
                        <li><a id="key-normal" href="#">Normal</a></li>
                        <li class="divider"></li>
                        <li><a id="key-pv" href="#">PV</a></li>
                      </ul>
                    </div>
            </form>
            <?php if(isset($msg) && !empty($msg)): ?>
            <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Erreur!</h4>
                    <?php echo $msg; ?>
            </div>
            <?php endif ?>
            <?php if(isset($msgOk) && !empty($msgOk)): ?>
            <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="fa fa-location-arrow"></i> Merci!</h4>
                    <?php echo $msgOk; ?>
            </div>
            <?php endif ?>
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Valider votre operation</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="showElement" class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group" style=" width: 90%; margin-left: 5%; ">
                      <label>Entrer le code pour ajouter/modifier les note du modele :</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                        <input type="password" class="form-control" name="key" placeholder="password">
                      </div>
                      <input type="hidden" value="<?php echo $module_id; ?>" name="module_id" />
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    
                    <button type="submit" class="btn btn-info pull-right">Suivant</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->
              
            </div>
    </div>
</section>
