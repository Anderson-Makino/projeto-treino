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

    #[ORM\Column(type: 'integer')]
    private $office;

    #[ORM\OneToMany(mappedBy: 'office_company', targetEntity: Escritorio::class)]
    private $company_office;

    public function __construct()
    {
        $this->company_office = new ArrayCollection();
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
     * @return Collection<int, Escritorio>
     */
    public function getCompanyOffice(): Collection
    {
        return $this->company_office;
    }

    public function addCompanyOffice(Escritorio $companyOffice): self
    {
        if (!$this->company_office->contains($companyOffice)) {
            $this->company_office[] = $companyOffice;
            $companyOffice->setOfficeCompany($this);
        }

        return $this;
    }

    public function removeCompanyOffice(Escritorio $companyOffice): self
    {
        if ($this->company_office->removeElement($companyOffice)) {
            // set the owning side to null (unless already changed)
            if ($companyOffice->getOfficeCompany() === $this) {
                $companyOffice->setOfficeCompany(null);
            }
        }

        return $this;
    }
}
