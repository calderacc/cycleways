<?php

namespace Caldera\Bundle\CyclewaysBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="incident_tag")
 * @ORM\Entity()
 */
class IncidentTag
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Caldera\Bundle\CalderaBundle\Entity\Incident")
     * @ORM\JoinTable(name="incident_incident_tag",
     *      joinColumns={@ORM\JoinColumn(name="incident_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     */
    protected $incidents;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @ORM\Column(name="font_color", type="string", length=255, nullable=true)
     */
    protected $fontColor;

    /**
     * @ORM\Column(name="background_color", type="string", length=255, nullable=true)
     */
    protected $backgroundColor;

    public function __construct()
    {
        $this->incidents = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
