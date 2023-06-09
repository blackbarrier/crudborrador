<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608161601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE persona_domicilio CHANGE user_actualiza_id usuario_actualiza_id INT NOT NULL');
        $this->addSql('ALTER TABLE profesional CHANGE user_id usuario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profesional ADD CONSTRAINT FK_2BB32E08DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX FK_profesional_usuario ON profesional (usuario_id)');
        $this->addSql('ALTER TABLE profesional_especialista CHANGE profesional_id profesional_id INT DEFAULT NULL, CHANGE especialidad_id especialidad_id INT DEFAULT NULL, CHANGE borrado borrado TINYINT(1) NOT NULL COMMENT \'0: activo - 1: borrado\'');
        $this->addSql('ALTER TABLE profesional_registracion CHANGE profesional_id profesional_id INT DEFAULT NULL, CHANGE alcance_id alcance_id INT DEFAULT NULL, CHANGE origen_registracion_id origen_registracion_id INT DEFAULT NULL, CHANGE borrado borrado TINYINT(1) NOT NULL COMMENT \'0: activo - 1: borrado\'');
        $this->addSql('ALTER TABLE profesional_registracion_archivo CHANGE profesional_registracion_id profesional_registracion_id INT DEFAULT NULL, CHANGE path path VARCHAR(100) NOT NULL, CHANGE nombre_archivo nombre_archivo VARCHAR(100) NOT NULL, CHANGE tipo_archivo tipo_archivo VARCHAR(50) NOT NULL, CHANGE borrado borrado TINYINT(1) NOT NULL COMMENT \'0: activo - 1: borrado\'');
        $this->addSql('ALTER TABLE provincia CHANGE pais_id pais_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE persona_domicilio CHANGE usuario_actualiza_id user_actualiza_id INT NOT NULL');
        $this->addSql('ALTER TABLE profesional DROP FOREIGN KEY FK_2BB32E08DB38439E');
        $this->addSql('DROP INDEX FK_profesional_usuario ON profesional');
        $this->addSql('ALTER TABLE profesional CHANGE usuario_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profesional_especialista CHANGE especialidad_id especialidad_id INT NOT NULL, CHANGE profesional_id profesional_id INT NOT NULL, CHANGE borrado borrado TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'0: activo - 1: borrado\'');
        $this->addSql('ALTER TABLE profesional_registracion CHANGE profesional_id profesional_id INT NOT NULL, CHANGE origen_registracion_id origen_registracion_id INT NOT NULL, CHANGE alcance_id alcance_id INT NOT NULL, CHANGE borrado borrado TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'0: activo - 1: borrado\'');
        $this->addSql('ALTER TABLE profesional_registracion_archivo CHANGE profesional_registracion_id profesional_registracion_id INT NOT NULL, CHANGE path path VARCHAR(100) DEFAULT \'\' NOT NULL, CHANGE nombre_archivo nombre_archivo VARCHAR(100) DEFAULT \'\' NOT NULL, CHANGE tipo_archivo tipo_archivo VARCHAR(50) DEFAULT \'\' NOT NULL, CHANGE borrado borrado TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'0: activo - 1: borrado\'');
        $this->addSql('ALTER TABLE provincia CHANGE pais_id pais_id INT NOT NULL');
    }
}
