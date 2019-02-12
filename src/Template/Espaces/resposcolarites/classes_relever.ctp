<?php 
// $this->requestAction(array('controller' => 'users', 'action' => 'get_category'));
// http://school.inilabs.net/v2.2/mark/index
//echo '<pre>';
//print_r($rows);
//echo '</pre>';
//die();
?>
<section class="content">
    <div class="row">
        <div class="col-md-6" style="width: 90% !important; margin-left: 5% !important;">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">selectionner une classe</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="generateTranscript" class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group" style=" width: 90%; margin-left: 5%; ">
                      <label>Classes</label>
                      <select name="class_id" class="form-control">
                          
                        <?php foreach ($clesses as $classe): ?>
                          <option value="<?php echo $classe['id']; ?>"><?php echo $classe['filiere']['libile'].' '.$classe['niveau']['libile']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    
                    <button type="submit" class="btn btn-info pull-right">Télécharger</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->
              
            </div>
    </div>
</section>
