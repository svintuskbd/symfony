<?php

namespace Oleg\TestBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CategoryAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title');
        $formMapper->add('slug');
        $formMapper->add('createdAt');
        $formMapper->add('updatedAt');
        $formMapper->add('news');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
        $datagridMapper->add('slug');
        $datagridMapper->add('createdAt');
        $datagridMapper->add('updatedAt');
        $datagridMapper->add('news');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title', null, array('label' => 'Заголовок'));
        $listMapper->add('slug', null, array('label' => 'Ссылка'));
        $listMapper->add('createdAt', null, array('label' => 'Дата создания'));
        $listMapper->add('updatedAt', null, array('label' => 'Дата обновления'));
        $listMapper->add('news', null, array('label' => 'Связанная новость'));
    }
}