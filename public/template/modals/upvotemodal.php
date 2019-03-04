                                                <div class="modal-body">
                                                    <div class="container">
                                                        <div class="row d-flex justify-content-around">
                                                            <form action="helper/vote.php" method="POST">
                                                                <input type="text" name="v_author" id="vote_author" value="" />
                                                                <input type="text" name="v_permlink" id="vote_permlink" value="" />
                                                                <input type="text" name="vote_value" id="vote_weight" value="" />
                                                            <div class="col-sm-2 nopadding"><button><i class="fas fa-chevron-circle-up upme"></i></button></div>    
                                                            <div class="col-sm-8 nopadding">
                                                                <div class="row d-flex justify-content-around">
                                                                    <div class="col-sm-9"><input id="rs-range-line" class="rs-range" type="range" value="0" min="0" max="100"></div>
                                                                    <div class="col-sm-2 nopadding"><span id="rs-bullet" class="rs-label">0</span></div>
                                                                </div>                                       
                                                            </div>
                                                            <div class="col-sm-2 nopadding">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
                                                            </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>