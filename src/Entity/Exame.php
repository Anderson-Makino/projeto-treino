<?php

namespace App\Entity;

use App\Repository\ExameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExameRepository::class)]
class Exame
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $dtExm;

    #[ORM\Column(type: 'string', length: 100)]
    private $procRealizado;

    #[ORM\Column(type: 'text', nullable: true)]
    private $observacao;

    #[ORM\Column(type: 'string', length: 50)]
    private $ordemExm;

    #[ORM\Column(type: 'string', length: 50)]
    private $resultado;

    #[ORM\Column(type: 'date')]
    private $vencimento;

    #[ORM\ManyToOne(targetEntity: Medico::class, inversedBy: 'exame')]
    #[ORM\JoinColumn(nullable: false)]
    private $medico;

    #[ORM\ManyToMany(targetEntity: Aso::class, inversedBy: 'exames', orphanRemoval:true)]
    private $aso;

    private $name = '';
    
    public function __construct()
    {
        $this->aso = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDtExm(): ?\DateTimeInterface
    {
        return $this->dtExm;
    }

    public function setDtExm(\DateTimeInterface $dtExm): self
    {
        $this->dtExm = $dtExm;

        return $this;
    }

    public function getProcRealizado(): ?string
    {
        return $this->procRealizado;
    }

    public function setProcRealizado(string $procRealizado): self
    {
        $this->procRealizado = $procRealizado;

        return $this;
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }

    public function getOrdemExm(): ?string
    {
        return $this->ordemExm;
    }

    public function setOrdemExm(string $ordemExm): self
    {
        $this->ordemExm = $ordemExm;

        return $this;
    }

    public function getResultado(): ?string
    {
        return $this->resultado;
    }

    public function setResultado(string $resultado): self
    {
        $this->resultado = $resultado;

        return $this;
    }

    public function getVencimento(): ?\DateTimeInterface
    {
        return $this->vencimento;
    }

    public function setVencimento(\DateTimeInterface $vencimento): self
    {
        $this->vencimento = $vencimento;

        return $this;
    }

    public function getMedico(): ?Medico
    {
        return $this->medico;
    }

    public function setMedico(?Medico $medico): self
    {
        $this->medico = $medico;

        return $this;
    }

    /**
     * @return Collection<int, Aso>
     */
    public function getAso(): Collection
    {
        return $this->aso;
    }

    public function addAso(Aso $aso): self
    {
        if (!$this->aso->contains($aso)) {
            $this->aso[] = $aso;
        }

        return $this;
    }

    public function removeAso(Aso $aso): self
    {
        $this->aso->removeElement($aso);

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
