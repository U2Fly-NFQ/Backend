<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220616024646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car ADD thumbnail_id INT NOT NULL, ADD created_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DFDFF2E92 FOREIGN KEY (thumbnail_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DE104C1D3 FOREIGN KEY (created_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_773DE69DFDFF2E92 ON car (thumbnail_id)');
        $this->addSql('CREATE INDEX IDX_773DE69DE104C1D3 ON car (created_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DFDFF2E92');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DE104C1D3');
        $this->addSql('DROP INDEX UNIQ_773DE69DFDFF2E92 ON car');
        $this->addSql('DROP INDEX IDX_773DE69DE104C1D3 ON car');
        $this->addSql('ALTER TABLE car DROP thumbnail_id, DROP created_user_id');
    }
}
