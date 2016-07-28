<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use OC\PlatformBundle\Entity\Animal;

/**
 * @ORM\Entity
 * @ORM\Table(name="oc_animal_reptile")
 */
class Reptile extends Animal
{
	/**
    * @ORM\Column(name="scale", type="string", length=255)
    */
	private $scale;

    /**
     * Set scale
     *
     * @param string $scale
     *
     * @return Reptile
     */
    public function setScale($scale)
    {
        $this->scale = $scale;

        return $this;
    }

    /**
     * Get scale
     *
     * @return string
     */
    public function getScale()
    {
        return $this->scale;
    }
	

    public function hiss(){
		return "Je suis un ".$this->getNom()." et mes écailles sont ".$this->scale;
	}
}
