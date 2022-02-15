<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Dennis Ormeño">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('static/admin/css/admin.css?v='.time()) }}">
    <script src="https://kit.fontawesome.com/084224f6ac.js" crossorigin="anonymous"></script>
    <title>Administrador de contenidos | Adingo</title>
    <style>
      table{
        box-shadow: rgb(53 63 74 / 2%) 0px 14px 68px, rgb(53 63 74 / 4%) 0px 5.84887px 28.4088px, rgb(53 63 74 / 4%) 0px 3.12708px 15.1887px, rgb(53 63 74 / 6%) 0px 1.75302px 8.51466px, rgb(53 63 74 / 6%) 0px 0.931014px 4.52207px, rgb(53 63 74 / 9%) 0px 0.387416px 1.88173px;
      }
      table tbody tr:hover{
        box-shadow: rgb(10 112 206 / 75%) 0px 0px 0px 1px inset, rgb(10 112 206 / 75%) 4px 0px 0px 0px inset !important;
        border-color: rgb(10, 112, 206) !important;
      }

      .loading{
        position: fixed;
        width: 100vw;
        height: 120vh;
        background: rgba(250, 250, 250, .95);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 99999;
      }
      #loader {
          border: 12px solid #f3f3f3;
          border-radius: 50%;
          border-top: 12px solid #444444;
          width: 70px;
          height: 70px;
          animation: spin 1s linear infinite;
          z-index: 9999;
      }
        
      @keyframes spin {
          100% {
              transform: rotate(360deg);
          }
      }
        
      .center-all  {
          position: absolute;
          top: 0;
          bottom: 0;
          left: 0;
          right: 0;
          margin: auto;
      }

::-webkit-scrollbar {
    width: 10px;
    height: 9px;
    background: rgb(196, 196, 196);
}

::-webkit-scrollbar {
    width: 10px;
    height: 9px;
    background: #C4C4C4;
}

::-webkit-scrollbar-thumb {
    width: 10px;
    background: rgb(81, 81, 81);
}
::-webkit-scrollbar-thumb {
    width: 10px;
    background: #515151;
}

::-webkit-scrollbar-track {
    box-shadow: white 0px 0px 5px inset;
}
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px white;
}

  </style>
</head>
<body>
    <div class="loading">
      <div id="loader" class="center-all"></div>
    </div>
    @include('admin.includes.header')

    <div class="modal fade" id="change" tabindex="-1" role="dialog" aria-labelledby="changeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="changeLabel">Cambiar contraseña</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => ['login.update', Auth::user()->id], 'method'=>'PUT']) !!}
                <div class="form-group">
                    {{ Form::label('password', 'Contraseña actual:') }}
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder'=>'Ingresa su contraseña actual']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('newpassword', 'Contraseña:') }}
                    {{ Form::password('newpassword', ['class' => 'form-control', 'placeholder'=>'Ingresa una nueva contraseña']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('renewpassword', 'Contraseña:') }}
                    {{ Form::password('renewpassword', ['class' => 'form-control', 'placeholder'=>'Repita la nueva contraseña']) }}
                </div>
                <div class="form-group float-right mb-0">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    {!! Form::submit('Cambiar contraseña',['class'=>'btn btn-success text-decoration-none text-white']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
          </div>
        </div>
    </div>
    
    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="logoutLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="logoutLabel">¿Desea cerrar sesión?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Selecciona "Cerrar sesión" si estás listo.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger" href="{{ route('login.logout') }}" class="text-decoration-none text-white">Cerrar sesión</a>
            </div>
          </div>
        </div>
    </div>
    
    <div class="layout">
        @include('admin.includes.sidebar')

        @yield('content')
    </div>
    <script>
      var route_prefix = "/filemanager";
    </script>
    <script>
      document.onreadystatechange = function() {
          if (document.readyState !== "complete") {
              document.querySelector(
                "body").style.visibility = "hidden";
              document.querySelector(
                ".loading").style.visibility = "visible";
              document.querySelector(
                "#loader").style.visibility = "visible";
          } else {
              setTimeout(function(){document.querySelector(
                ".loading").style.display = "none"}, 200);
              setTimeout(function(){document.querySelector(
                "#loader").style.display = "none"}, 200);
              document.querySelector(
                "body").style.visibility = "visible";
          }
      };
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="{{ asset('static/admin/js/admin.js?v='.time()) }}"></script>
    <script>
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })

      @if(Route::currentRouteName()!="progress.create")
      $('form').submit(function (e) {
        if ($(this).hasClass('submitted')) {
            e.preventDefault();
        }
        else {
            $(this).find(':submit').html('<i class="fa fa-spinner fa-spin"></i>');
            //$(this).find(":submit").prop('disabled', true);
            $(this).addClass('submitted');
            //$("*").css("cursor", "wait");
        }
      });
      @endif
    </script>
    <script src="{{ asset('static/admin/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
    <script>
      $('textarea').ckeditor({
        height: 100,
        filebrowserImageBrowseUrl: route_prefix + '?type=Images',
        filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token=LbN1W47Wmxi1atddNpT3pLcmTqo3gkrtKvrkPVju',
        filebrowserBrowseUrl: route_prefix + '?type=Files',
        filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token=LbN1W47Wmxi1atddNpT3pLcmTqo3gkrtKvrkPVju'
      });
    </script>
    @yield('script')
</body>
</html>