<?php

namespace Oleg\TestBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ArticleAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title');
        $formMapper->add('description');
        $formMapper->add('content');
        $formMapper->add('createdAt');
        $formMapper->add('updatedAt');
        $formMapper->add('category');
        $formMapper->add('slug');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
        $datagridMapper->add('description');
        $datagridMapper->add('content');
        $datagridMapper->add('createdAt');
        $datagridMapper->add('updatedAt');
        $datagridMapper->add('category');
        $datagridMapper->add('slug');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title', null, array('label' => 'Заголовок'));
        $listMapper->add('description');
        $listMapper->add('createdAt');
        $listMapper->add('updatedAt');
        $listMapper->add('category');
        $listMapper->add('slug');
    }
}