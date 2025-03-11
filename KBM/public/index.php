<?php

require_once __DIR__ . '/../src/helpers/process_articles.php';
require_once __DIR__ . '/../src/models/ArticleList.php';

// Process JSON files and get article data
$folderPath = __DIR__ . '/../klutch_articles_json';
$results = processArticleFiles($folderPath);

// Extract valid articles
$validArticles = [];
foreach ($results as $result) {
    if ($result['status'] === 'success') {
        $validArticles[] = $result['data'];
    }
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