<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-annotation) on 2015-12-06 16:59:23.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Test\TestBundle\Entity\Base;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Test\TestBundle\Entity\PersonRepository;

/**
 * Test\TestBundle\Entity\Person
 *
 * @ORM\Entity(repositoryClass="PersonRepository")
 * @ORM\Table(name="persons", indexes={@ORM\Index(name="fk_persons_places_idx", columns={"places_id"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"surgeon":"Test\TestBundle\Entity\Surgeon", "plumber":"Test\TestBundle\Entity\Plumber", "violonist":"Test\TestBundle\Entity\Violonist", "extended":"Test\TestBundle\Entity\Person"})
 */
abstract class Person
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="IDENTITY")
   */
  protected $id;

  /**
   * @ORM\Column(type="integer")
   */
  protected $places_id;

  /**
   * @ORM\Column(type="string", length=45)
   */
  protected $name;

  /**
   * @ORM\OneToMany(targetEntity="Test\TestBundle\Entity\Tool", mappedBy="person")
   * @ORM\JoinColumn(name="id", referencedColumnName="persons_id", nullable=false)
   */
  protected $tools;

  /**
   * @ORM\ManyToOne(targetEntity="Test\TestBundle\Entity\Place", inversedBy="people")
   * @ORM\JoinColumn(name="places_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
   */
  protected $place;

  /**
   * @ORM\ManyToMany(targetEntity="Test\TestBundle\Entity\Skill", inversedBy="people")
   * @ORM\JoinTable(name="persons_has_skills",
   *     joinColumns={@ORM\JoinColumn(name="persons_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")},
   *     inverseJoinColumns={@ORM\JoinColumn(name="skills_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")}
   * )
   */
  protected $skills;

  public function __construct()
  {
    $this->tools = new ArrayCollection();
    $this->skills = new ArrayCollection();
  }

  /**
   * Set the value of id.
   *
   * @param integer $id
   * @return \Test\TestBundle\Entity\Base\Person
   */
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of id.
   *
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of places_id.
   *
   * @param integer $places_id
   * @return \Test\TestBundle\Entity\Base\Person
   */
  public function setPlacesId($places_id)
  {
    $this->places_id = $places_id;

    return $this;
  }

  /**
   * Get the value of places_id.
   *
   * @return integer
   */
  public function getPlacesId()
  {
    return $this->places_id;
  }

  /**
   * Set the value of name.
   *
   * @param string $name
   * @return \Test\TestBundle\Entity\Base\Person
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the value of name.
   *
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Add Tool entity to collection (one to many).
   *
   * @param \Test\TestBundle\Entity\Base\Tool $tool
   * @return \Test\TestBundle\Entity\Base\Person
   */
  public function addTool(Tool $tool)
  {
    $this->tools[] = $tool;

    return $this;
  }

  /**
   * Remove Tool entity from collection (one to many).
   *
   * @param \Test\TestBundle\Entity\Base\Tool $tool
   * @return \Test\TestBundle\Entity\Base\Person
   */
  public function removeTool(Tool $tool)
  {
    $this->tools->removeElement($tool);

    return $this;
  }

  /**
   * Get Tool entity collection (one to many).
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getTools()
  {
    return $this->tools;
  }

  /**
   * Set Place entity (many to one).
   *
   * @param \Test\TestBundle\Entity\Base\Place $place
   * @return \Test\TestBundle\Entity\Base\Person
   */
  public function setPlace(Place $place = null)
  {
    $this->place = $place;

    return $this;
  }

  /**
   * Get Place entity (many to one).
   *
   * @return \Test\TestBundle\Entity\Base\Place
   */
  public function getPlace()
  {
    return $this->place;
  }

  /**
   * Add Skill entity to collection.
   *
   * @param \Test\TestBundle\Entity\Base\Skill $skill
   * @return \Test\TestBundle\Entity\Base\Person
   */
  public function addSkill(Skill $skill)
  {
    $skill->addPerson($this);
    $this->skills[] = $skill;

    return $this;
  }

  /**
   * Remove Skill entity from collection.
   *
   * @param \Test\TestBundle\Entity\Base\Skill $skill
   * @return \Test\TestBundle\Entity\Base\Person
   */
  public function removeSkill(Skill $skill)
  {
    $skill->removePerson($this);
    $this->skills->removeElement($skill);

    return $this;
  }

  /**
   * Get Skill entity collection.
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getSkills()
  {
    return $this->skills;
  }

  public function __sleep()
  {
    return array('id', 'places_id', 'name');
  }
}