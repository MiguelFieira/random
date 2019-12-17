<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WedstrijdRepository")
 */
class Wedstrijd
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $veld_nummer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVeldNummer(): ?int
    {
        return $this->veld_nummer;
    }

    public function setVeldNummer(int $veld_nummer): self
    {
        $this->veld_nummer = $veld_nummer;

        return $this;
    }
}
