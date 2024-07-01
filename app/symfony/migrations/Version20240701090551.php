<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240701090551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sprint ADD state_sprint_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sprint ADD CONSTRAINT FK_EF8055B7C4A9C256 FOREIGN KEY (state_sprint_id) REFERENCES state_sprint (id)');
        $this->addSql('CREATE INDEX IDX_EF8055B7C4A9C256 ON sprint (state_sprint_id)');
        $this->addSql('ALTER TABLE ticket ADD category_id INT DEFAULT NULL, ADD sprint_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA38C24077B FOREIGN KEY (sprint_id) REFERENCES sprint (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA312469DE2 ON ticket (category_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA38C24077B ON ticket (sprint_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA312469DE2');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA38C24077B');
        $this->addSql('DROP INDEX IDX_97A0ADA312469DE2 ON ticket');
        $this->addSql('DROP INDEX IDX_97A0ADA38C24077B ON ticket');
        $this->addSql('ALTER TABLE ticket DROP category_id, DROP sprint_id');
        $this->addSql('ALTER TABLE sprint DROP FOREIGN KEY FK_EF8055B7C4A9C256');
        $this->addSql('DROP INDEX IDX_EF8055B7C4A9C256 ON sprint');
        $this->addSql('ALTER TABLE sprint DROP state_sprint_id');
    }
}
