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