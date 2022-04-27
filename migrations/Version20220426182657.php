<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220426182657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exame_aso (exame_id INT NOT NULL, aso_id INT NOT NULL, INDEX IDX_44551197155C9BEA (exame_id), INDEX IDX_44551197365D1C34 (aso_id), PRIMARY KEY(exame_id, aso_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exame_aso ADD CONSTRAINT FK_44551197155C9BEA FOREIGN KEY (exame_id) REFERENCES exame (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exame_aso ADD CONSTRAINT FK_44551197365D1C34 FOREIGN KEY (aso_id) REFERENCES aso (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE exame_aso');
    }
}
