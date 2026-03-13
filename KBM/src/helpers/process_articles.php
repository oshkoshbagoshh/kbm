<?php

function processArticleFiles($folderPath)
{
    $files = scandir($folderPath);
    $results = [];
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
            $filePath = $folderPath . '/' . $file;
            $jsonData = file_get_contents($filePath);
            $data = json_decode($jsonData, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $results[] = ['status' => 'success', 'data' => $data];
            } else {
                $results[] = ['status' => 'error', 'message' => 'Invalid JSON in file: ' . $file];
            }
        }
    }
    return $results;
}