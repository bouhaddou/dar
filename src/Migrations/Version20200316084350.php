<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200316084350 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact CHANGE objet objet VARCHAR(255) DEFAULT NULL, CHANGE phone phone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE garant ADD name VARCHAR(255) NOT NULL, DROP first_name, DROP last_name, DROP set_at, DROP adresse, CHANGE email email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE images CHANGE caption caption VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE kafala ADD observation LONGTEXT DEFAULT NULL, ADD pour VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE orphelin ADD status TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE projets CHANGE image image VARCHAR(255) DEFAULT NULL, CHANGE prix prix DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact CHANGE objet objet VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE phone phone VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE garant ADD last_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD set_at DATE NOT NULL, ADD adresse LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE name first_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE images CHANGE caption caption VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE kafala DROP observation, DROP pour');
        $this->addSql('ALTER TABLE orphelin DROP status');
        $this->addSql('ALTER TABLE projets CHANGE image image VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE prix prix DOUBLE PRECISION DEFAULT \'NULL\'');
    }
}
