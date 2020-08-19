<?php include('template/header.php');  include('functions/categories.php'); 
if (isset($_GET["url"])) { 
    $decode = function ($data) {return rawurldecode($data);};
    $url = $_GET["url"]; $img = $_GET["imgUrl"]; $title = $_GET["title"];$des = $_GET["details"];
    $url = strip_tags(htmlspecialchars(trim($decode($url))));
    $img = strip_tags(htmlspecialchars(trim($decode($img))));
    $title = strip_tags(htmlspecialchars(trim($decode($title))));
    $des = strip_tags(htmlspecialchars(trim($decode($des))));
} else { die('Not Allowed');}
?></div>
<div class="latest-post-section" style="background: #fff;"><div class="container">
    <div class="user-login-signup-form-wrap link_section">
        <div class="modal-content" style="border:none;"><div class="modal-body">
            <input type="hidden" name="image" class="image_field" value="<?php print $img; ?>">
            <img class="img-fluid d-flex flex-column link_image" src="<?php $imgUrl = $img != 'null' ? $img : "https://dlike.io/images/default-img.jpg"; print $imgUrl; ?>" alt="dlike"/>
            <div class="modal-info-block link_box">
                <p class="data-title"><?php print $title; ?></p>
                <textarea class="data-desc" rows="2" style="width: 100%;border: none;" id="post_desc"><?php print $des; ?></textarea>
                <div class="link_bottom">
                    <p style="margin-bottom: 1px;"><i class="fas fa-link link_icon"></i><span id="domain_name"></span></p>
                    <select style="border:none;" name="category" class="dlike_cat">
                        <option value="0">Select Category</option>
                    <?php foreach ($categories as $category){ ?>
                        <option value="<?php echo $category;?>"><?php echo $category;?></option> <?php } ?>
                    </select>
                </div>
                <div class="link_bottom_section">
                    <input type="text" placeholder="Tags separated by space" style="width: 60%;border: none;color: rgb(27, 149, 224);" class="dlike_tags" />
                    <button type="button" class="btn btn-primary dlike_share_post">SHARE</button>
                </div>
            </div>
        </div></div>
    </div>
</div></div>
<script>let url_submitted = '<?php echo $url; ?>';let urlInput = '<?php echo $url; ?>';let restricted='<?php echo $restricted_urls; ?>';</script>
<?php include('template/footer.php'); ?>