<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Snake Game</title>
        <link href="https://fonts.googleapis.com/css?family=Antic+Slab" rel="stylesheet">
        <link rel="stylesheet" href="{!! asset('css/estilosSG.css') !!}">
        <script type="text/javascript" src="{!! asset('js/api.js') !!}" async></script>
    </head>
    <body>
        <h1 class="glow" id="title">{{$title}}</h1>
        
        <nav><ul>
            <li><a href="javascript:main()" class="start">Jugar</a></li>
            
            <li><a href="#">Dificultad</a>
                <ul><li>
                    <select id="dificultad" class="select-css">
                        <option value="fac">Fácil</option>
                        <option value="nor" selected>Normal</option>
                        <option value="dif">Difícil</option>
                    </select>
                </li></ul>
            </li>

            <li><a href="#">Modo</a>
                <ul><li>
                    <select id="modo" class="select-css">
                        <option value="1" selected>Normal</option>
                        <option value="2">Contrarreloj</option>
                    </select>
                </li></ul>
            </li>

            <li><a href="#">Temática</a>
                <ul><li>
                    <select id="tematica" class="select-css">
                        <option value="1" selected>Normal</option>
                        
                    </select>
                </li></ul>
            </li>

            <li><a href="/rankingSG">Ranking</a></li>
            <li><a href="/thematicSG">Ver temáticas</a></li>
        </ul></nav>
        <hr class="new1">
        <div class="info" id="form">
            <form class="info" action="{{ route('RankingSG.store') }}" method='POST'>
            @csrf
                <div id="form-end"></div>
            </form>
        
        </div>
        <div class="info">
            <div id="reload"></div>
            <div id="score"></div>
            <div id="countdown"></div>
        </div>
        <div class="contenedor"><canvas id="snakeboard" class="image" width="400" height="400"></canvas></div>
        <h2 id="fin"></h2>
        
        <div id="id-list" style="visibility:hidden">{{$id}}</div>
        <div id="nm-list" style="visibility:hidden">{{$name}}</div>
        <div id="bg-list" style="visibility:hidden">{{$background}}</div>
        <div id="sc-list" style="visibility:hidden">{{$snake_color}}</div>
    </body>

</html>