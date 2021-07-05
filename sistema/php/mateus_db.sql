-- MySQL Script generated by MySQL Workbench
-- Sun Jan 31 13:01:03 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mateus_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mateus_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mateus_db` DEFAULT CHARACTER SET utf8 ;
USE `mateus_db` ;

-- -----------------------------------------------------
-- Table `mateus_db`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mateus_db`.`usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(90) NOT NULL,
  `login` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(90) NOT NULL,
  `nivel` INT NOT NULL,
  `ativo` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mateus_db`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mateus_db`.`cliente` (
  `idCliente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(90) NOT NULL,
  `endereco` VARCHAR(120) NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(45) NOT NULL,
  `dataRegistro` DATE NOT NULL,
  PRIMARY KEY (`idCliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mateus_db`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mateus_db`.`produto` (
  `idProduto` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(90) NOT NULL,
  `marca` VARCHAR(45) NULL,
  `imagem` VARCHAR(120) NULL,
  `precoCompra` DOUBLE NOT NULL,
  `precoVenda` DOUBLE NOT NULL,
  `quantidade` INT NOT NULL DEFAULT 1,
  `detalhes` MEDIUMTEXT NULL,
  PRIMARY KEY (`idProduto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mateus_db`.`pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mateus_db`.`pedido` (
  `idPedido` INT NOT NULL AUTO_INCREMENT,
  `idProdutos` VARCHAR(90) NOT NULL,
  `idCliente` INT NOT NULL,
  `valor` DOUBLE NOT NULL,
  `detalhes` MEDIUMTEXT NULL,
  `dataPedido` DATE NOT NULL,
  PRIMARY KEY (`idPedido`),

  INDEX `Ped_Cliente_idx` (`idCliente` ASC),
  CONSTRAINT `Ped_Cliente`
    FOREIGN KEY (`idCliente`)
    REFERENCES `mateus_db`.`cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mateus_db`.`gastos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mateus_db`.`gastos` (
  `idGasto` INT NOT NULL AUTO_INCREMENT,
  `descricao` MEDIUMTEXT NULL,
  `valor` DOUBLE NOT NULL,
  `data` DATE NOT NULL,
  PRIMARY KEY (`idGasto`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;