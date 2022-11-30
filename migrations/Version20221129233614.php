<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221129233614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marker_tag ADD id INT AUTO_INCREMENT NOT NULL, ADD created DATETIME DEFAULT NULL, CHANGE marker_id marker_id INT DEFAULT NULL, CHANGE tag_id tag_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE marker_tag ADD CONSTRAINT FK_5FC2A080474460EB FOREIGN KEY (marker_id) REFERENCES marker (id)');
        $this->addSql('ALTER TABLE marker_tag ADD CONSTRAINT FK_5FC2A080BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marker_tag MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE marker_tag DROP FOREIGN KEY FK_5FC2A080474460EB');
        $this->addSql('ALTER TABLE marker_tag DROP FOREIGN KEY FK_5FC2A080BAD26311');
        $this->addSql('DROP INDEX `PRIMARY` ON marker_tag');
        $this->addSql('ALTER TABLE marker_tag DROP id, DROP created, CHANGE marker_id marker_id INT NOT NULL, CHANGE tag_id tag_id INT NOT NULL');
        $this->addSql('ALTER TABLE marker_tag ADD PRIMARY KEY (marker_id, tag_id)');
    }
}
