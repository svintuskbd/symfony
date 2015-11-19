<?php

namespace Oleg\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AjaxController extends Controller
{
    public function testAjaxAction() 
    {
        
        return $this->render('OlegTestBundle:News:ajax_view.html.twig');
    }
    
    public function ajaxAction()
    {
        
        return new JsonResponse(
            [
            'data' => 'Privet'
        ]); 
    }
}
