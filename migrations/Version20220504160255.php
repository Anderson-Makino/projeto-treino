<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504160255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE empresa ADD escritorio_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE empresa ADD CONSTRAINT FK_B8D75A50F95F0F4F FOREIGN KEY (escritorio_id) REFERENCES escritorio (id)');
        $this->addSql('CREATE INDEX IDX_B8D75A50F95F0F4F ON empresa (escritorio_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE empresa DROP FOREIGN KEY FK_B8D75A50F95F0F4F');
        $this->addSql('DROP INDEX IDX_B8D75A50F95F0F4F ON empresa');
        $this->addSql('ALTER TABLE empresa DROP escritorio_id');
    }
}
