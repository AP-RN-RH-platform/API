<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"application:read"}},
 *     denormalizationContext={"groups"={"application:write"}},
 *     collectionOperations={
 *         "get",
 *         "post"={"security"="is_granted('ROLE_APPLICANT')"}
 *     },
 *     itemOperations={
 *         "get",
 *         "put"={"security"="is_granted('ROLE_APPLICANT') and object.createdBy == user"},
 *         "delete"={"security"="is_granted('ROLE_APPLICANT') and object.createdBy == user"},
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationRepository")
 */
class Application
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"application:read", "application:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @Groups({"application:read", "application:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @Groups({"application:read", "application:write"})
     * @ORM\Column(type="boolean")
     */
    private $sex;

    /**
     * @Groups({"application:read", "application:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @Groups({"application:read", "application:write"})
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @Groups({"application:read", "application:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $address;



    /**
     * @Groups({"application:read", "application:write"})
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @Groups({"application:read", "application:write"})
     * @ORM\Column(type="text")
     */
    private $motives;

    /**
     * @Groups({"application:read", "application:write"})
     * @ORM\Column(type="integer")
     */
    private $expectedSalary;

    /**
     * @Groups({"application:read"})
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @Groups({"application:write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Offer", inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offer;

    /**
     * @var MediaObject|null
     *
     * @Groups({"application:read", "application:write"})
     * @ORM\ManyToOne(targetEntity=MediaObject::class)
     * @ORM\JoinColumn(nullable=true)
     * @ApiProperty(iri="http://schema.org/image")
     */
    public $CV;

    /**
     * @var MediaObject|null
     *
     * @Groups({"application:read", "application:write"})
     * @ORM\ManyToOne(targetEntity=MediaObject::class)
     * @ORM\JoinColumn(nullable=true)
     * @ApiProperty(iri="http://schema.org/image")
     */
    public $photo;


    public function __construct()
    {
        $this->status = "Créé";
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getSex(): ?bool
    {
        return $this->sex;
    }

    public function setSex(bool $sex): self
    {
        $this->sex = $sex;

        return $this;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }


    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getMotives(): ?string
    {
        return $this->motives;
    }

    public function setMotives(string $motives): self
    {
        $this->motives = $motives;

        return $this;
    }

    public function getExpectedSalary(): ?int
    {
        return $this->expectedSalary;
    }

    public function setExpectedSalary(int $expectedSalary): self
    {
        $this->expectedSalary = $expectedSalary;

        return $this;
    }


    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }
}
