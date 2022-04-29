<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220429161859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE escritorio CHANGE office_company_id office_company_id INT DEFAULT NULL, CHANGE endereco endereco VARCHAR(200) DEFAULT NULL, CHANGE cep cep VARCHAR(8) DEFAULT NULL, CHANGE numero numero VARCHAR(4) DEFAULT NULL, CHANGE bairro bairro VARCHAR(200) DEFAULT NULL, CHANGE cidade cidade VARCHAR(100) DEFAULT NULL, CHANGE uf uf VARCHAR(50) DEFAULT NULL, CHANGE email email VARCHAR(200) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE escritorio CHANGE office_company_id office_company_id INT NOT NULL, CHANGE endereco endereco VARCHAR(200) NOT NULL, CHANGE cep cep VARCHAR(8) NOT NULL, CHANGE numero numero VARCHAR(4) NOT NULL, CHANGE bairro bairro VARCHAR(200) NOT NULL, CHANGE cidade cidade VARCHAR(100) NOT NULL, CHANGE uf uf VARCHAR(50) NOT NULL, CHANGE email email VARCHAR(200) NOT NULL');
    }
}
