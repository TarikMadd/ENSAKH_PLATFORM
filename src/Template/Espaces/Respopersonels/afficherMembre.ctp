<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".flip").click(function(){
                $(".panel").slideToggle("slow");
            });
        });
    </script>
    <style>
        .panel, .flip {
            padding: 5px;
            text-align: center;
            background-color: #51A5CA;
            border: solid 1px #c3c3c3;
        }

        .panel {
            padding: 50px;
            display: none;
            background-color: #F5F5DC;
        }
    </style>
</head>
<body>
<!-- Content Header (Page header) -->
<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'afficherFonctEvent'], ['escape' => false])?>
    </li>
</ol>
<section class="content-header">
    <h1>
        <?php
        foreach ($fonctionnairesActivite as $fonctionnaireActivite)
        {
            $nomAct=$fonctionnaireActivite->activite->nomActivite;
            break;
        }
        ?>
        <section class="content">
            <div data-role="header">
                <h3>ENSA KHOURIBGA _ <?= $nomAct ?>:</h3>
            </div>
            
                                    <div class="flip">Comité Organisateur</div>
                                    <div class="panel">

                                        <p><h4><?php
                                            foreach ($fonctionnairesActivite as $fonctionnaireActivite)
                                            {
                                                echo  $fonctionnaireActivite->fonctionnaire->nom_fct.' ' ;
                                                echo  $fonctionnaireActivite->fonctionnaire->prenom_fct.'  :  '.$fonctionnaireActivite->poste_comite.'<br>';
                                            }
                                            ?></h4></p>
                                    </div>

                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <?php echo $this->Paginator->numbers(); ?>
                            </ul>
                        </div>

        </section>
    </h1>
</section>

