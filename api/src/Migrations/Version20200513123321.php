<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200513123321 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP INDEX uniq_8d93d649a1ace158');
        $this->addSql('DROP INDEX uniq_8d93d6493124b5b6');
        $this->addSql('DROP INDEX uniq_8d93d64914b78418');
        $this->addSql('DROP INDEX uniq_8d93d649d4e6f81');
        $this->addSql('DROP INDEX uniq_8d93d649835033f8');
        $this->addSql('DROP INDEX uniq_8d93d6492d5b0234');
        $this->addSql('DROP INDEX uniq_8d93d64983a00e68');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d649a1ace158 ON "user" (zip_code)');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d6493124b5b6 ON "user" (lastname)');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d64914b78418 ON "user" (photo)');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d649d4e6f81 ON "user" (address)');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d649835033f8 ON "user" (genre)');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d6492d5b0234 ON "user" (city)');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d64983a00e68 ON "user" (firstname)');
    }
}
