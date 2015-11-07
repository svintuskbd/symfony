<?php
/**
 * Description of PortfolioController
 *
 * @author oleg
 */

namespace Oleg\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Oleg\TestBundle\Entity\Post;
use Oleg\TestBundle\Entity\News;
use Oleg\TestBundle\Entity\Category;

class PortfolioController extends Controller 
{    
//    public function portfolioAction() 
//    {
//        $em = $this->getDoctrine()->getEntityManager('doctrine.orm.entity_manager');
//        $data = $em->getRepository('OlegTestBundle:Post')->findAll();
//        $arr = array('portfolio' => $data);
//        return $this->render('OlegTestBundle::portfolio_view.html.twig', $arr);
//    }
    
    public function portfolioAction() 
    {
        $em = $this->getDoctrine()->getEntityManager();
        $category = $em->getRepository('OlegTestBundle:Category')->find(1);
        dump($category->getNews());
        
//        $category = new Category;
//        $article = new News;
//        
//        $category->setTitle('category5')
//                ->setSlug('category5')
//                ->setCreatedAt()
//                ->setUpdatedAt();
//        $em->persist($category);        
//        
//        $article->setTitle('title5')
//                ->setDescription('description5')
//                ->setContent('content5')
//                ->setCreatedAt()
//                ->setCategory($category);
//        $em->persist($article);
//        $em->flush();
        

//        $em = $this->get('doctrine.orm.entity_manager');
//        $data = $em->getRepository('OlegTestBundle:Post')->findAll();
//        $arr = array('portfolio' => $data);
//        $em = $this->get('doctrine.orm.entity_manager');
//        $data = $em->getRepository('OlegTestBundle:News')->getNewsByTitle('title');
//        dump($data);
//        $arr = array('portfolio' => $data);
        return $this->render('OlegTestBundle::portfolio_view.html.twig', array('cat' => $category));
    }
    
    public function viewAction($id = 5)
    {  
        $em = $this->get('doctrine.orm.entity_manager');
        $data = $em->getRepository('OlegTestBundle:Post')->find(7);
//        dump($data);
//        $arr = array('portfolio' => $data);
//        $post = new Post;
//        $post->setTitle('title')
//                ->setDescription('description')
//                ->setContent('content')
//                ->setCreatedAt(new \DateTime);
//        $em->persist($post);
//        $em->flush();
        
        
        $data->setTitle('chenget title');
        $data->setUpdatedAt(new \DateTime('+3 day'));
        $em->persist($data);
        dump($data->getUpdatedAt());
        $em->flush();
        
        return $this->render('OlegTestBundle::single_view.html.twig');
        
    }
    
    public function delAction($id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $data = $em->getRepository('OlegTestBundle:Post')->find($id);
        try {
            $em->remove($data);
            $em->flush();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $product = null;
        }
        
        return $this->redirectToRoute('portfolio');
    }
    
}
