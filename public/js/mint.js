    $(document).ready(function() {
        let $urlfield,
            $editPost,
            $sharePost,
            $add_data, $loader, $add_data_f;
        $urlfield = _("#url_field");
        $editPost = _(".contact-info-outer");
        $sharePost = _(".shareForm");
        $add_data = _("#share");
        $add_data_f = _("#plus");
        $loader = _(".loader");

        _click($add_data, function() {
            if (username != null) {
                $.ajax({
                    url: '/helper/check_pro.php',
                    type: 'post',
                    dataType: 'json',
                    data: { user: username },
                    success: function(response) {
                            console.log(response);
                            if (response.status === false) {
                                toastr['error'](response.message);
                                return false;
                            } else {

                                let url = $("#url_field").val();
                                if (url == '') {
                                    $("#url_field").css("border-color", "RED");
                                    toastr.error('phew... You forgot to enter URL');
                                } else {

                                    let verifyUrl = getDomain(url);
                                    if (isValidURL(url)) {
                                        if (verifyUrl.match(/steemit.com/g)) {
                                            toastr.error('phew... Steem URL not allowed');
                                            return false;
                                        }
                                        $.ajax({
                                            url: '/helper/check_share.php',
                                            type: 'post',
                                            dataType: 'json',
                                            data: { url: url },
                                            success: function(response) {
                                                console.log(response);
                                                if (response.status === false) {
                                                    toastr['error'](response.message);
                                                    return false;
                                                } else {
                                                    _hide($add_data_f);
                                                    _show($loader);
                                                    _fetch("helper/main.php", url);
                                                    return;
                                                }
                                            }
                                        });
                                    }
                                }
                            } //else
                        } //success
                }); //ajax
            } else { toastr.error('hmm... You must be login!'); return false; }
        });

        function _fetch(apiUrl, webUrl) {
            $.post(apiUrl, { url: webUrl }, function(response) {
                //console.log(response);

                let res = JSON.parse(response);
                window.location.replace("editDetails.php?url=" + encodeURIComponent(res.url) + "&title=" + encodeURIComponent(res.title) + "&imgUrl=" + encodeURIComponent(res.imgUrl) + "&details=" + encodeURIComponent(res.des));
                //console.log("Response array: "+res.imgUrl);

            });
        }

        function isValidURL(url) {
            var RegExp = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
            if (RegExp.test(url)) {
                return true;
            } else {
                toastr.error('phew... Enter a valid url');
                return false;
            }
        }

        function _click(se, callback) {
            _(se).click(function(e) {
                callback(e);
            });
        }

        function _show(e) {
            e.css('display', 'block');
        }

        function _hide(e) {
            e.css('display', 'none');
        }

        function _(e) {
            return $(e);
        }

        function getDomain(url) {
            let hostName = getHostName(url);
            let domain = hostName;

            if (hostName != null) {
                let parts = hostName.split('.').reverse();
                if (parts != null && parts.length > 1) {
                    domain = parts[1] + '.' + parts[0];
                    if (hostName.toLowerCase().indexOf('.co.uk') != -1 && parts.length > 2) {
                        domain = parts[2] + '.' + domain;
                    }
                }
            }
            return domain;
        }

        function getHostName(url) {
            var match = url.match(/:\/\/(www[0-9]?\.)?(.[^/:]+)/i);
            if (match != null && match.length > 2 && typeof match[2] === 'string' && match[2].length > 0) {
                return match[2];
            } else {
                return null;
            }
        }
        $('.shareme').click(function(clickEvent) {
            //let text_words = $.trim($('form [name="description"]').val()).split(' ').filter(function(v){return v!==''}).length;
            let text_words = stripHtml(editor.getData()).trim().split(/\s+/)
            console.log({ text_words })
            if (text_words.length < 40) {
                showModalError(
                    "Make Sure..",
                    "Write minimum 40 words to explain how this share is useful for community.",
                    ""
                );
                return false;
            }

            if ($('.catg').val() == "0") {
                $('.catg').css("border-color", "RED");
                showModalError(
                    "uh-oh..",
                    "You must Select an appropriate Category",
                    ""
                );
                return false;
            }

            // tag check
            var tags = $('.tags').val();
            tags = $.trim(tags);
            tags = tags.split(' ');

            if (tags.length < 2) {
                $('.tags').css("border-color", "RED");
                showModalError(
                    "uh-oh..",
                    "Please add at least two related tags",
                    ""
                );
                return false;
            }
            if ($('.title_field').val() == "") {
                showModalError(
                    "uh-oh..",
                    "Title Should not be empty!",
                    ""
                );
                return false;
            }

            function arrayTo2DArray(list, howMany) {
                var idx = 0
                result = []

                while (idx < list.length) {
                    if (idx % howMany === 0) result.push([])
                    result[result.length - 1].push(list[idx++])
                }

                return result
            }

            const checkPlagiarism = text => {
                $("#com-sbmt").html('Checking Plagiarism...');
                text = text.replace(/"/g, '');

                return fetch('check_plag.php', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ text })
                }).then(response => response.json()).then(object => {
                    clickEvent.preventDefault();
                    console.log(object);

                    return object.unique;

                    //else {$('form').submit()}
                });
            };

            const editorData = stripHtml(editor.getData()).trim();
            const words = editorData.split(/\s+/);

            let proms = [];

            if (words.length > 27) {
                const segments = arrayTo2DArray(words, 27);
                for (let segment of segments) {
                    console.log(segment, segment.join(' '));
                    if (segment.length > 26) {
                        proms.push(checkPlagiarism(segment.join(' ')));
                    }
                }
            } else {
                proms.push(checkPlagiarism(editorData));
            }

            // wait if all checks are run
            Promise.all(proms).then(function(results) {
                // more than 50% must be true
                let trueCount = results.filter(function(result) {
                    return result;
                }).length;

                // if less than 50%, go out
                if (trueCount < results.length / 2) {
                    $("#com-sbmt").html('SUBMIT');
                    showModalError(
                        "Make Sure..",
                        "Write your own text and do not copy from elsewhere.",
                        () => clickEvent.preventDefault()
                    );

                    return;
                }

                // all must true
                // for (let i = 0, len = results.length; i< len; i++) {
                //     if (results[i] === false) {
                //         return;
                //     }
                // }

                $('form').submit();
            });

            return false;
        });

        function showModalError(title, content, callback) {
            $("#alert-title-error").text(title);
            $("#alert-content-error").html(content);
            $("#alert-modal-error").modal("show");
            $("#alert-modal-error").on("hidden.bs.modal", function(e) {
                callback();
            });
        }

        function showModalSuccess(title, content, callback) {
            $("#alert-title-success").text(title);
            $("#alert-content-success").html(content);
            $("#alert-modal-success").modal("show");
            $("#alert-modal-success").on("hidden.bs.modal", function(e) {
                callback();
            });
        }

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "500",
            "timeOut": "2000",
            "extendedTimeOut": "500",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

    });

    // Add me
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

    //dvd modal
    $('.latest-post-section, #profile_page').on("click", ".hov_me", function() {
        //alert('called');
        // we want to copy the 'id' from the button to the modal
        var mypermlink = $(this).attr("data-permlink");
        var authorname = $(this).attr("data-author");
        var postsrec = $(this).attr("data-likes");
        //console.log(postsrec);
        var datat = {
            ath: authorname,
            plink: mypermlink
        };
        $.ajax({
            type: "POST",
            url: "/helper/verify_post.php",
            data: datat,
            success: function(data) {
                try {
                    var response = JSON.parse(data)
                    if (response.error == true) {
                        $('#upvotefail').modal('show');
                    } else {
                        $('#recomendModal').modal('show');
                    }
                } catch (err) {
                    alert('Sorry. Server response is malformed.')
                }
            }
        });

        $("#r_author").val(authorname);
        $("#r_permlink").val(mypermlink);
        $("#r_likes").val(postsrec);
    });


    // hov element
    $('.hov-item').hover(function() {
        $(this).find('.hov-title').fadeIn(200);
    }, function() {
        $(this).find('.hov-title').fadeOut(100);

    });

    // here start recomendations
    $('.post-comments-mid').on("click", ".recomendation", function() {
        var recpermlink = $(this).attr("data-permlink");
        var recauthor = $(this).attr("data-author");
        var reclikes = $(this).attr("data-likes");
        $("#r_author").val(recauthor);
        $("#r_permlink").val(recpermlink);
        $("#r_likes").val(reclikes);
    });

    $('.recomendme').click(function() {
        //alert('good');
        var r_permlink = $("#r_permlink").val();
        var r_author = $("#r_author").val();
        var r_likes = $("#r_likes").val();
        var newlikes = parseInt(r_likes) + 1;
        var datavr = {
            rec_permlink: r_permlink,
            rec_author: r_author
        };
        $('#recomend-bar').hide();
        $('#recomend-status').show();

        $.ajax({
            type: "POST",
            url: "/helper/solve.php",
            data: datavr,
            success: function(data) {
                //console.log(success);
                try {
                    var response = JSON.parse(data)
                    if (response.error == true) {
                        toastr.error('There is some issue!');
                        $('#recomendModal').modal('hide');
                        $('#recomend-status').hide();
                        $('#recomend-bar').show();
                        return false;
                    } else {
                        $('#up_vote').removeAttr('data-target');
                        $('#vote_icon').addClass("not-active");
                        toastr.success('Thanks for Recomendation!');
                        $('#total_likes').html(newlikes);
                        $('#recomendModal').modal('hide');
                        $('#recomend-status').hide();
                        $('#recomend-bar').show();
                    }
                } catch (err) {
                    //console.log(err);
                    toastr.error('Sorry. Server response is malformed.');
                    $('#recomendModal').modal('hide');
                    $('#recomend-status').hide();
                    $('#recomend-bar').show();
                }
            },
        });
    });
    //logout
    $('.logout_btn').click(function() {
        api.revokeToken(function(err_log, result_log) {
            if (result_log && result_log.success) {
                $.removeCookie('username', { path: '/' });
                $.removeCookie('access_token', { path: '/' });
                document.location.href = '/';
            }
        });
    });


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
                            toastr.success('upVote done successfully!');
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
    //chat
    //function ChatbroLoader(chats,async){async=!1!==async;var params={embedChatsParameters:chats instanceof Array?chats:[chats],lang:navigator.language||navigator.userLanguage,needLoadCode:'undefined'==typeof Chatbro,embedParamsVersion:localStorage.embedParamsVersion,chatbroScriptVersion:localStorage.chatbroScriptVersion},xhr=new XMLHttpRequest;xhr.withCredentials=!0,xhr.onload=function(){eval(xhr.responseText)},xhr.onerror=function(){console.error('Chatbro loading error')},xhr.open('GET','//www.chatbro.com/embed.js?'+btoa(unescape(encodeURIComponent(JSON.stringify(params)))),async),xhr.send()}
    //ChatbroLoader({encodedChatId: '938nz'});
