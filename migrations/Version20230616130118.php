<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230616130118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE persona_domicilio CHANGE usuario_actualiza_id usuario_actualiza_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE persona_domicilio ADD CONSTRAINT FK_9AAF8CC31147731 FOREIGN KEY (usuario_actualiza_id_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_9AAF8CC31147731 ON persona_domicilio (usuario_actualiza_id_id)');
        $this->addSql('ALTER TABLE usuario ADD sexo_id INT DEFAULT NULL, DROP sexo');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D2B32DB58 FOREIGN KEY (sexo_id) REFERENCES sexo (id)');
        $this->addSql('CREATE INDEX IDX_2265B05D2B32DB58 ON usuario (sexo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE persona_domicilio DROP FOREIGN KEY FK_9AAF8CC31147731');
        $this->addSql('DROP INDEX IDX_9AAF8CC31147731 ON persona_domicilio');
        $this->addSql('ALTER TABLE persona_domicilio CHANGE usuario_actualiza_id_id usuario_actualiza_id INT NOT NULL');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D2B32DB58');
        $this->addSql('DROP INDEX IDX_2265B05D2B32DB58 ON usuario');
        $this->addSql('ALTER TABLE usuario ADD sexo VARCHAR(255) DEFAULT NULL, DROP sexo_id');
    }
}
