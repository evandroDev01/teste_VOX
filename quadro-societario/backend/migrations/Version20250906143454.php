<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250906143454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE company_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE partner_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE company (id INT NOT NULL, name VARCHAR(255) NOT NULL, cnpj VARCHAR(14) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE partner (id INT NOT NULL, company_id INT NOT NULL, name VARCHAR(255) NOT NULL, cpf VARCHAR(14) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_312B3E16979B1AD6 ON partner (company_id)');
        $this->addSql('ALTER TABLE partner ADD CONSTRAINT FK_312B3E16979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE company_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE partner_id_seq CASCADE');
        $this->addSql('ALTER TABLE partner DROP CONSTRAINT FK_312B3E16979B1AD6');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE partner');
    }
}
