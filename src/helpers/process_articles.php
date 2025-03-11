<?php

/**
 * Helper function to process all JSON files in a given folder.
 * 
 * @param string $folderPath The path to the folder containing JSON files.
 * @return array An array of results for each processed file.
 */
function processArticleFiles($folderPath)
{
    $results = [];

    // Ensure the folder exists
    if (!is_dir($folderPath)) {
        throw new Exception("The folder path does not exist: $folderPath");
    }

    // Scan the folder for JSON files
    $files = glob($folderPath . '/*.json');

    foreach ($files as $file) {
        $fileName = basename($file);

        try {
            // Read the JSON file
            $jsonContent = file_get_contents($file);

            // Decode the JSON content
            $data = json_decode($jsonContent, true);

            // Check if the JSON is valid
            if (json_last_error() !== JSON_ERROR_NONE) {
                $results[$fileName] = [
                    'status' => 'error',
                    'message' => 'Invalid JSON format',
                ];
                continue;
            }

            // Perform operations on the JSON data (e.g., validation, sanitization)
            $data = sanitizeArticleData($data);

            // Example: Check required fields
            $missingFields = checkRequiredFields($data, ['URL', 'Title', 'Price', 'Rating']);
            if (!empty($missingFields)) {
                $results[$fileName] = [
                    'status' => 'error',
                    'message' => 'Missing required fields: ' . implode(', ', $missingFields),
                ];
                continue;
            }

            // Example: Process the valid data (e.g., save to database or log)
            $results[$fileName] = [
                'status' => 'success',
                'message' => 'File processed successfully',
                'data' => $data, // You can remove this if you don't want to include the processed data in the results
            ];
        } catch (Exception $e) {
            $results[$fileName] = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }

    return $results;
}

/**
 * Sanitize the article data.
 * 
 * @param array $data The article data.
 * @return array The sanitized data.
 */
function sanitizeArticleData($data)
{
    // Example: Trim strings and sanitize URLs
    if (isset($data['URL'])) {
        $data['URL'] = filter_var(trim($data['URL']), FILTER_SANITIZE_URL);
    }

    if (isset($data['Email'])) {
        $data['Email'] = filter_var(trim($data['Email']), FILTER_SANITIZE_EMAIL);
    }

    if (isset($data['Title'])) {
        $data['Title'] = trim($data['Title']);
    }

    if (isset($data['Price'])) {
        $data['Price'] = floatval($data['Price']); // Ensure price is a valid float
    }

    if (isset($data['Rating'])) {
        $data['Rating'] = floatval($data['Rating']); // Ensure rating is a valid float
    }

    return $data;
}

/**
 * Check for missing required fields in the article data.
 * 
 * @param array $data The article data.
 * @param array $requiredFields The list of required fields.
 * @return array The list of missing fields.
 */
function checkRequiredFields($data, $requiredFields)
{
    $missingFields = [];

    foreach ($requiredFields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            $missingFields[] = $field;
        }
    }

    return $missingFields;
}

// Example usage:
try {
    $folderPath = __DIR__ . '/../../klutch_articles_json'; // Adjust the path as needed
    $results = processArticleFiles($folderPath);

    // Print the results
    foreach ($results as $fileName => $result) {
        echo "File: $fileName\n";
        echo "Status: " . $result['status'] . "\n";
        echo "Message: " . $result['message'] . "\n";
        echo str_repeat("-", 20) . "\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
