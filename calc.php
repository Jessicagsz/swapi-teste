<?php
session_start();

$val = null;

if (isset($_POST['mglt_value'])) {
    $val = $_POST['mglt_value'];
    $data = returnCalc($val);
    $_SESSION['results'] = $data;
}

header("Location: index.php");
exit();



function getStarships()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://swapi.dev/api/starships',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);
}


function returnCalc($getMlgtValue)
{
    $starship_mlgt = getStarships();
    $starships = [];
    if (isset($starship_mlgt) || $starship_mlgt != '') { //quando a API Swapi estiver no ar
        $starships = $starship_mlgt->results;
    } else { //quando a API SWAPI não estiver no ar
        $file = file_get_contents('extras/files/starships.json');
        $starships = json_decode($file, false);
    }

    $obj = new stdClass();
    $a = [];
    foreach ($starships as $starship) {
        $obj->name = $starship->name;
        $calc1 = intval($getMlgtValue) / intval($starship->MGLT);
        $calc2 = getDate1($starship->consumables);
        if (isset($calc2)) {
            $calc3 = $calc1 / $calc2;
            $a[] = $starship->name . '%' . intval($calc3);
        }
    }

    return $a;
}


function getDate1($consumables)
{
    $day = 24;
    $week = 168;
    $month = 720;
    $year = 8760;
    $val = 0;
    $consumable_int = explode(" ", $consumables)[0];

    if (str_contains($consumables, "day")) {
        $val = $consumable_int * $day;
    }
    if (str_contains($consumables, "week")) {
        $val = $consumable_int * $week;
    }
    if (str_contains($consumables, "month")) {
        $val = $consumable_int * $month;
    }
    if (str_contains($consumables, "year")) {
        $val = $consumable_int * $year;
    }

    return intval($val);
}
