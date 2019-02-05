<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<style>
    body {
        background-color: #FAFAFA;
        margin: 0;
    }
    .choice {
        width: 70%;
        height: auto;
        margin: 40px auto;
        padding: 20px;
        background-color: #E0F8F1;
        border: 1px solid #D8D8D8;
    }
    #indicateurs{
        width: 40%;
        margin: 2%;
        padding: 2%;
        float: right;
    }
    #titres{
        width: 52%;
        margin: 0;
        padding: 2%;
        float: left;
    }
    .i {
        text-align: center;
    }
    .info{
        color: #7401DF;
    }
</style>

<?= $this->Html->script('jspdf.min'); ?>
<script>
    function print() {
        var doc = new jsPDF();
        doc.fromHTML($('#HTMLtoPDF').get(0), 20,20,{
                    'width':500
        });
        doc.save('page.pdf');
    }
</script>

<div id="HTMLtoPDF">
    <div id="titres">
        <br>
        <h1>Gestion des notes</h1>
        <hr>
        <h2>Affichage des notes</h2>
        <hr>
        <h4>Module : <span class="info"><?= $module->libile ?></span></h4>
        <h4>Element :<span class="info"> <?= $element->libile ?></span></h4>
        <hr>
        
            <button class="btn btn-warning" onclick="print()" style="width:100px;">PDF</button>
        
    </div>

    <div id="indicateurs">
        <h2>Indicateurs de suivie</h2><br>
        <table>
            <tr>
                <td><b>Note Max</b></td>
                <td class="i"> <?= $max ?> </td>
            </tr>
            <tr>
                <td><b>Note Min</b></td>
                <td class="i"> <?= $min ?> </td>
            </tr>
            <tr>
                <td><b>Note Moy</b></td>
                <td class="i"> <?= $moy ?> </td>
            </tr>
            <tr>
                <td><b>Saisies effectués</b></td>
                <td class="i"> <?= sizeof($my_notes) ?> </td>
            </tr>
            <tr>
                <td><b>Ecart-type</b></td>
                <td class="i"> <?= $ecart ?> </td>
            </tr>
        </table>
    </div>

    <div id="affichage">
        <table>
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('CNE') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Nom') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('prénom') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Note') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < sizeof($my_notes); $i++) {
                    $et = $my_etudiants[$i];
                    $no = $my_notes[$i];
                    echo '<tr>';
                    echo "<td>$et->cne</td>";
                    echo "<td>$et->nom_fr</td>";
                    echo "<td>$et->prenom_fr</td>";
                    echo "<td>$no->note</td>";
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

</div>