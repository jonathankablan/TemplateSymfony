<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240701091221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket ADD dev_owner_id INT DEFAULT NULL, ADD admin_owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA33CA06E8A FOREIGN KEY (dev_owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3EA9C66FF FOREIGN KEY (admin_owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA33CA06E8A ON ticket (dev_owner_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3EA9C66FF ON ticket (admin_owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA33CA06E8A');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3EA9C66FF');
        $this->addSql('DROP INDEX IDX_97A0ADA33CA06E8A ON ticket');
        $this->addSql('DROP INDEX IDX_97A0ADA3EA9C66FF ON ticket');
        $this->addSql('ALTER TABLE ticket DROP dev_owner_id, DROP admin_owner_id');
    }
}
