<section class="content">
<?php if($_SESSION['auto'] == 'yes')
{ ?>
	<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i>Succes</h4>
                    Votre demande a été transmise au responsable personnel !
                  </div>
<?php }
else if($_SESSION['auto']=='no')
{?>
<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    Vous avez dépassé la limite des demandes d'abscences autorisée!
                  </div>
<?php }
?>
	<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Quick Example</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               <?php
                echo $this->form->create();
          		?>
                  <div class="box-body">
                  	<div class="form-group">
                  	<label>Durée d'absences:</label>
                  	<select name="duree_ab" class="form-control" >

                  		<option selected="selected" disabled="disabled">Choisir</option>
                  		<option value="0.5">1/2 jour</option>
                  		<option value="1">1 jour</option>
                  		<option value="1.5">3/2 jours</option>
                  		<option value="2">2 jours</option>
                  		<option value="2.5">5/2 jours</option>
                  		<option value="3">3 jours</option>
                  		<option value="3.5">7/2 jours</option>
                  		<option value="4">4 jours</option>
                  	</select>
                  		
                  	</div>
                    
                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                    <label>Date masks:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control" placeholder="aaaa-mm-jj" name="date">
                    </div><!-- /.input group -->
                  </div>
                    </div>
                    <div class="col-md-6">
                    	<div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>Time picker:</label>

                      <div class="input-group">
                      <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                        <input type="text" class="form-control timepicker" placeholder="hh:mm" name="time">
                        
                      </div><!-- /.input group -->
                    </div><!-- /.form group -->
                  </div>
                    </div>
                    	

                  
                    </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Cause:</label>
                      <input type="text" class="form-control" placeholder="Cause d'absence" name="cause">
                    </div>
                   
                    
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                  </div>
                <?php
              echo $this->form->end();
            ?>
              </div>
</section>