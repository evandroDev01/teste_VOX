<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250905124415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, cnpj VARCHAR(20) NOT NULL, address VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE partner (id SERIAL NOT NULL, company_id INT NOT NULL, role_id INT NOT NULL, name VARCHAR(255) NOT NULL, cpf_cnpj VARCHAR(20) NOT NULL, share_percentage DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_312B3E16979B1AD6 ON partner (company_id)');
        $this->addSql('CREATE INDEX IDX_312B3E16D60322AC ON partner (role_id)');
        $this->addSql('CREATE TABLE role (id SERIAL NOT NULL, name VARCHAR(100) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE partner ADD CONSTRAINT FK_312B3E16979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE partner ADD CONSTRAINT FK_312B3E16D60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE partner DROP CONSTRAINT FK_312B3E16979B1AD6');
        $this->addSql('ALTER TABLE partner DROP CONSTRAINT FK_312B3E16D60322AC');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE role');
    }
}
