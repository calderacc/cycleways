<?php

namespace Caldera\Bundle\CyclewaysBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class IncidentAdmin extends AbstractAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Beschreibung', ['class' => 'col-md-6'])
            ->add('title', TextType::class, [
                'label' => 'Titel'
            ])
            ->add('description', TextareaType::class)
            ->add('enabled', CheckboxType::class)
            ->end()

            ->with('Typ', ['class' => 'col-md-6'])
            ->add('incidentType', TextType::class)
            ->add('dangerLevel', TextType::class)
            ->end()

            ->with('Nutzer', ['class' => 'col-md-6'])
            ->add('user', EntityType::class, [
                'class' => 'Caldera\Bundle\CyclewaysBundle\Entity\User'
            ])
            ->end()

            ->with('Adresse', ['class' => 'col-md-6'])
            ->add('street', TextType::class)
            ->add('houseNumber', TextType::class)
            ->add('zipCode', TextType::class)
            ->add('suburb', TextType::class)
            ->add('district', TextType::class)
            ->add('town', TextType::class)
            ->add('village', TextType::class)
            ->add('city', TextType::class)
            ->end()

            ->with('Nutzer', ['class' => 'col-md-6'])
            ->add('slug', TextType::class)
            ->add('permalink', TextType::class)
            ->end()

            ->with('Nutzer', ['class' => 'col-md-6'])
            ->add('latitude', TextType::class)
            ->add('longitude', TextType::class)
            ->add('polyline', TextType::class)
            ->add('geometryType', TextType::class)
            ->end()

            ->with('Datum', ['class' => 'col-md-6'])
            ->add('dateTime', DateTimeType::class)
            ->add('creationDateTime', DateTimeType::class)
            ->add('expires', CheckboxType::class)
            ->add('visibleFrom', DateTimeType::class)
            ->add('visibleTo', DateTimeType::class)
            ->end()
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('user')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('user')
        ;
    }

    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('slug')
            ->add('user')
        ;
    }
}
