<?php

namespace App\Entity;

use App\Repository\FuncionarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FuncionarioRepository::class)]
class Funcionario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $nome;

    #[ORM\Column(type: 'string', length: 200)]
    private $email;

    #[ORM\Column(type: 'decimal', precision: 11, scale: 0, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private $salario;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $company;

    #[ORM\ManyToOne(targetEntity: Empresa::class, inversedBy: 'funcionario_id')]
    private $company_id;

    #[ORM\Column(type: 'string', length: 11)]
    private $cpf;

    #[ORM\Column(type: 'string', length: 14)]
    private $caepf;

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

    #[ORM\Column(type: 'string', length: 250)]
    private $endereco;

    #[ORM\Column(type: 'string', length: 30)]
    private $matricula;

    #[ORM\Column(type: 'string', length: 3)]
    private $categoria;

    #[ORM\OneToMany(mappedBy: 'funcionario', targetEntity: Aso::class)]
    private $asos;

    public function __construct()
    {
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getSalario(): ?string
    {
        return $this->salario;
    }

    public function setSalario(?string $salario): self
    {
        $this->salario = $salario;

        return $this;
    }

    public function getCompany(): ?int
    {
        return $this->company;
    }

    public function setCompany(int $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getCompanyId(): ?Empresa
    {
        return $this->company_id;
    }

    public function setCompanyId(?Empresa $company_id): self
    {
        $this->company_id = $company_id;

        return $this;
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

    public function getCaepf(): ?string
    {
        return $this->caepf;
    }

    public function setCaepf(string $caepf): self
    {
        $this->caepf = $caepf;

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

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getMatricula(): ?string
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula): self
    {
        $this->matricula = $matricula;

        return $this;
    }

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): self
    {
        $this->categoria = $categoria;

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
            $aso->setFuncionario($this);
        }

        return $this;
    }

    public function removeAso(Aso $aso): self
    {
        if ($this->asos->removeElement($aso)) {
            // set the owning side to null (unless already changed)
            if ($aso->getFuncionario() === $this) {
                $aso->setFuncionario(null);
            }
        }

        return $this;
    }
}
