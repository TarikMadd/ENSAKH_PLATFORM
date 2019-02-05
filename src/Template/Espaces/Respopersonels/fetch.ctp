<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<br>
<form method="post" action="fetch1">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search by employee details" name="search">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
    </form>


<div class="fonctionnaires index large-9 medium-8 columns content">
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Nom ') ?></th>
                <th><?= $this->Paginator->sort('Prenom ') ?></th>
                <th><?= $this->Paginator->sort('N° Somme') ?></th>
                <th><?= $this->Paginator->sort('Specialite') ?></th>
                <th><?= $this->Paginator->sort('Echelle') ?></th>
                <th><?= $this->Paginator->sort('Date Recrutement') ?></th>
                <th><?= $this->Paginator->sort('Date Naissance') ?></th>
                <th><?= $this->Paginator->sort('Lieu Naissance') ?></th>
                <th><?= $this->Paginator->sort('Age') ?></th>
                <th><?= $this->Paginator->sort('Genre') ?></th>
                <th><?= $this->Paginator->sort('Code Grade') ?></th>
                <th><?= $this->Paginator->sort('Code Pays') ?></th>
                <th><?= $this->Paginator->sort('Code Diplome') ?></th>
                <th><?= $this->Paginator->sort('UE Diplome') ?></th>
                <th><?= $this->Paginator->sort('Email') ?></th>

            </tr>
            <?php foreach ($query as $query): ?>
                <tr>
                    <td> <?php echo $query['nom_fct'];?> </td>
                    <td><?php echo $query['prenom_fct']; ?></td>
                    <td><?php echo $query['somme'];?></td>
                    <td><?php echo $query['specialite']; ?></td>
                    <td><?php echo $query['echelle']; ?></td>
                    <td><?php echo $query['date_Recrut']; ?></td>
                    <td><?php echo $query['dateNaissance']; ?></td>
                    <td><?php echo $query['lieuNaissance']; ?></td>
                    <td><?php echo $query['age']; ?></td>
                    <td><?php echo $query['genre']; ?></td>
                    <td><?php echo $query['codeGrade']; ?></td>
                    <td><?php echo $query['cdPays']; ?></td>
                    <td><?php echo $query['cdDiplome']; ?></td>
                    <td><?php echo $query['ueDiplome']; ?></td>
                    <td><?php echo $query['email']; ?></td>

                </tr>
            <?php endforeach; ?>
        </table>

    </div>
</div>
</body>
</html>
