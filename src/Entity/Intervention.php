<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionRepository::class)]
class Intervention
{
    public const INTERVENTION = [
        'type' => [
            'intervention suite alarme Taiko',
            'prise d appel',
            'intervention préventive',
            'demande par mail',
        ],
        'resolved' => [
            'oui',
            'oui par site',
            'partiellement',
            'non',
        ],
        'canceled' => [
            'oui',
            'non',
            'pas de clients',
        ]
    ];
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tech $tech = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    private ?Theatre $theatre = null;

    /**
     * @var Collection<int, Room>
     */
    #[ORM\ManyToMany(targetEntity: Room::class, inversedBy: 'interventions')]
    private Collection $rooms;

    /**
     * @var Collection<int, Equipement>
     */
    #[ORM\ManyToMany(targetEntity: Equipement::class, inversedBy: 'interventions')]
    private Collection $equipements;

    #[ORM\Column(nullable: true)]
    private ?bool $contact = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $resolved = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $canceled = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateTime = null;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
        $this->equipements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTech(): ?Tech
    {
        return $this->tech;
    }

    public function setTech(?Tech $tech): static
    {
        $this->tech = $tech;

        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): static
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms->add($room);
        }

        return $this;
    }

    public function removeRoom(Room $room): static
    {
        $this->rooms->removeElement($room);

        return $this;
    }

    /**
     * @return Collection<int, Equipement>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        $this->equipements->removeElement($equipement);

        return $this;
    }

    public function isContact(): ?bool
    {
        return $this->contact;
    }

    public function setContact(?bool $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getResolved(): ?string
    {
        return $this->resolved;
    }

    public function setResolved(?string $resolved): static
    {
        $this->resolved = $resolved;

        return $this;
    }

    public function getCanceled(): ?string
    {
        return $this->canceled;
    }

    public function setCanceled(?string $canceled): static
    {
        $this->canceled = $canceled;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->dateTime;
    }

    public function setDateTime(\DateTimeInterface $dateTime): static
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getTheatre(): ?Theatre
    {
        return $this->theatre;
    }

    public function setTheatre(?Theatre $theatre): static
    {
        $this->theatre = $theatre;

        return $this;
    }
}
