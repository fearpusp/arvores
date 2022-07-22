<p align="center"><a href="https://fearp.usp.br" target="_blank"><img src="https://fearp.usp.br/images/cabecalho-30-anos.png" width="400"></a></p>

## Árvores da fea-RP

Sistema objetiva registrar um catálogo das árvores da Faculdade bem como acompanhar seu manejo (ocorrência de podas, análise de risco, etc.).  
Projetado para funcionamento dentro da USP, está aberto a comentários de toda a comunidade uspiana, assim, qualquer pessoa com senha única, pode registrar algum comentário, enviar alguma imagem.

#### Acesse o [sistema em produção](https://arvores.fearp.usp.br)

### Recursos

* Cadastro de espécies
* Cadastro de árvores
* Histórico de ocorrências
* Exportação de arquivo csv com informações das árvores
* Comentários de usuários com ou sem imagem
* Moderação de comentários
* Concurso de fotografia
  
  
### Instalação

* Via clone do repositório github.com/fearusp/arvores
```
    git clone git@github.com:fearpusp/arvores arvores
    cd arvores
    composer install
    cp .env.example .env
    php artisan key:generate
    Configure o .env conforme a necessidade
    php artisan migrate 
```

* Ou crie um fork do repositório para seu github e depois faça o clone a partir dele
    * Caso faça dessa forma, será necessário verificar atualizações no repositório github.com/fearpusp/arvores

### Em produção

Para receber as últimas atualizações do sistema rode:

    git pull
    composer install --no-dev


### Autenticação 

Este projeto utiliza o [Senha única](https://github.com/uspdev/senhaunica-socialite), para configurá-lo, cadastre uma nova URL no [site](https://uspdigital.usp.br/adminws/oauthConsumidorAcessar) com a URL https://seu_app/callback. Este callback_id deverá ser inserido no arquivo .env.

### Atualizar mapa no *Google Maps*

1. Entrar no sistema [Árvores](https://arvores.fearp.usp.br);
2. Acessar menu Arquivos CSV/Gerar csv todas árvores;
3. Acessar o gmail com a conta sistemas@fearp.usp.br [Meus mapas](https://www.google.com/maps/d/u/0/?hl=pt-BR) e abrir o mapa 'Árvores - fea-RP/USP';
4. Clicar no ícone 'três pontinhos verticais' na camada Todas;
5. Excluir a camada, após a exclusão será criada nova camada;
6. Clicar em Importar e selecionar o arquivo csv gerado no sistema;
7. No pop-up 'Escolher colunas para posicionar marcadores', deixar marcado: Latitude e Longitude e clicar em Continuar;
8. No pop-up 'Escolher uma coluna para identificar seus marcadores', deixar marcado: Nome Popular e clicar em Concluir;
9. Clicar no ícone 'três pontinhos verticais' na camada criada anteriormente e selecionar 'Renomear esta camada', inserir o nome 'Todas' e clicar em Salvar;