  
$('button.equipment-tags-show').click(function(){
    $('#equipment-tags-modal').removeClass('hidden');
});

$('button.service-tags-show').click(function(){
    $('#service-tags-modal').removeClass('hidden');
});

//close modal if clicked beyong the modal
window.onclick = function(event) {
    var modalEq = document.getElementById("equipment-tags-modal");
    var modalSe = document.getElementById("service-tags-modal");
    if (event.target == modalEq) {
        $('#equipment-tags-modal').addClass('hidden');
    } else if (event.target == modalSe) {
        $('#service-tags-modal').addClass('hidden');
    }
}

$('p.tag.first').click(function(){
    $('p.tag').removeClass('isActiveBtn');
    $('div.tags.second').addClass('hidden');
    $('div.tags.third').addClass('hidden');
    $(this).addClass('isActiveBtn')
    var id = $(this).attr('id');
    $('#modal-hidden-tag').val(id);
    $('div.tags_'+id).removeClass('hidden');
    $('div.selected-tags span').empty();
    var tag = $(this).text();
    $('div.selected-tags span').text(tag);
});

$('p.tag.second').click(function(){
    $('p.tag.second').removeClass('isActiveBtn');
    $('p.tag.third').removeClass('isActiveBtn');
    $('div.tags.third').addClass('hidden');
    $(this).addClass('isActiveBtn');
    var id = $(this).attr('id');
    $('#modal-hidden-tag').val(id);
    var parentId = id.match(/^[0-9]*/)[0];
    $( 'div.tags_'+id.replace('.', '\\.') ).removeClass('hidden');
    var tag = $(this).text();
    var parentTag =  $('#'+parentId).text();
    $('div.selected-tags span').empty();
    var tags = parentTag + ' > ' + tag;
    $('div.selected-tags span').text(tags);
});

$('p.tag.third').click(function(){
    $('p.tag.third').removeClass('isActiveBtn');
    $(this).addClass('isActiveBtn');
    id = $(this).attr('id');
    $('#modal-hidden-tag').val(id);
    tag = $(this).text();
    var parentId = id.match(/^[0-9]*\.[0-9]*/)[0];
    parentId = parentId.replace('.', '\\.');
    var parentTag =  $('#'+parentId).text();
    var grandParentId = id.match(/^[0-9]*/)[0];
    var grandParentTag =  $('#'+grandParentId).text();
    $('div.selected-tags span').empty();
    var tags = grandParentTag + ' > ' +parentTag + ' > ' + tag;
    $('div.selected-tags span').text(tags);
});

$('button.close-tags').click(function(){
    $('div.modal-view').addClass('hidden');
});

$('button.submit-tags').click(function(){
    $('div.modal-view').addClass('hidden');
    // start searchibg or fill inputs
    if ( $(this).hasClass('post-search') ) {
        searchTag();
    } else {
        fillInputs();
    }
});

function fillInputs() {
    id = $('#modal-hidden-tag').val();
    tags = $('div.selected-tags p span').text();
    $('#tagEncodedHidden').val(id);
    $('#tagReadbleHidden').val(tags);
    $('#tagReadbleVisible span').text(tags);
}
