<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use App\Entity\User;
use App\Slug\SlugGenerator;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Validator\Constraints\Date;

class NewArticleHandler
{

    public $slugGene;
    public $articleStatsLogger;
    public $token;
    /**
     * NewArticleHandler constructor.
     */
    public function __construct(SlugGenerator $slugGenerator, ArticleStatsLogger $articleStatsLogger, TokenStorage $tokenStorage)
    {
        $this->slugGene = $slugGenerator;
        $this->articleStatsLogger = $articleStatsLogger;
        $this->token = $tokenStorage;
    }

    public function handle(Article $article): void
    {

        // Slugify le titre et ajoute l'utilisateur courant comme auteur de l'article
        // Log également un article stat avec pour action create.
        $article->setSlug($this->slugGene->generate($article->getTitle()));
        $article->setAuthor($this->token->getToken()->getUser());
        $article->setCreatedAt(new \DateTime());
        $article->setUpdatedAt(new \DateTime());

        $this->articleStatsLogger->log($article,'CREATE');

    }
}
