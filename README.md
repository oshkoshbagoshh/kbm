# Klutch Products (WIP)

## Overview

This project is a vanilla PHP application designed to automate the generation of affiliate links and blog posts. The end goal is to have a working website front end using Bootstrap to display all of the articles that have successfully been added to the PostgreSQL database after meeting validation and sanitization.

## Table of Contents

- [Setup](#setup)
- [Directory Structure](#directory-structure)
- [Processing JSON Articles](#processing-json-articles)
- [Form Submission](#form-submission)
- [Displaying Articles](#displaying-articles)
- [API Endpoints](#api-endpoints)
- [Environment Variables](#environment-variables)
- [Running the Project](#running-the-project)

## Setup

1. **Clone the repository**:

   ```sh
   git clone https://github.com/oshkoshbagoshh/klutch-products.git
   cd klutch-products
   ```

2. **Install dependencies**:

   ```sh
   composer install
   ```

3. **Set up environment variables**:
   Copy the `.env.example` file to `.env` and update the necessary values.

   ```sh
   cp .env.example .env
   ```

4. **Set up the database**:
   Ensure you have a PostgreSQL database set up and update the `.env` file with the database credentials.

5. **Run database migrations**:
   ```sh
   php artisan migrate
   ```

## Directory Structure

KBM/
├── klutch*articles_json/
│ ├── B0899YYSXV.json
│ ├── B0D8BM996F.json
│ ├── B0DN1BDR6Y.json
│ ├── B0DPFHHCFF.json
│ ├── data-1741584643332.csv
├── public/
│ └── index.php
├── src/
│ ├── controllers/
│ ├── helpers/
│ │ └── process_articles.php
│ ├── models/
│ │ ├── Article.php
│ │ └── ArticleList.php
├── views/
│ ├── api.php
│ ├── filesubmissionform.php
├── .env
├── .gitignore
├── [composer.json](http://\_vscodecontentref*/0)
├── [composer.lock](http://_vscodecontentref_/1)
├── [jqb.html](http://_vscodecontentref_/2)
├── [KBM.code-workspace](http://_vscodecontentref_/3)
├── Procfile
├── [README.md](http://_vscodecontentref_/4)
└── zzMisc/
├── BlogPostTemplate.md
└── notes.txt

## Processing JSON Articles

```php
<?php
// filepath: /Users/aj/Herd/KBM/src/helpers/process_articles.php
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
```

## Displaying Articles

```php
<?php
// filepath: /Users/aj/Herd/KBM/public/index.php
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
```

## Form Submission

```php
<?php
// filepath: /Users/aj/Herd/KBM/views/filesubmissionform.php
<?php
session_start();

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// HTML form
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo '<form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br>
            <label for="url">URL:</label>
            <input type="url" id="url" name="url" required><br>
            <label for="markdown">Markdown:</label>
            <textarea id="markdown" name="markdown" required></textarea><br>
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required><br>
            <label for="file">File:</label>
            <input type="file" id="file" name="file" required><br>
            <input type="submit" value="Submit">
          </form>';
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token');
    }

    // Handle form submission
    $title = htmlspecialchars($_POST['title']);
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
    $markdown = htmlspecialchars($_POST['markdown']);
    $category = htmlspecialchars($_POST['category']);
    $tags = explode(',', $category); // Split category into tags

    // Validate file
    $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
    if (in_array($_FILES['file']['type'], $allowedTypes) && $_FILES['file']['error'] === 0) {
        $uploadDir = '/uploads/';
        $fileName = uniqid() . '_' . basename($_FILES['file']['name']);
        $uploadFile = $uploadDir . $fileName;

        // Move uploaded file
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            echo 'File successfully uploaded.';
        } else {
            echo 'File upload failed.';
        }
    } else {
        echo 'Invalid file type or upload error.';
    }

    // Additional processing (e.g., save to database)
    // Assuming you have a PDO instance $pdo
    try {
        $pdo = new PDO('mysql:=localhost;dbname=your_database', 'username', 'password');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('INSERT INTO your_table (title, url, markdown, category, file_path) VALUES (:title, :url, :markdown, :category, :file_path)');
        $stmt->execute([
            ':title' => $title,
            ':url' => $url,
            ':markdown' => $markdown,
            ':category' => $category,
            ':file_path' => $uploadFile
        ]);

        echo 'Data successfully saved to the database.';
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
    }
}
```

## API Endpoints

```php
<?php
// filepath: /Users/aj/Herd/KBM/src/models/ArticleList.php
<?php

require_once __DIR__ . '/Article.php';

class ArticleList
{
    private $articles = [];

    public function __construct(array $articleData)
    {
        foreach ($articleData as $data) {
            $this->articles[] = new Article($data);
        }
    }

    // Render the list of articles
    public function renderList()
    {
        $html = "<div class='container'><div class='row'>";
        foreach ($this->articles as $article) {
            $html .= "<div class='col-md-6'>" . $article->renderListItem() . "</div>";
        }
        $html .= "</div></div>";
        return $html;
    }

    // Render a single article
    public function renderArticle($index)
    {
        if (isset($this->articles[$index])) {
            return $this->articles[$index]->renderFullArticle();
        }
        return "<p>Article not found.</p>";
    }
}
```

```php
<?php
// filepath: [api.php](http://_vscodecontentref_/5)
<?php

// Get request headers
$headers = getallheaders();

// Determine the endpoint from the request headers or URL
$endpoint = isset($headers['X-Endpoint']) ? $headers['X-Endpoint'] : 'default';

// Route the request to the appropriate handler
switch ($endpoint) {
    case 'users':
        handleUsersEndpoint();
        break;
    case 'articles':
        handleArticlesEndpoint();
        break;
    case 'influencers':
        handleInfluencersEndpoint();
        break;
    case 'tags':
        handleTagsEndpoint();
        break;
    case 'categories':
        handleCategoriesEndpoint();
        break;
    default:
        handleDefaultEndpoint();
        break;
}

function handleUsersEndpoint()
{
    // Your logic for handling users endpoint
    echo json_encode(['message' => 'Users endpoint']);
}

function handleArticlesEndpoint()
{
    // Your logic for handling articles endpoint
    echo json_encode(['message' => 'Articles endpoint']);
}

function handleInfluencersEndpoint()
{
    // Your logic for handling influencers endpoint
    echo json_encode(['message' => 'Influencers endpoint']);
}

function handleTagsEndpoint()
{
    // Your logic for handling tags endpoint
    echo json_encode(['message' => 'Tags endpoint']);
}

function handleCategoriesEndpoint()
{
    // Your logic for handling categories endpoint
    echo json_encode(['message' => 'Categories endpoint']);
}

function handleDefaultEndpoint()
{
    // Your logic for handling default endpoint
    echo json_encode(['message' => 'Default endpoint']);
}
```
