<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220917210401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE canciones ADD genre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE canciones ADD CONSTRAINT FK_AEE7E8814296D31F FOREIGN KEY (genre_id) REFERENCES album (id)');
        $this->addSql('CREATE INDEX IDX_AEE7E8814296D31F ON canciones (genre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE canciones DROP FOREIGN KEY FK_AEE7E8814296D31F');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP INDEX IDX_AEE7E8814296D31F ON canciones');
        $this->addSql('ALTER TABLE canciones DROP genre_id');
    }
}
