<?php 
include('template/header7.php'); 
include('functions/categories.php'); 
if (isset($_GET["url"])) {
    $decode = function ($data) {
        return rawurldecode($data);
    };
    $url = $_GET["url"];
    $img = $_GET["imgUrl"];
    $title = $_GET["title"];
    $des = $_GET["details"];
    $url = strip_tags(htmlspecialchars(trim($decode($url))));
    $img = strip_tags(htmlspecialchars(trim($decode($img))));
    $title = strip_tags(htmlspecialchars(trim($decode($title))));
    $des = strip_tags(htmlspecialchars(trim($decode($des))));
} else { die('Not Allowed');}

?>
</div><!-- sub-header -->
<style>
    .data-title {font-weight: 500;white-space: nowrap;padding-top: 3px;padding-right: 5px;overflow: hidden;text-overflow: ellipsis;font-weight: 600;margin-bottom: 0px;}
</style>
        <div class="container">
            <div class="user-login-signup-form-wrap" style="margin-top: 30px;margin-bottom: 40px;">
                <div class="modal-content" style="border:none;">
                    <div class="modal-body">
                        <input type="hidden" name="image" class="image_field" value="<?php print $img; ?>">
                        <img class="img-fluid d-flex flex-column" src="<?php $imgUrl = $img != 'null' ? $img : "https://dlike.io/images/default-img.jpg"; print $imgUrl; ?>" style="border-radius: 20px 20px 0px 0px;max-height: 340px;min-width: 100%;" alt="dlike"/>
                        <div class="modal-info-block" style="border: 1px solid rgba(0,0,0,.2);padding: 10px;border-radius: 0px 0px 10px 10px;">
                            <p class="data-title"><?php print $title; ?></p>
                            <p style="margin-bottom: 4px;line-height: 1.5em;height: 3em;overflow: hidden;" class="data-desc"><?php print $des; ?></p>
                            <div style="display: flex;justify-content: space-between;">
                                <p style="margin-bottom: 1px;"><i class="fas fa-link" style="padding-right: 5px;color: #c3bbb2;font-size: 12px;"></i>dlike.io</p>
                                <select style="border:none;" name="category" class="dlike_cat">
                                    <option value="0">Select Category</option>
                                <?php foreach ($categories as $category){ ?>
                                    <option value="<?php echo $category;?>"><?php echo $category;?></option>    
                                <?php } ?>
                                </select>
                            </div>
                            <div style="display: flex;justify-content: space-between;margin-top:9px">
                                <input type="text" placeholder="Tags separated by space" style="width: 60%;border: none;;color: rgb(27, 149, 224);" class="dlike_tags" />
                                <button type="button" class="btn btn-primary dlike_share_post" style="background-color: #c51d24;border-color: #c51d24;">SHARE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
<?php include('template/dlike_footer.php'); ?>
<script type="text/javascript">
    $(document).ready(function() {
   window.mobilecheck = function() {
      var check = false;
      (function(a) {
         if (
            /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(
               a
            ) ||
            /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
               a.substr(0, 4)
            )
         )
            check = true;
      })(navigator.userAgent || navigator.vendor || window.opera);
      return check;
   };
   // Move cursor to the end.
   function placeCaretAtEndX(el) {
      el.focus();
      if (
         typeof window.getSelection != "undefined" &&
         typeof document.createRange != "undefined"
      ) {
         var range = document.createRange();
         range.selectNodeContents(el);
         range.collapse(false);
         var sel = window.getSelection();
         sel.removeAllRanges();
         sel.addRange(range);
      } else if (typeof document.body.createTextRange != "undefined") {
         var textRange = document.body.createTextRange();
         textRange.moveToElementText(el);
         textRange.collapse(false);
         textRange.select();
      }
   }

   // Define special characters:
   var charactersX = [
      0,
      32, // space
      13 // enter
      // add other punctuation symbols or keys
   ];

   // Convert characters to charCode
   function toCharCodeX(char) {
      return char.charCodeAt(0);
   }

   var forbiddenCharactersX = [
      toCharCodeX("_"),
      toCharCodeX("-"),
      toCharCodeX("?"),
      toCharCodeX("*"),
      toCharCodeX("\\"),
      toCharCodeX("/"),
      toCharCodeX("("),
      toCharCodeX(")"),
      toCharCodeX("="),
      toCharCodeX("&"),
      toCharCodeX("%"),
      toCharCodeX("+"),
      toCharCodeX("^"),
      toCharCodeX("#"),
      toCharCodeX("'"),
      toCharCodeX("<"),
      toCharCodeX("|"),
      toCharCodeX(">"),
      toCharCodeX("."),
      toCharCodeX(","),
      toCharCodeX(";")
   ];

   $(document).on("keypress", ".dlike_tags", function(event) {
      var code = (event.keyCode) ? event.keyCode : event.which; 
      
      window.mobilecheck() ? event.key.charCodeAt(0) : event.which;
      if (charactersX.indexOf(code) > -1) {
         // Get and modify text.
         var text = $(".dlike_tags").text();
         text = XRegExp.replaceEach(text, [
            [/#\s*/g, ""],
            [/\s{2,}/g, " "],
            [XRegExp("(?:\\s|^)([\\p{L}\\p{N}]+)(?=\\s|$)(?=.*\\s\\1(?=\\s|$))","gi"),""],
            [XRegExp("([\\p{N}\\p{L}]+)", "g"), "#$1"]
         ]);
         // Save content.
         $(".dlike_tags").text(text);
         // Move cursor to the end
         placeCaretAtEndX(document.querySelector(".dlike_tags"));
      } else if (forbiddenCharactersX.indexOf(code) > -1) {
         event.preventDefault();
      }
   });
});
</script>
<script type="text/javascript">
    function getHostName(url) {
        var match = url.match(/:\/\/(www[0-9]?\.)?(.[^/:]+)/i);
        if (match != null && match.length > 2 && typeof match[2] === 'string' && match[2].length > 0) {
            return match[2];
        } else {
            return false;
        }
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

    $('.dlike_share_post').click(function(clickEvent) {
        if (dlike_username != null) {
            console.log(dlike_username);
            let urlInput = '<?php echo $url; ?>';
            console.log(urlInput);
            let verifyUrl = getDomain(urlInput);

            if (verifyUrl.match(/cointelegraph.com/g) || verifyUrl.match(/steemit.com/g)) {
                toastr.error('phew... Sharing from this url is not allowed');
                return false;
            }
            if ($('.dlike_cat').val() == "0") {
                $('.dlike_cat').css("border-color", "RED");
                toastr.error('Please Select an appropriate Category');
                return false;
            }
            // tag check
            var tags = $('.dlike_tags').val();
            tags = $.trim(tags);
            tags = tags.split(' ');

            if (tags.length < 2) {
                $('.tags').css("border-color", "RED");
                toastr.error('Please add at least two related tags');
                return false;
            }
            var author = dlike_username;
            console.log(author);
            var title = $('.data-title').html();
            console.log(title);
            var permlink = title.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').replace(/-+/g,'-').toLowerCase();
            console.log(permlink);
            //var urlImage =  $('.image_field').val();
            var tags = $('.dlike_tags').val();
            console.log(tags);
            //var vtags = added_tags.replace(/([a-zA-Z0-9-]+)/g, "\"$1\"");
            //console.log(vtags);
            //var qtags = vtags.replace(/\s+/g, ', ').toLowerCase();
            //console.log(qtags);
            var description = $('.data-desc').html();
            console.log(description);
            var post_body = description.replace(/[\u2018\u2019]/g, "'").replace(/[\u201C\u201D]/g, '"');
            console.log(post_body);
            var urlImage =  $('.image_field').val();
            console.log(urlImage);
            //var body = '<center><img src="'+urlImage+'" alt="Shared From DLIKE" /></center><br>'+post_body+'<br><center><br><a href="https://dlike.io/post/@' + author + '/' + permlink+'">Shared On DLIKE</a><hr><br><a href="https://dlike.io/"><img src="https://dlike.io/images/dlike-logo.jpg"></a></center>';
            //console.log(body);
            var post_category = $('.dlike_cat').val();
            console.log(post_category);
            //var post_tags = '["hive-116221", "dlike", '+ qtags +']';
            //var meta_tags = JSON.parse(post_tags);
            //var jsonMetadata = {
            //   "tags": meta_tags,
            //   "app": "dlike/3",
            //   "community": "dlike",
            //    "format": "html",
            //    "image": urlImage,
            //    "url": urlInput,
            //    "type": "share",
            //    "body": post_body,
            //    "category": post_category
            //};

            $(".dlike_share_post").attr("disabled", true);
            $('.dlike_share_post').html('Publishing...');

            var data = {
                author: author,
                title: title,
                permlink: permlink,
                tags: tags,
                description: description,
                category: post_category,
                image: urlImage,
                exturl:urlInput
            };
            
        } else { toastr.error('You must be login to share!'); return false; }
    });
</script>