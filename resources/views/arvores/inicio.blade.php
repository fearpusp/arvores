@extends ('layouts.app')
@section ('content')
    <div class="col-sm-10 container-fluid">
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-4"><span class="align-middle"><img src="{{ asset('logo_fearp_arvore_transparente.png') }}"> ÁRVORES da fea-RP!</span></h1>
                <p>Este espaço foi constituído como o repositório das árvores que ficam dentro das dependências da FEA-RP. </p>
                <p>Nele, o usuário poderá acessar diversas informações das plantas da faculdade e interagir.</p>
            </div>
        </div>
        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    QUAIS INFORMAÇÕES ESTÃO DISPONÍVEIS? <span class="text-right"><i class="fas fa-plus"></i></span>
                </button>
              </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">
                  <p>Entre as informações disponíveis estão os nomes popular e científico, porte, localização, foto e histórico de ocorrências. Também é possível compartilhar as informações nas redes sociais Facebook, Twitter e LinkedIn e fazer comentários.</p>
                  <p>Todas as árvores estão recebendo também placas de identificação e um QR Code específico. O usuário poderá escanear o código com seu celular e será direcionado à página da árvore em questão e visualizar as informações dela.</p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    COMO UTILIZAR? <span class="text-right"><i class="fas fa-plus"></i></span>
                </button>
              </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
              <div class="card-body">
                  A navegação é feita pelos itens da barra superior: <br><br>
                <ul>
                    <li><a href="{{ route('arvores.index') }}"><i>Listagem completa</a></i> exibe todas as árvores catalogadas. A partir dessa lista é possível acessar a página de cada árvore</li>
                    <li><i><a href="{{ route('arvores.mapa') }}">Mapa com todas árvores</a></i> exibe um mapa do google com as marcações de localização das árvores</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingFour">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    CRÉDITOS <span class="text-right"><i class="fas fa-plus"></i></span>
                </button>
              </h2>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
              <div class="card-body">
                  <b>Catálogo:</b><br>
                  <p>Adriano Apolinário</p>

                  <b>Desenvolvimento do sistema:</b><br>
                  <p>STI<br>
                      Lucas Flóro<br>
                      Kleber Benatti<br>
                  </p>
                  <b>Logo e Design das placas:</b><br>
                    Leonardo Rezende (Assistente de Comunicação)
              </div>
            </div>
          <div class="card">
            <div class="card-header" id="headingFive">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    INFORMAÇÕES PARA DESENVOLVEDORES? <span class="text-right"><i class="fas fa-plus"></i></span>
                </button>
              </h2>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
              <div class="card-body">
                  Caso queira utilizar em sua unidade acesse o repositório: <a href="https://gitlab.com/fearp/arvores" target="_blank"><i>GitLab</a></i>
                  <br><br>
                  Sistema desenvolvido com tecnologias abertas: <br><br>
                <ul>
                    <li><i><a href="https://github.com/laravel/laravel" target="_blank"><i>Laravel</a></i> <i>framework</i> PHP</li>
                    <li><a href="https://github.com/uspdev/" target=""_blank>Projetos do grupo USPDev</a></i> senhaunica-socialite; laravel-usp-theme, etc.</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
