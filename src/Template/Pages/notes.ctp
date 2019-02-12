<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<div style="border: 2px dashed #99F; margin: 30px; padding: 50px;">
    <br>
    <h1>Gestion des notes</h1>
    <div style="text-align: center;">
        <hr>
        <?= $this->Html->link('Saisir des notes', '/notes/preparation-saisie', ['class'=>'btn btn-primary']) ?>
        <hr>
        <?= $this->Html->link('Afficher les notes', '/notes/preparation-affichage', ['class'=>'btn btn-warning']) ?>
        <hr>
        <hr>
        <?= $this->Html->link('Afficher les notes pour etudiants', '/notes/affichage-etudiant', ['class'=>'btn btn-warning']) ?>
        <hr>
    </div>
</div>