<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210722082643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_voyage (tag_id INT NOT NULL, voyage_id INT NOT NULL, INDEX IDX_D6DCC079BAD26311 (tag_id), INDEX IDX_D6DCC07968C9E5AF (voyage_id), PRIMARY KEY(tag_id, voyage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tag_voyage ADD CONSTRAINT FK_D6DCC079BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_voyage ADD CONSTRAINT FK_D6DCC07968C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage ADD id_cat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D8955C09A1CAE FOREIGN KEY (id_cat_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_3F9D8955C09A1CAE ON voyage (id_cat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D8955C09A1CAE');
        $this->addSql('ALTER TABLE tag_voyage DROP FOREIGN KEY FK_D6DCC079BAD26311');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_voyage');
        $this->addSql('DROP INDEX IDX_3F9D8955C09A1CAE ON voyage');
        $this->addSql('ALTER TABLE voyage DROP id_cat_id');
    }
}
