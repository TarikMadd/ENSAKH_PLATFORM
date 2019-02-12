$('#cncrs').change(
    function(){
         $(this).closest('form').trigger('submit');
         
    });
$('#grps').change(
    function(){
         $(this).closest('form').trigger('submit');
        
    });

$('#preselecteGroupe').click(
    function(){
        $('#attente').attr('checked',false);
        $(this).closest('form').trigger('submit');
        
    });

$('#preselecteAttenteGroupe').click(
    function(){

        $('#attente').attr('checked','checked');
        $(this).closest('form').trigger('submit');
         
        
    });

$('#cocherTous').change(function() {
    var checkboxes = $(this).closest('form').find(':checkbox:enabled');
    if($(this).is(':checked')) {
        checkboxes.prop('checked', true);
    } else {
        checkboxes.prop('checked', false);
    }
});