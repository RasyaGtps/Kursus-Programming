<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json = file_get_contents("php://input");

    $formData = json_decode($json, true);

    if (!filter_var($formData['mail'], FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address. Data not saved.";
        exit;
    }

    $file = '../contact.json';
    $existingData = file_get_contents($file);
    $existingDataArray = json_decode($existingData, true);

    if (!$existingDataArray) {
        $existingDataArray = [];
    }

    $existingDataArray[] = $formData;

    file_put_contents($file, json_encode($existingDataArray));
    echo "Data saved successfully.";
} else {
    echo "Invalid request method.";
}
?>
