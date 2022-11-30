<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221129003035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE marker_tag (marker_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_5FC2A080474460EB (marker_id), INDEX IDX_5FC2A080BAD26311 (tag_id), PRIMARY KEY(marker_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE marker_tag ADD CONSTRAINT FK_5FC2A080474460EB FOREIGN KEY (marker_id) REFERENCES marker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE marker_tag ADD CONSTRAINT FK_5FC2A080BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marker_tag DROP FOREIGN KEY FK_5FC2A080474460EB');
        $this->addSql('ALTER TABLE marker_tag DROP FOREIGN KEY FK_5FC2A080BAD26311');
        $this->addSql('DROP TABLE marker_tag');
    }
}
