CREATE TABLE `membros_api`.`endereco` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rua` VARCHAR(150) NOT NULL,
  `bairro` VARCHAR(150) NOT NULL,
  `cidade` VARCHAR(150) NOT NULL,
  `uf` VARCHAR(2) NOT NULL,
  `cep` VARCHAR(9) NOT NULL,
  `complemento` VARCHAR(150),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

CREATE TABLE `membros_api`.`igreja` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `abreviacao` VARCHAR(150) NOT NULL,
  `dataFundacao` DATE,
  `cnpj` VARCHAR(14),
  `idEndereco` INT,
  `presidente` VARCHAR(150),
  `secretaria` VARCHAR(150),
  `email` VARCHAR(150),
  `telefone` VARCHAR(100),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

ALTER TABLE `membros_api`.`igreja` 
ADD INDEX `fk_idEndereco` (`idEndereco` ASC);
;
ALTER TABLE `membros_api`.`igreja` 
ADD CONSTRAINT `fk_endereco`
  FOREIGN KEY (`idEndereco`)
  REFERENCES `membros_api`.`endereco` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  INSERT INTO `membros_api`.`igreja` (`nome`, `abreviacao`, `dataFundacao`) VALUES ('Igreja Batista de Vera Cruz', 'IBVC', '1960-11-15');



CREATE TABLE `membros_api`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idIgreja` INT NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(100) NOT NULL,
  `ativo` boolean NOT NULL,
  `ultimoLogin` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

ALTER TABLE `membros_api`.`usuario` 
ADD INDEX `fk_idIgreja` (`idIgreja` ASC);
;
ALTER TABLE `membros_api`.`usuario` 
ADD CONSTRAINT `fk_igreja`
  FOREIGN KEY (`idIgreja`)
  REFERENCES `membros_api`.`igreja` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

--Senha: Ls@999517332
INSERT INTO `membros_api`.`usuario` (`idIgreja`, `nome`, `email`, `senha`, `ativo`, `ultimoLogin`) VALUES (1, 'Leandro', 'leandro.sousa.azevedo@gmail.com', '$2y$10$/A6LMKpbiIBTMc78fbp60./DnUviNYFHi.RMQxkT.3M.CkJgFpWY2', true, '2023-07-17 17:26:30');


