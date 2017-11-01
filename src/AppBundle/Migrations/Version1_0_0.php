<?php

namespace AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Class Version1_0_0
 */
class Version1_0_0 extends AbstractMigration
{
    /**
     * Up
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        // Tables
        $this->addSql('CREATE TABLE ds_session (id VARCHAR(128) NOT NULL PRIMARY KEY, `data` BLOB NOT NULL, `time` INTEGER UNSIGNED NOT NULL, lifetime MEDIUMINT NOT NULL) COLLATE utf8_bin, engine = innodb');
        $this->addSql('CREATE TABLE ds_config (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `key` VARCHAR(255) NOT NULL, `value` LONGTEXT DEFAULT NULL, enabled TINYINT(1) NOT NULL, version INT DEFAULT 1 NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_758C45F4D17F50A6 (uuid), UNIQUE INDEX UNIQ_758C45F44E645A7E (`key`), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_access (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', identity VARCHAR(255) DEFAULT NULL, identity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_A76F41DCD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_access_permission (id INT AUTO_INCREMENT NOT NULL, access_id INT DEFAULT NULL, entity VARCHAR(255) DEFAULT NULL, entity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `key` VARCHAR(255) NOT NULL, attributes LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', INDEX IDX_D46DD4D04FEA67CF (access_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_asset (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', identity VARCHAR(255) DEFAULT NULL, identity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_D47CD791D17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_asset_association (id INT AUTO_INCREMENT NOT NULL, asset_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', entity VARCHAR(255) NOT NULL, entity_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) NOT NULL, owner_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_D7B8D55AD17F50A6 (uuid), INDEX IDX_D7B8D55A5DA1941 (asset_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_asset_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_BC9F16462C2AC5D3 (translatable_id), UNIQUE INDEX app_asset_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        // Foreign Keys
        $this->addSql('ALTER TABLE ds_access_permission ADD CONSTRAINT FK_D46DD4D04FEA67CF FOREIGN KEY (access_id) REFERENCES ds_access (id)');
        $this->addSql('ALTER TABLE app_asset_association ADD CONSTRAINT FK_D7B8D55A5DA1941 FOREIGN KEY (asset_id) REFERENCES app_asset (id)');
        $this->addSql('ALTER TABLE app_asset_trans ADD CONSTRAINT FK_BC9F16462C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_asset (id) ON DELETE CASCADE');

        // Data
        $this->addSql('
            INSERT INTO 
                `ds_config` (`id`, `uuid`, `owner`, `owner_uuid`, `key`, `value`, `enabled`, `version`, `created_at`, `updated_at`)
            VALUES 
                (1, \'100f677f-28f9-4842-a0b8-fcaaea520205\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.user.username\', \'system@ds\', 1, 1, now(), now()),
                (2, \'add4781a-ba82-4f1c-bba4-3bf152dec047\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.user.uuid\', \'b496655f-8fe6-4340-9a77-1bc3eeabab53\', 1, 1, now(), now()),
                (3, \'b96682ce-8dea-4a1a-a13e-7d8749c3baf4\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.user.roles\', \'ROLE_SYSTEM\', 1, 1, now(), now()),
                (4, \'74b931d5-1e6e-4d98-8cdb-0c6fdd7936f4\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.user.identity\', \'System\', 1, 1, now(), now()),
                (5, \'ae45c251-1592-41ce-92b4-75a8acdc80a1\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.user.identity_uuid\', \'df5fd904-aa47-452f-9c4a-d6b52fe5ace4\', 1, 1, now(), now()),
                (6, \'2b2ae71f-2e85-41c0-88f4-3161b0ca3eaa\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.authentication.host\', \'http://127.0.0.1\', 1, 1, now(), now()),
                (7, \'e1b4933d-0a84-44bc-8b3a-67eed67e776c\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.identities.host\', \'http://127.0.0.1\', 1, 1, now(), now()),
                (8, \'6e70bc1a-049c-4fa3-9f0c-b6e9a4c06f97\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.cases.host\', \'http://127.0.0.1\', 1, 1, now(), now()),
                (9, \'279e1644-addb-48fd-983d-2a2be4aa8d89\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.services.host\', \'http://127.0.0.1\', 1, 1, now(), now()),
                (10, \'c4bc767e-2772-4b27-8edb-8061b8cc1db3\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.records.host\', \'http://127.0.0.1\', 1, 1, now(), now()),
                (11, \'90218efe-d6ff-4933-bc39-d0fe8ad85165\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.assets.host\', \'http://127.0.0.1\', 1, 1, now(), now()),
                (12, \'2f047fec-f816-4c59-b2d1-b5b20bbc126b\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.cms.host\', \'http://127.0.0.1\', 1, 1, now(), now()),
                (13, \'388c2861-7f4a-41b5-8a09-847833d32d66\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.camunda.host\', \'http://127.0.0.1/engine-rest\', 1, 1, now(), now()),
                (14, \'aea7371f-7768-498e-be8d-68810be03111\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.formio.host\', \'http://127.0.0.1\', 1, 1, now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                `ds_access` (`id`, `uuid`, `owner`, `owner_uuid`, `identity`, `identity_uuid`, `version`, `created_at`, `updated_at`)
            VALUES 
                (1, \'f86c5f4d-db8c-4581-9ca7-cce959db04eb\', \'System\', \'df5fd904-aa47-452f-9c4a-d6b52fe5ace4\', \'System\', \'df5fd904-aa47-452f-9c4a-d6b52fe5ace4\', 1, now(), now()),
                (2, \'aa5b73bd-24f9-4e5e-85ad-0823c006f8dc\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'System\', \'7b59586d-6924-47f3-bc1b-0dc207f5e80c\', 1, now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                `ds_access_permission` (`id`, `access_id`, `entity`, `entity_uuid`, `key`, `attributes`)
            VALUES 
                (1, 1, \'BusinessUnit\', NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\'),
                (2, 1, \'BusinessUnit\', NULL, \'property\', \'["BROWSE","READ","EDIT"]\'),
                (3, 1, \'BusinessUnit\', NULL, \'custom\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\'),
                (4, 2, \'BusinessUnit\', NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\'),
                (5, 2, \'BusinessUnit\', NULL, \'property\', \'["BROWSE","READ","EDIT"]\'),
                (6, 2, \'BusinessUnit\', NULL, \'custom\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\');
        ');
    }

    /**
     * Down
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        // Foreign Keys
        $this->addSql('ALTER TABLE ds_access_permission DROP FOREIGN KEY FK_D46DD4D04FEA67CF');
        $this->addSql('ALTER TABLE app_asset_association DROP FOREIGN KEY FK_D7B8D55A5DA1941');
        $this->addSql('ALTER TABLE app_asset_trans DROP FOREIGN KEY FK_BC9F16462C2AC5D3');

        // Tables
        $this->addSql('DROP TABLE ds_config');
        $this->addSql('DROP TABLE ds_access');
        $this->addSql('DROP TABLE ds_access_permission');
        $this->addSql('DROP TABLE app_asset');
        $this->addSql('DROP TABLE app_asset_association');
        $this->addSql('DROP TABLE app_asset_trans');
        $this->addSql('DROP TABLE ds_session');
    }
}
