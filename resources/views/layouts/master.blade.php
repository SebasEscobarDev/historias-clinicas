<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <link rel="shortcut icon" href="{{{ asset('img/icon.png') }}}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <!-- Compiled and minified CSS -->
  {!!Html::style('css/materialize.css')!!}
  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  {!!Html::style('css/csSebas.css?v=2.0.6')!!}
</head>
<body>
  <body-segundo class="">
    <div class="preloader-dev">
      <div class="progress">
        <div class="indeterminate blue darken-1"></div>
      </div>
      <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-blue-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div><div class="gap-patch">
            <div class="circle"></div>
          </div><div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
    </div>
    <div id="app" class="charge">
      <main class="main-container">
        <div class="col-md-12">
          <div class="row content-logo">
            <div class="col-md-3 center">
              <div class="logo-container">
                <span class="mayus-logo">
                  SGHC
                </span>
                <br>
                <span class="desc-logo">
                  Sistema de Gestión de Historias Clínicas
                </span>
              </div>
            </div>
            <div class="col-md-9">
              <div class="panel-admin-icon center">
                    <i class="material-icons center">recent_actors</i>
                    @if( Auth::user() )
                        <span class="title-admin center">{{Auth::user()->name}}</span>
                    @else
                        <span class="title-admin center">Name</span>
                    @endif
              </div>
              <div class="row no-margg">
                @include('layouts.menu')
              </div>
            </div>
          </div>
          <div class="row" style="margin-bottom: 0px;">
            <div class="col-md-12 text-align-right btn-menu">
              <button class="float-right blue darken-4 waves-effect waves-light btn menu-button" type="submit" onclick="menu_desplegable()"><b>&nbsp;Menú</b>
                <div class="barras-del-menu">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
              </button>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
          @endif

          <div class="card">
            <div class="card-header card-panel blue darken-2">
              <h3 style="margin:0px" class="dev-title center">
                <i class="material-icons icon-titlee">@yield('icon')</i>@yield('title')
              </h3>
            </div>
            <div class="card-body" style="padding-top: 0px">
              <div class="col-md-12">
                @yield('content')
              </div>
            </div>
          </div>

        </div>

      </main>
    </div>

    <!-- jQuery -->
    <!-- script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script-->
    {!!Html::script('js/jquery.js')!!}
    <!-- Materialize -->
    {!!Html::script('js/materialize.js')!!}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- my Scripts -->
    {!!Html::script('js/jSebas.js?v=3.3.5')!!}

    <!-- FLATPICKR JS CALENDAR -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- LECTOR DE IMAGENES A TEXTO v2 -->
    <!--script src='https://unpkg.com/tesseract.js@v2.1.0/dist/tesseract.min.js'></script-->
    @yield('scripts')
  </body-segundo>
  <!-- /BODY SEGUNDO -->
</body>
</html>
