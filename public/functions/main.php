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