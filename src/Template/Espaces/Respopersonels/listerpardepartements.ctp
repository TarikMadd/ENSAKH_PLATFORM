<?php 
echo $this->Form->create('Post',array('id' => 'textBox', 'type' => 'post','url' => array('controller' => 'respopersonels', 'action' => 'listerpardepartements'))); ?>
                <?php echo $this->Form->input('search', array('label'=>"",'placeholder'=>'veuillez  taper un departement ','id'=>'search','required'=>'required')); ?>
                <?php  echo $this->Form->button(__(' cliquez ici pour chercher')) ;?>
                        

                              <?php echo $this->Form->end(); ?>










                              <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
             
              <th>somme</th>
              <th>nom</th>
              <th>prenom</th>
              <th>Date</th>
            </tr>
              <?php foreach ($books as $book): ?>
              <tr>
                          <td><?php echo $book['somme']; ?></td>
                          <td><?php echo $book['nom_vacataire']; ?></td>
                          <td><?php echo $book['prenom_vacataire']; ?></td>
                          <td><?php echo $book['dateAffectation']; ?></td>

               
                
              </tr>
            <?php endforeach; ?>
          </table>
        </div>