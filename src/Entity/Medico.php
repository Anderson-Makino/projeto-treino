<?php

namespace App\Entity;

use App\Repository\MedicoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicoRepository::class)]
class Medico
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $nome;

    #[ORM\Column(type: 'string', length: 15)]
    private $crm;

    #[ORM\Column(type: 'decimal', precision: 11, scale: 0, nullable: true)]
    private $phone;

    private $name = '';

    #[ORM\Column(type: 'string', length: 11)]
    private $cpf;

    #[ORM\Column(type: 'string', length: 8)]
    private $cep;

    #[ORM\Column(type: 'string', length: 4)]
    private $numero;

    #[ORM\Column(type: 'text', nullable: true)]
    private $complemento;

    #[ORM\Column(type: 'string', length: 200)]
    private $bairro;

    #[ORM\Column(type: 'string', length: 100)]
    private $cidade;

    #[ORM\Column(type: 'string', length: 50)]
    private $uf;

    #[ORM\Column(type: 'string', length: 11, nullable: true)]
    private $celular;

    #[ORM\Column(type: 'string', length: 200)]
    private $email;

    #[ORM\Column(type: 'string', length: 250)]
    private $endereco;

    #[ORM\OneToMany(mappedBy: 'medico', targetEntity: Exame::class)]
    private $exame;

    #[ORM\OneToMany(mappedBy: 'medico_aso', targetEntity: Aso::class)]
    private $asos;

    #[ORM\ManyToOne(targetEntity: Escritorio::class, inversedBy: 'medicos')]
    private $escritorio;

    public function __construct()
    {
        $this->exame = new ArrayCollection();
        $this->asos = new ArrayCollection();
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

    public function getCrm(): ?string
    {
        return $this->crm;
    }

    public function setCrm(string $crm): self
    {
        $this->crm = $crm;

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

    public function __toString()
    {
        return $this->name;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function setCep(string $cep): self
    {
        $this->cep = $cep;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getComplemento(): ?string
    {
        return $this->complemento;
    }

    public function setComplemento(?string $complemento): self
    {
        $this->complemento = $complemento;

        return $this;
    }

    public function getBairro(): ?string
    {
        return $this->bairro;
    }

    public function setBairro(string $bairro): self
    {
        $this->bairro = $bairro;

        return $this;
    }

    public function getCidade(): ?string
    {
        return $this->cidade;
    }

    public function setCidade(string $cidade): self
    {
        $this->cidade = $cidade;

        return $this;
    }

    public function getUf(): ?string
    {
        return $this->uf;
    }

    public function setUf(string $uf): self
    {
        $this->uf = $uf;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(?string $celular): self
    {
        $this->celular = $celular;

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

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * @return Collection<int, Exame>
     */
    public function getExame(): Collection
    {
        return $this->exame;
    }

    public function addExame(Exame $exame): self
    {
        if (!$this->exame->contains($exame)) {
            $this->exame[] = $exame;
            $exame->setMedico($this);
        }

        return $this;
    }

    public function removeExame(Exame $exame): self
    {
        if ($this->exame->removeElement($exame)) {
            // set the owning side to null (unless already changed)
            if ($exame->getMedico() === $this) {
                $exame->setMedico(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Aso>
     */
    public function getAsos(): Collection
    {
        return $this->asos;
    }

    public function addAso(Aso $aso): self
    {
        if (!$this->asos->contains($aso)) {
            $this->asos[] = $aso;
            $aso->setMedicoAso($this);
        }

        return $this;
    }

    public function removeAso(Aso $aso): self
    {
        if ($this->asos->removeElement($aso)) {
            // set the owning side to null (unless already changed)
            if ($aso->getMedicoAso() === $this) {
                $aso->setMedicoAso(null);
            }
        }

        return $this;
    }

    public function getEscritorio(): ?Escritorio
    {
        return $this->escritorio;
    }

    public function setEscritorio(?Escritorio $escritorio): self
    {
        $this->escritorio = $escritorio;

        return $this;
    }
}
