<?php
session_start();

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/**========================================================================
 *                             Form 
 *  
 *   - form submission to allow uploading of files 
 *   - validate file type, duplicates, etc.
 * - sanitize output
 * - CSRF ,
 *  - Sql injection 
 * -  save to /uploads folder , and rename the file
 *   - Required: Title, URL,  markdown, category needs to be split into tags
fallback user in case there isn’t one
 *  
 *========================================================================**/

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
        $pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
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
