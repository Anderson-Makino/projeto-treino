<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220422203705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aso (id INT AUTO_INCREMENT NOT NULL, empresa_id INT NOT NULL, funcionario_id INT NOT NULL, medico_aso_id INT NOT NULL, medico_pcmso_id INT DEFAULT NULL, dt_aso DATE NOT NULL, tipo VARCHAR(50) NOT NULL, resultado VARCHAR(50) NOT NULL, INDEX IDX_6F4B2EF9521E1991 (empresa_id), INDEX IDX_6F4B2EF9642FEB76 (funcionario_id), INDEX IDX_6F4B2EF95820605 (medico_aso_id), INDEX IDX_6F4B2EF9B84EA87A (medico_pcmso_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE empresa (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(200) NOT NULL, endereco VARCHAR(250) NOT NULL, phone NUMERIC(11, 0) DEFAULT NULL, descricao LONGTEXT DEFAULT NULL, office INT DEFAULT NULL, cep VARCHAR(8) NOT NULL, numero VARCHAR(4) NOT NULL, complemento LONGTEXT DEFAULT NULL, bairro VARCHAR(200) NOT NULL, cidade VARCHAR(100) NOT NULL, uf VARCHAR(50) NOT NULL, celular VARCHAR(11) DEFAULT NULL, cpf_responsavel VARCHAR(11) NOT NULL, email VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE escritorio (id INT AUTO_INCREMENT NOT NULL, office_company_id INT NOT NULL, nome VARCHAR(200) NOT NULL, endereco VARCHAR(200) NOT NULL, phone NUMERIC(11, 0) DEFAULT NULL, descricao LONGTEXT DEFAULT NULL, cnpj VARCHAR(14) NOT NULL, cep VARCHAR(8) NOT NULL, numero VARCHAR(4) NOT NULL, complemento LONGTEXT DEFAULT NULL, bairro VARCHAR(200) NOT NULL, cidade VARCHAR(100) NOT NULL, uf VARCHAR(50) NOT NULL, celular VARCHAR(11) DEFAULT NULL, email VARCHAR(200) NOT NULL, INDEX IDX_4652D1D9C88866B7 (office_company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exame (id INT AUTO_INCREMENT NOT NULL, medico_id INT NOT NULL, dt_exm DATE NOT NULL, proc_realizado VARCHAR(100) NOT NULL, observacao LONGTEXT DEFAULT NULL, ordem_exm VARCHAR(50) NOT NULL, resultado VARCHAR(50) NOT NULL, vencimento DATE NOT NULL, INDEX IDX_9DE5A679A7FB1C0C (medico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE funcionario (id INT AUTO_INCREMENT NOT NULL, company_id_id INT DEFAULT NULL, nome VARCHAR(100) NOT NULL, email VARCHAR(200) NOT NULL, phone NUMERIC(11, 0) DEFAULT NULL, salario NUMERIC(7, 2) DEFAULT NULL, company INT DEFAULT NULL, cpf VARCHAR(11) NOT NULL, caepf VARCHAR(14) NOT NULL, cep VARCHAR(8) NOT NULL, numero VARCHAR(4) NOT NULL, complemento LONGTEXT DEFAULT NULL, bairro VARCHAR(200) NOT NULL, cidade VARCHAR(100) NOT NULL, uf VARCHAR(50) NOT NULL, celular VARCHAR(11) DEFAULT NULL, endereco VARCHAR(250) NOT NULL, matricula VARCHAR(30) NOT NULL, categoria VARCHAR(3) NOT NULL, INDEX IDX_7510A3CF38B53C32 (company_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medico (id INT AUTO_INCREMENT NOT NULL, company_id_id INT DEFAULT NULL, nome VARCHAR(100) NOT NULL, crm VARCHAR(15) NOT NULL, phone NUMERIC(11, 0) DEFAULT NULL, company INT DEFAULT NULL, cpf VARCHAR(11) NOT NULL, cep VARCHAR(8) NOT NULL, numero VARCHAR(4) NOT NULL, complemento LONGTEXT DEFAULT NULL, bairro VARCHAR(200) NOT NULL, cidade VARCHAR(100) NOT NULL, uf VARCHAR(50) NOT NULL, celular VARCHAR(11) DEFAULT NULL, email VARCHAR(200) NOT NULL, endereco VARCHAR(250) NOT NULL, INDEX IDX_34E5914C38B53C32 (company_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_2265B05DE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_escritorio (usuario_id INT NOT NULL, escritorio_id INT NOT NULL, INDEX IDX_B5629B7BDB38439E (usuario_id), INDEX IDX_B5629B7BF95F0F4F (escritorio_id), PRIMARY KEY(usuario_id, escritorio_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aso ADD CONSTRAINT FK_6F4B2EF9521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)');
        $this->addSql('ALTER TABLE aso ADD CONSTRAINT FK_6F4B2EF9642FEB76 FOREIGN KEY (funcionario_id) REFERENCES funcionario (id)');
        $this->addSql('ALTER TABLE aso ADD CONSTRAINT FK_6F4B2EF95820605 FOREIGN KEY (medico_aso_id) REFERENCES medico (id)');
        $this->addSql('ALTER TABLE aso ADD CONSTRAINT FK_6F4B2EF9B84EA87A FOREIGN KEY (medico_pcmso_id) REFERENCES medico (id)');
        $this->addSql('ALTER TABLE escritorio ADD CONSTRAINT FK_4652D1D9C88866B7 FOREIGN KEY (office_company_id) REFERENCES empresa (id)');
        $this->addSql('ALTER TABLE exame ADD CONSTRAINT FK_9DE5A679A7FB1C0C FOREIGN KEY (medico_id) REFERENCES medico (id)');
        $this->addSql('ALTER TABLE funcionario ADD CONSTRAINT FK_7510A3CF38B53C32 FOREIGN KEY (company_id_id) REFERENCES empresa (id)');
        $this->addSql('ALTER TABLE medico ADD CONSTRAINT FK_34E5914C38B53C32 FOREIGN KEY (company_id_id) REFERENCES empresa (id)');
        $this->addSql('ALTER TABLE usuario_escritorio ADD CONSTRAINT FK_B5629B7BDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_escritorio ADD CONSTRAINT FK_B5629B7BF95F0F4F FOREIGN KEY (escritorio_id) REFERENCES escritorio (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aso DROP FOREIGN KEY FK_6F4B2EF9521E1991');
        $this->addSql('ALTER TABLE escritorio DROP FOREIGN KEY FK_4652D1D9C88866B7');
        $this->addSql('ALTER TABLE funcionario DROP FOREIGN KEY FK_7510A3CF38B53C32');
        $this->addSql('ALTER TABLE medico DROP FOREIGN KEY FK_34E5914C38B53C32');
        $this->addSql('ALTER TABLE usuario_escritorio DROP FOREIGN KEY FK_B5629B7BF95F0F4F');
        $this->addSql('ALTER TABLE aso DROP FOREIGN KEY FK_6F4B2EF9642FEB76');
        $this->addSql('ALTER TABLE aso DROP FOREIGN KEY FK_6F4B2EF95820605');
        $this->addSql('ALTER TABLE aso DROP FOREIGN KEY FK_6F4B2EF9B84EA87A');
        $this->addSql('ALTER TABLE exame DROP FOREIGN KEY FK_9DE5A679A7FB1C0C');
        $this->addSql('ALTER TABLE usuario_escritorio DROP FOREIGN KEY FK_B5629B7BDB38439E');
        $this->addSql('DROP TABLE aso');
        $this->addSql('DROP TABLE empresa');
        $this->addSql('DROP TABLE escritorio');
        $this->addSql('DROP TABLE exame');
        $this->addSql('DROP TABLE funcionario');
        $this->addSql('DROP TABLE medico');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE usuario_escritorio');
    }
}
