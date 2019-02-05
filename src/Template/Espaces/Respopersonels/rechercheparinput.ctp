<?php 
echo $this->Form->create('Post',array('id' => 'textBox', 'type' => 'post','url' => array('controller' => 'respopersonels', 'action' => 'resultrechercheparinput'))); ?>
                <?php echo $this->Form->input('search', array('label'=>"",'placeholder'=>'veuillez  taper un numero de somme ','id'=>'search','required'=>'required')); ?>
                <?php  echo $this->Form->button(__(' cliquez ici pour chercher')) ;?>
                        

                              <?php echo $this->Form->end(); ?>