<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428195005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medico DROP FOREIGN KEY FK_34E5914C38B53C32');
        $this->addSql('DROP INDEX IDX_34E5914C38B53C32 ON medico');
        $this->addSql('ALTER TABLE medico DROP company_id_id, DROP company');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medico ADD company_id_id INT DEFAULT NULL, ADD company INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medico ADD CONSTRAINT FK_34E5914C38B53C32 FOREIGN KEY (company_id_id) REFERENCES empresa (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_34E5914C38B53C32 ON medico (company_id_id)');
    }
}
