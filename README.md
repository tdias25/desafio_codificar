## Sobre o projeto

O projeto se trata de um pequeno desafio de programação proposta pela equipe da Codificar, o objetivo do projeto é consumir alguns dados da [API pública da assembleia legislativa do estado de minas gerais](http://dadosabertos.almg.gov.br/ws/ajuda/sobre)

Objetivos:

- Consumir e salvar os dados num banco de dados, o banco escolhido foi o MySQL.
- Mostrar o top 5 deputados que mais pediram reembolso de verbas indenizatórias por mês, considerando somente o mês de 2017
- Mostrar o ranking das redes sociais mais utilizadas dentre os deputados, ordenado de forma decrescente. :x:

## 1.0 Instruções de Uso [Instalação]


O projeto possui 2 rotas para popular dados dos deputados e dados da verbas indenizatórias (e suas despesas detalhadas), as rotas são:

- /set_deputados 
- /set_verbas

Ao acessar cada rota o sistema consome os dados da API, itera e os salva no banco de dados.

NOTA: Na iteração dos deputados é verificada a existência no banco de dados através do "idDeputado" retornado pela API, já na iteração de verbas não é possível, pois não existe um identificador único.


### 1.1 Importação dos dados através de backup MySQL

Como o processo de população dos dados de verbas indenizatórias, através do acesso por rota, é demorado (pelo fato de serem 77 deputados por legislatura x 12 meses(janeiro-dezembro), com um intervalo de 5 segundos entre cada requisição), também é possível importar os dados através de um backup do banco de dados MySQL, o nome do arquivo é ```"arquivo_backup.sql"``` e pode ser encontrado na raiz da pasta, ao importar o arquivo as seguintes tabelas serão criadas: deputados, verbas_indenizatorias e verbas_indenizatorias_despesas

### Explicação das tabelas:

``` deputados:``` salva os dados dos deputados retornados pelo webservice

``` verbas_indenizatorias```: salva os dados das verbas indenizatórias retornados pelo webservice

``` verbas_indenizatorias_despesas:``` salva os dados sobre as despesas detalhadas retornados em cada verba indenizatória retornada pelo webservice


## 2.0 Instruções de Uso [Acesso à API]

listagem de verbas indenizatórias:

```/verbas_indenizatorias```

### 2.1 parâmetros aceitos:

```order=``` asc (crescente) ou desc (decrescente)

```limit=``` (numero de resultados)

Exemplo de listagem decrescente das verbas e com limite de 5 resultados (por valor total e agrupadas por deputado):

```/verbas_indenizatorias?order=desc&limit=5```
