<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230424140950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE persona ADD hospital_nac_id INT NOT NULL');
        $this->addSql('ALTER TABLE persona ADD CONSTRAINT FK_51E5B69B489C60E8 FOREIGN KEY (hospital_nac_id) REFERENCES hospital (id)');
        $this->addSql('CREATE INDEX IDX_51E5B69B489C60E8 ON persona (hospital_nac_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE persona DROP FOREIGN KEY FK_51E5B69B489C60E8');
        $this->addSql('DROP INDEX IDX_51E5B69B489C60E8 ON persona');
        $this->addSql('ALTER TABLE persona DROP hospital_nac_id');
    }
}
