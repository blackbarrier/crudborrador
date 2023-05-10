<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230508172329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medico DROP FOREIGN KEY FK_34E5914C489C60E8');
        $this->addSql('DROP INDEX IDX_34E5914C489C60E8 ON medico');
        $this->addSql('ALTER TABLE medico DROP hospital_nac_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medico ADD hospital_nac_id INT NOT NULL');
        $this->addSql('ALTER TABLE medico ADD CONSTRAINT FK_34E5914C489C60E8 FOREIGN KEY (hospital_nac_id) REFERENCES hospital (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_34E5914C489C60E8 ON medico (hospital_nac_id)');
    }
}
