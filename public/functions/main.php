<?php
function genBeneficiaries($tring)
{
    $arr_str = explode(",", $tring);
    $beneficiaries = [];
    if (!($arr_str === null or $arr_str === [""])) {
        foreach ($arr_str as $tr) {
            $xpld = explode(":", $tr);
            $weight = (float)$xpld[1] * 100;
            $weight = (int)$weight;
            $beneficiary =
                [
                    "account" => $xpld[0],
                    "weight" => $weight
                ];
            $beneficiaries[] = $beneficiary;
        }
    }
    return $beneficiaries;
}



function getMaxPayout($user_status, $user_score) {
    $max_accepted_payout = 300;
    switch($user_status) {
        case "elite":
            $max_accepted_payout = 990;
            break;
        case "blacklisted":
            $max_accepted_payout = 300;
            break;
        case "normal":
            if ($user_score <= 3)
                $max_accepted_payout = 300;
            elseif ($user_score > 3 && $user_score <= 4)
                $max_accepted_payout = 400;
            elseif ($user_score > 4 && $user_score <= 5)
                $max_accepted_payout = 500;
            elseif ($user_score > 5 && $user_score <= 6)
                $max_accepted_payout = 600;
            elseif ($user_score > 6 && $user_score <= 7)
                $max_accepted_payout = 700;
            elseif ($user_score > 7 && $user_score <= 10)
                $max_accepted_payout = 990;
            else
                $max_accepted_payout = 300;
            break;
        default:
            $max_accepted_payout = 300;
    }
    return $max_accepted_payout;
}


function clean($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    $string = str_replace('--', '-', $string); // Replaces all spaces with hyphens.
    return strtolower($string);
}


function validationData($data)
{
    $data = htmlspecialchars(strip_tags(nl2br(trim($data))));
    return $data;
}

?>