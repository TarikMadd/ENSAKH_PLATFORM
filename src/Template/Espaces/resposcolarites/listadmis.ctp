<section class="content">
 <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">LISTE DES ADMIS</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th style="text-align: center;">Cycle</th>
                      <th style="text-align: center;">Niveau</th>
                      <th style="text-align: center;">Filière</th>
                      <th style="text-align: center;">Liste das admis</th>
                    </tr>
                    <tr style="text-align: center;">
                      <td>1</td>
                      <td rowspan="2" style="vertical-align: middle;">Cycle Préparatoire</td>
                      <td style="text-align: center;">Première année</td>
                      <td rowspan="2" style="vertical-align: middle;"><span class="badge bg-grey">API</span></td>
                      <td style="text-align: center;">
                        <?php 
                      if($_SESSION['admis'][0]['access']==0)
                      {
                        echo "<span class=\"label label-danger\">Non Disponible</span>";
                      }
                      else
                      {
                        echo "<a href=\"listAdmis/1\"><span class=\"label label-success\">Disponible</span></a>";
                      }
                      ?>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td style="text-align: center;">Deuxième année</td>
                      <td style="text-align: center;">
                        <?php 
                      if($_SESSION['admis'][1]['access']==0)
                      {
                        echo "<span class=\"label label-danger\">Non Disponible</span>";
                      }
                      else
                      {
                        echo "<a href=\"listAdmis/2\"><span class=\"label label-success\">Disponible</span></a>";
                      }
                      ?>
                      </td>
                      
                    </tr>
                    <tr style="text-align: center;">
                      <td>3</td>
                      <td rowspan="10" style="vertical-align: middle;">Cycle Ingénieur</td>
                      <td rowspan="2" style="vertical-align: middle;">Troisième année</td>
                      <td style="text-align: center;"><span class="badge bg-black">TC</span></td>
                      <td style="text-align: center;">
                        <?php 
                      if($_SESSION['admis'][2]['access']==0)
                      {
                        echo "<span class=\"label label-danger\">Non Disponible</span>";
                      }
                      else
                      {
                        echo "<a href=\"listAdmis/3\"><span class=\"label label-success\">Disponible</span></a>";
                      }
                      ?>
                      </td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td style="text-align: center;"><span class="badge bg-green">GPEE</span></td>
                      <td style="text-align: center;">
                        <?php 
                      if($_SESSION['admis'][3]['access']==0)
                      {
                        echo "<span class=\"label label-danger\">Non Disponible</span>";
                      }
                      else
                      {
                        echo "<a href=\"listAdmis/4\"><span class=\"label label-success\">Disponible</span></a>";
                      }
                      ?>
                      </td>
                    </tr>
                    <tr style="text-align: center;">
                      <td>5</td>
                      <td rowspan="4" style="vertical-align: middle;">Quatrième année</td>
                      <td style="text-align: center;"><span class="badge bg-blue">GRT</span></td>
                      <td style="text-align: center;">
                        <?php 
                      if($_SESSION['admis'][4]['access']==0)
                      {
                        echo "<span class=\"label label-danger\">Non Disponible</span>";
                      }
                      else
                      {
                        echo "<a href=\"listAdmis/5\"><span class=\"label label-success\">Disponible</span></a>";
                      }
                      ?>
                      </td>
                    </tr>
                    <tr>
                      <td>6</td>
                      
                      <td style="text-align: center;"><span class="badge bg-yellow">GI</span></td>
                      <td style="text-align: center;">
                        <?php 
                      if($_SESSION['admis'][5]['access']==0)
                      {
                        echo "<span class=\"label label-danger\">Non Disponible</span>";
                      }
                      else
                      {
                        echo "<a href=\"listAdmis/6\"><span class=\"label label-success\">Disponible</span></a>";
                      }
                      ?>
                      </td>
                    </tr>
                    <tr>
                      <td>7</td>
                      
                      <td style="text-align: center;"><span class="badge bg-red">GE</span></td>
                      <td style="text-align: center;">
                        <?php 
                      if($_SESSION['admis'][6]['access']==0)
                      {
                        echo "<span class=\"label label-danger\">Non Disponible</span>";
                      }
                      else
                      {
                        echo "<a href=\"listAdmis/7\"><span class=\"label label-success\">Disponible</span></a>";
                      }
                      ?>
                      </td>
                    </tr>
                    <tr>
                      <td>8</td>
                      
                      <td style="text-align: center;"><span class="badge bg-green">GPEE</span></td>
                      <td style="text-align: center;">
                        <?php 
                      if($_SESSION['admis'][7]['access']==0)
                      {
                        echo "<span class=\"label label-danger\">Non Disponible</span>";
                      }
                      else
                      {
                        echo "<a href=\"listAdmis/8\"><span class=\"label label-success\">Disponible</span></a>";
                      }
                      ?>
                      </td>
                    </tr>
                    <tr style="text-align: center;"  >
                      <td>9</td>
                      <td rowspan="4" style="vertical-align: middle;">Cinquième année</td>
                      <td style="text-align: center;"><span class="badge bg-blue">GRT</span></td>
                      <td style="text-align: center;">
                        <?php 
                      if($_SESSION['admis'][8]['access']==0)
                      {
                        echo "<span class=\"label label-danger\">Non Disponible</span>";
                      }
                      else
                      {
                        echo "<a href=\"listAdmis/9\"><span class=\"label label-success\">Disponible</span></a>";
                      }
                      ?>
                      </td>
                    </tr>
                    <tr>
                      <td>10</td>
                      
                      <td style="text-align: center;"><span class="badge bg-yellow">GI</span></td>
                      <td style="text-align: center;">
                        <?php 
                      if($_SESSION['admis'][9]['access']==0)
                      {
                        echo "<span class=\"label label-danger\">Non Disponible</span>";
                      }
                      else
                      {
                        echo "<a href=\"listAdmis/10\"><span class=\"label label-success\">Disponible</span></a>";
                      }
                      ?>
                      </td>
                    </tr>
                    <tr>
                      <td>11</td>
                      
                      <td style="text-align: center;"><span class="badge bg-red">GE</span></td>
                      <td style="text-align: center;">
                        <?php 
                      if($_SESSION['admis'][10]['access']==0)
                      {
                        echo "<span class=\"label label-danger\">Non Disponible</span>";
                      }
                      else
                      {
                        echo "<a href=\"listAdmis/11\"><span class=\"label label-success\">Disponible</span></a>";
                      }
                      ?>
                      </td>
                    </tr>
                    <tr>
                      <td>12</td>
                      
                      <td style="text-align: center;"><span class="badge bg-green">GPEE</span></td>
                      <td style="text-align: center;">
                        <?php 
                      if($_SESSION['admis'][11]['access']==0)
                      {
                        echo "<span class=\"label label-danger\" class=\"disabled\">Non Disponible</span>";
                      }
                      else
                      {
                        echo "<a href=\"listAdmis/12\"><span class=\"label label-success\">Disponible</span></a>";
                      }
                      ?>
                      </td>
                    </tr>
                  </table>
                </div><!-- /.box-body -->
              </div>
</section>