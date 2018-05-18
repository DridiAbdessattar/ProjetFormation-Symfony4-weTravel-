<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180511162552 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, vaoyage_organise_id INT DEFAULT NULL, soire_id INT DEFAULT NULL, user_id INT DEFAULT NULL, date DATETIME NOT NULL, nbre_place INT NOT NULL, prix DOUBLE PRECISION NOT NULL, date_creation DATETIME NOT NULL, INDEX IDX_42C849555344000 (vaoyage_organise_id), INDEX IDX_42C849553128338 (soire_id), INDEX IDX_42C84955A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vaoyage_organise (id INT AUTO_INCREMENT NOT NULL, date_depart DATETIME NOT NULL, nbre_jour INT NOT NULL, prix DOUBLE PRECISION NOT NULL, title VARCHAR(255) NOT NULL, cover VARCHAR(255) NOT NULL, programme VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville_vaoyage_organise (ville_id INT NOT NULL, vaoyage_organise_id INT NOT NULL, INDEX IDX_B6A1E5DFA73F0036 (ville_id), INDEX IDX_B6A1E5DF5344000 (vaoyage_organise_id), PRIMARY KEY(ville_id, vaoyage_organise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, vaoyage_organise_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_C53D045F5344000 (vaoyage_organise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soire (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, tarif DOUBLE PRECISION NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, place VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849555344000 FOREIGN KEY (vaoyage_organise_id) REFERENCES vaoyage_organise (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849553128338 FOREIGN KEY (soire_id) REFERENCES soire (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ville_vaoyage_organise ADD CONSTRAINT FK_B6A1E5DFA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ville_vaoyage_organise ADD CONSTRAINT FK_B6A1E5DF5344000 FOREIGN KEY (vaoyage_organise_id) REFERENCES vaoyage_organise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F5344000 FOREIGN KEY (vaoyage_organise_id) REFERENCES vaoyage_organise (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849555344000');
        $this->addSql('ALTER TABLE ville_vaoyage_organise DROP FOREIGN KEY FK_B6A1E5DF5344000');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F5344000');
        $this->addSql('ALTER TABLE ville_vaoyage_organise DROP FOREIGN KEY FK_B6A1E5DFA73F0036');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849553128338');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vaoyage_organise');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE ville_vaoyage_organise');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE soire');
    }
}
