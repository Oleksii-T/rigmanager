// fade out flash massages after 3 sec
$("div.flash").delay(4000).fadeOut(350);

// counter for unique pop-up ids
var popUpId = 1;
function getPopUpId() {
    popUpId++;
    return popUpId;
}

// show message depends on role and fade out it after 3 sec
function showPopUpMassage(role, massage) {
    var id = "pop-up-" + getPopUpId();
    if (role) {
        var src = "/icons/successIcon.svg";
        role = role = "pop-up-success";
    } else {
        var src = "/icons/alertIcon.svg";
        role = role = "pop-up-error";
    }
    $('#pop-up-container').append("<div class='pop-up "+role+"' id="+id+"><p><img src="+src+" alt='{{__('alt.keyword')}}'>"+massage+"</p><div class='animated-line'></div></div>");
    $("#"+id).delay(4000).fadeOut(350);
    setTimeout(function(){
        $("#"+id).remove();
    }, 4500);
}