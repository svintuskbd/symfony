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
        $arr = array('portfolio' => array (
            0 => 'title1',
            1 => 'title2',
            2 => 'title3',
            3 => 'title4',
            4 => 'title5',
        ));
        return $this->render('OlegTestBundle::portfolio_view.html.twig', $arr);
    }
    
}
