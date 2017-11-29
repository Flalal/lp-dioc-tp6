<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\User;
use App\Slug\SlugGenerator;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class CountViewUpdater
{
    public $token;

    /**
     * CountViewUpdater constructor.
     */
    public function __construct(TokenStorage $tokenStorage, SlugGenerator $slugGenerator)
    {
        $this->token = $tokenStorage;
    }

    public function update(Article $article): void
    {
        // Incremente le compteur de vue, sauf si l'utilisareur courant est également l'auteur de l'article.
        if($article->getAuthor() === $this->token->getToken()->getUser()) {
            return;
        }
        $article->setCountView($article->getCountView()+1);
    }
}
