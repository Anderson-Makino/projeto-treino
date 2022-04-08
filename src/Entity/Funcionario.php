<?php

namespace App\Entity;

use App\Repository\FuncionarioRepository;
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

    #[ORM\Column(type: 'decimal', precision: 11, scale: 11, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private $salario;

    #[ORM\Column(type: 'integer')]
    private $company;

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
}
