<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use OC\PlatformBundle\Entity\Animal;

/**
 * @ORM\Entity
 * @ORM\Table(name="oc_animal_mammifere")
 */
class Mammifere extends Animal
{
	/**
	* @ORM\Column(name="fur", type="string", length=255)
	*/
	private $fur;

    /**
     * Set fur
     *
     * @param string $fur
     *
     * @return Mammifere
     */
    public function setFur($fur)
    {
        $this->fur = $fur;

        return $this;
    }

    /**
     * Get fur
     *
     * @return string
     */
    public function getFur()
    {
        return $this->fur;
    }
	
	public function growl(){
		return "Je suis un ".$this->getNom()." et ma fourrure est ".$this->fur;
	}
}
