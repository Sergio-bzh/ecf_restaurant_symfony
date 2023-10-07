<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231007211101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `primary` ON reservation_allergie');
        $this->addSql('ALTER TABLE reservation_allergie ADD PRIMARY KEY (reservation_id, allergie_id)');
        $this->addSql('ALTER TABLE reservation_allergie RENAME INDEX idx_65842836b83297e7 TO IDX_836D7C5EB83297E7');
        $this->addSql('ALTER TABLE reservation_allergie RENAME INDEX idx_658428367c86304a TO IDX_836D7C5E7C86304A');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `PRIMARY` ON reservation_allergie');
        $this->addSql('ALTER TABLE reservation_allergie ADD PRIMARY KEY (allergie_id, reservation_id)');
        $this->addSql('ALTER TABLE reservation_allergie RENAME INDEX idx_836d7c5e7c86304a TO IDX_658428367C86304A');
        $this->addSql('ALTER TABLE reservation_allergie RENAME INDEX idx_836d7c5eb83297e7 TO IDX_65842836B83297E7');
    }
}
