<?php
header('Content-Type: application/json');
require 'db.php';

// Helper function to parse JSON requests
function getRequestBody()
{
    return json_decode(file_get_contents('php://input'), true);
}

// Route handling
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// User login
if ($method === 'POST' && $path === '/api/login') {
    $data = getRequestBody();
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        echo json_encode(['message' => 'Login successful', 'user' => $user]);
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid credentials']);
    }
    exit;
}

// User registration
if ($method === 'POST' && $path === '/api/register') {
    $data = getRequestBody();
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare('INSERT INTO users (email, password) VALUES (?, ?)');
    $stmt->execute([$email, $hashedPassword]);

    echo json_encode(['message' => 'User registered successfully']);
    exit;
}

// Retrieve all blog posts
if ($method === 'GET' && $path === '/api/blog_posts') {
    $stmt = $pdo->query('SELECT * FROM blog_posts');
    $posts = $stmt->fetchAll();
    echo json_encode($posts);
    exit;
}

// Create a new blog post
if ($method === 'POST' && $path === '/api/blog_posts') {
    $data = getRequestBody();
    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';

    $stmt = $pdo->prepare('INSERT INTO blog_posts (title, content) VALUES (?, ?)');
    $stmt->execute([$title, $content]);

    echo json_encode(['message' => 'Blog post created successfully']);
    exit;
}

// Retrieve all products
if ($method === 'GET' && $path === '/api/products') {
    $stmt = $pdo->query('SELECT * FROM products');
    $products = $stmt->fetchAll();
    echo json_encode($products);
    exit;
}

// Generate a new affiliate link
if ($method === 'POST' && $path === '/api/affiliate_links') {
    $data = getRequestBody();
    $productId = $data['product_id'] ?? '';
    $userId = $data['user_id'] ?? '';
    $affiliateLink = "https://example.com/affiliate?product=$productId&user=$userId";

    $stmt = $pdo->prepare('INSERT INTO affiliate_links (product_id, user_id, link) VALUES (?, ?, ?)');
    $stmt->execute([$productId, $userId, $affiliateLink]);

    echo json_encode(['message' => 'Affiliate link generated', 'link' => $affiliateLink]);
    exit;
}

// Default response for undefined routes
http_response_code(404);
echo json_encode(['error' => 'Endpoint not found']);
