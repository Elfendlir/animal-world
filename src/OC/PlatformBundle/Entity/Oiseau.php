<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use OC\PlatformBundle\Entity\Animal;
/**
 * @ORM\Entity
 * @ORM\Table(name="oc_animal_oiseau")
 */
class Oiseau extends Animal
{
	/**
	* @ORM\Column(name="feathers", type="string", length=255)
	*/
	private $feathers;

    /**
     * Set feathers
     *
     * @param string $feathers
     *
     * @return Oiseau
     */
    public function setFeathers($feathers)
    {
        $this->feathers = $feathers;

        return $this;
    }

    /**
     * Get feathers
     *
     * @return string
     */
    public function getFeathers()
    {
        return $this->feathers;
    }
	
	public function tweet(){
		return "Je suis un ".$this->getNom()." et mon plumage est ".$this->feathers;
	}
}
