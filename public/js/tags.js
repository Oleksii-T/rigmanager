$('button.equipment-tags-show').click(function(){
    $('#equipment-tags-modal').removeClass('hidden');
    $('body').addClass('noscroll');
});

$('button.service-tags-show').click(function(){
    $('#service-tags-modal').removeClass('hidden');
    $('body').addClass('noscroll');
});

//close modal if clicked beyong the modal
window.onclick = function(event) {
    var modalEq = document.getElementById("equipment-tags-modal");
    var modalSe = document.getElementById("service-tags-modal");
    if (event.target == modalEq) {
        $('#equipment-tags-modal').addClass('hidden');
        $('body').removeClass('noscroll');
    } else if (event.target == modalSe) {
        $('#service-tags-modal').addClass('hidden');
        $('body').removeClass('noscroll');
    }
}

$('p.tag.first').click(function(){
    $('p.tag').removeClass('isActiveBtn');
    $('div.tags.second').addClass('hidden');
    $('div.tags.third').addClass('hidden');
    $(this).addClass('isActiveBtn')
    var id = $(this).attr('id');
    $('div.tags_'+id).removeClass('hidden');
});

$('p.tag.second').click(function(){
    $('p.tag.second').removeClass('isActiveBtn');
    $('p.tag.third').removeClass('isActiveBtn');
    $('div.tags.third').addClass('hidden');
    $(this).addClass('isActiveBtn');
    var id = $(this).attr('id');
    id = id.replace('.', '\\.');
    $('div.tags_'+id).removeClass('hidden');
});

$('p.tag.third').click(function(){
    console.log ('you have chosed: ' + $(this).attr('id'));
});