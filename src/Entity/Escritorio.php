<?php

namespace App\Entity;

use App\Repository\EscritorioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EscritorioRepository::class)]
class Escritorio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 200)]
    private $nome;

    #[ORM\Column(type: 'string', length: 200)]
    private $endereco;

    #[ORM\Column(type: 'decimal', precision: 11, scale: 0, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descricao;

    #[ORM\ManyToMany(targetEntity: Usuario::class, mappedBy: 'office')]
    private $user_office;

    public function __construct()
    {
        $this->user_office = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return Collection<int, Usuario>
     */
    public function getUserOffice(): Collection
    {
        return $this->user_office;
    }

    public function addUserOffice(Usuario $userOffice): self
    {
        if (!$this->user_office->contains($userOffice)) {
            $this->user_office[] = $userOffice;
            $userOffice->addOffice($this);
        }

        return $this;
    }

    public function removeUserOffice(Usuario $userOffice): self
    {
        if ($this->user_office->removeElement($userOffice)) {
            $userOffice->removeOffice($this);
        }

        return $this;
    }
}
