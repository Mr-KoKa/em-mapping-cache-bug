<?php

namespace App\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Item {
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Main\Item", mappedBy="container")
     */
    private $items;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Main\Item", inversedBy="items")
     * @ORM\JoinColumn(name="container", referencedColumnName="id")
     * @var $container Item
     */
    private $container;

    public function getId(){
        return $this->id;
    }

    public function getValue(){
        return $this->value;
    }

    public function getItems(){
        return $this->items;
    }

    public function getContainer(){
        return $this->container;
    }

    public function setContainer(Item $container){
        $this->container = $container;
    }

    public function setValue(string $value){
        $this->value = $value;
    }

    public function __toString(){
        return '';
    }
}
