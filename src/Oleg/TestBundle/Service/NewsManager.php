<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NewsManager
 *
 * @author oleg
 */
namespace Oleg\TestBundle\Service;

use Oleg\TestBundle\Entity\News;

class NewsManager 
{
    private $serviceConteiner;
    
    public function __construct($service)
    {
        $this->serviceConteiner = $service;
    }
    
    /*
     * Create article
     * @param array $data
     * @param Category $category
     * 
     * @return Article
     */
    public function createArticle($data, \Oleg\TestBundle\Entity\Category $category=null)
    {
        $em = $this->getEm();
        $news = new News;
        if (isset($data['title']) && $data['title'])
        {
            $news->setTitle($data['title']);
        }
        if (isset($data['txt']) && $data['txt'])
        {
            $news->setContent($data['txt']);
        }
        if (isset($data['description']) && $data['description'])
        {
            $news->setDescription($data['description']);
        } else {
            $news->setDescription($this->cropText($data['txt']));
        }
        if (isset($data['url']) && $data['url'])
        {
            $news->setSlug($this->transliteration($data['url']));
        } else {
            $news->setSlug($this->transliteration($data['title']));
        }
        if(isset($data['category']) && $data['category']){
            $category = $em->getRepository('OlegTestBundle:Category')
                    ->findOneBySlug($data['category']);
            $news->setCategory($category);
        }
        $news->setCreatedAt();
        
        return $this->save($news);
                
    }
    
    private function getEm()
    {
        return $this->serviceConteiner->get('doctrine.orm.entity_manager');
        
    }
    
    /*
     * translit string
     * @param string $str
     * @return string
     */
    private function transliteration($str)
    {
        $st = strtr($str, 
            array(
                'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d',
                'е'=>'e','ё'=>'e','ж'=>'zh','з'=>'z','и'=>'i',
                'к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o',
                'п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u',
                'ф'=>'ph','х'=>'h','ы'=>'y','э'=>'e','ь'=>'',
                'ъ'=>'','й'=>'y','ц'=>'c','ч'=>'ch', 'ш'=>'sh',
                'щ'=>'sh','ю'=>'yu','я'=>'ya',' '=>'_'
            )
        );
        $st2 = strtr($st, 
            array(
                'А'=>'a','Б'=>'b','В'=>'v','Г'=>'g','Д'=>'d',
                'Е'=>'e','Ё'=>'e','Ж'=>'zh','З'=>'z','И'=>'i',
                'К'=>'k','Л'=>'l','М'=>'m','Н'=>'n','О'=>'o',
                'П'=>'p','Р'=>'r','С'=>'s','Т'=>'t','У'=>'u',
                'Ф'=>'ph','Х'=>'h','Ы'=>'y','Э'=>'e','Ь'=>'',
                'Ъ'=>'','Й'=>'y','Ц'=>'c','Ч'=>'ch', 'Ш'=>'sh',
                'Щ'=>'sh','Ю'=>'yu','Я'=>'ya'
            )
        );
        $translit = $st2;
        
        return $translit;
    }
    
    /*
     * crop text
     * @param string $str
     * @param int optional $quantiti
     * @param string optional $end
     * return string
     */
    private function cropText($str, $quantity = 50, $end = '...')
    {
        return mb_substr($str, 0, $quantity, 'utf-8').$end;
    }

    /*
     * save article
     * @param object $obj
     * @return object
     */
    private function save($obj)
    {
        $em = $this->getEm();
        $em->persist($obj);
        $em->flush();
        
        return $obj;
    }
}
