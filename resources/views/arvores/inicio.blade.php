@extends ('layouts.app')
@section ('content')
    <div class="col-sm-10 container-fluid" style="max-width: 1100px;">
        <div class="text-center" style="margin-bottom: 8px">
            <a href="{{ route('arvores.index') }}"><img src="{{ asset('banner_arvores_1100px.jpg') }}" class="img-fluid rounded"></a>
        </div>
        <div class="jumbotron" style="padding-top: 22px; padding-bottom: 22px; padding-left: 64px; padding-right: 64px; margin-bottom: 8px;">
            <p class="mb-2">O sistema on-line Árvores da FEA-RP é um catálogo estruturado com o objetivo de manter o histórico de manejo de cada árvore da faculdade.</p>
            <p class="mb-2">No sistema, cada indivíduo possui página própria, com foto real, nomes popular e científico, porte, geolocalização e histórico de manejo (análise de risco, execução de poda, indicação de extração etc.). Há também meios de interação da comunidade: links para compartilhamento direto nas redes sociais Facebook, Twitter e LinkedIn e campo para que pessoas vinculadas à Universidade de São Paulo possam fazer comentários.</p>
            <p class="mb-2">Como parte do projeto, foram instaladas placas de identificação próximas ao tronco de árvores de grande porte, por meio das quais é possível acessar a página do espécime via QR code.</p>
            <p class="mb-2">Lançado em abril de 2022, o sistema foi projetado pelas áreas administrativa, de informática e de comunicação da FEA-RP, com apoio do Serviço de Áreas Verdes e Meio Ambiente da Prefeitura do Campus.</p>
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
          <div class="card">
            <div class="card-header" id="headingFive">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    INFORMAÇÕES PARA DESENVOLVEDORES <span class="text-right"><i class="fas fa-plus"></i></span>
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
        </div>
    </div>
@endsection
