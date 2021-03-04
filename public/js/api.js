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

var head_img = new Image();
head_img.src = "../../img/head.png";
var body_img = new Image();
body_img.src = "../../img/body.png";
var body2_img = new Image();
body2_img.src = "../../img/body2.png";
var tail_img = new Image();
tail_img.src = "../../img/tail.png";

var food_img = new Image();
food_img.src = "../../img/apple.png";

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

// función game llamada repetidamente para mantener el juego en marcha
function game() {
    if (has_game_ended()){
        totalTime = 0;
        velocidad = 100000;
        snakeboard_ctx.font = "48px impact";
        snakeboard_ctx.fillStyle = "black";
        snakeboard_ctx.textAlign = "center";
        snakeboard_ctx.fillText("Game Over", snakeboard.width/2, snakeboard.height/2);
        document.getElementById('reload').innerHTML = "Reiniciar&emsp;&emsp;";
        document.getElementById('reload').addEventListener("click", restart);
    } 
    
    changing_direction = false;
    setTimeout(function onTick() {
        clear_board();
        drawFood();
        move_snake();
        drawSnake();
        // Repetir
        game();
    }, velocidad)
}

function setScore() {
    document.getElementById('score').innerHTML = "Puntuación: " + score;
}

function mode() {
    if(document.getElementById('modo').value == "val2") {
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

function thematic() {
    if(document.getElementById('tematica').value == "1") {
        board_background.src = "../../img/theme1.jpg";
        snake_col = 'lightblue';
        snake_border = 'darkblue';
    }else if(document.getElementById('tematica').value == "2"){
        board_background.src = "../../img/desert.png";
        snake_col = '#fab300';
        snake_border = 'black';
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
        var segy = segment.y;

        if(i == 0){
            //snakeboard_ctx.drawImage(head_img, part.x-4.5, part.y-5, 20, 20);
            var nseg = snake[i+1]; //siguiente elemento
            if (segy < nseg.y) {
                // Up
                changeTexture(head_img, segment);
            } else if (segx > nseg.x) {
                // Right
                changeTexture(head_img, segment);
            } else if (segy > nseg.y) {
                // Down
                changeTexture(head_img, segment);
            } else if (segx < nseg.x) {
                // Left
                changeTexture(head_img, segment);
            }
        }else if(i == snake.length-1){
            //snakeboard_ctx.drawImage(tail_img, part.x-4.5, part.y-5, 20, 20);
            var pseg = snake[i-1]; //segmento previo
            if (pseg.y < segy) {
                // Up
                changeTexture(tail_img, segment);
            } else if (pseg.x > segx) {
                // Right
                changeTexture(tail_img, segment);
            } else if (pseg.y > segy) {
                // Down
                changeTexture(tail_img, segment);
            } else if (pseg.x < segx) {
                // Left
                changeTexture(tail_img, segment);
            }
        }else{
            //snakeboard_ctx.drawImage(body_img, part.x-4.5, part.y-5, 20, 20);
            var nseg = snake[i+1];
            var pseg = snake[i-1];
            if (pseg.x < segx && nseg.x > segx || nseg.x < segx && pseg.x > segx) {
                // Horizontal Left-Right
                changeTexture(body_img, segment);
            } else if (pseg.x < segx && nseg.y > segy || nseg.x < segx && pseg.y > segy) {
                // Angle Left-Down
                changeTexture(body2_img, segment);
            } else if (pseg.y < segy && nseg.y > segy || nseg.y < segy && pseg.y > segy) {
                // Vertical Up-Down
                changeTexture(body_img, segment);
            } else if (pseg.y < segy && nseg.x < segx || nseg.y < segy && pseg.x < segx) {
                // Angle Top-Left
                changeTexture(body2_img, segment);
            } else if (pseg.x > segx && nseg.y < segy || nseg.x > segx && pseg.y < segy) {
                // Angle Right-Up
                changeTexture(body2_img, segment);
            } else if (pseg.y > segy && nseg.x > segx || nseg.y > segy && pseg.x > segx) {
                // Angle Down-Right
                changeTexture(body2_img, segment);
            }
        }
    } 
    
    // Dibuja un borde alrededor de la parte de la serpiente
    //snakeboard_ctx.strokeRect(snakePart.x, snakePart.y, 10, 10);
}

function changeTexture(img, part) {
    if(dx == -10 && dy == 0){
        drawImageRotated(img, part.x+5, part.y+5, 0.3, 180*Math.PI/180);
    }else if(dx == 0 && dy == -10){
        drawImageRotated(img, part.x+5, part.y, 0.3, -90*Math.PI/180);
    }else if(dx == 10 && dy == 0) {
        snakeboard_ctx.drawImage(img, part.x-4.5, part.y-5, 20, 20);
    }else if(dx == 0 && dy == 10){
        drawImageRotated(img, part.x+5, part.y, 0.3, 90*Math.PI/180);
    }
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

function drawImageRotated(img, x, y, scale, rot) {
    snakeboard_ctx.setTransform(scale, 0, 0, scale, x, y);
    snakeboard_ctx.rotate(rot);
    snakeboard_ctx.drawImage(img, -img.width / 2, -img.height / 2);
    snakeboard_ctx.setTransform(1, 0, 0, 1, 0, 0);
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

