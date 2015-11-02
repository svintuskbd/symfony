<?php

namespace Oleg\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{    
    public function testAction()
    {
        $arr = array('home' => array('title' => 'Homepage', 'content' => 'bla bla bla'));
        return $this->render('OlegTestBundle::index_template.html.twig', $arr);
    }
}
