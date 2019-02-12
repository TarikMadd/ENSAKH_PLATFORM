 <section class="content-header">
         
          <ol class="breadcrumb" style="margin-right: 20px;margin-top: -18px; font-size: 15px;">
          
            <li><i class="fa fa-fw fa-sitemap"></i><?php echo "Classes"?></li>
            <li><a href="../aitsaidAfficherClasse" style="color: #337ab7;"><i class="fa fa-fw fa-book"></i><?php echo "Modules"?></a></li>
            <li><?php echo $element['0']['n']." ".$element['0']['f']?></li>
            <li class="breadcrumb-item active"><?php echo $element['0']['m']?></li>
            
          </ol>
        </section>
        <section class="content">
<div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
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
                        <i><?php echo $_SESSION['prof'];?></i>
                        </td>
                           
                      </tr>
                         <tr>
                             <tr>
                        <td><strong>CM:</strong></td>
                        <td><i><?php echo $element['0']['CM']." heures"?></i></td>
                      </tr>
                        <tr>
                        <td><strong>TD:</strong></td>
                        <td><i><?php echo $element['0']['TD']." heures"?></i></td>
                      </tr>
                      <tr>
                        <td><strong>TP:</strong></td>
                        <td><i><?php echo $element['0']['TP']." heures"?></i></td>
                      </tr>
                        <td><strong>AP:</strong></td>
                        <td>
                        <i><?php echo $element['0']['AP']." heures"?></i>
                        </td>
                           
                      </tr>
                      <tr>
                        <td><strong>Eval:</strong></td>
                        <td>
                        <i><?php echo $element['0']['Eval']." heures"?></i>
                        </td>
                           
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                
            
          </div>
        </div>
      </div>
</div>

        </section>
