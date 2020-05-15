<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\SendInvitation;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"invitation_read"}},
 *     denormalizationContext={"groups"={"invitation_write"}},
 *     collectionOperations={
 *         "get",
 *         "post"={"security"="is_granted('ROLE_RECRUITER')"}
 *     },
 *     itemOperations={
 *         "get"={"security"="is_granted('ROLE_RECRUITER')"},
 *         "put"={"security"="is_granted('ROLE_RECRUITER')"},
 *         "delete"={"security"="is_granted('ROLE_RECRUITER')"},
 *         "send_invitation"={
 *             "method"="GET",
 *             "path"="/send_invitation/{token}",
 *             "controller"=SendInvitation::class,
 *             "defaults"={"_api_receive"=false},
 *             "openapi_context"= {
 *                  "parameters"= {
 *                      {
 *                          "name": "token",
 *                          "in": "path",
 *                          "type": "string",
 *                          "required": true
 *                      }
 *                  }
 *              }
 *         }
 *     },
 *     subresourceOperations={
 *          "api_invitation_offer_get_subresource"={
 *              "method"="POST",
 *              "path"="/invitation/{id}/offer"
 *          },
 *     },
 * )
 * @ORM\Entity(repositoryClass="App\Repository\InvitationRepository")
 */
class Invitation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"invitation_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"invitation_read","invitation_write"})
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Offer", inversedBy="invitations")
     * @Groups({"invitation_read","invitation_write","offer:read"})
     * @ApiSubresource
     */
    private $offer;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"invitation_read"})
     */
    private $token;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }
}
