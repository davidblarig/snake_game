const board_border = 'black';
var board_background = new Image();
var snake_col;
var snake_border;

var totalTime = 120;    

let snake = [
    {x: 200, y: 200},
    {x: 190, y: 200},
    {x: 180, y: 200},
    {x: 170, y: 200},
    {x: 160, y: 200}
]

let score = 0;
let points = 0;
// True si se cambia de dirección
let changing_direction = false;
// Velocidad horizontal
let food_x;
let food_y;
let dx = 10;
// Velocidad vertical
let dy = 0;
    
var velocidad;

// Obtener el elemento del canvas
const snakeboard = document.getElementById("snakeboard");
// Devuelve un contexto de dibujo bidimensional
const snakeboard_ctx = snakeboard.getContext("2d");
// Iniciar el juego
//main();
var width = snakeboard.width;
var height = snakeboard.height;

var url_imgs = "../../images/imagesSG/";

var head_img = new Image();
var body_img = new Image();
var body2_img = new Image();
var tail_img = new Image();

var food_img = new Image();
food_img.src = url_imgs + "apple.png";

gen_food();
clear_board();
document.addEventListener("keydown", change_direction);
    
function main() {
    difficulty();
    setScore();
    mode();
    thematic();
    game();
}

var id_list = document.getElementById('id-list').innerHTML;
var id_arr = id_list.split(",");

var nm_list = document.getElementById('nm-list').innerHTML;
var nm_arr = nm_list.split(",");


function addThematics() {
    var sel = document.getElementById("tematica");

    for(var i=2; i<=id_arr.length; i++){
        var opt = document.createElement("option");
        opt.value = id_arr[i-1];
        opt.text = nm_arr[i-1];
        sel.add(opt);
    }
}

window.onload = addThematics;

var fecha = new Date();

function currentDate(fecha) {
    var anyo = fecha.getFullYear();
    var mes = fecha.getMonth() + 1; 
    var dia = fecha.getDate();

    if(mes < 10) mes = '0' + mes;
    if(dia < 10) dia = '0' + dia;

    return fecha = anyo + '-' + mes + '-' + dia;
}

var modo;
var route = '"RankingSG.store"'; 

// función game llamada repetidamente para mantener el juego en marcha
function game() {
    if (has_game_ended()){
        totalTime = 0;
        velocidad = 1000000;
        modo = document.getElementById('modo').value;
        snakeboard_ctx.font = "48px impact";
        snakeboard_ctx.fillStyle = "black";
        snakeboard_ctx.textAlign = "center";
        snakeboard_ctx.fillText("Game Over", snakeboard.width/2, snakeboard.height/2);
        document.getElementById('reload').innerHTML = "Reiniciar&emsp;&emsp;";
        document.getElementById('reload').addEventListener("click", restart);
        document.getElementById('form-end').innerHTML = "<div class='info' id='reload'>FIN DEL JUEGO</div><div class='info'>Introduce tus iniciales</div><input type='text' maxlength='3' name='name' autocomplete='off'><input type='hidden' name='score' id='score' value='" + score + "'><input type='hidden' name='date' id='date' value='" + currentDate(fecha) + "'><input type='hidden' name='mode' id='mode' value='" + modo + "'><input type='submit'  value='Guardar'>";
        document.getElementById('reload').addEventListener("click", restart);
    } 
    //console.log(board_background.src == '');
    changing_direction = false;
    setTimeout(function onTick() {
        if(board_background.src != '') {
            clear_board();
            drawFood();
            move_snake();
            drawSnake();
            // Repetir
            game();
        }
    }, velocidad)
}

function setScore() {
    document.getElementById('score').innerHTML = "Puntuación: " + score;
}


function mode() {
    if(document.getElementById('modo').value == "2") {
        updateClock();
    }
}


function difficulty() {
    if(document.getElementById('dificultad').value == "fac") {
        velocidad = 200;
        points = 50;
    }else if(document.getElementById('dificultad').value == "nor") {
        velocidad = 100;
        points = 25;
    }else if(document.getElementById('dificultad').value == "dif") {
        velocidad = 50;
        points = 10;
    }
}

var bg_list = document.getElementById('bg-list').innerHTML;
var bg_imgs = bg_list.split(",");

var sc_list = document.getElementById('sc-list').innerHTML;
var sc_colors = sc_list.split(",");
console.log(bg_imgs);
function thematic() {
    for(var i=1; i<=bg_imgs.length; i++){
        if(document.getElementById('tematica').value == i){
            board_background.src = url_imgs + bg_imgs[i-1];
            head_img.src = url_imgs + sc_colors[i-1] + "head.png";
            body_img.src = url_imgs + sc_colors[i-1] + "body.png";
            body2_img.src = url_imgs + sc_colors[i-1] + "body2.png";
            tail_img.src = url_imgs + sc_colors[i-1] + "tail.png";
        }

    }
}

function restart() {
    location.reload();
}

// dibujar un borde alrededor del canvas
function clear_board() {
    //  Selecciona el color para rellenar el dibujo
    snakeboard_ctx.fillStyle = board_background;
    //  Selecciona el color para el borde del canvas
    snakeboard_ctx.strokestyle = board_border;
    // Dibuja un rectángulo "relleno" para cubrir todo el canvas
    
    snakeboard_ctx.drawImage(board_background, 0, 0, width, height);
    
    // Dibuja un "borde" alrededor de todo el canvas
    snakeboard_ctx.strokeRect(0, 0, snakeboard.width, snakeboard.height);
}
    
// Dibuja la serpiente en el canvas
/*function drawSnake() {
    // Dibuja cada parte
    snake.forEach(part => drawSnakePart(part))
}*/

function drawFood() {
    snakeboard_ctx.fillStyle = 'lightgreen';
    //snakeboard_ctx.strokestyle = 'darkgreen';
    snakeboard_ctx.drawImage(food_img, food_x-4.5, food_y-6, 20, 20);
    //snakeboard_ctx.strokeRect(food_x, food_y, 10, 10);
}
    
// Dibuja una parte de la serpiente
function drawSnake() {
    // Establece el color de la parte de la serpiente
    //snakeboard_ctx.fillStyle = snake_col;
    // Establece el color del borde de la parte de la serpiente
    //snakeboard_ctx.strokestyle = snake_border;
    // Dibuja un rectángulo "relleno" para representar la parte de la serpiente en las coordenadas 
    // en las que se encuentra
    //snakeboard_ctx.fillRect(snakePart.x, snakePart.y, 10, 10);
    for(var i = 0; i < snake.length; i++) {
        var segment = snake[i];
        var segx = segment.x;
        var segy  = segment.y;
        var scale = 0.3;

        changeTexture(i, segx, segy, scale);

        //snakeboard_ctx.strokestyle = snake_border;
        //snakeboard_ctx.strokeRect(segx, segy, 10, 10);
    } 
    
    // Dibuja un borde alrededor de la parte de la serpiente
    //snakeboard_ctx.strokeRect(snakePart.x, snakePart.y, 10, 10);
    
}

function changeTexture(i, segx, segy, scale) {
    if(i == 0){
        var nseg = snake[i+1]; //siguiente elemento
        if (segy < nseg.y) {
            // Up
            drawImageRotated(head_img, segx+5, segy, scale, -90*Math.PI/180);
        } else if (segx > nseg.x) {
            // Right
            //snakeboard_ctx.drawImage(head_img, segx, segy-5, 20, 20);
            drawImageRotated(head_img, segx+10, segy+5, scale, 0);
        } else if (segy > nseg.y) {
            // Down
            drawImageRotated(head_img, segx+5, segy+10, scale, 90*Math.PI/180);
        } else if (segx < nseg.x) {
            // Left
            drawImageRotated(head_img, segx, segy+5, scale, 180*Math.PI/180);
        }
    }else if(i == snake.length-1){
        var pseg = snake[i-1]; //segmento previo
        if (pseg.y < segy) {
            // Up
            drawImageRotated(tail_img, segx+5, segy+10, scale, -90*Math.PI/180);
        } else if (pseg.x > segx) {
            // Right
            //snakeboard_ctx.drawImage(tail_img, segx-10, segy-5, 20, 20);
            drawImageRotated(tail_img, segx, segy+5, scale, 0);
        } else if (pseg.y > segy) {
            // Down
            drawImageRotated(tail_img, segx+5, segy, scale, 90*Math.PI/180);
        } else if (pseg.x < segx) {
            // Left
            drawImageRotated(tail_img, segx+10, segy+5, scale, 180*Math.PI/180);
        }
    }else{
        var nseg = snake[i+1];
        var pseg = snake[i-1];
        if (pseg.x < segx && nseg.x > segx || nseg.x < segx && pseg.x > segx) {
            // Horizontal Left-Right
            drawImageRotated(body_img, segx, segy+5, scale, 180*Math.PI/180);
        } else if (pseg.x < segx && nseg.y > segy || nseg.x < segx && pseg.y > segy) {
            // Angle Left-Down
            drawImageRotated(body2_img, segx+5, segy+5, scale, 180*Math.PI/180);
        } else if (pseg.y < segy && nseg.y > segy || nseg.y < segy && pseg.y > segy) {
            // Vertical Up-Down
            drawImageRotated(body_img, segx+5, segy, scale, -90*Math.PI/180);
        } else if (pseg.y < segy && nseg.x < segx || nseg.y < segy && pseg.x < segx) {
            // Angle Top-Left
            drawImageRotated(body2_img, segx+5, segy+5, scale, -90*Math.PI/180);
        } else if (pseg.x > segx && nseg.y < segy || nseg.x > segx && pseg.y < segy) {
            // Angle Right-Up
            //snakeboard_ctx.drawImage(body2_img, segx-5, segy-5, 20, 20);
            drawImageRotated(body2_img, segx+5, segy+5, scale, 0);
        } else if (pseg.y > segy && nseg.x > segx || nseg.y > segy && pseg.x > segx) {
            // Angle Down-Right
            drawImageRotated(body2_img, segx+5, segy+5, scale, 90*Math.PI/180);
        }
    }
}

function drawImageRotated(img, x, y, scale, rot) {
    snakeboard_ctx.setTransform(scale, 0, 0, scale, x, y);
    snakeboard_ctx.rotate(rot);
    snakeboard_ctx.drawImage(img, -img.width / 2, -img.height / 2);
    snakeboard_ctx.setTransform(1, 0, 0, 1, 0, 0);
}

function has_game_ended() {
    for (let i = 4; i < snake.length; i++) {
        if (snake[i].x === snake[0].x && snake[i].y === snake[0].y) return true
    }
    if(totalTime==0) return true;
    const hitLeftWall = snake[0].x < 0;
    const hitRightWall = snake[0].x > snakeboard.width - 10;
    const hitToptWall = snake[0].y < 0;
    const hitBottomWall = snake[0].y > snakeboard.height - 10;
    return hitLeftWall || hitRightWall || hitToptWall || hitBottomWall
}

function random_food(min, max) {
    return Math.round((Math.random() * (max-min) + min) / 10) * 10;
}

function gen_food() {
    // Genera un número aleatorio para la coordenada x de la comida
    food_x = random_food(0, snakeboard.width - 10);
    // Genera un número aleatorio para la coordenada y de la comida
    food_y = random_food(0, snakeboard.height - 10);
    // si la nueva ubicación de la comida es donde la serpiente se encuentra actualmente, 
    // genera una nueva ubicación de la comida
    snake.forEach(function has_snake_eaten_food(part) {
        const has_eaten = part.x == food_x && part.y == food_y;
        if (has_eaten) gen_food();
    });
}

function change_direction(event) {
    const LEFT_KEY = 37;
    const RIGHT_KEY = 39;
    const UP_KEY = 38;
    const DOWN_KEY = 40;
      
    // Evita que la serpiente retroceda
    
    if (changing_direction) return;
    changing_direction = true;
    const keyPressed = event.keyCode;
    const goingUp = dy === -10;
    const goingDown = dy === 10;
    const goingRight = dx === 10;
    const goingLeft = dx === -10;
    if (keyPressed === LEFT_KEY && !goingRight) {
        dx = -10;
        dy = 0;
    }
    if (keyPressed === UP_KEY && !goingDown) {
        dx = 0;
        dy = -10;
    }
    if (keyPressed === RIGHT_KEY && !goingLeft) {
        dx = 10;
        dy = 0;
    }
    if (keyPressed === DOWN_KEY && !goingUp) {
        dx = 0;
        dy = 10;
    }
}

function move_snake() {
    // Crea la nueva cabeza de la serpiente
    const head = {x: snake[0].x + dx, y: snake[0].y + dy};
    // Añade la nueva cabeza al principio del cuerpo de la serpiente
    snake.unshift(head);
    const has_eaten_food = snake[0].x === food_x && snake[0].y === food_y;
    if (has_eaten_food) {
        // Aumenta la puntuación
        score += points;
        // Muestra la puntuación en la pantalla
        document.getElementById('score').innerHTML = "Puntuación: " + score;
        // Genera una nueva ubicación de la comida
        gen_food();
    } else {
        // Quita la última parte del cuerpo de la serpiente
        snake.pop();
    }
}

function updateClock() {
    var min = parseInt(totalTime/60);
    var seg = parseInt(totalTime%60);
    if(seg<10){
        document.getElementById('countdown').innerHTML = "&emsp;&emsp;Tiempo " + min + ":0" + seg;
    }else{
        document.getElementById('countdown').innerHTML = "&emsp;&emsp;Tiempo " + min + ":" + seg;
    }
    if(totalTime>0){
        totalTime-=1;
        setTimeout(updateClock, 1000);
    }
}

