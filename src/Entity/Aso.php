<?php

namespace App\Entity;

use App\Repository\AsoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AsoRepository::class)]
class Aso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $dtAso;

    #[ORM\Column(type: 'string', length: 50)]
    private $tipo;

    #[ORM\Column(type: 'string', length: 50)]
    private $resultado;

    #[ORM\ManyToOne(targetEntity: Empresa::class, inversedBy: 'asos')]
    #[ORM\JoinColumn(nullable: false)]
    private $empresa;

    #[ORM\ManyToOne(targetEntity: Funcionario::class, inversedBy: 'asos')]
    #[ORM\JoinColumn(nullable: false)]
    private $funcionario;

    #[ORM\ManyToOne(targetEntity: Medico::class, inversedBy: 'asos')]
    #[ORM\JoinColumn(nullable: false)]
    private $medico_aso;

    #[ORM\ManyToOne(targetEntity: Medico::class, inversedBy: 'asos')]
    #[ORM\JoinColumn(nullable: true)]
    private $medico_pcmso;

    #[ORM\ManyToMany(targetEntity: Exame::class, mappedBy: 'aso', cascade: ['persist', 'remove'])]
    private $exames;

    public function __construct()
    {
        $this->exames = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDtAso(): ?\DateTimeInterface
    {
        return $this->dtAso;
    }

    public function setDtAso(\DateTimeInterface $dtAso): self
    {
        $this->dtAso = $dtAso;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

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

    public function getEmpresa(): ?Empresa
    {
        return $this->empresa;
    }

    public function setEmpresa(?Empresa $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }

    public function getFuncionario(): ?Funcionario
    {
        return $this->funcionario;
    }

    public function setFuncionario(?Funcionario $funcionario): self
    {
        $this->funcionario = $funcionario;

        return $this;
    }

    public function getMedicoAso(): ?Medico
    {
        return $this->medico_aso;
    }

    public function setMedicoAso(?Medico $medico_aso): self
    {
        $this->medico_aso = $medico_aso;

        return $this;
    }

    public function getMedicoPcmso(): ?Medico
    {
        return $this->medico_pcmso;
    }

    public function setMedicoPcmso(?Medico $medico_pcmso): self
    {
        $this->medico_pcmso = $medico_pcmso;

        return $this;
    }

    /**
     * @return Collection<int, Exame>
     */
    public function getExames(): Collection
    {
        return $this->exames;
    }

    public function addExame(Exame $exame): self
    {
        if (!$this->exames->contains($exame)) {
            $this->exames[] = $exame;
            $exame->addAso($this);
        }

        return $this;
    }

    public function removeExame(Exame $exame): self
    {
        if ($this->exames->removeElement($exame)) {
            $exame->removeAso($this);
        }

        return $this;
    }
}
