<?php $i=0; ?>
<?php foreach ($articles as $article): ?>
			<?php if ($this->Number->format($article->quantite) - $this->Number->format($article->quantite_min)  <=5  ){ ?>
				<?php $i++; ?>
			 <?php } ?> 

            <?php endforeach; ?>
			<?php $j=0; ?>
<?php foreach ($articles as $article): ?>
			<?php if ($this->Number->format($article->id) ){ ?>
				<?php $j++; ?>
			 <?php } ?> 
			

            <?php endforeach; ?>
			
						<?php $her=0; ?>
<?php foreach ($commandes as $commande): ?>
			
				<?php $her++; ?>
			

            <?php endforeach; ?>
			
									<?php $mer=0; ?>
<?php foreach ($stockCategories as $stockCategorie): ?>
			
				<?php $mer++; ?>
			

            <?php endforeach; ?>
			
<section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
            <a href="index_articles" class="small-box-footer">
            <div class="small-box" style="background-color: #336E7B; color: #fff">
              <div class="inner">
                <h3><?= $j ;?></h3>
                <p>Totales Articles</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
            </div>
            </a>
        </div>
      <div class="col-lg-3 col-xs-6">
        <a href="indexCommandes" class="small-box-footer">
        <div class="small-box" style="background-color: #66CC99; color: #fff">
          <div class="inner">
            <h3><?= $her; ?></h3>
            <p>Commandes Effectuées</p>
          </div>
          <div class="icon">
            <i class="fa fa-calendar"></i>
          </div>
        </div>
        </a>
      </div>
      <div class="col-lg-3 col-xs-6">
        <a href="index_stockcategories" class="small-box-footer">
        <div class="small-box" style="background-color: #F9BF3B; color: #fff">
          <div class="inner">
            <h3><?= $mer; ?></h3>
            <p>Categories</p>
          </div>
          <div class="icon">
            <i class="fa fa-tags"></i>
          </div>
        </div>
        </a>
      </div>
      <div class="col-lg-3 col-xs-6">
      <?php if($i>0) { ?>
        <a href="#" class="small-box-footer">
        <div class="small-box" style="background-color: #F64747; color: #fff">
          <div class="inner">
            <h3><?= $i; ?></h3>
            <p>Articles en états critique</p>
          </div>
          <div class="icon">
            <i class="fa fa-exclamation-triangle"></i>
          </div>
        </div>
        </a>
      <?php } else {?>
      <div class="small-box" style="background-color: #F64747; color: #fff">
          <div class="inner">
            <h3><?= $i; ?></h3>
            <p>Articles en états critique</p>
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
                <td><?= $role ?></td>
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
        <div class="box-body" style="padding: 0px; background-color: #fff;">
          <div class="box box-primary">
            <div class="box-header" >
              <h3 class="box-title text-black">Articles En état critique</h3>
            </div>
            <div class="box-body" style="padding: 0px; height: 308px; overflow: auto">
              <table class="table table-hover">
                <tbody>
                <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('stock_categorie_id') ?></th>
              <th><?= $this->Paginator->sort('label_article') ?></th>
              <th><?= $this->Paginator->sort('quantite_min') ?></th>
              <th><?= $this->Paginator->sort('marque') ?></th>
              <th><?= $this->Paginator->sort('utilite') ?></th>
              <th><?= $this->Paginator->sort('quantite') ?></th>
              <th><?= __('Action') ?></th>
            </tr>
            <?php foreach ($articles as $article): ?>
			<?php if ($this->Number->format($article->quantite) - $this->Number->format($article->quantite_min)  <= 5  ){ ?>
             
			 <tr>
                <td><?= $this->Number->format($article->id) ?></td>
                <td><?= $article->has('stock_category') ? $this->Html->link($article->stock_category->id, ['controller' => 'Respostocks', 'action' => 'view_stockcategories', $article->stock_category->id]) : '' ?></td>
                <td><?= h($article->label_article) ?></td>
                <td><?= $this->Number->format($article->quantite_min) ?></td>
                <td><?= h($article->marque) ?></td>
                <td><?= h($article->utilite) ?></td>
                <td><?= $this->Number->format($article->quantite) ?></td>
                <td class="commander" style="white-space:nowrap">
                   <?= $this->Html->link(__('Afficher'), ['action' => 'view_articles', $article->id], ['class'=>'btn btn-success btn-xs']) ?>
                  
                </td>
              </tr>
			
			 <?php } ?> 
            <?php endforeach; ?>
          </table>
                </tbody>
              </table>
            </div>            
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
<?php  $this->end();?>

