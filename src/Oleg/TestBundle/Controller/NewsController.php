<?php


/**
 * Description of NewsController
 *
 * @author oleg
 */

namespace Oleg\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Oleg\TestBundle\Entity\Post;
use Oleg\TestBundle\Entity\News;
use Oleg\TestBundle\Entity\Category;

class NewsController extends Controller
{
    public function newsAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $data = $em->getRepository('OlegTestBundle:News')->getArticle();
        
        return $this->render('OlegTestBundle:News:news_view.html.twig', array('news' => $data));
    }
    
    public function viewAction($slug)
    {  
        $em = $this->get('doctrine.orm.entity_manager');
        $data = $em->getRepository('OlegTestBundle:News')->getNewsBySlug($slug);
        
        return $this->render('OlegTestBundle:News:single_view.html.twig', array('article' => $data));  
    }
    
    public function editArticleAction($slug)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $data = $em->getRepository('OlegTestBundle:News')->getNewsBySlug($slug);
        $category = $em->getRepository('OlegTestBundle:Category')->findAll();
        $request = $this->get('request');
        if($request->get('data')){
            $newsManager = $this->get('news_manager');
            $res = $newsManager->updateArticle($request->get('data'), $slug);
            
            return $this->redirectToRoute('news_index');
        }
        
        return $this->render('OlegTestBundle:News:edit_view.html.twig', array('article' => $data, 'category' => $category));
    }
    
    public function addArticleAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $category = $em->getRepository('OlegTestBundle:Category')->findAll();
        $request = $this->get('request');
        if($request->get('data')){
            $newsManager = $this->get('news_manager');
            $res = $newsManager->createArticle($request->get('data'));
            
            return $this->redirectToRoute('news_index');
        }
        
        return $this->render('OlegTestBundle:News:add_view.html.twig', array('category' => $category));
    }
    
    public function delArticleAction($slug)
    {
        $this->get('news_manager')->delArticle($slug);
        
        return $this->redirectToRoute('news_index');
    }
    
    public function searchArticlesAction()
    {
        $request = $this->get('request');
        if($request->get('search')){
            $em = $this->get('doctrine.orm.entity_manager');
            $data = $em->getRepository('OlegTestBundle:News')->search($request->get('search'));
            dump($data);
            return $this->render('OlegTestBundle:News:search_view.html.twig', array('search' => $data));
        }
        
        return $this->render('OlegTestBundle:News:search_view.html.twig');
    }
}
