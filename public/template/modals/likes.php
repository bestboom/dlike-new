<div class="dvd-account-title">
                       <h3>Do You Like this Share?</h3>
                      <p><span>Total Votes:  --  Ratings: </span></p>
                    </div>  
                    <div class="md-account-banner">
                      <div class="row justify-content-center">
                          <div style="height:60px;width:470px;border:1px solid #000;"></div>
                        </div>
                    </div>                    
                    <div class="dvd-account-content">
                    <div class="row">
                    <form action="helper/solve.php" method="post" id="logsubmit">
                        <div class="col-md-6">
                                <div class="row justify-content-center form-group">
                                	<span id="capt"><?php echo solvemedia_get_html("pJG21ZGjcE3uBoChKLz3AFUQTeHgcEir", null, true); ?></span>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="user_label"><b>Enter Some username </b></label>
                                <input type="text" class="form-control" name="likes_user" id="likes_name" value="">
                            </div>
                            <div class="form-group">
                                <label><b>Rate this post if you want</b></label>
                                <input type="hidden" name="myRate" id="myRate1" value="0" />
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
                    	<button type="submit" class="btn btn-default">UPVOTE</button>
                    </div>
                	</form>
                    </div>
                    <div class="modal-likes">
                      	<h3>Rules For Likes</h3>
                    	<div class="row">
                            <ul>
                                <li class="letter"><i class="fas fa-exclamation-triangle"></i>  Self promotion not allowed</li>
                                <li class="letter"><i class="fas fa-exclamation-triangle"></i>  Make sure to upvote quality posts and do not promote spam</li>
                            </ul>
                        </div>
                    </div>
                </div>
