<?php
// Include database connection
require  'data/db.php';


/**
 * Class Influencer
 * Represents an Influencer entity with email, name, bio, and product group.
 */
class Influencer
{
    /**
     * @var string The email of the influencer.
     */
    private $email;

    /**
     * @var string The name of the influencer.
     */
    private $name;

    /**
     * @var string|null The bio of the influencer.
     */
    private $bio;

    /**
     * @var string The product group associated with the influencer.
     */
    private $productGroup;

    /**
     * Influencer constructor.
     *
     * @param string $email The email of the influencer.
     * @param string $name The name of the influencer.
     * @param string|null $bio The bio of the influencer.
     * @param string $productGroup The product group associated with the influencer.
     * @throws Exception If validation fails for any of the parameters.
     */
    public function __construct($email, $name, $bio, $productGroup)
    {
        $this->setEmail($email);
        $this->setName($name);
        $this->setBio($bio);
        $this->setProductGroup($productGroup);
    }

    /**
     * Gets the email of the influencer.
     *
     * @return string The email of the influencer.
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email of the influencer.
     *
     * @param string $email The email to set.
     * @throws Exception If the email is not valid.
     */
    public function setEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = trim($email);
        } else {
            throw new Exception("Invalid email format: $email");
        }
    }

    /**
     * Gets the name of the influencer.
     *
     * @return string The name of the influencer.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name of the influencer.
     *
     * @param string $name The name to set.
     * @throws Exception If the name is not valid.
     */
    public function setName($name)
    {
        if (is_string($name) && strlen(trim($name)) > 0) {
            $this->name = trim($name);
        } else {
            throw new Exception("Invalid name: $name");
        }
    }

    /**
     * Gets the bio of the influencer.
     *
     * @return string|null The bio of the influencer.
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Sets the bio of the influencer.
     *
     * @param string|null $bio The bio to set.
     */
    public function setBio($bio)
    {
        $this->bio = is_string($bio) ? trim($bio) : null;
    }

    /**
     * Gets the product group of the influencer.
     *
     * @return string The product group of the influencer.
     */
    public function getProductGroup()
    {
        return $this->productGroup;
    }

    /**
     * Sets the product group of the influencer.
     *
     * @param string $productGroup The product group to set.
     * @throws Exception If the product group is not valid.
     */
    public function setProductGroup($productGroup)
    {
        if (is_string($productGroup) && strlen(trim($productGroup)) > 0) {
            $this->productGroup = trim($productGroup);
        } else {
            throw new Exception("Invalid product group: $productGroup");
        }
    }

    /**
     * Saves the influencer data to the database.
     *
     * @param PDO $pdo The PDO instance for database interaction.
     * @throws Exception If the database operation fails.
     */
    public function saveToDatabase($pdo)
    {
        $stmt = $pdo->prepare("INSERT INTO influencers (email, name, bio, product_group) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->email, $this->name, $this->bio, $this->productGroup]);
    }
}

/**
 * Processes spreadsheet data and saves each influencer to the database.
 *
 * @param array $articles An array of associative arrays representing influencer data.
 * @param PDO $pdo The PDO instance for database interaction.
 * @return array An array of results indicating success or failure for each influencer.
 */
function processSpreadsheetData($articles, $pdo)
{
    $processed = [];

    foreach ($articles as $article) {
        try {
            // Ensure keys exist and handle missing or malformed data
            $email = $article['email'] ?? null;
            $name = $article['name'] ?? null;
            $bio = $article['bio'] ?? null;
            $productGroup = $article['product_group'] ?? null;

            // Create an Influencer object and save it to the database
            $influencer = new Influencer($email, $name, $bio, $productGroup);
            $influencer->saveToDatabase($pdo);

            $processed[] = [
                'email' => $influencer->getEmail(),
                'name' => $influencer->getName(),
                'status' => 'success'
            ];
        } catch (Exception $e) {
            $processed[] = [
                'email' => $article['email'] ?? 'unknown',
                'name' => $article['name'] ?? 'unknown',
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    return $processed;
}

// Example usage
$articles = [
    [
        "email" => "Janelle.nowroozi@gmail.com",
        "name" => "Janelle",
        "bio" => "Janelle is a 34-year-old mother of a 1-year-old...",
        "product_group" => "Mom_A, Women_A"
    ],
    [
        "email" => "klutchsocialmedia@gmail.com",
        "name" => "Jeff",
        "bio" => "Jeff is a 36-year-old single male living in Milwaukee...",
        "product_group" => "Men_A"
    ],
    [
        "email" => "Michael.nowroozi@pentecost.ai",
        "name" => "Michael",
        "bio" => "Michael Nowroozi is Quia adipisci nihil iure...",
        "product_group" => "Men_A"
    ],
    [
        "email" => "Isvien@me.com",
        "name" => "Isaac",
        "bio" => "Isaac is a 37-year-old single male living in a duplex...",
        "product_group" => "Men_B"
    ]
];

// Process and store the data
$result = processSpreadsheetData($articles, $pdo);

// Output the result
echo json_encode($result, JSON_PRETTY_PRINT);
