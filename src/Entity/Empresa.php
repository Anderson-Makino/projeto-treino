<?php

namespace App\Entity;

use App\Repository\EmpresaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpresaRepository::class)]
class Empresa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 200)]
    private $nome;

    #[ORM\Column(type: 'string', length: 250)]
    private $endereco;

    #[ORM\Column(type: 'decimal', precision: 11, scale: 0, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descricao;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $office;

    #[ORM\OneToMany(mappedBy: 'company_id', targetEntity: Funcionario::class)]
    private $funcionario_id;

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

    #[ORM\Column(type: 'string', length: 11)]
    private $cpf_responsavel;

    #[ORM\Column(type: 'string', length: 200)]
    private $email;

    #[ORM\OneToMany(mappedBy: 'empresa', targetEntity: Aso::class)]
    private $asos;

    private $name = '';

    #[ORM\ManyToOne(targetEntity: Escritorio::class, inversedBy: 'empresas')]
    private $escritorio;

    public function __construct()
    {
        $this->company_office = new ArrayCollection();
        $this->medico_id = new ArrayCollection();
        $this->funcionario_id = new ArrayCollection();
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

    public function getOffice(): ?int
    {
        return $this->office;
    }

    public function setOffice(int $office): self
    {
        $this->office = $office;

        return $this;
    }

    /**
     * @return Collection<int, Funcionario>
     */
    public function getFuncionarioId(): Collection
    {
        return $this->funcionario_id;
    }

    public function addFuncionarioId(Funcionario $funcionarioId): self
    {
        if (!$this->funcionario_id->contains($funcionarioId)) {
            $this->funcionario_id[] = $funcionarioId;
            $funcionarioId->setCompanyId($this);
        }

        return $this;
    }

    public function removeFuncionarioId(Funcionario $funcionarioId): self
    {
        if ($this->funcionario_id->removeElement($funcionarioId)) {
            // set the owning side to null (unless already changed)
            if ($funcionarioId->getCompanyId() === $this) {
                $funcionarioId->setCompanyId(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
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

    public function getCpfResponsavel(): ?string
    {
        return $this->cpf_responsavel;
    }

    public function setCpfResponsavel(string $cpf_responsavel): self
    {
        $this->cpf_responsavel = $cpf_responsavel;

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
     * @return Collection<int, Aso>
     */
    public function getAsos(): Collection
    {
        return $this->asos;
    }

    public function addAsos(Aso $asos): self
    {
        if (!$this->asos->contains($asos)) {
            $this->asos[] = $asos;
            $asos->setEmpresa($this);
        }

        return $this;
    }

    public function removeAsos(Aso $asos): self
    {
        if ($this->asos->removeElement($asos)) {
            // set the owning side to null (unless already changed)
            if ($asos->getEmpresa() === $this) {
                $asos->setEmpresa(null);
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
