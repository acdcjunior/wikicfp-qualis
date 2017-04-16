# wikicfp-qualis

http://wikicfpqualis.esy.es/

Traz o WikiCFP com a indicação de Qualis de cada evento.


-----

# Como Desenvolver

### O que você precisa:

Ter o **docker** instalado. [Clique aqui para mais instruções.](https://docs.docker.com/engine/installation/)

### Como proceder:

Vá na pasta [`desenvolvimento`](/desenvolvimento) deste repositório e:

    $ docker-compose up
    
Pronto, agora é só acessar **http://127.0.0.1** e mexer nos fontes à vontade -- as mudanças refletirão no servidor automaticamente.
 
## Detalhes

Esse comando sobe três containers docker:

- Um **Apache+PHP7** na porta 80: http://127.0.0.1
    - Todas suas mudanças no código fonte refletirão aí
- Um **phpMyAdmin** na porta 81: http://127.0.0.1:81
    - Vai te ajudar a ver o que tem na base e fazer modificações diretamente no banco
- Um **MySQL** (MariaDB, na verdade) já carregado com dados de exemplo
    - Quando sobre, o banco já executa os scripts da pasta [`ddl`](/desenvolvimento/ddl)
    