<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Snake Game</title>
        <link href="https://fonts.googleapis.com/css?family=Antic+Slab" rel="stylesheet">
        <link rel="stylesheet" href="{!! asset('css/estilos.css') !!}">
        <script type="text/javascript" src="{!! asset('js/api.js') !!}" async></script>
    </head>
    <body>
        <h1 class="glow" id="title" style="visibility:hidden">{{$title}}</h1>
        
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
                    <option value="val1" selected>Normal</option>
                    <option value="val2">Contrarreloj</option>
                </select>
            </li></ul>
        </li>

        <li><a href="#">Temática</a>
            <ul><li>
                <select id="tematica" class="select-css">
                    <option value="1" selected>Normal</option>
                    <option value="2">Desierto</option>
                    <option value="3">Almería</option>
                    <option value="4">Personalizado</option>
                </select>
            </li></ul>
        </li>

        <li><a href="/rankingSG">Ranking</a></li>
        <li><a href="/thematicSG">Ver temáticas</a></li>
        <li><a href="/thematicSG/create">Crear temática</a></li>
        </ul></nav>
        <hr class="new1">
        <div class="info">
            <div id="reload"></div>
            <div id="score"></div>
            <div id="countdown"></div>
        </div>
        <div class="contenedor"><canvas id="snakeboard" class="image" width="400" height="400"></canvas></div>
        <h2 id="fin"></h2>
    </body>

</html>