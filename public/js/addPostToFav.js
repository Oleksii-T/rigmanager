//action when user clicks on addToFav icon
function addPostToFav(button, postId, blade) {
    var img = button.children('img');
    button.addClass('loading');
    //send Ajax reqeust to add Item to fav list of user
    $.ajax({
        type: "GET",
        url: blade['url'],
        data: { post_id: postId },
        success: function(data) {
            //if no server errors, change digit of favItemsAmount in nav bar
            //and change color of AddToFav btn img
            if ( data ) {
                var n = $("#favItemsTab span").text();
                n = parseInt(n,10);
                //visualize removing from fav list
                if ( img.hasClass('active-fav-img') ) {
                    $("#favItemsTab span").html(n-1);
                    img.attr("src", blade['whiteHeart']);
                    showPopUpMassage(true, blade['removedMes']);
                //visualize adding to fav list
                } else {
                    $("#favItemsTab span").html(n+1);
                    img.attr("src", blade['orangeHeart']);
                    showPopUpMassage(true, blade['addedMes']);
                }
                img.toggleClass('active-fav-img');
            //if server errors occures, pop up error massage
            } else {
                showPopUpMassage(false, blade['addErrorMes']);
            }
            //remove cursor wait
            button.removeClass('loading');
        },
        error: function() {
            //pop up error massage and remove cursor wait
            showPopUpMassage(false, blade['errorMes']);
            button.removeClass('loading');
        }
    });
};
