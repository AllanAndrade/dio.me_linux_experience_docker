CREATE DATABASE dio;
USE dio;
CREATE TABLE dados (
    id int AUTO_INCREMENT NOT NULL, 
    AlunoID int,
    Nome varchar(50),
    Sobrenome varchar(50),
    Endereco varchar(150),
    Cidade varchar(50),
    Host varchar(50),
    PRIMARY KEY (id)
);
