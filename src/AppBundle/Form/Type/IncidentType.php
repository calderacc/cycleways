<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Incident;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class IncidentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['required' => false])
            ->add('description', TextareaType::class, ['required' => false])
            ->add('polyline', HiddenType::class, ['required' => false])
            ->add('geometryType', HiddenType::class, ['required' => false])
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
            ->add('dateTime', DateTimeType::class,
                [
                    'date_widget' => 'single_text',
                    'model_timezone' => 'UTC',
                    'view_timezone' => 'Europe/Berlin',
                ])
            ->add('visibleFrom', DateType::class,
                [
                    'widget' => 'single_text',
                    'model_timezone' => 'UTC',
                    'view_timezone' => 'Europe/Berlin',
                ])
            ->add('visibleTo',  DateType::class,
                [
                    'widget' => 'single_text',
                    'model_timezone' => 'UTC',
                    'view_timezone' => 'Europe/Berlin',
                ])
            ->add('expires', CheckboxType::class, ['required' => false])
            ->add('street', TextType::class, ['required' => false])
            ->add('houseNumber', TextType::class, ['required' => false])
            ->add('suburb', HiddenType::class, ['required' => false])
            ->add('district', HiddenType::class, ['required' => false])
            ->add('town', HiddenType::class, ['required' => false])
            ->add('village', HiddenType::class, ['required' => false])
            ->add('city', HiddenType::class, ['required' => false])
            ->add('zipCode', HiddenType::class, ['required' => false])
            ->add('streetviewLink', TextType::class, ['required' => false])
            ->add('latitude', HiddenType::class, ['required' => false])
            ->add('longitude', HiddenType::class, ['required' => false])
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
                        'Bahnübergang' => Incident::ACCIDENT_TYPE_RAILROADCROSSING,
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
            ->add('accidentAge', NumberType::class, ['required' => false])
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
        ;
    }

    public function getName()
    {
        return 'incident';
    }
}
