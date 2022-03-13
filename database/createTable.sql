
CREATE TABLE `tags` (
    `id` INT(10)  NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255),
    `is_deteted` boolean,
    PRIMARY KEY (`id`)
);

CREATE TABLE `product_tags` (
    `id` INT(10)  NOT NULL AUTO_INCREMENT,
    `id_tag` INT(10),
    `id_product` INT(10),
    PRIMARY KEY (`id`)
)

