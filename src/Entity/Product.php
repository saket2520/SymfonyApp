<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $product_id;

    /**
     * @ORM\Column(type="string", length=90)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $owner_name;

    public function jsonSerialize()
    {
        return ["id"=>$this->id ,
             "product_id"=>$this->product_id ,
             "name"=>$this->name ,
             "Type"=>$this->Type ,
             "age"=>$this->age,
             "owner_name"=>$this->owner_name
            ];

   }
   
    public function __construct($a=null, $b=null, $c=null, $d=null, $e=null)
    {
        $this->product_id=$a;
        $this->name=$b;
        $this->Type=$c;
        $this->age=$d;
        $this-> owner_name=$e;
    }

    public function __toString()
    {
        return ($this->product_id?"Product-Id=$this->product_id":"").($this->name?"Name=$this->name":"").($this->Type?"Type-$this->Type":"").
        ($this->age?"Age-$this->age":"").($this->owner_name?"Owner=$this->owner_name":"");
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?string
    {
        return $this->product_id;
    }

    public function setProductId(string $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getOwnerName(): ?string
    {
        return $this->owner_name;
    }

    public function setOwnerName(string $owner_name): self
    {
        $this->owner_name = $owner_name;

        return $this;
    }
}
