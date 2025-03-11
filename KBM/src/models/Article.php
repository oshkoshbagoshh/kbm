<?php

class Article
{
    private $url;
    private $productCategory;
    private $price;
    private $estimatedRevenue;
    private $rating;
    private $email;
    private $individual;
    private $articleMarkdown;
    private $title;
    private $cleanedProductName;
    private $image;
    private $video;
    private $productName;

    public function __construct(array $data)
    {
        $this->url = $data['URL'] ?? '';
        $this->productCategory = $data['Product Category'] ?? '';
        $this->price = $data['Price'] ?? 0.0;
        $this->estimatedRevenue = $data['Estimated Revenue'] ?? 0.0;
        $this->rating = $data['Rating'] ?? 0.0;
        $this->email = $data['Email'] ?? '';
        $this->individual = $data['Individual'] ?? '';
        $this->articleMarkdown = $data['Article Markdown'] ?? '';
        $this->title = $data['Title'] ?? '';
        $this->cleanedProductName = $data['Cleaned Product Name'] ?? '';
        $this->image = $data['Image'] ?? '';
        $this->video = $data['Video'] ?? '';
        $this->productName = $data['Product Name'] ?? '';
    }

    // Render the article as a Bootstrap list item
    public function renderListItem()
    {
        return "
            <div class='card mb-3'>
                <div class='row g-0'>
                    <div class='col-md-4'>
                        <img src='{$this->image}' class='img-fluid rounded-start' alt='{$this->cleanedProductName}'>
                    </div>
                    <div class='col-md-8'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$this->title}</h5>
                            <p class='card-text'><small class='text-muted'>Category: {$this->productCategory}</small></p>
                            <p class='card-text'><strong>Price:</strong> \${$this->price}</p>
                            <p class='card-text'><strong>Rating:</strong> {$this->rating} stars</p>
                            <a href='{$this->url}' class='btn btn-primary' target='_blank'>View Product</a>
                        </div>
                    </div>
                </div>
            </div>
        ";
    }

    // Render the full article
    public function renderFullArticle()
    {
        return "
            <div class='container'>
                <div class='row'>
                    <div class='col-md-12'>
                        <h1>{$this->title}</h1>
                        <img src='{$this->image}' class='img-fluid mb-3' alt='{$this->cleanedProductName}'>
                        <p><strong>Price:</strong> \${$this->price}</p>
                        <p><strong>Rating:</strong> {$this->rating} stars</p>
                        <p><strong>Category:</strong> {$this->productCategory}</p>
                        <p>{$this->articleMarkdown}</p>
                        <a href='{$this->url}' class='btn btn-primary' target='_blank'>Buy Now</a>
                    </div>
                </div>
            </div>
        ";
    }
}
