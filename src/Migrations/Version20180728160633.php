<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180728160633 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3E097FE32');
        $this->addSql('DROP TABLE customer');
        $this->addSql('ALTER TABLE `order` DROP date_order, DROP visitor');
        $this->addSql('DROP INDEX IDX_97A0ADA3E097FE32 ON ticket');
        $this->addSql('ALTER TABLE ticket ADD name VARCHAR(255) NOT NULL, ADD surname VARCHAR(255) NOT NULL, ADD birthday DATETIME NOT NULL, ADD country VARCHAR(255) NOT NULL, ADD reduction TINYINT(1) NOT NULL, DROP id_customers_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, firstname VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD date_order DATETIME NOT NULL, ADD visitor VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE ticket ADD id_customers_id INT NOT NULL, DROP name, DROP surname, DROP birthday, DROP country, DROP reduction');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3E097FE32 FOREIGN KEY (id_customers_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3E097FE32 ON ticket (id_customers_id)');
    }
}
