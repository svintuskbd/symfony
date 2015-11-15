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
        $data = $em->getRepository('OlegTestBundle:News')->findBy(array(), array('id' => 'DESC'));
        
        dump($data);

        return $this->render('OlegTestBundle:News:news_view.html.twig', array('news' => $data));
    }
    
    public function viewAction($slug)
    {  
        $em = $this->get('doctrine.orm.entity_manager');
        $data = $em->getRepository('OlegTestBundle:News')->getNewsBySlug($slug);
//        $data = $em->getRepository('OlegTestBundle:News')->findOneBySlug($slug);
//        dump($data->getCategory());
        
        return $this->render('OlegTestBundle:News:single_view.html.twig', array('article' => $data));  
    }
    
    public function editArticleAction($slug)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $data = $em->getRepository('OlegTestBundle:News')->getNewsBySlug($slug);
        
        
        return $this->render('OlegTestBundle:News:edit_view.html.twig', array('article' => $data));
    }
    
    public function addArticleAction($post = null)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $data = $em->getRepository('OlegTestBundle:Category')->findAll();
        $newsManager = $this->get('news_manager');
        $request = $this->get('request');
        if($request->get('data')){
            $res = $newsManager->createArticle($request->get('data'));
            return $this->redirectToRoute('news_index');
        }
        
        return $this->render('OlegTestBundle:News:add_view.html.twig', array('category' => $data));
    }
    
    public function delArticleAction($slug)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $data = $em->getRepository('OlegTestBundle:News')->findOneBySlug($slug);
        try {
            $em->remove($data);
            $em->flush();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $product = null;
        }
        
        return $this->redirectToRoute('news_index');
    }
}
