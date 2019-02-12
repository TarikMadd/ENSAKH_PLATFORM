<ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'afficherEvent'], ['escape' => false])?>
    </li>
  </ol>

  <center><div class="Activite" style="width:500px;margin-left:8px" class="professeursActivites form large-9 medium-8 columns content">
    <?= $this->Form->create($profpermanentsActivite) ?>
    <fieldset>
        <legend><?= __('Affectation Professeurs Permanents Activites') ?></legend>
        <label >Nom Professeur</label><br />
                      <select style='color:black;height:35px;width:460px' name="nomProf">
                      <?php
                       for($i=1;$i<=count($tabNomProf);$i++)
                      {
                         ?><option style='color:black' value=<?= $tabNomProf[$i]?> ><?=$tabNomProf[$i]?> </option><?php
                      }?>
                      </select>
                      <label >Prénom Professeur</label><br />
                                    <select style='color:black;height:35px;width:460px' name="prenomProf">
                                    <?php
                                     for($i=1;$i<=count($tabPrenomProf);$i++)
                                    {
                                       ?><option style='color:black' value=<?= $tabPrenomProf[$i]?> ><?=$tabPrenomProf[$i]?> </option><?php
                                    }?>
                                    </select><?php
            echo $this->Form->input('nomActivite', ['options' => $nomtab]);
            echo $this->Form->input('poste_comite');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div></center>
