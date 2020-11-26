$('.hov_vote').click(function() {
    if (dlike_username != null) {
        var mypermlink = $(this).attr("data-permlink");
        var authorname = $(this).attr("data-author");
        $(this).addClass('fas fa-spinner fa-spin like_loader');
        var update = '1';
        $.ajax({ type: "POST",url: "/helper/solve.php", data: {ath: authorname, plink: mypermlink},
            success: function(data) {
                try { var response = JSON.parse(data)
                    if (response.done == true) {$('.hov_vote').removeClass('fas fa-spinner fa-spin like_loader');$('#upvotefail').modal('show');return false;
                    } else if (response.error == true) {$('.hov_vote').removeClass('fas fa-spinner fa-spin like_loader');toastr.error(response.message);return false;
                    } else {$('.hov_vote').removeClass('fas fa-spinner fa-spin like_loader');
                        toastr.success(response.message);
                        var getpostlikes = $(".post_likes" + mypermlink + authorname).html();
                        var post_income = response.post_income;
                        var newlikes = parseInt(getpostlikes) + parseInt(update);
                        var updatespostincome = (newlikes * post_income).toFixed(2); 
                        $('.post_likes' + mypermlink + authorname).html(newlikes);
                        $('.dlike_tokens' + mypermlink + authorname).html(updatespostincome);
                        console.log(mypermlink);
                    }
                } catch (err) {toastr.error('Sorry. Server response is malformed.');}
            }
        });
    } else {toastr.error('You must be login with DLIKE username!');return false;}
});