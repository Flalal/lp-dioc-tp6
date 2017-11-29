<?php

namespace App\Controller;

use App\Article\ArticleFetcher;
use App\Article\CountViewUpdater;
use App\Article\NewArticleHandler;
use App\Article\UpdateArticleHandler;
use App\Article\ViewArticleHandler;
use App\Entity\Article;
use App\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(path="/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route(path="/show/{slug}", name="article_show")
     */
    public function showAction(ViewArticleHandler $viewArticleHandler)
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        return $this->render('Article/show.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route(path="/new", name="article_new")
     */
    public function newAction(Request $request)
    {
        // Seul les auteurs doivent avoir access.
      //  if ($this->getUser()->isAuthor()) {

            $form = $this->createForm(ArticleType::class);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $articleF = new ArticleFetcher();
                $article = $form->getData();


                $manager->persist($article);
                $manager->flush();

                return $this->render('Article/new.html.twig', ['form' => $form->createView()]);
            }
       // }
        return $this->redirect($this->redirectToRoute("homepage"));



    }

    /**
     * @Route(path="/update/{slug}", name="article_update")
     */
    public function updateAction(UpdateArticleHandler $updateArticleHandler)
    {
        // Seul les auteurs doivent avoir access.
        // Seul l'auteur de l'article peut le modifier


    }
}
