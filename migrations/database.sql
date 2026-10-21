CREATE DATABASE concessionariapea;
USE concessionariapea;


CREATE TABLE clintes (
    IdCliente INT PRIMARY KEY AUTO_INCREMENT,
    nome_completo VARCHAR(50) NOT NULL,
    Cpf VARCHAR(15) NOT NULL UNIQUE,
    Email VARCHAR(50) NOT NULL,
    Telefone VARCHAR(21) NOT NULL,
    Cidade VARCHAR(30) NOT NULL
);

CREATE TABLE carros (
    IdCarro INT PRIMARY KEY AUTO_INCREMENT,
    Marca VARCHAR(25) NOT NULL,
    Modelo VARCHAR(25) NOT NULL,
    ano_fabricacao DATE NOT NULL,
    Cor VARCHAR(15) NOT NULL,
    Placa VARCHAR(15) NOT NULL UNIQUE,
    Quilometragem FLOAT NOT NULL,
    Preco DECIMAL(10,2) NOT NULL,
    Situacao ENUM('Dispinível','Vendido')
)

CREATE TABLE motos (
    IdMoto INT PRIMARY KEY AUTO_INCREMENT,
    Marca VARCHAR(25) NOT NULL,
    Modelo VARCHAR(25) NOT NULL,
    ano_fabricacao DATE NOT NULL,
    Cor VARCHAR(15) NOT NULL,
    Placa VARCHAR(15) NOT NULL UNIQUE,
    Quilometragem FLOAT NOT NULL,
    Preco DECIMAL(10,2) NOT NULL,
    Situacao ENUM('Dispinível','Vendido')
)

CREATE TABLE funcionarios (
    IdFuncionário INT PRIMARY KEY AUTO_INCREMENT,
    nome_completo VARCHAR(50) NOT NULL,
    cpf VARCHAR(15) NOT NULL UNIQUE,
    Email VARCHAR(50) NOT NULL,
    Telefone VARCHAR(21) NOT NULL,
    Cargo VARCHAR(20) NOT NULL,
    Salario DECIMAL(10,2) NOT NULL
);