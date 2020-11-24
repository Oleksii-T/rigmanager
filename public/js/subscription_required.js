function showSubscriptionAlert() {
    $('#subscription-required').removeClass('hidden');
}

$(document).ready(function() {


    $('.close-bar img').click(function(){
        $('#subscription-required').addClass('hidden');
    });

    //close modal if clicked beyong the modal
    window.addEventListener('click', function(event) {
        var modalSubAlert = document.getElementById("subscription-required");
        if (event.target == modalSubAlert) {
            $('#subscription-required').addClass('hidden');
        }
    });

});