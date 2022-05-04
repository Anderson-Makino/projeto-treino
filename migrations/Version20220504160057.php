<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504160057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE escritorio DROP FOREIGN KEY FK_4652D1D9C88866B7');
        $this->addSql('DROP INDEX IDX_4652D1D9C88866B7 ON escritorio');
        $this->addSql('ALTER TABLE escritorio DROP office_company_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE escritorio ADD office_company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE escritorio ADD CONSTRAINT FK_4652D1D9C88866B7 FOREIGN KEY (office_company_id) REFERENCES empresa (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4652D1D9C88866B7 ON escritorio (office_company_id)');
    }
}
