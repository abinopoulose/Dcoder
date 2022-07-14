<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DeCODER</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts --> 
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="{{ asset('css/editcm.css') }}" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

          
      <style>
       

      </style>


    
</head>
<body>


<form action="/{{$id}}/run" method="post">
@csrf
    <div id="app" style=" background-color: #222222;">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            
            <div class="container"  style="color: white;margin-right:0vw;">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                

                <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> -->
                    <!-- Left Side Of Navbar -->   
                    <ul class="navbar-nav me-auto">
                        <a class="navbar-brand gbutton" href="/home"  style="color: white;margin-left:-13vw;">HOME</a>
                        &nbsp;  &nbsp; 
                        <button id="saveb" type="button" onclick="savefun();" class="gbutton runb" >SAVE </button>   
                    </ul>


                        <div class="navbar-brand"  style="color: white;">
                        <img src="{{ asset('img/logo.png') }}" style="width:3vh;height:3vh;margin-top:-1vh;">eCODER
                        </div>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto" >
                        <!-- Authentication Links -->
                        <button  type="button" onclick="showinput();" class="gbutton" > RUN </button> &nbsp;&nbsp;&nbsp;&nbsp;
                        <button  type="button" onclick="showdebug()" class="gbutton"  > DEBUG </button>&nbsp;&nbsp;&nbsp;&nbsp;
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}" style="color: white;">>{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"  style="color: white;">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown" >
                                <a  style="color: white;"id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                <!-- </div> -->

            </div>
        </nav>

        
    </div>

  
                    
CODE
<div >                        
<textarea style="magrin-left:5%;" id="code" name="code">{{$code}}</textarea>
</div>
<br>    
   

OUTPUT
<textarea class="ioo" id=output name="output" style="width:100%;height:40vh;color:white; " >{{$response}}</textarea>



<div class="inputdiv" id="inputdiv" > 
      <b>INPUT</b>
      <span style="float:right;margin-top:-1vw;margin-right:-1vw;">
      <button  type="button" class="gbutton closeb" onclick="hideinput();"> X </button>
      </span>
      <br>
      <textarea name="input" id="inputarea" style="width:100%;height:40vh;resize:none;"  class="form-control" > {{$input}} </textarea>
      <span style="float:right;margin-top:-3.5vw;margin-right:1vw;">
      <button  type="button" onclick="runpro();" class="gbutton runb" >RUN </button>
      </span>
</div>



<div class="debugbar" id="debugbar"> 
          <div style="text-align:center">
          <b>DEBUGBAR</b>

          </div>
          <br>
          <div class="textOnInput">
              <label >Variable</label>
              <input type="text" name="val" class="form-control"  style="width:20vw;height:50px;" value="{{$val}}" requied >
              </div><br>

          <div class="textOnInput">
            <label >Line</label>  
              <input type="number" name="line" class="form-control"  style="height:50px;background-color:white;"  value="{{$line}}" requied>
              </div>
              <br>
              
              <input type="submit" value="FIND VALUE"  formaction="/{{$id}}/find" class="gbutton" />
              
              <button  type="button" onclick="hidedebug();" class="gbutton" style="float:right;"> HIDE</button>
              <br><br>
              <div class="textOnInput">
                      
                      @if($val != null and $line != null)
                          <label >
                          Value of {{$val}} at Line {{$line}}
                          </label>
                      @endif
                        
                      <input type="test" name="value" style="width:20vw;height:50px;"  class="form-control"  value={{$value}} > 
            </div>

</div>


</form>

    

  
   
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.52.2/theme/monokai.min.css">
    <script src="{{ asset('js/editcm.js') }}" ></script>

<script>
   var editor = CodeMirror.fromTextArea(document.getElementById('code'), {
    lineNumbers: true,
    theme: 'monokai'
});
</script>

<link href="{{ asset('css/edit.css') }}" rel="stylesheet">

<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.52.2/codemirror.min.css">
</link>

<script type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.52.2/codemirror.min.js">
</script>
<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.52.2/theme/monokai.min.css">








    
<script>
    
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  


function runpro() {
  
  document.getElementById("inputdiv").style.display = "none";
    document.getElementById("output").innerHTML = "Running...";
    
    var data = {
      'code': editor.getValue(),
      'input': document.getElementById("inputarea").innerHTML,
    };

    $.ajax({
        url: '/runpro',
        type: 'POST',
        data: data,
        success: function(response) {
          document.getElementById("output").innerHTML = response;
        }
    })


}


function savefun() {
    document.getElementById("saveb").innerHTML = "Saving...";
    
    var data = {
      'code': editor.getValue(),
      'id': {{$id}}
    };

    $.ajax({
        url: '/save',
        type: 'POST',
        data: data,

        
        success: function(response) {
       
          document.getElementById("saveb").innerHTML = "SAVE";
        }
    })


}

function hidedebug() 
{
  document.getElementById("debugbar").style.display = "none";
}
function showdebug() 
{
  document.getElementById("debugbar").style.display = "block";
}

function hideinput() 
{
  document.getElementById("inputdiv").style.display = "none";
}
function showinput() 
{
  document.getElementById("inputdiv").style.display = "block";
}

</script>
    


</body>
</html>












































 