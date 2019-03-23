<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190322202333 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE abus (id INT AUTO_INCREMENT NOT NULL, about_id INT DEFAULT NULL, informer_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, encoding DATETIME DEFAULT NULL, INDEX IDX_72C9FD01D087DB59 (about_id), INDEX IDX_72C9FD016FFB3625 (informer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, content VARCHAR(255) DEFAULT NULL, cote INT DEFAULT NULL, encoding DATETIME DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_9474526CF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internship (id INT AUTO_INCREMENT NOT NULL, organizer_id INT DEFAULT NULL, show_date DATETIME DEFAULT NULL, show_until DATETIME DEFAULT NULL, begin DATETIME DEFAULT NULL, description VARCHAR(500) DEFAULT NULL, end DATETIME DEFAULT NULL, more_info VARCHAR(500) DEFAULT NULL, name VARCHAR(255) NOT NULL, price VARCHAR(255) DEFAULT NULL, INDEX IDX_10D1B00C876C4DDA (organizer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locality (id INT AUTO_INCREMENT NOT NULL, locality VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, doc_pdf VARCHAR(255) DEFAULT NULL, publication DATETIME DEFAULT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, logo_id INT DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, rank INT DEFAULT NULL, INDEX IDX_16DB4F89F98F144A (logo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE postal_code (id INT AUTO_INCREMENT NOT NULL, postal_code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, offer_id INT DEFAULT NULL, category_id INT DEFAULT NULL, show_date DATETIME DEFAULT NULL, show_until DATETIME DEFAULT NULL, begin DATETIME DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, doc_pdf VARCHAR(255) DEFAULT NULL, end DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_C11D7DD153C674EE (offer_id), INDEX IDX_C11D7DD112469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, adresse_cp_id INT DEFAULT NULL, adresse_locality_id INT DEFAULT NULL, adresse_city_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, adresse_num VARCHAR(255) DEFAULT NULL, adresse_street VARCHAR(255) DEFAULT NULL, banned TINYINT(1) DEFAULT NULL, identifiant INT DEFAULT NULL, inscr_activated TINYINT(1) DEFAULT NULL, inscri_date DATETIME DEFAULT NULL, unsucessful_try TINYINT(1) DEFAULT NULL, user_type VARCHAR(255) DEFAULT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D64985CF3708 (adresse_cp_id), INDEX IDX_8D93D649468CC37D (adresse_locality_id), INDEX IDX_8D93D64925B2DD30 (adresse_city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider (id INT NOT NULL, user_id INT DEFAULT NULL, email_contact VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, phone_numb VARCHAR(255) DEFAULT NULL, tva_numb VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_92C4739CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(500) DEFAULT NULL, in_front TINYINT(1) DEFAULT NULL, name VARCHAR(255) NOT NULL, validity TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_provider (service_id INT NOT NULL, provider_id INT NOT NULL, INDEX IDX_6BB228A1ED5CA9E6 (service_id), INDEX IDX_6BB228A1A53A8AA (provider_id), PRIMARY KEY(service_id, provider_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE surfer (id INT NOT NULL, avatar_id INT DEFAULT NULL, newsletter TINYINT(1) DEFAULT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_26ABE10486383B10 (avatar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE surfer_provider (surfer_id INT NOT NULL, provider_id INT NOT NULL, INDEX IDX_3ACB23B06729D507 (surfer_id), INDEX IDX_3ACB23B0A53A8AA (provider_id), PRIMARY KEY(surfer_id, provider_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abus ADD CONSTRAINT FK_72C9FD01D087DB59 FOREIGN KEY (about_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE abus ADD CONSTRAINT FK_72C9FD016FFB3625 FOREIGN KEY (informer_id) REFERENCES surfer (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES surfer (id)');
        $this->addSql('ALTER TABLE internship ADD CONSTRAINT FK_10D1B00C876C4DDA FOREIGN KEY (organizer_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89F98F144A FOREIGN KEY (logo_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD153C674EE FOREIGN KEY (offer_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD112469DE2 FOREIGN KEY (category_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64985CF3708 FOREIGN KEY (adresse_cp_id) REFERENCES postal_code (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649468CC37D FOREIGN KEY (adresse_locality_id) REFERENCES locality (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64925B2DD30 FOREIGN KEY (adresse_city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE provider ADD CONSTRAINT FK_92C4739CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE provider ADD CONSTRAINT FK_92C4739CBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_provider ADD CONSTRAINT FK_6BB228A1ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_provider ADD CONSTRAINT FK_6BB228A1A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE surfer ADD CONSTRAINT FK_26ABE10486383B10 FOREIGN KEY (avatar_id) REFERENCES picture (id)');
        $this->addSql('ALTER TABLE surfer ADD CONSTRAINT FK_26ABE104BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE surfer_provider ADD CONSTRAINT FK_3ACB23B06729D507 FOREIGN KEY (surfer_id) REFERENCES surfer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE surfer_provider ADD CONSTRAINT FK_3ACB23B0A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64925B2DD30');
        $this->addSql('ALTER TABLE abus DROP FOREIGN KEY FK_72C9FD01D087DB59');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649468CC37D');
        $this->addSql('ALTER TABLE surfer DROP FOREIGN KEY FK_26ABE10486383B10');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64985CF3708');
        $this->addSql('ALTER TABLE provider DROP FOREIGN KEY FK_92C4739CA76ED395');
        $this->addSql('ALTER TABLE provider DROP FOREIGN KEY FK_92C4739CBF396750');
        $this->addSql('ALTER TABLE surfer DROP FOREIGN KEY FK_26ABE104BF396750');
        $this->addSql('ALTER TABLE internship DROP FOREIGN KEY FK_10D1B00C876C4DDA');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89F98F144A');
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD153C674EE');
        $this->addSql('ALTER TABLE service_provider DROP FOREIGN KEY FK_6BB228A1A53A8AA');
        $this->addSql('ALTER TABLE surfer_provider DROP FOREIGN KEY FK_3ACB23B0A53A8AA');
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD112469DE2');
        $this->addSql('ALTER TABLE service_provider DROP FOREIGN KEY FK_6BB228A1ED5CA9E6');
        $this->addSql('ALTER TABLE abus DROP FOREIGN KEY FK_72C9FD016FFB3625');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE surfer_provider DROP FOREIGN KEY FK_3ACB23B06729D507');
        $this->addSql('DROP TABLE abus');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE internship');
        $this->addSql('DROP TABLE locality');
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE postal_code');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE provider');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_provider');
        $this->addSql('DROP TABLE surfer');
        $this->addSql('DROP TABLE surfer_provider');
    }
}
