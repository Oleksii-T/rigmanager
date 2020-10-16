  
$('button.equipment-tags-show').click(function(){
    $('#equipment-tags-modal').removeClass('hidden');
});

$('button.service-tags-show').click(function(){
    $('#service-tags-modal').removeClass('hidden');
});

//close modal if clicked beyong the modal
window.addEventListener('click', function(event) {
    var modalEq = document.getElementById("equipment-tags-modal");
    var modalSe = document.getElementById("service-tags-modal");
    if (event.target == modalEq) {
        $('#equipment-tags-modal').addClass('hidden');
    } else if (event.target == modalSe) {
        $('#service-tags-modal').addClass('hidden');
    }
});

$('p.equipment.tag.first').click(function(){
    var id = $(this).attr('id');
    var tag = $(this).text();
    $('p.equipment.tag').removeClass('isActiveBtn');
    $(this).addClass('isActiveBtn')
    $('div.equipment.tags.second').addClass('hidden');
    $('div.equipment.tags.third').addClass('hidden');
    $('input.equipment.hidden-encoded-tag').val(id);
    $('div.equipment.tags_'+id).removeClass('hidden');
    $('div.equipment.selected-tags span').empty();
    $('div.equipment.selected-tags span').text(tag);
});

$('p.service.tag.first').click(function(){
    var id = $(this).attr('id');
    var tag = $(this).text();
    $('p.service.tag').removeClass('isActiveBtn');
    $('div.service.tags.second').addClass('hidden');
    $('div.service.tags.third').addClass('hidden');
    $(this).addClass('isActiveBtn')
    $('input.service.hidden-encoded-tag').val(id);
    $('div.service.tags_'+id).removeClass('hidden');
    $('div.service.selected-tags span').empty();
    $('div.service.selected-tags span').text(tag);
});

$('p.equipment.tag.second').click(function(){
    var tag = $(this).text();
    var id = $(this).attr('id');
    var parentId = id.match(/^[0-9]*/)[0];
    var parentTag =  $('#'+parentId).text();
    var tags = parentTag + ' > ' + tag;
    $('p.equipment.tag.second').removeClass('isActiveBtn');
    $(this).addClass('isActiveBtn');
    $('p.equipment.tag.third').removeClass('isActiveBtn');
    $('div.equipment.tags.third').addClass('hidden');
    $('input.equipment.hidden-encoded-tag').val(id);
    $('div.equipment.tags_'+id.replace('.', '\\.') ).removeClass('hidden');
    $('div.equipment.selected-tags span').empty();
    $('div.equipment.selected-tags span').text(tags);
});

$('p.service.tag.second').click(function(){
    var tag = $(this).text();
    var id = $(this).attr('id');
    var parentId = id.match(/^[0-9]*/)[0];
    var parentTag =  $('#'+parentId).text();
    var tags = parentTag + ' > ' + tag;
    $('p.service.tag.second').removeClass('isActiveBtn');
    $(this).addClass('isActiveBtn');
    $('p.service.tag.third').removeClass('isActiveBtn');
    $('div.service.tags.third').addClass('hidden');
    $('input.service.hidden-encoded-tag').val(id);
    $('div.service.tags_'+id.replace('.', '\\.') ).removeClass('hidden');
    $('div.service.selected-tags span').empty();
    $('div.service.selected-tags span').text(tags);
});

$('p.equipment.tag.third').click(function(){
    id = $(this).attr('id');
    tag = $(this).text();
    var parentId = id.match(/^[0-9]*\.[0-9]*/)[0].replace('.', '\\.');
    var parentTag =  $('#'+parentId).text();
    var grandParentId = id.match(/^[0-9]*/)[0];
    var grandParentTag =  $('#'+grandParentId).text();
    var tags = grandParentTag + ' > ' +parentTag + ' > ' + tag;
    $('p.equipment.tag.third').removeClass('isActiveBtn');
    $(this).addClass('isActiveBtn');
    $('input.equipment.equipment.hidden-encoded-tag').val(id);
    $('div.equipment.selected-tags span').empty();
    $('div.equipment.selected-tags span').text(tags);
});

$('p.service.tag.third').click(function(){
    id = $(this).attr('id');
    tag = $(this).text();
    var parentId = id.match(/^[0-9]*\.[0-9]*/)[0].replace('.', '\\.');
    var parentTag =  $('#'+parentId).text();
    var grandParentId = id.match(/^[0-9]*/)[0];
    var grandParentTag =  $('#'+grandParentId).text();
    var tags = grandParentTag + ' > ' +parentTag + ' > ' + tag;
    $('p.service.tag.third').removeClass('isActiveBtn');
    $(this).addClass('isActiveBtn');
    $('input.service.equipment.hidden-encoded-tag').val(id);
    $('div.service.selected-tags span').empty();
    $('div.service.selected-tags span').text(tags);
});

$('button.close-tags').click(function(){
    $('div.modal-view').addClass('hidden');
});

$('button.equipment.submit-tags').click(function(){
    $('div.modal-view').addClass('hidden');
    // start searching or fill inputs
    if ( $(this).hasClass('post-search') ) {
        id = $('input.equipment.hidden-encoded-tag').val();
        searchTag(id);
    } else if ($(this).hasClass('post-create')) {
        fillInputs();
    }
});

$('button.service.submit-tags').click(function(){
    $('div.modal-view').addClass('hidden');
    // start searching or fill inputs
    if ( $(this).hasClass('post-search') ) {
        id = $('input.service.hidden-encoded-tag').val();
        searchTag(id);
    } else if ($(this).hasClass('post-create')) {
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
