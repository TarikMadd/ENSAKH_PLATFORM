<ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'afficherEvent'], ['escape' => false])?>
    </li>
  </ol>

  <center><div class="Activite" style="width:500px;margin-left:8px" class="professeursActivites form large-9 medium-8 columns content">
    <?= $this->Form->create($profpermanentsActivite) ?>
    <fieldset>
        <legend><?= __('Affectation Professeurs Permanents Activites') ?></legend>
         <label >Nom et Prenom Professeur</label><br />
              <select style='color:black;height:35px;width:460px' name="idProf">
              <?php foreach($queryProf as $prof): ?>
              <option value=<?= $prof->id ?>><?= $prof->nom_prof.' '.$prof->prenom_prof ?></option>
              <?php endforeach; ?>
              </select>
        <?php
            echo $this->Form->input('nomActivite', ['options' => $nomtab]);
            echo $this->Form->input('poste_comite');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div></center>
