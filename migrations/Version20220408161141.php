<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220408161141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE empresa (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(200) NOT NULL, endereco VARCHAR(250) NOT NULL, phone NUMERIC(11, 11) DEFAULT NULL, descricao LONGTEXT DEFAULT NULL, office INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE escritorio (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(200) NOT NULL, endereco VARCHAR(200) NOT NULL, phone NUMERIC(11, 11) DEFAULT NULL, descricao LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE funcionario (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(100) NOT NULL, email VARCHAR(200) NOT NULL, phone NUMERIC(11, 11) DEFAULT NULL, salario NUMERIC(7, 2) DEFAULT NULL, company INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medico (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(100) NOT NULL, crm VARCHAR(15) NOT NULL, phone NUMERIC(11, 11) DEFAULT NULL, company INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(100) NOT NULL, email VARCHAR(200) NOT NULL, password VARCHAR(200) NOT NULL, office INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE empresa');
        $this->addSql('DROP TABLE escritorio');
        $this->addSql('DROP TABLE funcionario');
        $this->addSql('DROP TABLE medico');
        $this->addSql('DROP TABLE `user`');
    }
}
