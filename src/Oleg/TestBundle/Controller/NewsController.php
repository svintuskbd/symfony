<?php
/**
 * Description of NewsController
 *
 * @author oleg
 */

namespace Oleg\TestBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    public function indexAction()
    {
        
        return $this->render('OlegTestBundle:News:base_news.html.twig');
    }
}
