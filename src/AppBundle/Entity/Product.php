<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     *
     */
    private $category;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     */
    private $description = "";

    /**
     * @ORM\Column(type="integer")
     *
     */
    private $price;


    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getDesc(){
        return $this->description;
    }

    public function setDesc($description = ""){
        $this->description = $description;
    }

    public function getPrice(){
        return $this->price;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function getCategory(){
        return $this->category;
    }

    public function setCategory($category){
        $this->category = $category;
    }
}