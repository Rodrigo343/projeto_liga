Create database loja_cartas;

CREATE TABLE edicao_cartas (
    id_edicao INT UNSIGNED AUTO_INCREMENT NOT null,
    nm_edicao_pt VARCHAR(100) NOT null UNIQUE,
    nm_edicao_en VARCHAR(100) NOT null UNIQUE,   
    dt_lancamento date NOT null, 
    quantidade_cartas VARCHAR(100) NOT null,
    PRIMARY KEY(id_edicao)
);

CREATE TABLE cartas (
    id_carta INT UNSIGNED AUTO_INCREMENT NOT null,
    nm_carta_pt VARCHAR(100) NOT null UNIQUE,
    nm_carta_en VARCHAR(100) NOT null UNIQUE,   
    cor VARCHAR(50) NOT null,
    tipo VARCHAR(100) NOT null,
    artista VARCHAR(100) NOT null,
    raridade VARCHAR(100) NOT null,
    imagem VARCHAR(500) NOT null,
    descricao VARCHAR(500) NOT null,
    preco decimal (10,2) NOT null,
    quantidade VARCHAR(100) NOT null,
    id_edicao INT UNSIGNED NOT null,   
    PRIMARY KEY(id_carta),
    CONSTRAINT fk_cartas_id_edicao
    FOREIGN KEY(id_edicao) REFERENCES edicao_cartas(id_edicao)
);

CREATE TABLE usuarios (
  id_usuario int(10) UNSIGNED NOT NULL,
  nome varchar(200) NOT NULL,
  email varchar(200) NOT NULL UNIQUE,
  senha varchar(200) NOT NULL,
  PRIMARY KEY(id_usuario)
);

CREATE TABLE tokens (
    id_token INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT UNSIGNED NOT NULL,
    token VARCHAR(1000) NOT NULL,
    refresh_token VARCHAR(1000) NOT NULL,
    dt_expiracao DATETIME NOT NULL,
    ativo TINYINT UNSIGNED NOT NULL DEFAULT 1,
    CONSTRAINT fk_tokens_usuarios_id_usuarios
        FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- Criar usuaria com senha que foi encriptada pela função password_hash()
-- Senha 123
INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`) VALUES
(0, 'Teste', 'Test@gmai.com', '$2y$10$mEkdJCnwS9X7nFh.pD2YwuOh9lUghdRCubQaTXmMLpLve8g1KA8gy');

INSERT INTO `edicao_cartas` (`id_edicao`, `nm_edicao_pt`, `nm_edicao_en`, `dt_lancamento`, `quantidade_cartas`) VALUES
(1, 'Modern Horizons 3 (MH3)', 'Modern Horizons 3 (MH3)', '2024-06-14', '522'),
(2, 'Breaking News (OTP)', 'Breaking News (OTP)', '2024-04-19', '80');

INSERT INTO `cartas` (`id_carta`, `nm_carta_pt`, `nm_carta_en`, `cor`, `tipo`, `artista`, `raridade`, `imagem`, `descricao`, `preco`, `quantidade`, `id_edicao`) VALUES
(10, 'Derrubar os Poderosos', 'Fell the Mighty', 'Branco', 'Feitiço', 'Magnus Jansson', 'Normal', 'img', 'Destrua todas as criaturas com poder maior que o poder da criatura alvo.', 0.14, '10', 2),
(11, 'Jornada a Lugar Nenhum', 'Journey to Nowhere', 'Branco', 'Encantamento', 'Adam Volker', 'Normal', 'img', 'Quando Jornada a Lugar Nenhum entrar no campo de batalha, exile a criatura alvo. Quando Jornada a Lugar Nenhum deixar o campo de batalha, devolva o card exilado ao campo de batalha sob o controle de seu dono.', 0.18, '2', 2),
(12, 'Devorador de Destinos', 'Devourer of Destiny', 'Branco', 'Criatura', 'Raph Lomotan', 'Normal', 'img', 'Você pode revelar este card da sua mão de abertura. Se fizer isso, no início de sua primeira manutenção, olhe os quatro cards do topo de seu grimório. Você pode colocar um daqueles cards de volta no topo de seu grimório. Exile o restante. Quando você conjurar esta mágica, exile a permanente alvo que tenha uma ou mais cores.', 3.73, '15', 1),
(13, 'Herigast, Nulavérneo em Erupção', 'Herigast, Erupting Nullkite', 'Branco', 'Criatura Lendária', 'Lucas Graciano', 'Raro', 'img', 'Emergir (Você pode conjurar esta mágica sacrificando uma criatura e pagando o custo de emergir menos o valor de mana daquela criatura.) Quando você conjura esta mágica, você pode exilar sua mão. Se fizer isso, compre três cards. Voar: Cada mágica de criatura que você conjura tem emergir. O custo de emergir é igual ao seu custo de mana.', 7.00, '1', 1);