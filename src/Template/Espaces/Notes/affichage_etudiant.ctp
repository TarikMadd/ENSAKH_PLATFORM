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
    #etudiant{
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
    .info{
        color: #7401DF;
    }
</style>

<div>
    <div id="titres">
        <br>
        <h1>Gestion des notes</h1>
        <hr>
        <h2>Affichage des notes</h2>
        <hr>
        <!-- <h4>Module : <span class="info"><?= $module->libile ?></span></h4>
        <h4>Element :<span class="info"> <?= $element->libile ?></span></h4> -->
    </div>

    <div id="etudiant">
        <h2>Etudiant</h2><br>
        <table id="t1">
            <tr>
                <td><b>Nom</b></td>
                <td class="i"> <?= $etudiant->nom_fr ?> </td>
            </tr>
            <tr>
                <td><b>Prénom</b></td>
                <td class="i"> <?= $etudiant->prenom_fr ?> </td>
            </tr>
            <tr>
                <td><b>CNE</b></td>
                <td class="i"> <?= $etudiant->cne ?> </td>
            </tr>
            <tr>
                <td><b>CIN</b></td>
                <td class="i"> <?= $etudiant->cin  ?> </td>
            </tr>
        </table>
    </div>

    <div id="affichage">
        <table id="t2">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('Module') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Element') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Note') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Résultat') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    for ($i = 0; $i < sizeof($my_etudiers); $i++) {
                        $et = $my_etudiers[$i];
                        if (isset($nom_elements[$i])) {
                            $e = $nom_elements[$i];
                            $m = $nom_modules[$i];
                            $n = $my_notes[$i];
                            echo '<tr>';
                                echo "<td> $m </td>";
                                echo "<td> $e </td>";
                                echo "<td> $n->note </td>";
                                if ($n->note > 10) echo "<td> Validé </td>";
                                else echo "<td> Rattrapage </td>";
                            echo '</tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    
</div>

                    

<?= $this->Html->script('jspdf') ?>
<?= $this->Html->script('jspdf.min') ?>
<?= $this->Html->script('jspdf.debug') ?>
<?= $this->Html->script('html2pdf') ?>
<?= $this->Html->script('jspdf-aututable') ?>


<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>  
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script> -->

<script>  
    (function () {  
        var  
         form = $('.form'),  
         cache_width = form.width(),  
         a4 = [595.28, 841.89]; // for a4 size paper width and height  
  
        $('#create_pdf').on('click', function () {  
            $('body').scrollTop(0);  
            createPDF();  
        });  
        //create pdf  
        function createPDF() {  
            getCanvas().then(function (canvas) {  
                var  
                 img = canvas.toDataURL("image/png"),  
                 doc = new jsPDF({  
                     unit: 'px',  
                     format: 'a4'  
                 });  
                doc.addImage(img, 'JPEG', 20, 20);  
                doc.save('Bhavdip-html-to-pdf.pdf');  
                form.width(cache_width);  
            });  
        }  
  
        // create canvas object  
        function getCanvas() {  
            form.width((a4[0] * 1.33333) - 80).css('max-width', 'none');  
            return html2canvas(form, {  
                imageTimeout: 2000,  
                removeContainer: true  
            });  
        }  
  
    }());  
</script>  
<script>  
    /* 
 * jQuery helper plugin for examples and tests 
 */  
    (function ($) {  
        $.fn.html2canvas = function (options) {  
            var date = new Date(),  
            $message = null,  
            timeoutTimer = false,  
            timer = date.getTime();  
            html2canvas.logging = options && options.logging;  
            html2canvas.Preload(this[0], $.extend({  
                complete: function (images) {  
                    var queue = html2canvas.Parse(this[0], images, options),  
                    $canvas = $(html2canvas.Renderer(queue, options)),  
                    finishTime = new Date();  
  
                    $canvas.css({ position: 'absolute', left: 0, top: 0 }).appendTo(document.body);  
                    $canvas.siblings().toggle();  
  
                    $(window).click(function () {  
                        if (!$canvas.is(':visible')) {  
                            $canvas.toggle().siblings().toggle();  
                            throwMessage("Canvas Render visible");  
                        } else {  
                            $canvas.siblings().toggle();  
                            $canvas.toggle();  
                            throwMessage("Canvas Render hidden");  
                        }  
                    });  
                    throwMessage('Screenshot created in ' + ((finishTime.getTime() - timer) / 1000) + " seconds<br />", 4000);  
                }  
            }, options));  
  
            function throwMessage(msg, duration) {  
                window.clearTimeout(timeoutTimer);  
                timeoutTimer = window.setTimeout(function () {  
                    $message.fadeOut(function () {  
                        $message.remove();  
                    });  
                }, duration || 2000);  
                if ($message)  
                    $message.remove();  
                $message = $('<div ></div>').html(msg).css({  
                    margin: 0,  
                    padding: 10,  
                    background: "#000",  
                    opacity: 0.7,  
                    position: "fixed",  
                    top: 10,  
                    right: 10,  
                    fontFamily: 'Tahoma',  
                    color: '#fff',  
                    fontSize: 12,  
                    borderRadius: 12,  
                    width: 'auto',  
                    height: 'auto',  
                    textAlign: 'center',  
                    textDecoration: 'none'  
                }).hide().fadeIn().appendTo('body');  
            }  
        };  
    })(jQuery);  
  
</script>  
