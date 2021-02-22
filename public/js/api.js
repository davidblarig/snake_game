// Create the image object
var image = new Image();

// Add onload event handler
image.onload = function () {
    // Done loading, now we can use the image
};

// Set the source url of the image
image.src = "snake-graphics.png";

const board_border = 'black';
var board_background = 'transparent';
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
        var mensaje = alert("Fin del juego\nHas conseguido " + score + " puntos");
        location.reload();
        return mensaje;
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
        board_background = "white";
        snake_col = 'lightblue';
        snake_border = 'darkblue';
    }else if(document.getElementById('tematica').value == "2"){
        board_background = "#fccd56";
        snake_col = '#fab300';
        snake_border = 'black';
    }
}
    
// dibujar un borde alrededor del canvas
function clear_board() {
    //  Selecciona el color para rellenar el dibujo
    snakeboard_ctx.fillStyle = board_background;
    //  Selecciona el color para el borde del canvas
    snakeboard_ctx.strokestyle = board_border;
    // Dibuja un rectángulo "relleno" para cubrir todo el canvas
    snakeboard_ctx.fillRect(0, 0, snakeboard.width, snakeboard.height);
    // Dibuja un "borde" alrededor de todo el canvas
    snakeboard_ctx.strokeRect(0, 0, snakeboard.width, snakeboard.height);
}
    
// Dibuja la serpiente en el canvas
function drawSnake() {
    // Dibuja cada parte
    snake.forEach(drawSnakePart)
}

function drawFood() {
    snakeboard_ctx.fillStyle = 'lightgreen';
    snakeboard_ctx.strokestyle = 'darkgreen';
    snakeboard_ctx.fillRect(food_x, food_y, 10, 10);
    snakeboard_ctx.strokeRect(food_x, food_y, 10, 10);
}
    
// Dibuja una parte de la serpiente
function drawSnakePart(snakePart) {
    // Establece el color de la parte de la serpiente
    snakeboard_ctx.fillStyle = snake_col;
    // Establece el color del borde de la parte de la serpiente
    snakeboard_ctx.strokestyle = snake_border;
    // Dibuja un rectángulo "relleno" para representar la parte de la serpiente en las coordenadas 
    // en las que se encuentra
    snakeboard_ctx.fillRect(snakePart.x, snakePart.y, 10, 10);
    // Dibuja un borde alrededor de la parte de la serpiente
    snakeboard_ctx.strokeRect(snakePart.x, snakePart.y, 10, 10);
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

