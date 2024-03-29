                <div class="modal-body ">
                    <div class="transfer-respond">
                        <h4>DELEGATIONS Recieved</h4>
                        <table class='table table-striped table-bordered table-condensed' style="width: 100%">
                            <thead>
                            <tr>
                                <th>From</th>
                                <th>To</th>
                                <th class="amount">Amount</th>
                                <th>Symbol</th>
                                <th>Created</th>
                                <th>Updated</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = ["to" => $user_name, "symbol" => "DLIKER"];
                            $delegations = $_STEEM_ENGINE->get_delegations($query);

                            if ($delegations !== false) {
                                foreach ($delegations as $delegation) {
                                    $updated_safe = isset($delegation->updated) ? $delegation->updated : "";
                                    $created_safe = isset($delegation->created) ? $delegation->created : "";
                                    if ((int)$updated_safe === (int)$created_safe) {
                                        $updated = "";
                                    } else {
                                        $updated = epoch_to_time($delegation->updated);
                                    }
                                    if (!isset($delegation->created)) {
                                        $delegation->created = "";
                                    }
                                    print("<tr><td>$delegation->from</td><td>$delegation->to</td><td>" . (float)$delegation->quantity . "</td><td>$delegation->symbol</td><td data-order='$created_safe'><abbr title='" . epoch_to_time($created_safe, true, true) . "'>" . epoch_to_time($created_safe) . "</abbr></td><td data-order='$updated_safe'><abbr title='" . epoch_to_time($updated_safe, true, true) . "'>$updated</abbr></td></tr>");
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>