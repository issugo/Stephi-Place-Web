<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200202180202 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, id_bien_id INT NOT NULL, id_agent_id INT NOT NULL, UNIQUE INDEX UNIQ_F65593E56308117F (id_bien_id), INDEX IDX_F65593E564CF9D9E (id_agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bien (id INT AUTO_INCREMENT NOT NULL, id_vendeur_id INT NOT NULL, superficie DOUBLE PRECISION NOT NULL, nb_pieces INT NOT NULL, type VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, jardin TINYINT(1) NOT NULL, cave TINYINT(1) NOT NULL, cellier TINYINT(1) NOT NULL, loggia TINYINT(1) NOT NULL, terrasse TINYINT(1) NOT NULL, garage TINYINT(1) NOT NULL, verranda TINYINT(1) NOT NULL, prix_min DOUBLE PRECISION NOT NULL, prix_vente DOUBLE PRECISION NOT NULL, INDEX IDX_45EDC38620068689 (id_vendeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contre_proposition (id INT AUTO_INCREMENT NOT NULL, id_proposition_achat_id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_B0AAD320C27488F3 (id_proposition_achat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favori (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favori_utilisateur (favori_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_5ABDCB2AFF17033F (favori_id), INDEX IDX_5ABDCB2AFB88E14F (utilisateur_id), PRIMARY KEY(favori_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favori_annonce (favori_id INT NOT NULL, annonce_id INT NOT NULL, INDEX IDX_9BD937C2FF17033F (favori_id), INDEX IDX_9BD937C28805AB2F (annonce_id), PRIMARY KEY(favori_id, annonce_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposition_achat (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, id_annonce_id INT DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_98F93686C6EE5C49 (id_utilisateur_id), INDEX IDX_98F936862D8F2BF8 (id_annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vendeur (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, carte_identite LONGBLOB NOT NULL, UNIQUE INDEX UNIQ_7AF49996C6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E56308117F FOREIGN KEY (id_bien_id) REFERENCES bien (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E564CF9D9E FOREIGN KEY (id_agent_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC38620068689 FOREIGN KEY (id_vendeur_id) REFERENCES vendeur (id)');
        $this->addSql('ALTER TABLE contre_proposition ADD CONSTRAINT FK_B0AAD320C27488F3 FOREIGN KEY (id_proposition_achat_id) REFERENCES proposition_achat (id)');
        $this->addSql('ALTER TABLE favori_utilisateur ADD CONSTRAINT FK_5ABDCB2AFF17033F FOREIGN KEY (favori_id) REFERENCES favori (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favori_utilisateur ADD CONSTRAINT FK_5ABDCB2AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favori_annonce ADD CONSTRAINT FK_9BD937C2FF17033F FOREIGN KEY (favori_id) REFERENCES favori (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favori_annonce ADD CONSTRAINT FK_9BD937C28805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE proposition_achat ADD CONSTRAINT FK_98F93686C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE proposition_achat ADD CONSTRAINT FK_98F936862D8F2BF8 FOREIGN KEY (id_annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE vendeur ADD CONSTRAINT FK_7AF49996C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E564CF9D9E');
        $this->addSql('ALTER TABLE favori_annonce DROP FOREIGN KEY FK_9BD937C28805AB2F');
        $this->addSql('ALTER TABLE proposition_achat DROP FOREIGN KEY FK_98F936862D8F2BF8');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E56308117F');
        $this->addSql('ALTER TABLE favori_utilisateur DROP FOREIGN KEY FK_5ABDCB2AFF17033F');
        $this->addSql('ALTER TABLE favori_annonce DROP FOREIGN KEY FK_9BD937C2FF17033F');
        $this->addSql('ALTER TABLE contre_proposition DROP FOREIGN KEY FK_B0AAD320C27488F3');
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC38620068689');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE bien');
        $this->addSql('DROP TABLE contre_proposition');
        $this->addSql('DROP TABLE favori');
        $this->addSql('DROP TABLE favori_utilisateur');
        $this->addSql('DROP TABLE favori_annonce');
        $this->addSql('DROP TABLE proposition_achat');
        $this->addSql('DROP TABLE vendeur');
    }
}
