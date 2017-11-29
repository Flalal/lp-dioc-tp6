<?php

namespace App\Article;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManagerInterface;

class ArticleFetcher
{

    public $em;
    public $limite;
    /**
     * ArticleFetcher constructor.
     */
    public function __construct(EntityManagerInterface $em, $limite)
    {
        $this->limite = $limite;
        $this->em = $em;
    }

    public function fetch() : array
    {
        // Retourne les 10 derniers articles.
        // La limit (ici 10) doit provenir d'une variable d'env.

        $articles[]= $this->em->getRepository(Article::class)->findBy(array(),['createdAt'=>'desc'],$this->limite);

        return $articles;
    }
}
