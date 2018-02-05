$(document).ready(function(){
    $("#result-block").on("click",function(){
            var $textval =  $(this).attr('value');
        swal({
                title:"Sorry!",
                text:$textval,
                confirmButtonClass:"btn-raised btn-primary",
                confirmButtonText:"OK"
            })
        }
    )
});