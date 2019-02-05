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
        <div class="col-md-6" style="width: 90% !important; margin-left: 5% !important; ">
            <form method="POST" action="showClass">
                <button style=" background-color: #fff; margin-bottom: 2px; margin-bottom: 10px;" type="submit" class="btn btn-block btn-default">Liste Classes</button>
            </form>
        </div>
    </div>
    <div class="row">
        <?php if(isset($message) != null && $message != null) :?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                                    <?php echo $message; ?>
                                </div>
                              <?php endif ?>
        <div class="col-md-6" style="width: 90% !important; margin-left: 5% !important;">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">selectionner un module</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="checkKey" class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group" style=" width: 90%; margin-left: 5%; ">
                      <label>Modules</label>
                      <select id="dropDownId" name="module_id"class="form-control">
                        <?php $id_drop = 0; $row_counter = 0; ?>
                        <?php foreach ($modules as $module): ?>
                          <option <?php if($id_drop == 0) echo 'selected'; $id_drop++; ?> value="<?php echo $module['id']; $row_counter++; ?>"><?php echo $module['libile']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                      <?php if($row_counter > 0): ?>
                      <button type="submit" name="action" value="modufier" class="btn btn-info pull-right">Modification</button>
                      <?php endif ?>
                  </div><!-- /.box-footer -->
                </form>
                <?php if($row_counter > 0): ?>
                <form method="POST" action="showElement" class="form-horizontal">
                    <input type="hidden" class="modulid" value="" name="module_id"/>
                    <button id="submet2" style="position: relative;margin-left: 5px;left: -115px;top: -43px;" type="submit" name="action" value="consulter" class="btn btn-info pull-right">Consultation</button>
                </form>
                <?php endif ?>
              </div><!-- /.box -->
              
            </div>
    </div>
</section>

