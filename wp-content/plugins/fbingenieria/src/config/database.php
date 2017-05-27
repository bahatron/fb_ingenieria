<?php

function fbingenieriaDatabase()
{
    global $wpdb;
    $fbiClient = $wpdb->prefix.'fbi_clients';
    $fbiProject = $wpdb->prefix.'fbi_projects';
    $fbiProjectImg = $wpdb->prefix.'fbi_images';

    $sql = "CREATE TABLE IF NOT EXISTS $fbiClient (
      id INT(11) NOT NULL AUTO_INCREMENT,
      name VARCHAR(100) NOT NULL,
      webisteUrl VARCHAR(200) NULL,
      imageUrl VARCHAR(1000) NULL,
      description VARCHAR(1000) NULL,
      active TINYINT(1) NULL,
      PRIMARY KEY (id),
      UNIQUE INDEX name_UNIQUE (name ASC))
      ENGINE = InnoDB
      DEFAULT CHARACTER SET = utf8;";
    $wpdb->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS  $fbiProject (
      id INT(11) NOT NULL AUTO_INCREMENT,
      name VARCHAR(100) NOT NULL,
      shortDescription VARCHAR(160) NULL,
      longDescription VARCHAR(1000) NULL,
      client_id INT(11) NOT NULL,
      PRIMARY KEY (id),
      UNIQUE INDEX name_UNIQUE (name ASC),
      INDEX fk_fbiProject_fbiClient_idx (client_id ASC),
      CONSTRAINT fk_fbiProject_fbiClient
        FOREIGN KEY (client_id)
        REFERENCES $fbiClient (id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
      ENGINE = InnoDB
      DEFAULT CHARACTER SET = utf8;";
    $wpdb->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS $fbiProjectImg (
      id INT(11) NOT NULL AUTO_INCREMENT,
      url VARCHAR(1000) NOT NULL,
      name VARCHAR(100) NULL,
      project_id INT(11) NOT NULL,
      PRIMARY KEY (id),
      INDEX fk_fbiProjectImg_fbiProject1_idx (project_id ASC),
      CONSTRAINT fk_fbiProjectImg_fbiProject
        FOREIGN KEY (project_id)
        REFERENCES $fbiProject (id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
      ENGINE = InnoDB
      DEFAULT CHARACTER SET = utf8;";
    $wpdb->query($sql);
}
