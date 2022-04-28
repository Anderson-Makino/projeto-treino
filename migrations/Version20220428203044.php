<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428203044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medico ADD escritorio_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medico ADD CONSTRAINT FK_34E5914CF95F0F4F FOREIGN KEY (escritorio_id) REFERENCES escritorio (id)');
        $this->addSql('CREATE INDEX IDX_34E5914CF95F0F4F ON medico (escritorio_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medico DROP FOREIGN KEY FK_34E5914CF95F0F4F');
        $this->addSql('DROP INDEX IDX_34E5914CF95F0F4F ON medico');
        $this->addSql('ALTER TABLE medico DROP escritorio_id');
    }
}
