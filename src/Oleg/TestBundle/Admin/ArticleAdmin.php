<?php

namespace Oleg\TestBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ArticleAdmin extends Admin
{
    protected $datagridValues = array(

        // display the first page (default = 1)
        '_page' => 1,

        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',

        // name of the ordered field (default = the model's id field, if any)
        '_sort_by' => 'updatedAt',
    );
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Новая новость', array('class' => 'col-md-9'))
                ->add('title')
                ->add('description', 'textarea', array('required' => false))
                ->add('content', 'textarea')
                ->add('createdAt', 'sonata_type_datetime_picker', array(
                        'required' => false,
                        'dp_language' => 'en',
                        'format' => 'dd.MM.yyyy, HH:mm',
                        'attr' => array(
                            'data-date-format' => 'DD.MM.YYYY, HH:mm',
                        )))
                ->add('updatedAt', 'sonata_type_datetime_picker', array(
                        'required' => false,
                        'dp_language' => 'en',
                        'format' => 'dd.MM.yyyy, HH:mm',
                        'attr' => array(
                            'data-date-format' => 'DD.MM.YYYY, HH:mm',
                        )))
                ->add('slug', null, array('required' => false))
            ->end()
                
            ->with('Категории', array('class' => 'col-md-3'))
                ->add('category')
                ->add('category', 'sonata_type_model', array(
                    'class' => 'Oleg\TestBundle\Entity\Category',
                    'property' => 'title',
                ))
            ->end();
        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
        $datagridMapper->add('description');
        $datagridMapper->add('content');
        $datagridMapper->add('createdAt', 'doctrine_orm_date_range', array(
                'field_type' => 'sonata_type_date_range_picker',
            ));
        $datagridMapper->add('updatedAt', 'doctrine_orm_date_range', array(
                'field_type' => 'sonata_type_date_range_picker',
            ));
        $datagridMapper->add('category');
        $datagridMapper->add('slug');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title', null, array('label' => 'Заголовок'))
                    ->add('draft');
        $listMapper->add('description', null, array('label' => 'Описание'));
        $listMapper->add('createdAt', null, array('label' => 'Дата создания'));
        $listMapper->add('updatedAt', null, array('label' => 'Дата обновления'));
        $listMapper->add('category', null, array('label' => 'Связанная категория'));
        $listMapper->add('slug', null, array('label' => 'Ссылка'));
    }
    
    public function toString($object)
    {
        return $object instanceof \Oleg\TestBundle\Entity\News
            ? $object->getTitle()
            : 'Blog Post'; // shown in the breadcrumb on the create view
    }
}