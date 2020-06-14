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
                        <img class="img-fluid d-flex flex-column" src="<?php $imgUrl = $img != 'null' ? $img : "https://dlike.io/images/default-img.jpg"; print $imgUrl; ?>" style="border-radius: 20px 20px 0px 0px;max-height: 340px;min-width: 100%;" alt="dlike"/>
                        <div class="modal-info-block" style="border: 1px solid rgba(0,0,0,.2);padding: 10px;border-radius: 0px 0px 10px 10px;">
                            <p class="data-title"><?php print $title; ?></p>
                            <p style="margin-bottom: 4px;line-height: 1.5em;height: 3em;overflow: hidden;"><?php print $des; ?></p>
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
            </div><!-- user-login-signup-form-wrap -->
        </div>
  
<?php include('template/dlike_footer.php'); ?>

<script type="text/javascript">
    //var dlike_username  = $.cookie("dlike_username");
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
        } else { toastr.error('You must be login to share!'); return false; }
    });

</script>