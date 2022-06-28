<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627112123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE airline (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, country VARCHAR(50) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE airline_class (id INT AUTO_INCREMENT NOT NULL, class_id INT NOT NULL, airline_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, seat_available INT NOT NULL, INDEX IDX_3EE1AE98EA000B10 (class_id), INDEX IDX_3EE1AE98130D0C16 (airline_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE class_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discount (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flight (id INT AUTO_INCREMENT NOT NULL, airline_id INT NOT NULL, discount_id INT NOT NULL, arrival_airport VARCHAR(100) NOT NULL, departure_airport VARCHAR(100) NOT NULL, seats INT NOT NULL, start_time DATETIME NOT NULL, duration DOUBLE PRECISION NOT NULL, code VARCHAR(20) NOT NULL, INDEX IDX_C257E60E130D0C16 (airline_id), INDEX IDX_C257E60E4C7C611F (discount_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passenger (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, gender VARCHAR(10) NOT NULL, birthday DATETIME DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, identify_number VARCHAR(30) NOT NULL, email VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, passenger_id INT NOT NULL, flight_id INT NOT NULL, class_id INT NOT NULL, seat_number VARCHAR(10) NOT NULL, total_price DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_97A0ADA34502E565 (passenger_id), INDEX IDX_97A0ADA391F478C5 (flight_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE airline_class ADD CONSTRAINT FK_3EE1AE98EA000B10 FOREIGN KEY (class_id) REFERENCES class_type (id)');
        $this->addSql('ALTER TABLE airline_class ADD CONSTRAINT FK_3EE1AE98130D0C16 FOREIGN KEY (airline_id) REFERENCES airline (id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E130D0C16 FOREIGN KEY (airline_id) REFERENCES airline (id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E4C7C611F FOREIGN KEY (discount_id) REFERENCES discount (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA34502E565 FOREIGN KEY (passenger_id) REFERENCES passenger (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA391F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE airline_class DROP FOREIGN KEY FK_3EE1AE98130D0C16');
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60E130D0C16');
        $this->addSql('ALTER TABLE airline_class DROP FOREIGN KEY FK_3EE1AE98EA000B10');
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60E4C7C611F');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA391F478C5');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA34502E565');
        $this->addSql('DROP TABLE airline');
        $this->addSql('DROP TABLE airline_class');
        $this->addSql('DROP TABLE class_type');
        $this->addSql('DROP TABLE discount');
        $this->addSql('DROP TABLE flight');
        $this->addSql('DROP TABLE passenger');
        $this->addSql('DROP TABLE ticket');
    }
}
