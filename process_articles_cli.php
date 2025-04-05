<?php

use PDO;
use Article;
use Dotenv\Dotenv;



require_once __DIR__ . '/src/helpers/process_articles.php';
require_once __DIR__ . '/src/models/Article.php';
require_once __DIR__ . '/src/models/ArticleList.php';

// Load environment variables
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

// Database connection
try {
    $pdo = new PDO(
        sprintf('pgsql:host=%s;port=%s;dbname=%s', $_ENV['DB_HOST'], $_ENV['DB_PORT'], $_ENV['DB_DATABASE']),
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Process JSON files and get article data
$folderPath = __DIR__ . '/klutch_articles_json';
$results = processArticleFiles($folderPath);

// Extract valid articles and save to database
foreach ($results as $result) {
    if ($result['status'] === 'success') {
        $data = $result['data'];
        $article = new Article($data);

        // Save article to database
        try {
            $stmt = $pdo->prepare('INSERT INTO articles (url, product_category, price, estimated_revenue, rating, email, individual, article_markdown, title, cleaned_product_name, image, video, product_name) VALUES (:url, :product_category, :price, :estimated_revenue, :rating, :email, :individual, :article_markdown, :title, :cleaned_product_name, :image, :video, :product_name)');
            $stmt->execute([
                ':url' => $article->getUrl(),
                ':product_category' => $article->getProductCategory(),
                ':price' => $article->getPrice(),
                ':estimated_revenue' => $article->getEstimatedRevenue(),
                ':rating' => $article->getRating(),
                ':email' => $article->getEmail(),
                ':individual' => $article->getIndividual(),
                ':article_markdown' => $article->getArticleMarkdown(),
                ':title' => $article->getTitle(),
                ':cleaned_product_name' => $article->getCleanedProductName(),
                ':image' => $article->getImage(),
                ':video' => $article->getVideo(),
                ':product_name' => $article->getProductName()
            ]);

            echo 'Article saved: ' . $article->getTitle() . PHP_EOL;

        } catch (PDOException $e) {
            echo 'Failed to save article: ' . $e->getMessage() . PHP_EOL;
        }
    } else {
        echo 'Error processing file: ' . $result['message'] . PHP_EOL;
    }
}