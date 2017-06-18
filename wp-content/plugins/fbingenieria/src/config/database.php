<?php

function cleanFbingenieriaDatabase()
{
    global $wpdb;
    $fbiClient = $wpdb->prefix.'fbi_clients';
    $fbiProject = $wpdb->prefix.'fbi_projects';
    $fbiProjectImg = $wpdb->prefix.'fbi_images';
    $fbiHeaderImg = $wpdb->prefix.'fbi_header_images';

    $sql = "DROP TABLE $fbiHeaderImg";
    $wpdb->query($sql);
    $sql = "DROP TABLE $fbiProjectImg";
    $wpdb->query($sql);
    $sql = "DROP TABLE $fbiProject";
    $wpdb->query($sql);
    $sql = "DROP TABLE $fbiClient";
    $wpdb->query($sql);
}

function fbingenieriaDatabase()
{
    global $wpdb;
    $fbiClient = $wpdb->prefix.'fbi_clients';
    $fbiProject = $wpdb->prefix.'fbi_projects';
    $fbiProjectImg = $wpdb->prefix.'fbi_images';
    $fbiHeaderImg = $wpdb->prefix.'fbi_header_images';

    $sql = "CREATE TABLE IF NOT EXISTS $fbiClient (
      id INT(11) NOT NULL AUTO_INCREMENT,
      name VARCHAR(100) NOT NULL,
      websiteUrl VARCHAR(200) NULL,
      imageUrl VARCHAR(1000) NULL,
      description VARCHAR(1000) NULL,
      visible TINYINT(1) NULL,
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
      visible TINYINT(1) NULL DEFAULT 1,
      client_id INT(11) NULL,
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
      url VARCHAR(1000) NULL,
      post_id VARCHAR(45) NULL,
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

    $sql = "CREATE TABLE IF NOT EXISTS $fbiHeaderImg (
      id INT(11) NOT NULL AUTO_INCREMENT,
      post_id VARCHAR(45) NOT NULL,
      PRIMARY KEY (id))
      ENGINE = InnoDB
      DEFAULT CHARACTER SET = utf8;";
    $wpdb->query($sql);
}
