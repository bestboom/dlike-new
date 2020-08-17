    var optionstk = {
        target: '#add-msg',
        url: 'helper/tkad.php',
        success: function() {},
    }
    $('#toksubmit').submit(function() {
        $(this).ajaxSubmit(optionstk)
        return !1
    });

    // Wallet
    $('.wallet-search').click(function() {
        let user_wallet = $('#exp_search').val();
        let wallet_url = "https://dlike.io/wallets/" + user_wallet;
        window.open(wallet_url, "_self");
    });

    // star ratings
    function postToControll() {
        for (i = 0; i < document.getElementsByName('star').length; i++) {
            if (document.getElementsByName('star')[i].checked == true) {
                var ratingValue = document.getElementsByName('star')[i].value;
                break;
            }
        }
        //alert(ratingValue);
        $('#myRatingz').val(ratingValue);
    };

    // here starts dlike-steem-upvote
    $('.latest-post-section, #user_posts').on("click", ".upvoting", function() {
        var votepermlink = $(this).attr("data-permlink");
        var voteauthor = $(this).attr("data-author");

        $("#vote_author").val(voteauthor);
        $("#vote_permlink").val(votepermlink);

    });
    //upvote
    //if(rangeSlider != null){
    var rangeSlider = document.getElementById("rs-range-line");
    var rangeBullet = document.getElementById("rs-bullet");
    rangeSlider.addEventListener("input", showSliderValue, false);
    //console.log(rangeSlider);
    //}
    function showSliderValue() {
        rangeBullet.innerHTML = rangeSlider.value;
    }
    $('.upme').click(function() {

        var upvoteValue = $('#rs-range-line').val();
        var upvoteValue = upvoteValue * 100;
        var weight = parseInt(upvoteValue);
        //alert(upvoteValue)
        var v_authorname = $("#vote_author").val();
        var v_permlink = $("#vote_permlink").val();
        var voter = username;

        var datav = {
            v_permlink: v_permlink,
            v_author: v_authorname,
            vote_value: upvoteValue
        };

        if (username != null) {
            $('#upvoting-bar').hide();
            $('#upvoting-status').show();
            $.ajax({
                type: "POST",
                url: "/helper/vote.php",
                data: datav,

                success: function(data) {
                    //console.log(data);
                    try {
                        var response = JSON.parse(data)
                        if (response.error == true) {
                            toastr.error('There is some issue!');
                            $('#upvoteModal').modal('hide');
                            $('#upvoting-status').hide();
                            $('#upvoting-bar').show();
                            return false;
                        } else {
                            //$('#vote_icon').css("color", "RED");
                            toastr.success('UpVoted Successfully!');
                            $('#upvoteModal').modal('hide');
                            $('#upvoting-status').hide();
                            $('#upvoting-bar').show();
                        }
                    } catch (err) {
                        toastr.error('Sorry. Server response is malformed.');
                        $('#upvoteModal').modal('hide');
                        $('#upvoting-status').hide();
                        $('#upvoting-bar').show();
                    }
                },
                error: function(xhr, textStatus, error) {
                    console.log(xhr.statusText);
                    console.log(textStatus);
                    console.log(error);
                }
            }); 
        } else {
            toastr.error('hmm... You must be login!');
            $('#upvoteModal').modal('hide');
            return false;
        };
    });
    //valid email
    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    }