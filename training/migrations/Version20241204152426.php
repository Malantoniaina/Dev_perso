<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241204152426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comptes (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, numero_compte VARCHAR(10) NOT NULL, solde DOUBLE PRECISION NOT NULL, INDEX IDX_5673580119EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payments (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, compte_id INT DEFAULT NULL, payment_date DATE NOT NULL, amount DOUBLE PRECISION NOT NULL, INDEX IDX_65D29B3219EB6921 (client_id), INDEX IDX_65D29B32F2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comptes ADD CONSTRAINT FK_5673580119EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE payments ADD CONSTRAINT FK_65D29B3219EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE payments ADD CONSTRAINT FK_65D29B32F2C56620 FOREIGN KEY (compte_id) REFERENCES comptes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comptes DROP FOREIGN KEY FK_5673580119EB6921');
        $this->addSql('ALTER TABLE payments DROP FOREIGN KEY FK_65D29B3219EB6921');
        $this->addSql('ALTER TABLE payments DROP FOREIGN KEY FK_65D29B32F2C56620');
        $this->addSql('DROP TABLE comptes');
        $this->addSql('DROP TABLE payments');
    }
}
