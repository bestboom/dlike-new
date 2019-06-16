                  
                <div class="dvd-account-content">
                    <form action="helper/solve.php" method="post" id="logsubmit">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="user_label"><b>Enter Some username </b></label>
                                <input type="text" class="form-control" name="likes_user" id="likes_name" value="">
                            </div>
                            <div class="form-group">
                                <label><b>Rate this post if you want</b></label>
                                <input type="hidden" name="ratingz" id="myRatingz" value="0" />
                                <input type="hidden" name="rated_author" id="author_rate" value="" />
                                <input type="hidden" name="rated_permlink" id="permlink_rate" value="" />
                                <?php echo  $_POST['rated_author']; ?>
                                <div class="stars">
                                    <input class="star star-5" id="star-5" type="radio" name="star" onclick="postToControll();" value="5" />
                                    <label class="star star-5" for="star-5"></label>
                                    <input class="star star-4" id="star-4" type="radio" name="star" onclick="postToControll();" value="4" />
                                    <label class="star star-4" for="star-4"></label>
                                    <input class="star star-3" id="star-3" type="radio" name="star" onclick="postToControll();" value="3" />
                                    <label class="star star-3" for="star-3"></label>
                                    <input class="star star-2" id="star-2" type="radio" name="star" onclick="postToControll();" value="2" />
                                    <label class="star star-2" for="star-2"></label>
                                    <input class="star star-1" id="star-1" type="radio" name="star" onclick="postToControll();" value="1" />
                                    <label class="star star-1" for="star-1"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="contact-form btn-sub">
                    	<div id="output-msg"></div>
                    	<button type="submit" class="btn btn-default" id="upvote">UPVOTE</button>
                    </div>
                	</form>
                    </div>
                </div>