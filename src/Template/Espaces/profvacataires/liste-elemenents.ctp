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
            
                <form method="POST" action="showClass">
                    <button style=" background-color: #fff; margin-bottom: 2px; " type="submit" class="btn btn-block btn-default">Liste Classes</button>
                </form>
                <form method="POST" action="showModel">
                        <button style=" background-color: #fff; margin-bottom: 15px; " type="submit" class="btn btn-block btn-default">Liste Modules</button>
                </form>
         
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" style="width: 90% !important; margin-left: 5% !important;">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">selectionner un element</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="showStudents" class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group" style=" width: 90%; margin-left: 5%; ">
                      <label>Elements</label>
                      <select name="element_id" class="form-control">
                        <?php foreach ($elements as $element): ?>
                          <option value="<?php echo $element['id']; ?>"><?php echo $element['libile']; ?></option>
                        <?php endforeach; ?>
                      </select>
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
