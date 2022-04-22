<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220422180337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE escritorio ADD cep VARCHAR(8) NOT NULL, ADD numero VARCHAR(4) NOT NULL, ADD complemento LONGTEXT DEFAULT NULL, ADD bairro VARCHAR(200) NOT NULL, ADD cidade VARCHAR(100) NOT NULL, ADD uf VARCHAR(50) NOT NULL, ADD celular VARCHAR(11) DEFAULT NULL, ADD email VARCHAR(200) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE escritorio DROP cep, DROP numero, DROP complemento, DROP bairro, DROP cidade, DROP uf, DROP celular, DROP email');
    }
}
