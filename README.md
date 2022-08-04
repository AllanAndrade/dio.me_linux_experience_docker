# Digital Innovation One -  Bootcamp: Linux Experience

## Atividade

Docker: Utilização prática no cenário de Microsserviços

## Observação
Exemplo simplificado para fins didáticos, não usar em produção.

## Antes de iniciar é necessário

Clonar o repositório

- `git clone git@github.com:AllanAndrade/dio.me_linux_experience_docker.git`
- `cd dio.me_linux_experience_docker`
Fazer parte de um cluster docker swarm, para iniciar um cluster rode o comando abaixo:
- `docker swarm init`

Criar a rede docker que será utilizada pelos serviços.

- `docker network create -d overlay ambiente`

## Serviços

### Banco de dados

Iniciar o serviço de banco de dados:

- `docker stack deploy -c ./database/docker-compose.yml dio_db`


### Aplicação (servidor web)

Criar imagem (necessário apenas uma vez):

- `docker build ./app -f ./app/ApachePHP.Dockerfile -t img_app_dio:v1.0`

Iniciar o serviço de aplicação:

- `docker stack deploy -c ./app/docker-compose.yml dio_app`

Escalar o serviço de aplicação em 5 réplicas no exemplo abaixo:

- `docker service scale dio_app_apache_php8=5`

### Acessando a aplicação

Abra a aplicação no browser (url: http://127.0.0.1:8080/)

Note que o host irá variar de acordo com o algoritmo interno de balanceamento do Docker Swarm. Ele poderá fazer várias requisições ao mesmo host.

## Encerrando os serviços

Encerrar serviço de aplicação:

- `docker stack rm dio_app`
  
Encerrar serviço de banco de dados:

- `docker stack rm dio_db`

Remove a imagem

- `docker image rm img_app_dio:v1.0`