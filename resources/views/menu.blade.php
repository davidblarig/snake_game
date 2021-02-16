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
        <h1 class="glow">{{$title}}</h1>

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
                <select name="tematica" class="select-css">
                    <option selected>Normal</option>
                    <option>Desierto</option>
                </select>
            </li></ul>
        </li>

        <li><a href="/ranking" class="b1">Ranking</a></li>
        <li><a href="/thematic" class="b1">Ver temáticas</a></li>
        <li><a href="/thematic/create" class="b1">Crear temática</a></li>
        </ul></nav>
        <hr class="new1">
        <h2>Puntuación<div id="score">0</div></h1>
        <h3 id="countdown"></h3>
        <canvas id="snakeboard" width="400" height="400"></canvas>
    </body>

</html>