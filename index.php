<!-- 
Implementa un juego de coche donde un objeto de tipo coche representado por la letra C y de color amarillo 
se mueve por un tablero esquivando obstáculos. Su objetivo es llegar a la meta. 

Para definir las características del coche es necesario utilizar POO. Las reglas del juego son las siguientes:

El tablero de juego será un cuadrado, por ejemplo de 10x10.
La celda que representa el coche se marca con el carácter ‘C‘, se coloca el coche de forma aleatoria en el tablero. 
Por ejemplo, la (5,3).

Se reparten 10 bombas en 10 casillas aleatorias. La celda que representa una bomba se marca con el carácter ‘B’ 
y en color rojo. Si el coche cae a una bomba se acaba el juego.

Se reparten 10 muros en 10 casillas aleatorias. La celda que representa un muro se marca con el carácter ‘M‘ y en color gris. 
El coche no puede pasar por un muro.

El coche solo se puede mover por celdas libres, se representan con el color blanco.
El jugador podrá pulsar cuatro teclas. Cada una de ellas le proporcionará un movimiento: 
derecha, izquierda, arriba y abajo (‘D’, ‘A’,’W’ y ‘S’).

La posición final será la (10,10) y si se consigue llegar se gana el juego.

El tamaño del tablero, el número de bombas y de muros son parámetros que define el usuario desde un formulario antes de que empiece 
el juego. Se podrán variar las especificaciones del juego con el fin de crear un interfaz más amigable.

No se evaluarán ejercicios que contengan errores y no se pueden ejecutar. 
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />  
    <title>Coche</title>
</head>
<body class="bgImage">

    <div class="form">
        <form method="post" action="opcionalCoche.php">
            <label for="text" > El tamaño de tu tablero: </br></label>
            <input type="number" name="numero" required></input>
            <br> 
            <input type="submit" name="botonEnviar" value="Enviar datos"/>
        </form>
    </div>

</body>
</html>