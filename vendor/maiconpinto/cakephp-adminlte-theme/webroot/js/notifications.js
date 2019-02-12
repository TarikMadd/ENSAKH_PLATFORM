document.addEventListener("DOMContentLoaded", function(event) { 
      $.get( $("#actualiserNotif").text(),{},function(data){
        $("#notifMenu").empty().append(data);
});
});
setInterval(function(){
    $.ajax({
            url: $("#actualiserNotif").text(),
            context: document.body
        }).done(function(data) {
            var nombreNotifsActuel = $("#nombreNotif").text();
            var returned =  $($.parseHTML(data)).find("#nombreNotif").text(); 
            if(returned != nombreNotifsActuel ){
                $("#notifMenu").empty().append(data);
            }
    });
}, 1000);