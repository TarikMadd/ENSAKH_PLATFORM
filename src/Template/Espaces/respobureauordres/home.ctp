
    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
            
            <div class="small-box" style="background-color: #336E7B; color: #fff">
              <div class="inner">
                <h3><?= $couArr; ?></h3>
                <p> Courriers reçus</p>
              </div>
              <div class="icon">
                <i class="fa fa-fw fa-envelope"></i>
              </div>
            </div>
            </a>
        </div>
      <div class="col-lg-3 col-xs-6">
        
        <div class="small-box" style="background-color: #66CC99; color: #fff">
          <div class="inner">
            <h3><?= $couDep; ?></h3>
            <p> Courriers departs</p>
          </div>
          <div class="icon">
            <i class="fa fa-fw fa-envelope-o"></i>
          </div>
        </div>
        </a>
      </div>
      <div class="col-lg-3 col-xs-6">
        
        <div class="small-box" style="background-color: #F9BF3B; color: #fff">
          <div class="inner">
            <h3><?= $dest; ?></h3>
            <p>Destinataires</p>
          </div>
          <div class="icon">
            <i class=" fa fa-fw fa-user"></i>
          </div>
        </div>
        </a>
      </div>
      <div class="col-lg-3 col-xs-6">
        
        <div class="small-box" style="background-color: #F64747; color: #fff">
          <div class="inner">
            <h3><?= $exp; ?></h3>
            <p>Expediteurs</p>
          </div>
          <div class="icon">
            <i class=" fa fa-fw fa-users"></i>
          </div>
        </div>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <section class="panel" >
                 <div class="profile-db-head" style="background-color: #336E7B; color: #fff"><br/>
                   <p style="text-align:center;"><img src="/Ensaksite/admin_l_t_e/img/respobureauordre.png" class="img-circle" alt=""  width="75px" ></p>
                   <h3><p style="text-align:center;"><?= $genre ?>. <?= $nom ?></p></h3>
                   <p style="text-align:center;"><?= $name[0]['specialite'] ?></p>
                 </div>
          <table class="table table-hover">
                      <tbody>
                        <tr>
                          <td>
                            <i class="glyphicon glyphicon-user text-maroon-light"></i>
                          </td>
                          <td>CIN</td>
                          <td><?= $name[0]['CIN'] ?></td>
                        </tr>
                        <tr>
                          <td>
                            <i class="fa fa-envelope text-maroon-light"></i>
                          </td>
                          <td>Email</td>
                          <td><?= $name[0]['email'] ?></td>
                        </tr>
                        <tr>
                          <td>
                            <i class="fa fa-phone text-maroon-light"></i>
                          </td>
                          <td>Tel</td>
                          <td><?= $name[0]['phone'] ?></td>
                        </tr>
                        <tr>
                          <td>
                            <i class=" fa fa-globe text-maroon-light"></i>
                          </td>
                          <td>Addresse</td>
                          <td>Bd Béni Amir, BP 77, Khouribga - Maroc</td>
                        </tr>
                      </tbody>
                    </table>
        </section>
      </div>
     
    </div>
  </section>


  
  












    <section class="content">
      
    <div class="row">
      
      
      <div class="col-sm-12">
        <div class="box box-primary">
          <div class="box-body no-padding">
            <div id="calendar"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
    $this->Html->css('AdminLTE./plugins/fullcalendar/fullcalendar.min', ['block' => 'css']);
    $this->Html->css('AdminLTE./plugins/fullcalendar/fullcalendar.print', ['block' => 'css', 'media' => 'print']);

    $this->Html->script([
      'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
      'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js',
      'AdminLTE./plugins/fullcalendar/fullcalendar.min',
    ],
    ['block' => 'script']);
  ?>

<?php $this->start('scriptBotton'); ?>
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      });
    }

    ini_events($('#external-events div.external-event'));

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: "Aujourd'hui",
        month: 'Mois',
        week: 'Semaine',
        day: 'jour'
      },
      //Random default events
      events: [
        
      
      ],
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar !!!
      drop: function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }

      }
    });

    /* ADDING EVENTS */
    var currColor = "#3c8dbc"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
      //Add color effect to button
      $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });
    $("#add-new-event").click(function (e) {
      e.preventDefault();
      //Get value and make sure it is not null
      var val = $("#new-event").val();
      if (val.length == 0) {
        return;
      }

      //Create events
      var event = $("<div />");
      event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
      event.html(val);
      $('#external-events').prepend(event);

      //Add draggable funtionality
      ini_events(event);

      //Remove event from text input
      $("#new-event").val("");
    });
  });
</script>
<?php  $this->end(); ?>
