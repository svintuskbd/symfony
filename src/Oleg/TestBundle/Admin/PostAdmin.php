<?php

namespace Oleg\TestBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PostAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title');
        $formMapper->add('description');
        $formMapper->add('content');
        $formMapper->add('createdAt');
        $formMapper->add('updatedAt');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
        $datagridMapper->add('description');
        $datagridMapper->add('content');
        $datagridMapper->add('createdAt');
        $datagridMapper->add('updatedAt');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title', null, array('label' => 'Заголовок'));
        $listMapper->add('description', null, array('label' => 'Описание'));
        $listMapper->add('content', null, array('label' => 'Содержание'));
        $listMapper->add('createdAt', null, array('label' => 'Дата создания'));
        $listMapper->add('updatedAt', null, array('label' => 'Дата обновления'));
    }
}