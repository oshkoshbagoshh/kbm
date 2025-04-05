<?php

require_once __DIR__ . '/../src/helpers/process_articles.php';
require_once __DIR__ . '/../src/models/ArticleList.php';

// Define the processArticleFiles function
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

// Process JSON files and get article data
$folderPath = __DIR__ . '/../klutch_articles_json';
$results = processArticleFiles($folderPath);

// Extract valid articles
$validArticles = [];
foreach ($results as $result) {
    if ($result['status'] === 'success') {
        $validArticles[] = $result['data'];
    }
    /* The `}` in the PHP code is used to close the opening curly brace `{` that starts a block of code. In
this specific context, the `}` is closing the block of code that contains the foreach loop where
valid articles are being extracted from the results array. This ensures that the code within the
foreach loop is executed for each element in the results array, and the closing curly brace marks
the end of that loop. */
}

// Create ArticleList instance
$articleList = new ArticleList($validArticles);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klutch Articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="my-4">Klutch Articles</h1>
        <?php echo $articleList->renderList(); ?>
    </div>
</body>

</html>