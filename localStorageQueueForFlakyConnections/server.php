<?php

if (file_exists('data.json')) {
    $loadedData = json_decode(file_get_contents('data.json'), true);
} else {
    $loadedData = [];
}

if (empty($_POST)) {
    echo '<pre>';
    echo json_encode($loadedData, JSON_PRETTY_PRINT);
    exit;
}

// just every 10th request is successfull
$randomNumber = rand(1, 10);

if ($randomNumber === 1) {
    // work correct
    $availableInputFields = ['a', 'b', 'c', 'd', 'id'];

    $dataToSave = [];
    foreach($availableInputFields as $key) {
        if (isset($_POST[$key])) {
            $dataToSave[$key] = $_POST[$key];
        }

    }

    $loadedData[] = $dataToSave;

    // remove first key if array larger then 10 entries, simple garbage collecting
    if (count($loadedData) > 10) {
        array_shift($loadedData);
    }

    file_put_contents('data.json', json_encode($loadedData, true));

    exit;
}

// take a while for whatever
sleep(3);
// just answer bad
header("HTTP/1.1 500 Internal Server Error");
echo "buuh";
