# Credere API

https://credere-api.herokuapp.com/

# Endpoints

## DELETE /resetar

> Reinicia o cenário colocando a sonda no ponto inicial
>
> **Retorno**
>
> _Status: 204 - No Content_
>
> **cURL**
>
> ```curl --location --request DELETE 'https://credere-api.herokuapp.com/resetar'```

## PUT /executar-comandos

> Recebe uma sequência de comandos a serem executados:
>
> **Parâmetros**
>
> -   comandos - Array
>     -   **M**: Mover a sonda uma casa a frente no atual sentido
>     -   **GD**: Girar 90 graus a DIREITA
>     -   **GE**: Girar 90 graus a ESQUERDA
>
> **Retorno**
>
> _Status: 200 - OK_ > _(application/json)_
>
> Caso seja informada uma sequência válida de comandos é retornada a posição atual da sonda após a execução da mesma.
>
> _Ex: { x: 0, y: 4, sentido: 'B' }_
>
> Caso contrário é retornado o motivo do erro
>
> _Ex: { erro: 'A sonda não pode mais se mover no eixo: X' }_
>
> **cURL**
>
> ```
> curl --location --request PUT 'https://credere-api.herokuapp.com/executar-comandos' \
> --header 'Content-Type: application/x-www-form-urlencoded' \
> --data-urlencode 'comandos[]=GE' \
> --data-urlencode 'comandos[]=M' \
> --data-urlencode 'comandos[]=M' \
> --data-urlencode 'comandos[]=M' \
> --data-urlencode 'comandos[]=GD' \
> --data-urlencode 'comandos[]=M' \
> --data-urlencode 'comandos[]=M'
> ```

## GET /posicao-atual

> **Retorno**
>
> _Status: 200 - OK_ > _(application/json)_
>
> Retorna a posição atual da sonda
>
> _Ex: { x: 2, y: 4, sentido: 'C' }_
>
> **cURL**
>
> ```curl --location --request GET 'https://credere-api.herokuapp.com/posicao-atual'```

# Instalar

1. `git clone https://github.com/marcaum54/credere-api`
2. `cd credere-api`
3. `composer install`
4. `php -S localhost:8000 -t public`

# Testes

Utilizei o corverage para acompanhar se os testes estavam cobrindo todo o código que eu produzi.

Dentro do projeto tem uma pasta ```/coverage``` com o relatório em HTML que mostra a cobertura com detalhes.

Para rodar os testes para rodar o seguinte comando: ```vendor\bin\phpunit```
