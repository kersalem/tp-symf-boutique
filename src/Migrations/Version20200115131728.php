<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200115131728 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_commande MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_commande DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ligne_commande DROP id, DROP id_article, DROP id_commande, CHANGE commande_id commande_id INT NOT NULL, CHANGE produit_id produit_id INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_commande ADD PRIMARY KEY (commande_id, produit_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_commande ADD id INT AUTO_INCREMENT NOT NULL, ADD id_article VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD id_commande VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE commande_id commande_id INT DEFAULT NULL, CHANGE produit_id produit_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
