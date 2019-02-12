<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#flip").click(function(){
                $("#panel").slideToggle("slow");
            });
        });
    </script>
    <style>
        #panel, #flip {
            padding: 5px;
            text-align: center;
            background-color: #51A5CA;
            border: solid 1px #c3c3c3;
        }

        #panel {
            padding: 50px;
            display: none;
            background-color: #F5F5DC;
        }
    </style>
</head>
<body>
<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'listerMouvement'], ['escape' => false])?>
    </li>
</ol>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?php
    /*  foreach ($fonctionnairesService as $fonctionnairesService)
      {$nom = $fonctionnairesService->fonctionnaire->nom_fct;
      }*/?>

    <section class="content">

        <div data-role="header">
            <h4><strong>Mouvement des fonctionnaires </strong></h4>
        </div>

        <div id="flip"><strong>Les postes occupés </strong> </div>
                        <div id="panel">

                            <p><?php
$i=1;
                            foreach ($fonctionnairesService as $fonctionnairesService)
                            {
                                echo '<strong>Service ' . $i . ' : </strong>'.$fonctionnairesService->service->nom_service.'  |   ';
                                echo '<strong>Date : </strong>'. $fonctionnairesService->date_debut.'<br>';
$i++;

                            }
                                ?></p>
                        </div>

                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <?php echo $this->Paginator->numbers(); ?>
                        </ul>
                    </div>

        </div>
    </section>

</section>

</body>
</html>