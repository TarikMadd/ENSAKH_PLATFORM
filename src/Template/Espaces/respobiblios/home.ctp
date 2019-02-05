<section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
            <a href="badrconsulterOuvrages" class="small-box-footer">
            <div class="small-box" style="background-color: #336E7B; color: #fff">
              <div class="inner">
                <h3><?= $premierCadre[0]['sum']; ?></h3>
                <p>Totales ouvrages</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
            </div>
            </a>
        </div>
      <div class="col-lg-3 col-xs-6">
        <a href="hajarreservation" class="small-box-footer">
        <div class="small-box" style="background-color: #66CC99; color: #fff">
          <div class="inner">
            <h3><?= $deuxiemeCadre[0]['sum']; ?></h3>
            <p>Ouvrages résérvées</p>
          </div>
          <div class="icon">
            <i class="fa fa-calendar"></i>
          </div>
        </div>
        </a>
      </div>
      <div class="col-lg-3 col-xs-6">
        <a href="majdaemprunte" class="small-box-footer">
        <div class="small-box" style="background-color: #F9BF3B; color: #fff">
          <div class="inner">
            <h3><?= $troisiemeCadre[0]['sum']; ?></h3>
            <p>Ouvrages empreintées</p>
          </div>
          <div class="icon">
            <i class="fa fa-tags"></i>
          </div>
        </div>
        </a>
      </div>
      <div class="col-lg-3 col-xs-6">
      <?php if($quatriemeCadre[0]['sum']>0) { ?>
        <a href="badrDepassementDelai" class="small-box-footer">
        <div class="small-box" style="background-color: #F64747; color: #fff">
          <div class="inner">
            <h3><?= $quatriemeCadre[0]['sum']; ?></h3>
            <p>Ouvrages non retournées</p>
          </div>
          <div class="icon">
            <i class="fa fa-exclamation-triangle"></i>
          </div>
        </div>
        </a>
      <?php } else {?>
      <div class="small-box" style="background-color: #F64747; color: #fff">
          <div class="inner">
            <h3><?= $quatriemeCadre[0]['sum']; ?></h3>
            <p>Ouvrages non retournées</p>
          </div>
          <div class="icon">
            <i class="fa fa-exclamation-triangle"></i>
          </div>
        </div>
      <?php }?>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <section class="panel" >
          <div class="profile-db-head" style="background-color: #336E7B; color: #fff"><br/>
            <p style="text-align:center;"><img src="/admin_l_t_e/img/respobiblio.png" class="img-circle" alt=""  width="75px" ></p>
            <h3><p style="text-align:center;">Mr. Alexander Pierce</p></h3>
            <p style="text-align:center;"><?= $role ?></p>
          </div>
          <table class="table table-hover">
            <tbody>
              <tr>
                <td>
                  <i class="glyphicon glyphicon-user text-maroon-light"></i>
                </td>
                <td>Utilisateurs</td>
                <td><?= $username ?></td>
              </tr>
              <tr>
                <td>
                  <i class="fa fa-envelope text-maroon-light"></i>
                </td>
                <td>Email</td>
                <td><?= $role ?>@gmail.com</td>
              </tr>
              <tr>
                <td>
                  <i class="fa fa-phone text-maroon-light"></i>
                </td>
                <td>Tel</td>
                <td>0602122546</td>
              </tr>
              <tr>
                <td>
                  <i class=" fa fa-globe text-maroon-light"></i>
                </td>
                <td>Addresse</td>
                <td>Bd Béni Amir, BP 77, Khouribga - Maroc</td>
              </tr>
            </tbody>
          </table>
        </section>
      </div>
      <div class="col-sm-8">
        <div class="box-body" style="padding: 0px;height: 345px;background-color: #fff;">
          <div class="box box-primary">
            <div class="box-header" >
              <h3 class="box-title text-black">Suggestions</h3>
              <div class="pull-right"><?= $this->Html->link(__('Consulter suggestions'), ['action' => 'listproposition'], ['class'=>'btn btn-primary btn-xs']) ?></div>
            </div>
            <div class="box-body" style="padding: 0px; height: 308px; overflow: auto">
              <table class="table table-hover">
                <tbody>
                <?php for ($i=0; $i < count($proposition); $i++) { ?>
                  <tr><td><?= $i+1 ?></td><td><?= $proposition[$i]['nom'].' '.$proposition[$i]['prenom'] ?></td><td><?= substr($proposition[$i]['resumer'],0,80) ?>...</td></tr>
                <?php } ?>
                </tbody>
              </table>
            </div>            
          </div>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="box box-primary">
          <div class="box-body no-padding">
            <div id="calendar"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
    $this->Html->css('AdminLTE./plugins/fullcalendar/fullcalendar.min', ['block' => 'css']);
    $this->Html->css('AdminLTE./plugins/fullcalendar/fullcalendar.print', ['block' => 'css', 'media' => 'print']);

    $this->Html->script([
      'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
      'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js',
      'AdminLTE./plugins/fullcalendar/fullcalendar.min',
    ],
    ['block' => 'script']);
  ?>

<?php $this->start('scriptBotton'); ?>
<script>
  $(function () {
    function ini_events(ele) {
      ele.each(function () {

        var eventObject = {
          title: $.trim($(this).text())
        };
        $(this).data('eventObject', eventObject);


      });
    }

    ini_events($('#external-events div.external-event'));
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: "Aujourd'hui",
        month: 'Mois',
        week: 'Semaines',
        day: 'jours'
      },
      events: [
      <?php for($i=0;$i<count($date);$i++) { ?>
        {
          title: '<?= $date[$i]['titre'] ?>',
          start: new Date("<?= $date[$i]['year'] ?>, <?= $date[$i]['mois'] ?>, <?= $date[$i]['jourDebut'] ?>"),
          end: new Date("<?= $date[$i]['yearFin'] ?>, <?= $date[$i]['moisFin'] ?>, <?= $date[$i]['jourFin']?>"),
          backgroundColor: "<?php echo array_rand($couleurs,1) ?>", 
          borderColor: "#2A3F54" 
        },
      <?php } ?>
      ],
    });

    });
  
</script>
<?php  $this->end(); ?>
