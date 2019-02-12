<?php foreach ($books as $book): ?>
<tr>
<td><?php echo $book['id']; ?></td> 
<td><?php echo $book['nom_vacataire']; ?></td>
<td><?php echo $book['nom_departement']; ?></td>

<tr>
<?php endforeach; ?>

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Categories
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?= __('List of') ?> Categories</h3>
            <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">

                </span>
              </div>
            </form>
          </div>
            </div>

        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>id</th>
              <th>nom</th>
              <th>prenom</th>
              <th>somme</th>
              <th>dep</th>
            </tr>
              <?php foreach ($books as $book): ?>
              <tr>
                          <td><?php echo $book['id']; ?></td>

                <td><?php echo $book['nom_vacataire']; ?></td>
                <td><?php echo $book['prenom_vacataire']; ?></td>
                <td><?php echo $book['somme']; ?></td>


            <td><?php echo $book['nom_departement']; ?></td>
 
                
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
          </ul>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
