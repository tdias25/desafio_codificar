## Sobre o projeto

O projeto se trata de um pequeno desafio de programação proposta pela equipe da Codificar, o objetivo do projeto é consumir alguns dados da [API pública da assembleia legislativa do estado de minas gerais](http://dadosabertos.almg.gov.br/ws/ajuda/sobre)

Objetivos:

- Consumir e salvar os dados num banco de dados, o banco escolhido foi o MySQL.
- Mostrar o top 5 deputados que mais pediram reembolso de verbas indenizatórias por mês, considerando somente o ano de 2017
- Mostrar o ranking das redes sociais mais utilizadas dentre os deputados, ordenado de forma decrescente. :x:

## 1.0 Instruções de Uso [Instalação]

O projeto foi feito usando ```Laravel 6.2.0```, e a versão PHP deve ser a ```7.2``` ou superior, mais informações podem ser encontradas no site do [Laravel](https://laravel.com/docs/6.x)

O projeto possui 2 rotas para popular dados dos deputados e dados da verbas indenizatórias (e suas despesas detalhadas), as rotas são:

- /set_deputados 
- /set_verbas

Ao acessar cada rota o sistema consome os dados da API, itera e os salva no banco de dados.

```NOTA: Na iteração dos deputados é verificada a existência no banco de dados através do "idDeputado" retornado pelo Webservice, já na iteração de verbas não é possível, pois não existe um identificador único.```


### 1.1 Importação dos dados através de backup MySQL

Como o processo de população dos dados de verbas indenizatórias, através do acesso por rota, é demorado (pelo fato de serem 77 deputados por legislatura x 12 meses(janeiro-dezembro), com um intervalo de 5 segundos entre cada requisição), também é possível importar os dados através de um backup do banco de dados MySQL, o nome do arquivo é ```"arquivo_backup.sql"``` e pode ser encontrado na raiz da pasta, ao importar o arquivo as seguintes tabelas serão criadas: deputados, verbas_indenizatorias e verbas_indenizatorias_despesas

### Explicação das tabelas:

``` deputados:``` salva os dados dos deputados retornados pelo webservice

``` verbas_indenizatorias```: salva os dados das verbas indenizatórias retornados pelo webservice

``` verbas_indenizatorias_despesas:``` salva os dados sobre as despesas detalhadas retornados em cada verba indenizatória retornada pelo webservice


## 2.0 Instruções de Uso [Acesso à API]

listagem de verbas indenizatórias:

```GET /api/verbas_indenizatorias```

### 2.1 parâmetros aceitos:

```ordem=```  [opcional], Ex: asc(crescente) ou desc(decrescente)

```limite=``` [opcional], Ex: 5

```mes=``` [obrigatório], Ex: 1

Exemplo de listagem decrescente das verbas com limite de 5 resultados para o mês de janeiro (por valor total e agrupadas por deputado):

```GET /api/verbas_indenizatorias?mes=1&ordem=desc&limite=5```
