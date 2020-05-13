<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200513093829 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE application_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE offer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE application (id INT NOT NULL, applicant_id INT NOT NULL, offer_id INT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, sex BOOLEAN NOT NULL, photo VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, age INT NOT NULL, address VARCHAR(255) NOT NULL, motives TEXT NOT NULL, expected_salary INT NOT NULL, cv VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A45BDDC197139001 ON application (applicant_id)');
        $this->addSql('CREATE INDEX IDX_A45BDDC153C674EE ON application (offer_id)');
        $this->addSql('CREATE TABLE offer (id INT NOT NULL, created_by_id INT NOT NULL, name VARCHAR(255) NOT NULL, company_description TEXT NOT NULL, offer_description TEXT NOT NULL, begin_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, contract_type VARCHAR(255) NOT NULL, place VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_29D6873EB03A8386 ON offer (created_by_id)');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC197139001 FOREIGN KEY (applicant_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC153C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EB03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE application DROP CONSTRAINT FK_A45BDDC153C674EE');
        $this->addSql('DROP SEQUENCE application_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE offer_id_seq CASCADE');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE offer');
    }
}
