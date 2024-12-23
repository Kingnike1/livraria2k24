-- MySQL Script generated by MySQL Workbench
-- Fri Nov  8 09:50:24 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`editora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`editora` (
  `ideditora` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `localidade` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`ideditora`),
  UNIQUE INDEX `ideditora_UNIQUE` (`ideditora` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`cliente` (
  `idcliente` INT NOT NULL AUTO_INCREMENT,
  `cpf` VARCHAR(45) NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `data_de_nascimento` DATE NOT NULL,
  PRIMARY KEY (`idcliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`autor` (
  `idautor` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `nacionalidade` VARCHAR(45) NOT NULL,
  `data_de_nascimento` DATE NOT NULL,
  PRIMARY KEY (`idautor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`funcionario` (
  `idfuncionario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cpf` VARCHAR(45) NOT NULL,
  `salario` DECIMAL(10,2) NOT NULL,
  `data_de_nascimento` DATE NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idfuncionario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`livro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`livro` (
  `idlivro` INT NOT NULL AUTO_INCREMENT,
  `genero` VARCHAR(100) NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `disponivel` TINYINT NOT NULL,
  `idioma` VARCHAR(30) NOT NULL,
  `data_de_publicacao` VARCHAR(45) NOT NULL,
  `autor_idautor` INT NOT NULL,
  `editora_ideditora` INT NOT NULL,
  PRIMARY KEY (`idlivro`),
  INDEX `fk_livro_autor1_idx` (`autor_idautor` ASC) VISIBLE,
  INDEX `fk_livro_editora1_idx` (`editora_ideditora` ASC) VISIBLE,
  CONSTRAINT `fk_livro_autor1`
    FOREIGN KEY (`autor_idautor`)
    REFERENCES `mydb`.`autor` (`idautor`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_livro_editora1`
    FOREIGN KEY (`editora_ideditora`)
    REFERENCES `mydb`.`editora` (`ideditora`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`emprestimo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`emprestimo` (
  `idemprestimo` INT NOT NULL AUTO_INCREMENT,
  `devolucao` DATE NOT NULL,
  `dia_do_emprestimo` TIMESTAMP NOT NULL,
  `funcionario_idfuncionario` INT NOT NULL,
  `cliente_idcliente` INT NOT NULL,
  `livro_idlivro` INT NOT NULL,
  PRIMARY KEY (`idemprestimo`),
  INDEX `fk_emprestimo_funcionario1_idx` (`funcionario_idfuncionario` ASC) VISIBLE,
  INDEX `fk_emprestimo_cliente1_idx` (`cliente_idcliente` ASC) VISIBLE,
  INDEX `fk_emprestimo_livro1_idx` (`livro_idlivro` ASC) VISIBLE,
  CONSTRAINT `fk_emprestimo_funcionario1`
    FOREIGN KEY (`funcionario_idfuncionario`)
    REFERENCES `mydb`.`funcionario` (`idfuncionario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_emprestimo_cliente1`
    FOREIGN KEY (`cliente_idcliente`)
    REFERENCES `mydb`.`cliente` (`idcliente`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_emprestimo_livro1`
    FOREIGN KEY (`livro_idlivro`)
    REFERENCES `mydb`.`livro` (`idlivro`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(120) NOT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE INDEX `idusuario_UNIQUE` (`idusuario` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  UNIQUE INDEX `senha_UNIQUE` (`senha` ASC) VISIBLE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `avaliacao_funcionario` (
  `idavaliacao` INT NOT NULL AUTO_INCREMENT,
  `funcionario_idfuncionario` INT NOT NULL,
  `cliente_idcliente` INT NOT NULL,
  `avaliacao` DECIMAL(3,2) NOT NULL,  -- Ex: avaliação de 0.00 a 5.00
  `data_avaliacao` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idavaliacao`),
  INDEX `fk_avaliacao_funcionario_idx` (`funcionario_idfuncionario` ASC) VISIBLE,
  INDEX `fk_avaliacao_cliente_idx` (`cliente_idcliente` ASC) VISIBLE,
  CONSTRAINT `fk_avaliacao_funcionario`
    FOREIGN KEY (`funcionario_idfuncionario`)
    REFERENCES `mydb`.`funcionario` (`idfuncionario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_avaliacao_cliente`
    FOREIGN KEY (`cliente_idcliente`)
    REFERENCES `mydb`.`cliente` (`idcliente`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

use mydb;

-- Inserindo dados na tabela `editora`
INSERT INTO `mydb`.`editora` (`nome`, `localidade`) VALUES
('Editora Alpha', 'São Paulo'),
('Editora Beta', 'Rio de Janeiro'),
('Editora Gamma', 'Belo Horizonte'),
('Editora Delta', 'Curitiba'),
('Editora Epsilon', 'Salvador'),
('Editora Zeta', 'Porto Alegre'),
('Editora Eta', 'Recife'),
('Editora Theta', 'Brasília'),
('Editora Iota', 'Fortaleza'),
('Editora Kappa', 'Manaus');

-- Inserindo dados na tabela `cliente`
INSERT INTO `mydb`.`cliente` (`cpf`, `telefone`, `nome`, `data_de_nascimento`) VALUES
('12345678901', '(11) 98765-4321', 'João Silva', '1985-05-15'),
('23456789012', '(21) 97654-3210', 'Maria Oliveira', '1990-03-22'),
('34567890123', '(31) 96543-2109', 'Carlos Santos', '1978-12-05'),
('45678901234', '(41) 95432-1098', 'Ana Lima', '2000-07-09'),
('56789012345', '(51) 94321-0987', 'Paulo Gonçalves', '1983-01-20'),
('67890123456', '(71) 93210-9876', 'Carla Souza', '1995-09-13'),
('78901234567', '(81) 92109-8765', 'Ricardo Alves', '1970-11-30'),
('89012345678', '(61) 91098-7654', 'Fernanda Dias', '1988-06-25'),
('90123456789', '(85) 90987-6543', 'Gabriel Rocha', '1992-04-17'),
('01234567890', '(92) 89876-5432', 'Juliana Mendes', '1975-10-02');

-- Inserindo dados na tabela `autor`
INSERT INTO `mydb`.`autor` (`nome`, `nacionalidade`, `data_de_nascimento`) VALUES
('Machado de Assis', 'Brasileiro', '1839-06-21'),
('Clarice Lispector', 'Brasileira', '1920-12-10'),
('Jorge Amado', 'Brasileiro', '1912-08-10'),
('Paulo Coelho', 'Brasileiro', '1947-08-24'),
('Cecília Meireles', 'Brasileira', '1901-11-07'),
('Érico Veríssimo', 'Brasileiro', '1905-12-17'),
('Rubem Fonseca', 'Brasileiro', '1925-05-11'),
('Lygia Fagundes Telles', 'Brasileira', '1923-04-19'),
('Manuel Bandeira', 'Brasileiro', '1886-04-19'),
('Raquel de Queiroz', 'Brasileira', '1910-11-17');

-- Inserindo dados na tabela `funcionario`
INSERT INTO `mydb`.`funcionario` (`nome`, `cpf`, `salario`, `data_de_nascimento`, `telefone`) VALUES
('José da Silva', '11122233344', 2500.00, '1990-01-01', '(11) 91234-5678'),
('Ana Maria', '22233344455', 3000.00, '1985-02-15', '(21) 92345-6789'),
('Carlos Pereira', '33344455566', 2800.00, '1992-03-20', '(31) 93456-7890'),
('Mariana Souza', '44455566677', 3200.00, '1980-04-10', '(41) 94567-8901'),
('Fernanda Costa', '55566677788', 2900.00, '1978-05-30', '(51) 95678-9012'),
('Ricardo Alves', '66677788899', 3100.00, '1995-06-15', '(71) 96789-0123'),
('Juliana Mendes', '77788899900', 2700.00, '1993-07-25', '(81) 97890-1234'),
('Gabriel Rocha', '88899900011', 3400.00, '1987-08-05', '(61) 98901-2345'),
('Luciana Lima', '99900011122', 3300.00, '1975-09-12', '(85) 99012-3456'),
('Paulo Roberto', '00011122233', 2600.00, '1990-10-20', '(92) 90123-4567');

-- Inserindo dados na tabela `livro`
INSERT INTO `mydb`.`livro` (`genero`, `titulo`, `disponivel`, `idioma`, `data_de_publicacao`, `autor_idautor`, `editora_ideditora`) VALUES
('Romance', 'Dom Casmurro', 1, 'Português', '1899', 1, 1),
('Drama', 'A Hora da Estrela', 1, 'Português', '1977', 2, 2),
('Ficção', 'Capitães da Areia', 1, 'Português', '1937', 3, 3),
('Espiritualidade', 'O Alquimista', 1, 'Português', '1988', 4, 4),
('Poesia', 'Romanceiro da Inconfidência', 1, 'Português', '1953', 5, 5),
('Crônica', 'O Tempo e o Vento', 1, 'Português', '1949', 6, 6),
('Contos', 'Feliz Ano Novo', 1, 'Português', '1975', 7, 7),
('Memórias', 'Ciranda de Pedra', 1, 'Português', '1954', 8, 8),
('Poesia', 'Libertinagem', 1, 'Português', '1930', 9, 9),
('Romance', 'O Quinze', 1, 'Português', '1930', 10, 10);

-- Inserindo dados na tabela `emprestimo`
INSERT INTO `mydb`.`emprestimo` (`devolucao`, `dia_do_emprestimo`, `funcionario_idfuncionario`, `cliente_idcliente`, `livro_idlivro`) VALUES
('2024-11-25', '2024-11-15 10:00:00', 1, 1, 1),
('2024-11-26', '2024-11-16 11:00:00', 2, 2, 2),
('2024-11-27', '2024-11-17 12:00:00', 3, 3, 3),
('2024-11-28', '2024-11-18 13:00:00', 4, 4, 4),
('2024-11-29', '2024-11-19 14:00:00', 5, 5, 5),
('2024-11-30', '2024-11-20 15:00:00', 6, 6, 6),
('2024-12-01', '2024-11-21 16:00:00', 7, 7, 7),
('2024-12-02', '2024-11-22 17:00:00', 8, 8, 8),
('2024-12-03', '2024-11-23 18:00:00', 9, 9, 9),
('2024-12-04', '2024-11-24 19:00:00', 10, 10, 10);
