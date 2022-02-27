<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220221163009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('
            INSERT INTO users (email, roles, password, first_name, last_name, account_type, location, contact, slug)
            VALUES 
                   (
                    "anonyme@todo-and-co.herokuapp.com",
                    "[]",
                    "$argon2id$v=19$m=16,t=2,p=1$eXlZeVVuTGtMZ29EcjIxRw$brUu1X3JtDYEPds/XGI5yA",
                    "Anonyme",
                    "ANONYMOUS",
                    "Administrateur",
                    "https://todo-and-co.herokuapp.com/",
                    "https://todo-and-co.herokuapp.com/",
                    "Anonymous"
                    ),
                    (
                    "marielehmann@todo-and-co.herokuapp.com",
                    "[\\"ROLE_USER\\", \\"ROLE_ADMIN\\"]",
                    "$argon2i$v=19$m=16,t=2,p=1$cnVIa1RPamtzVEswcU5QNg$TiPDsX0fKZECZvX+0QI9dg",
                    "Marie",
                    "LEHMANN",
                    "Administrateur",
                    "Strasbourg, France",
                    "+33 09 87 65 45",
                    "marielehmann"
                    );
        ');

        $this->addSql('SET foreign_key_checks = 0');

        $this->addSql('UPDATE tasks SET user_id = 1 WHERE user_id is null');

        $this->addSql('SET foreign_key_checks = 1');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM users WHERE email = "anonyme@todo-and-co.herokuapp.com";');
    }
}
