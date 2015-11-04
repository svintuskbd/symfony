<?php
/**
 * Description of PortfolioController
 *
 * @author oleg
 */

namespace Oleg\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class PortfolioController extends Controller 
{    
    public function portfolioAction() 
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $data = $em->getRepository('OlegTestBundle:Post')->findAll();
        $arr = array('portfolio' => $data);
        return $this->render('OlegTestBundle::portfolio_view.html.twig', $arr);
    }
    
    public function viewAction($id)
    {
        $url = 'http://128.199.53.5/recipes?page=1&per_page=1&api_key=33608dcc73018d51a896cfb5d1e386f8';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        $response = curl_exec($curl);
        curl_close($curl);
        $content = json_decode($response, true);
//        dump($content);
        
        
        
        $em = $this->get('doctrine.orm.entity_manager');
        $data = $em->getRepository('OlegTestBundle:Post')->find($id);
        $arr = array('portfolio' => $data, 'content' => $content);
        return $this->render('OlegTestBundle::single_view.html.twig', $arr);
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
