<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005142022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE share ADD user_id INT DEFAULT NULL, ADD equipment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE share ADD CONSTRAINT FK_EF069D5AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE share ADD CONSTRAINT FK_EF069D5A517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id)');
        $this->addSql('CREATE INDEX IDX_EF069D5AA76ED395 ON share (user_id)');
        $this->addSql('CREATE INDEX IDX_EF069D5A517FE9FE ON share (equipment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE share DROP FOREIGN KEY FK_EF069D5AA76ED395');
        $this->addSql('ALTER TABLE share DROP FOREIGN KEY FK_EF069D5A517FE9FE');
        $this->addSql('DROP INDEX IDX_EF069D5AA76ED395 ON share');
        $this->addSql('DROP INDEX IDX_EF069D5A517FE9FE ON share');
        $this->addSql('ALTER TABLE share DROP user_id, DROP equipment_id');
    }
}
