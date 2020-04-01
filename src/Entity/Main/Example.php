<?php

namespace App\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Example {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $value;

    public function getId(){
        return $this->id;
    }

    public function getValue(){
        return $this->value;
    }

    public function setValue(string $value){
        $this->value = $value;
    }
}
