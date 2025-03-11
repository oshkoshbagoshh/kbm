<?php

function convertCsvToJson($csvFilePath)
{
    if (!file_exists($csvFilePath) || !is_readable($csvFilePath)) {
        throw new Exception("CSV file does not exist or is not readable.");
    }

    $data = [];
    if (($handle = fopen($csvFilePath, 'r')) !== false) {
        // Get the headers from the first row
        $headers = fgetcsv($handle);
        if ($headers === false) {
            throw new Exception("Failed to read headers from CSV file.");
        }

        // Process each subsequent row as data
        while (($row = fgetcsv($handle)) !== false) {
            $data[] = array_combine($headers, $row);
        }
        fclose($handle);
    }

    // Convert data to JSON
    return json_encode($data, JSON_PRETTY_PRINT);
}

// Example Usage
try {
    $csvFilePath = '/data.csv/'; // Replace with your CSV file path
    $json = convertCsvToJson($csvFilePath);
    echo $json;

    // Optionally save JSON to a file
    file_put_contents('output.json', $json);
    echo "\nJSON saved to output.json\n";
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
