<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220501180823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE permission_matrix (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, is_granted TINYINT(1) DEFAULT NULL, resourcePermission_id INT DEFAULT NULL, INDEX IDX_31E9E624D60322AC (role_id), INDEX IDX_31E9E624929DAE70 (resourcePermission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permission_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_DD10CC895E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resource_permissions (id INT AUTO_INCREMENT NOT NULL, resource_id INT DEFAULT NULL, permission_type_id INT DEFAULT NULL, INDEX IDX_2956F23D89329D25 (resource_id), INDEX IDX_2956F23DF25D6DC4 (permission_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resources (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, salt VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, is_enabled TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, last_login_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE permission_matrix ADD CONSTRAINT FK_31E9E624D60322AC FOREIGN KEY (role_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE permission_matrix ADD CONSTRAINT FK_31E9E624929DAE70 FOREIGN KEY (resourcePermission_id) REFERENCES resource_permissions (id)');
        $this->addSql('ALTER TABLE resource_permissions ADD CONSTRAINT FK_2956F23D89329D25 FOREIGN KEY (resource_id) REFERENCES resources (id)');
        $this->addSql('ALTER TABLE resource_permissions ADD CONSTRAINT FK_2956F23DF25D6DC4 FOREIGN KEY (permission_type_id) REFERENCES permission_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resource_permissions DROP FOREIGN KEY FK_2956F23DF25D6DC4');
        $this->addSql('ALTER TABLE permission_matrix DROP FOREIGN KEY FK_31E9E624929DAE70');
        $this->addSql('ALTER TABLE resource_permissions DROP FOREIGN KEY FK_2956F23D89329D25');
        $this->addSql('ALTER TABLE permission_matrix DROP FOREIGN KEY FK_31E9E624D60322AC');
        $this->addSql('DROP TABLE permission_matrix');
        $this->addSql('DROP TABLE permission_type');
        $this->addSql('DROP TABLE resource_permissions');
        $this->addSql('DROP TABLE resources');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE user');
    }
}
