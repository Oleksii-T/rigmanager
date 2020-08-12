var popUpId = 10;
function getPopUpId() {
    popUpId++;
    return popUpId;
}

function showPopUpMassage(role, massage) {
    var id = "pop-up-" + getPopUpId();
    if (role) {
        var src = "/icons/successIcon.svg";
        role = role = "pop-up-success";
    } else {
        var src = "/icons/alertIcon.svg";
        role = role = "pop-up-error";
    }
    $('#pop-up-container').append("<div class='pop-up "+role+"' id="+id+"><p><img src="+src+" alt='{{__('alt.keyword')}}'>"+massage+"</p></div>");
    $("#"+id).delay(3000).fadeOut(350);
    setTimeout(function(){
        $("#"+id).remove();
    }, 3500);
}