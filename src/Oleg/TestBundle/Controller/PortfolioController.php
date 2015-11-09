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
//        $em = $this->getDoctrine()->getEntityManager();
//        $category = $em->getRepository('OlegTestBundle:Category')->find(1);
//        dump($category->getNews());
        
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
        

        $em = $this->get('doctrine.orm.entity_manager');
        $data = $em->getRepository('OlegTestBundle:Post')->findAll();
//        $em = $this->get('doctrine.orm.entity_manager');
//        $data = $em->getRepository('OlegTestBundle:News')->getNewsByTitle('title');
//        $arr = array('portfolio' => $data);
        return $this->render('OlegTestBundle::portfolio_view.html.twig', array('portfolio' => $data));
    }
    
    public function addCategory()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        
        $category = new Category;
        $category->setSlug()
                ->setDescription()
                ->setCreatedAt()
                ->setUpdatedAt();
        $em->persist($category);
        $em->flush();
            
    }
    
    public function viewAction($id)
    {  
        $em = $this->get('doctrine.orm.entity_manager');
        
        $data = $em->getRepository('OlegTestBundle:Post')->find($id);
//      Create Article
//        $post = new Post;
//        $post->setTitle('title')
//                ->setDescription('description')
//                ->setContent('content')
//                ->setCreatedAt(new \DateTime);
//        $em->persist($post);
//        $em->flush();
        
        
        return $this->render('OlegTestBundle::single_view.html.twig', array('portfolio' => $data));  
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
