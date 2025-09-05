<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250905130515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partner_role (id SERIAL NOT NULL, partner_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75DB9729393F8FE ON partner_role (partner_id)');
        $this->addSql('CREATE INDEX IDX_75DB972D60322AC ON partner_role (role_id)');
        $this->addSql('ALTER TABLE partner_role ADD CONSTRAINT FK_75DB9729393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE partner_role ADD CONSTRAINT FK_75DB972D60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE partner_role DROP CONSTRAINT FK_75DB9729393F8FE');
        $this->addSql('ALTER TABLE partner_role DROP CONSTRAINT FK_75DB972D60322AC');
        $this->addSql('DROP TABLE partner_role');
    }
}
