<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200513105956 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE application ADD zip_code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE application ADD city VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD firstname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD lastname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD genre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD photo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD address VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD zip_code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD city VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64983A00E68 ON "user" (firstname)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6493124B5B6 ON "user" (lastname)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649835033F8 ON "user" (genre)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64914B78418 ON "user" (photo)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D4E6F81 ON "user" (address)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A1ACE158 ON "user" (zip_code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6492D5B0234 ON "user" (city)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_8D93D64983A00E68');
        $this->addSql('DROP INDEX UNIQ_8D93D6493124B5B6');
        $this->addSql('DROP INDEX UNIQ_8D93D649835033F8');
        $this->addSql('DROP INDEX UNIQ_8D93D64914B78418');
        $this->addSql('DROP INDEX UNIQ_8D93D649D4E6F81');
        $this->addSql('DROP INDEX UNIQ_8D93D649A1ACE158');
        $this->addSql('DROP INDEX UNIQ_8D93D6492D5B0234');
        $this->addSql('ALTER TABLE "user" DROP firstname');
        $this->addSql('ALTER TABLE "user" DROP lastname');
        $this->addSql('ALTER TABLE "user" DROP genre');
        $this->addSql('ALTER TABLE "user" DROP photo');
        $this->addSql('ALTER TABLE "user" DROP address');
        $this->addSql('ALTER TABLE "user" DROP zip_code');
        $this->addSql('ALTER TABLE "user" DROP city');
        $this->addSql('ALTER TABLE application DROP zip_code');
        $this->addSql('ALTER TABLE application DROP city');
    }
}
