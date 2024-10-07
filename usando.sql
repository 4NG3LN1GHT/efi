CREATE DATABASE eficienSys;

USE eficienSys;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('gerente', 'manutentor', 'operario') NOT NULL
);

CREATE TABLE areas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE machines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    area_id INT,
    status ENUM('normal', 'aviso') DEFAULT 'normal',
	Status_Chamada ENUM('precisa_atendimento', 'em_atendimento') DEFAULT 'precisa_atendimento',
    last_reported_by VARCHAR(50),
    FOREIGN KEY (area_id) REFERENCES areas(id),
    attended_by_name VARCHAR(255)
);

CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    machine_id INT,
    reported_by VARCHAR(50),
    reported_by_name VARCHAR(255),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (machine_id) REFERENCES machines(id)
);

CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message VARCHAR(255),
    user_id INT,
    is_read BOOLEAN DEFAULT FALSE,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

insert into users (id, username, password, role) values (1, "adm", "123", 1);
insert into users (id, username, password, role) values (2, "fun", "123", 3);
insert into users (id, username, password, role) values (3, "man", "123", 2);
insert into areas (id, name) values (1, "area1");
insert into machines (name, area_id) values ("maquina1", 1);

