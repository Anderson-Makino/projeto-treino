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

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    private $endereco;

    #[ORM\Column(type: 'decimal', precision: 11, scale: 0, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descricao;

    #[ORM\ManyToMany(targetEntity: Usuario::class, mappedBy: 'office', orphanRemoval: true)]
    private $user_office;

    private $name = '';

    #[ORM\Column(type: 'string', length: 14)]
    private $cnpj;

    #[ORM\Column(type: 'string', length: 8, nullable: true)]
    private $cep;

    #[ORM\Column(type: 'string', length: 4, nullable: true)]
    private $numero;

    #[ORM\Column(type: 'text', nullable: true)]
    private $complemento;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    private $bairro;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $cidade;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $uf;

    #[ORM\Column(type: 'string', length: 11, nullable: true)]
    private $celular;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    private $email;

    #[ORM\OneToMany(mappedBy: 'escritorio', targetEntity: Medico::class)]
    private $medicos;

    #[ORM\OneToMany(mappedBy: 'escritorio', targetEntity: Empresa::class)]
    private $empresas;

    public function __construct()
    {
        $this->user_office = new ArrayCollection();
        $this->medicos = new ArrayCollection();
        $this->empresas = new ArrayCollection();
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

    public function __toString(): string
    {
        return $this->name;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(string $cnpj): self
    {
        $this->cnpj = $cnpj;

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

    /**
     * @return Collection<int, Medico>
     */
    public function getMedicos(): Collection
    {
        return $this->medicos;
    }

    public function addMedico(Medico $medico): self
    {
        if (!$this->medicos->contains($medico)) {
            $this->medicos[] = $medico;
            $medico->setEscritorio($this);
        }

        return $this;
    }

    public function removeMedico(Medico $medico): self
    {
        if ($this->medicos->removeElement($medico)) {
            // set the owning side to null (unless already changed)
            if ($medico->getEscritorio() === $this) {
                $medico->setEscritorio(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Empresa>
     */
    public function getEmpresas(): Collection
    {
        return $this->empresas;
    }

    public function addEmpresa(Empresa $empresa): self
    {
        if (!$this->empresas->contains($empresa)) {
            $this->empresas[] = $empresa;
            $empresa->setEscritorio($this);
        }

        return $this;
    }

    public function removeEmpresa(Empresa $empresa): self
    {
        if ($this->empresas->removeElement($empresa)) {
            // set the owning side to null (unless already changed)
            if ($empresa->getEscritorio() === $this) {
                $empresa->setEscritorio(null);
            }
        }

        return $this;
    }
}
