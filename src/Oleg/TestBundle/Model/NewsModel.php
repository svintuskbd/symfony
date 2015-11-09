<?php

/**
 * Description of NewsModel
 *
 * @author oleg
 */

namespace Oleg\TestBundle\Model;

class NewsModel 
{
    public function readPost()
    {
        $postResult = [];
        $postResult['title'] = $_POST['title'];
        $postResult['content'] = $_POST['txt'];
        if (!empty($_POST['description'])){
            $postResult['description'] = $_POST['description'];
        } else {
            $postResult['description'] = mb_substr($postResult['content'], 0, 50, 'utf-8').'...';
        }
        if(empty($_POST['url'])){
            $st = strtr($_POST['title'], 
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
            $postResult['url'] = $st2;
        } else {
            $postResult['url'] = $_POST['url'];
        }
        if(!empty($_POST['category'])){
            $postResult['category'] = $_POST['category'];
        } else {
            $postResult['category'] = null;
        }
        
        return $postResult;
    }
}
