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
            INSERT INTO tasks (title, description, status, slug)
            VALUES ("Payer les impôts sur le revenu", "Un impôt sur le revenu est prélevé directement à la source. Vous déclarerez vos revenus 2022 aux services des impôts à partir en avril 2022. À partir du 1er septembre 2022, vous serez prélevé selon le taux calculé sur vos revenus 2021.", "todo", "payerlesimpôtssurlerevenu"),
                   ("Commander un nouveau chéquier", "Toutes les banques traditionnelles vous offrent la possibilité d’avoir accès à un chéquier. C’est aussi le cas de certaines banques en ligne. Pour savoir si votre établissement bancaire vous permet de faire des chèques (ou pour trouver un organisme dans ce cas), le plus simple reste d’utiliser notre comparateur en ligne. Grâce à cet outil objectif, vous pouvez comparer en un coup d’oeil les différentes caractéristiques des banques, leurs coûts, ainsi que le nombre et le type de moyens de paiements qu’elles prévoient pour leurs clients.", "todo", "Commanderunnouveauchéquier"),
                   ("Avertir la banque : nouveau numéro", "Qui prévenir quand on change de banque ? Dans les faits, le particulier donne à sa nouvelle banque un mandat pour accomplir les démarches nécessaires. La nouvelle banque peut alors informer son ancienne banque de la volonté du client de fermer son compte et ainsi débuter les changements de domiciliation des prélèvements récurrents (voir ci-dessous).", "todo", "avertirlabanque:nouveaunuméro"),
                   ("Activer ma nouvelle carte bancaire", "Pour activer votre carte bancaire, effectuez un retrait dans un distributeur de billets en France ou ailleurs. Vous pouvez aussi régler un achat chez un commerçant en France, avec saisie de votre code secret. Cette méthode ne fonctionne pas avec les paiements par téléphone et sur Internet.", "todo", "activermanouvellecartebancaire");
        ');
        $this->addSql('
            INSERT INTO users (email, roles, password, first_name, last_name, account_type, location, contact, slug)
            VALUES 
                   (
                    "marielehmann@todo-and-co.herokuapp.com",
                    "[\\"ROLE_USER\\", \\"ROLE_ADMIN\\"]",
                    "$argon2i$v=19$m=16,t=2,p=1$cnVIa1RPamtzVEswcU5QNg$TiPDsX0fKZECZvX+0QI9dg",
                    "Anonyme",
                    "ANONYMOUS",
                    "Administrateur",
                    "https://todo-and-co.herokuapp.com/",
                    "https://todo-and-co.herokuapp.com/",
                    "Anonymous"
                    ),
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
