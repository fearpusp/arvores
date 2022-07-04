@extends ('layouts.app')
@section ('content')
    <div class="col-sm-10 container-fluid" style="max-width: 1100px;">
        <div class="text-center" style="margin-bottom: 8px">
            <a href="{{ route('concurso') }}"><img src="{{ asset('banner_concurso_fotos.jpg') }}" class="img-fluid rounded"></a>
        </div>
        <div class="jumbotron" style="padding-top: 22px; padding-bottom: 22px; padding-left: 64px; padding-right: 64px; margin-bottom: 8px;">
            <p class="mb-2">O site Árvores da FEA-RP é um sistema on-line criado em 2022, em trabalho conjunto das áreas administrativa, comunicação e de informática da FEA-RP, com apoio do Serviço de Áreas Verdes e Meio Ambiente da Prefeitura do Campus.</p>
            <p class="mb-2">O sistema tem o objetivo de acompanhar o manejo das árvores da faculdade (ocorrência de podas, análise de risco etc.) bem como apresentá-las à comunidade, que poderá acessar diversas informações e interagir, comentando e compartilhando nas redes sociais Facebook, Twitter e LinkedIn.</p>
            <p class="mb-2">Como parte do projeto, grupos de árvores de grande porte receberam placas de identificação próximo a seu tronco. O QR Code impresso na placa remete à página específica da árvore, que contém informações como: nomes popular e científico, porte, localização, foto, comentários e histórico de ocorrências.</p>
            <p class="mb-2">Além das cerca de 250 árvores catalogadas no momento da criação do sistema, a Faculdade possui outro conjunto arbóreo não contabilizado, localizado em uma área preservada delimitada por Bloco B1, Rua Pedreira de Freitas, Bloco C1 e Cantina.</p>
        </div>
        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    COMO UTILIZAR? <span class="text-right"><i class="fas fa-plus"></i></span>
                </button>
              </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">
                  A navegação é feita pelos itens da barra superior: <br><br>
                <ul>
                    <li><a href="{{ route('arvores.index') }}"><i>Listagem completa</a></i> exibe todas as árvores catalogadas. A partir dessa lista é possível acessar a página de cada árvore</li>
                    <li><i><a href="{{ route('arvores.mapa') }}">Mapa com todas as árvores</a></i> exibe um mapa do google com as marcações de localização das árvores</li>
                    <li><a href="https://www.youtube.com/watch?v=Uijy5kW8G40"><i>Vídeo tutorial no <b>YouTube</b></i></a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    PROCEDIMENTOS PARA MANEJO DAS ÁRVORES <span class="text-right"><i class="fas fa-plus"></i></span>
                </button>
              </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
              <div class="card-body text-center">
                  <img src="{{ asset('fluxograma_poda.png') }}">
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
                  <p>Adriano Apolinário<br>
                  Antônio Justino da Silva</p>

                  <b>Desenvolvimento do sistema (STI):</b><br>
                  <p>
                      Lucas Flóro<br>
                      Kleber Benatti<br>
                      <b>Banner:</b><br>
                      Enzo Zanella<br>
                  </p>
                  <b>Logo e Design das placas:</b><br>
                  Leonardo Rezende (Assistente de Comunicação)<br>

              </div>
            </div>
          </div>
          <!--div class="card">
            <div class="card-header" id="headingFive">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    INFORMAÇÕES PARA DESENVOLVEDORES? <span class="text-right"><i class="fas fa-plus"></i></span>
                </button>
              </h2>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
              <div class="card-body">
                  Caso queira utilizar em sua unidade acesse o repositório: <a href="https://github.com/fearpusp/arvores" target="_blank"><i>Github</a></i>
                  <br><br>
                  Sistema desenvolvido com tecnologias abertas: <br><br>
                <ul>
                    <li><i><a href="https://github.com/laravel/laravel" target="_blank"><i>Laravel</a></i> <i>framework</i> PHP</li>
                    <li><a href="https://github.com/uspdev/" target=""_blank>Projetos do grupo USPDev</a></i> senhaunica-socialite; laravel-usp-theme.</li>
                </ul>
              </div>
            </div>
          </div>
        </div-->
    </div>
@endsection
