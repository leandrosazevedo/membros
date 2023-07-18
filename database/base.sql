-- TABELA: endereco
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

-- TABELA: igreja
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

-- TABELA: usuario
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


--- CRIAR

-- TABELA: instrucao
CREATE TABLE `membros_api`.`instrucao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `profissao` VARCHAR(150),
  `grau` VARCHAR(100),
  `linguaEstrangeira` VARCHAR(150),
  `instrumentoMusical` VARCHAR(150),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));


-- TABELA: pessoa
CREATE TABLE `membros_api`.`pessoa` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `dataNascimento` DATE,
  `sexo` VARCHAR(1) NOT NULL,
  `estadoCivil` VARCHAR(50),
  `tipoSanguineo` VARCHAR(3),
  `cpf` VARCHAR(11),
  `naturalidadeCidade` VARCHAR(150),
  `naturalidadeUF` VARCHAR(2),
  `nacionalidade`VARCHAR(100),
  `mae` VARCHAR(150),
  `pai` VARCHAR(150),
  `email` VARCHAR(150),
  `celular` VARCHAR(15),
  `whatsapp` VARCHAR(15),
  `idEndereco` INT,
  `idInstrucao` INT,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

ALTER TABLE `membros_api`.`pessoa` 
ADD INDEX `fk_idEndereco` (`idEndereco` ASC);
;
ALTER TABLE `membros_api`.`pessoa` 
ADD CONSTRAINT `fk_endereco`
  FOREIGN KEY (`idEndereco`)
  REFERENCES `membros_api`.`endereco` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


ALTER TABLE `membros_api`.`pessoa` 
ADD INDEX `fk_idInstrucao` (`idInstrucao` ASC);
;
ALTER TABLE `membros_api`.`pessoa` 
ADD CONSTRAINT `fk_instrucao`
  FOREIGN KEY (`idInstrucao`)
  REFERENCES `membros_api`.`instrucao` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


-- TABELA: visitante
CREATE TABLE `membros_api`.`visitante` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idIgreja` INT NOT NULL,
  `dataInicio` DATE NOT NULL,
  `observacao` TEXT,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

ALTER TABLE `membros_api`.`visitante` 
ADD INDEX `fk_idPessoa` (`id` ASC);
;
ALTER TABLE `membros_api`.`visitante` 
ADD CONSTRAINT `fk_pessoa`
  FOREIGN KEY (`id`)
  REFERENCES `membros_api`.`pessoa` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `membros_api`.`visitante` 
ADD INDEX `fk_idIgreja` (`idIgreja` ASC);
;
ALTER TABLE `membros_api`.`visitante` 
ADD CONSTRAINT `fk_igreja`
  FOREIGN KEY (`idIgreja`)
  REFERENCES `membros_api`.`igreja` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


-- TABELA: batismo
CREATE TABLE `membros_api`.`batismo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NOT NULL,
  `igreja` VARCHAR(150) NOT NULL,
  `pastor` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));


-- TABELA: membro
CREATE TABLE `membros_api`.`membro` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idIgreja` INT NOT NULL,
  `idBatismo` INT,
  `dataAdmissao` DATE NOT NULL,
  `formaAdmissao` VARCHAR(100) NOT NULL,
  `igrejasAnteriores` TEXT,
  `ministeriosAnteriores` TEXT,
  `ministerioAtual` TEXT,
  `donsEspirituais` TEXT,
  `ebd` boolean NOT NULL,
  `pgm` boolean NOT NULL,
  `dizimista` boolean NOT NULL,
  `ofertante` boolean NOT NULL,
  `contribuinte` boolean NOT NULL,
  `pam` boolean NOT NULL,
  `construcao` boolean NOT NULL,
  `status` VARCHAR(50) NOT NULL,
  `ultimaAtualizacao` DATE NOT NULL DEFAULT 'now()',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

ALTER TABLE `membros_api`.`membro` 
ADD INDEX `fk_idIgreja` (`idIgreja` ASC);
;
ALTER TABLE `membros_api`.`membro` 
ADD CONSTRAINT `fk_igreja`
  FOREIGN KEY (`idIgreja`)
  REFERENCES `membros_api`.`igreja` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `membros_api`.`membro` 
ADD INDEX `fk_idBatismo` (`idBatismo` ASC);
;
ALTER TABLE `membros_api`.`membro` 
ADD CONSTRAINT `fk_batismo`
  FOREIGN KEY (`idBatismo`)
  REFERENCES `membros_api`.`batismo` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

-- TABELA: ocorrencia
CREATE TABLE `membros_api`.`ocorrencia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idMembro` INT NOT NULL,
  `descricao` TEXT,
  `data` DATE NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

ALTER TABLE `membros_api`.`ocorrencia` 
ADD INDEX `fk_idMembro` (`id` ASC);
;
ALTER TABLE `membros_api`.`ocorrencia` 
ADD CONSTRAINT `fk_membro`
  FOREIGN KEY (`id`)
  REFERENCES `membros_api`.`membro` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


-- TABELA: historicomembro
CREATE TABLE `membros_api`.`historicomembro` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idMembro` INT NOT NULL,
  `status` VARCHAR(50) NOT NULL,
  `data` DATE NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

ALTER TABLE `membros_api`.`historicomembro` 
ADD INDEX `fk_idMembro` (`id` ASC);
;
ALTER TABLE `membros_api`.`historicomembro` 
ADD CONSTRAINT `fk_membro`
  FOREIGN KEY (`id`)
  REFERENCES `membros_api`.`membro` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;