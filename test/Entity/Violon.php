<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-annotation) on 2015-12-06 16:21:37.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Test\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Test\TestBundle\Entity\Base\Violon as BaseViolon;
use Test\TestBundle\Entity\ViolonRepository;

/**
 * Test\TestBundle\Entity\Violon
 *
 * @ORM\Entity(repositoryClass="ViolonRepository")
 */
class Violon extends BaseViolon
{

  /**
   * @ORM\ManyToOne(targetEntity="Test\TestBundle\Entity\Violonist", inversedBy="violons")
   * @ORM\JoinColumn(name="persons_id", referencedColumnName="id", nullable=false)
   */
  protected $violonist;
  
  /**
   * Set Person entity (many to one).
   *
   * @param \Test\TestBundle\Entity\Base\Person $person
   * @return \Test\TestBundle\Entity\Base\Tool
   */
  public function setViolonist(Violonist $violonist = null)
  {
    $this->violonist = $violonist;

    return $this;
  }

  /**
   * Get Person entity (many to one).
   *
   * @return \Test\TestBundle\Entity\Base\Person
   */
  public function getViolonist()
  {
    return $this->violonist;
  }

}