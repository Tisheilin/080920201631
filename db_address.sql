CREATE TABLE db.address
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    area VARCHAR(255) NOT NULL,
    streer VARCHAR(255),
    house VARCHAR(255),
    information VARCHAR(255)
);
CREATE UNIQUE INDEX address_id_uindex ON db.address (id);

INSERT INTO db.address (name, city, area, street, house, information) VALUES ('ANTAGOSOFT', 'Kharkiv', 'Khar''kovskaya', 'Tobolska', '32', '');

