<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use App\Slug\SlugGenerator;

class UpdateArticleHandler
{
    public $slugGene;
    public $artcileS;

    /**
     * NewArticleHandler constructor.
     */
    public function __construct(SlugGenerator $slugGenerator, ArticleStatsLogger $articleStatsLogger)
    {
        $this->slugGene = $slugGenerator;
        $this->artcileS = $articleStatsLogger;
    }
    public function handle(Article $article)
    {
        // Slugify le titre et met à jour la date de mise à jour de l'article
        // Log également un article stat avec pour action update.
        $article->setSlug($this->slugGene->generate($article->getTitle()));
        $article->setUpdatedAt(date("now"));

        $this->artcileS->log($article,'update');
    }
}
