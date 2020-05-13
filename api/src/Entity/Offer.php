<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
<<<<<<< HEAD
 *     normalizationContext={"groups"={"offer_read"}},
 *     denormalizationContext={"groups"={"offer_write"}}
=======
 *     normalizationContext={"groups"={"offer:read"}},
 *     denormalizationContext={"groups"={"offer:write"}},
 *     collectionOperations={
 *         "get",
 *         "post"={"security"="is_granted('ROLE_RECRUITER')"}
 *     },
 *     itemOperations={
 *         "get",
 *         "put"={"security"="is_granted('ROLE_RECRUITER') and object.createdBy == user"},
 *         "delete"={"security"="is_granted('ROLE_RECRUITER') and object.createdBy == user"},
 *     }
>>>>>>> bbf697ef562659dcba6e1ad6e936d008dbdf9afe
 * )
 * @ORM\Entity(repositoryClass="App\Repository\OfferRepository")
 */
class Offer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
<<<<<<< HEAD
=======
     * @Groups({"offer:read", "offer:write"})
>>>>>>> bbf697ef562659dcba6e1ad6e936d008dbdf9afe
     * @ORM\Column(type="string", length=255)
     * @Groups({"offer_write", "offer_read", "user_read"})
     */
    private $name;

    /**
<<<<<<< HEAD
=======
     * @Groups({"offer:read", "offer:write"})
>>>>>>> bbf697ef562659dcba6e1ad6e936d008dbdf9afe
     * @ORM\Column(type="text")
     * @Groups({"offer_write", "offer_read", "user_read"})
     */
    private $companyDescription;

    /**
<<<<<<< HEAD
=======
     * @Groups({"offer:read", "offer:write"})
>>>>>>> bbf697ef562659dcba6e1ad6e936d008dbdf9afe
     * @ORM\Column(type="text")
     * @Groups({"offer_write", "offer_read", "user_read"})
     */
    private $offerDescription;

    /**
<<<<<<< HEAD
=======
     * @Groups({"offer:read", "offer:write"})
>>>>>>> bbf697ef562659dcba6e1ad6e936d008dbdf9afe
     * @ORM\Column(type="datetime")
     * @Groups({"offer_write", "offer_read", "user_read"})
     */
    private $beginAt;

    /**
<<<<<<< HEAD
=======
     * @Groups({"offer:read", "offer:write"})
>>>>>>> bbf697ef562659dcba6e1ad6e936d008dbdf9afe
     * @ORM\Column(type="string", length=255)
     * @Groups({"offer_write", "offer_read", "user_read"})
     */
    private $contractType;

    /**
<<<<<<< HEAD
=======
     * @Groups({"offer:read", "offer:write"})
>>>>>>> bbf697ef562659dcba6e1ad6e936d008dbdf9afe
     * @ORM\Column(type="string", length=255)
     * @Groups({"offer_write", "offer_read", "user_read"})
     */
    private $place;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @Groups({"application:read"})
     * @ORM\OneToMany(targetEntity="App\Entity\Application", mappedBy="offer")
     */
    private $applications;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Invitation", mappedBy="offer")
     */
    private $invitations;

    public function __construct()
    {
        $this->applications = new ArrayCollection();
        $this->invitations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCompanyDescription(): ?string
    {
        return $this->companyDescription;
    }

    public function setCompanyDescription(string $companyDescription): self
    {
        $this->companyDescription = $companyDescription;

        return $this;
    }

    public function getOfferDescription(): ?string
    {
        return $this->offerDescription;
    }

    public function setOfferDescription(string $offerDescription): self
    {
        $this->offerDescription = $offerDescription;

        return $this;
    }

    public function getBeginAt(): ?\DateTimeInterface
    {
        return $this->beginAt;
    }

    public function setBeginAt(\DateTimeInterface $beginAt): self
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    public function getContractType(): ?string
    {
        return $this->contractType;
    }

    public function setContractType(string $contractType): self
    {
        $this->contractType = $contractType;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

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

    /**
     * @return Collection|Application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
            $application->setOffer($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->contains($application)) {
            $this->applications->removeElement($application);
            // set the owning side to null (unless aloffer:ready changed)
            if ($application->getOffer() === $this) {
                $application->setOffer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Invitation[]
     */
    public function getInvitations(): Collection
    {
        return $this->invitations;
    }

    public function addInvitation(Invitation $invitation): self
    {
        if (!$this->invitations->contains($invitation)) {
            $this->invitations[] = $invitation;
            $invitation->setOffer($this);
        }

        return $this;
    }

    public function removeInvitation(Invitation $invitation): self
    {
        if ($this->invitations->contains($invitation)) {
            $this->invitations->removeElement($invitation);
            // set the owning side to null (unless already changed)
            if ($invitation->getOffer() === $this) {
                $invitation->setOffer(null);
            }
        }

        return $this;
    }
}
