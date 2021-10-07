<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005142201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipment ADD rental_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D58316AA567C FOREIGN KEY (rental_type_id) REFERENCES rental_type (id)');
        $this->addSql('CREATE INDEX IDX_D338D58316AA567C ON equipment (rental_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D58316AA567C');
        $this->addSql('DROP INDEX IDX_D338D58316AA567C ON equipment');
        $this->addSql('ALTER TABLE equipment DROP rental_type_id');
    }
}
