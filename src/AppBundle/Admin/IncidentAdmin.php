<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Incident;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
            ->add('incidentType', ChoiceType::class,
                [
                    'choices' => [
                        'Road Rage' => Incident::INCIDENT_RAGE,
                        'Gefahrenstelle' => Incident::INCIDENT_DANGER,
                        'Arbeitsstelle' => Incident::INCIDENT_ROADWORKS,
                        'Unfall' => Incident::INCIDENT_ACCIDENT,
                        'Tödlicher Unfall' => Incident::INCIDENT_DEADLY_ACCIDENT,
                        'Polizeikontrolle' => Incident::INCIDENT_POLICE,
                        'schlechte Infrastruktur' => Incident::INCIDENT_INFRASTRUCTURE
                    ]
                ]
            )
            ->add('dangerLevel', ChoiceType::class,
                [
                    'choices' => [
                        'ungefährlich' => Incident::DANGER_LEVEL_NONE,
                        'niedrig' => Incident::DANGER_LEVEL_LOW,
                        'normal' => Incident::DANGER_LEVEL_NORMAL,
                        'hoch' => Incident::DANGER_LEVEL_HIGH
                    ]
                ]
            )
            ->end()

            ->with('Nutzer', ['class' => 'col-md-6'])
            ->add('user', EntityType::class, [
                'class' => 'AppBundle\Entity\User'
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

            ->with('Unfalldaten', ['class' => 'col-md-6'])
            ->add('accidentType', ChoiceType::class,
                [
                    'choices' => [
                        '' => null,
                        'unbekannt' => Incident::ACCIDENT_TYPE_UNKNOWN,
                        'Alleinunfall' => Incident::ACCIDENT_TYPE_SOLO,
                        'Querung der Straße' => Incident::ACCIDENT_TYPE_CROSSING,
                        'Vorfahrtsverstoß' => Incident::ACCIDENT_TYPE_RIGHTOFWAY,
                        'Rotlichtverstoß' => Incident::ACCIDENT_TYPE_REDLIGHT,
                        'Abbiegeunfall' => Incident::ACCIDENT_TYPE_RIGHTTURN,
                        'Frontalzusammenstoß' => Incident::ACCIDENT_TYPE_FRONTAL,
                        'Überholmanöver' => Incident::ACCIDENT_TYPE_OVERTAKE,
                        'Rammen' => Incident::ACCIDENT_TYPE_RAM,
                        'Einfahren' => Incident::ACCIDENT_TYPE_PULLIN,
                        'Dooring' => Incident::ACCIDENT_TYPE_DOORING,
                    ]
                ]
            )
            ->add('accidentLocation', ChoiceType::class,
                [
                    'choices' => [
                        '' => null,
                        'innerorts' => Incident::ACCIDENT_LOCATION_CITY,
                        'außerorts' => Incident::ACCIDENT_LOCATION_LAND,
                    ]
                ]
            )
            ->add('accidentInfrastructure', ChoiceType::class,
                [
                    'choices' => [
                        '' => null,
                        'Fahrbahn' => Incident::ACCIDENT_INFRASTRUCTURE_ROAD,
                        'Radweg' => Incident::ACCIDENT_INFRASTRUCTURE_CYCLEPATH,
                        'Gehweg' => Incident::ACCIDENT_INFRASTRUCTURE_SIDEWALK,
                        'freigegebener Gehweg' => Incident::ACCIDENT_INFRASTRUCTURE_FREEDSIDEWALK,
                        'gemeinsamer Fuß- und Radweg' => Incident::ACCIDENT_INFRASTRUCTURE_COMBINED,
                        'Radfahrstreifen' => Incident::ACCIDENT_INFRASTRUCTURE_RADFAHRSTREIFEN,
                        'Schutzstreifen' => Incident::ACCIDENT_INFRASTRUCTURE_SCHUTZSTREIFEN,
                        'Fahrradstraße' => Incident::ACCIDENT_INFRASTRUCTURE_FAHRRADSTRASSE,
                        'abseits der Straße' => Incident::ACCIDENT_INFRASTRUCTURE_OTHER,
                    ]
                ]
            )
            ->add('accidentOpponent', ChoiceType::class,
                [
                    'choices' => [
                        '' => null,
                        'Fußgänger' => Incident::ACCIDENT_OPPONENT_PEDESTRIAN,
                        'Fahrradfahrer' => Incident::ACCIDENT_OPPONENT_CYCLIST,
                        'Motorradfahrer' => Incident::ACCIDENT_OPPONENT_MOTORCYCLE,
                        'Personenkraftwagen' => Incident::ACCIDENT_OPPONENT_CAR,
                        'Lastkraftwagen' => Incident::ACCIDENT_OPPONENT_TRUCK,
                        'Traktor oder landwirtschaftliches Fahrzeug' => Incident::ACCIDENT_OPPONENT_TRACTOR,
                        'Eisenbahn' => Incident::ACCIDENT_OPPONENT_TRAIN,
                        'Straßenbahn' => Incident::ACCIDENT_OPPONENT_TRAM,
                        'Tier, Haustier' => Incident::ACCIDENT_OPPONENT_ANIMAL,
                        'keiner / Alleinunfall' => Incident::ACCIDENT_OPPONENT_NONE,
                        'unbekannt' => Incident::ACCIDENT_OPPONENT_UNKNOWN,
                    ]
                ])
            ->add('accidentSex', ChoiceType::class,
                [
                    'choices' => [
                        '' => null,
                        'männlich' => Incident::ACCIDENT_SEX_MALE,
                        'weiblich' => Incident::ACCIDENT_SEX_FEMALE,
                    ]
                ]
            )
            ->add('accidentAge', NumberType::class)
            ->add('accidentPedelec', ChoiceType::class,
                [
                    'choices' => [
                        'unbekannt' => null,
                        'ja' => true,
                        'nein' => false,
                    ]
                ]
            )
            ->add('accidentHelmet', ChoiceType::class,
                [
                    'choices' => [
                        'unbekannt' => null,
                        'ja' => true,
                        'nein' => false,
                    ]
                ]
            )
            ->add('accidentCyclistCaused', ChoiceType::class,
                [
                    'choices' => [
                        'unbekannt' => null,
                        'ja' => true,
                        'nein' => false,
                    ]
                ]
            )
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
