<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />  
    <meta name="author" content="Jorge Salazar Maceda">
    <title>Coche Busca Minas</title>
</head>
<body class="bgImage">
<?php
    include_once "models/claseCoche.php"; //Incluimos el fichero de clase y con once solo se importará una vez
    include_once "models/Bombas.php";

     //Creamos el tablero
     //Sería intentar que la matriz sea cuadrada... El usuario pone el tamaño, por ejemplo numero es = que i y j.
     //Otra idea sería hacer un formulario select con dificultad facil 5x5, media 10x10 o dificil 20x20
    
        $fila=intval($_POST['numero']);
        $columna=intval($_POST['numero']);

        // $posx = intval(isset($_POST["posX"]) ? $_POST["posX"] : -1);
        // $posy = intval(isset($_POST["posY"]) ? $_POST["posY"] : -1);
        

        // Inicializamos el array de bombas
        $arrayBombas = array();

        // Hacemos un bucle para ir insertando las bombas en el array
        for($i = 0; $i < $columna; $i++) {

            // En este bucle comprobamos que la bomba que acabamos de crear con las 
            // posiciones aleatorias no estén ya en el array.
            // Si está en el array entonces damos otra vuelta en el bucle para generar 
            // otras coordenadas aleatorias.
            do {

                // Vamos a comprobar si hemos recibido datos de los inputs hidden de las bombas
                // Si es así cogemos el valor y lo guardamos como coordenadas
                if (isset($_POST["bomba".$i])) {
                    // El valor lo estamos enviando con el formato XX_YY, por lo que necesitamos
                    // separar las coordenadas usando la función explode.
                    $coordenadas = explode("_", $_POST["bomba".$i]);
                    $posBombaX = $coordenadas[0];
                    $posBombaY = $coordenadas[1];

                // Si no hemos recibido datos del input hidden, generamos las coordenadas de forma aleatorio
                } else {
                    $posBombaX = rand(0,$fila-1);
                    $posBombaY = rand(0,$columna-1);
                }
                $bomba = new Bomba($posBombaX, $posBombaY);

                // Con array_search miramos que el objeto $bomba está en el array
                // $arrayBombas, si devuelve false, es que no está
            } while(array_search($bomba, $arrayBombas) !== false);
            
            // Si no está en el array lo insertamos.
            array_push($arrayBombas, $bomba);
        }

        // Hacemos las posiciones random o las inicializamos con lo que recibimos por POST
        if (isset($_POST["posX"])) {
            $posx = intval($_POST["posX"]);
            $posy = intval($_POST["posY"]);
            //Creamos un objeto coche
            $coche = new Coche($posx, $posy);
        } else {
            do {
                $posx = rand(0,$columna-1);
                $posy = rand(0,$fila-1);
                //Creamos un objeto coche
                $coche = new Coche($posx, $posy);
                $cocheBomba = new Bomba($posx, $posy);
            }while(array_search($cocheBomba, $arrayBombas) !== false);  
        }


        //Hacemos el setter de las posiciones
        // $coche->setPosicionX($posx);
        // $coche->setPosicionY($posy);

        //Motor de colisiones, es si te pasas de la matriz, la c desaparece
        if($posx >= $columna) {
            echo "¡¡¡¡¡¡Te estás saliendo!!!!!!";
            $posx -= 1;
            $coche->setPosicionX($posx);
        }
        else if($posy >= $fila){
            echo "¡¡¡¡¡¡Te estás saliendo!!!!!!";
            $posy -= 1;
            $coche->setPosicionY($posy);
        }
        else if($posx < 0){
            echo "¡¡¡¡¡¡Te estás saliendo!!!!!!";
            $posx += 1;
            $coche->setPosicionX($posx);
        }
        else if($posy < 0){
            echo "¡¡¡¡¡¡Te estás saliendo!!!!!!";
            $posy += 1;
            $coche->setPosicionY($posy);
        }

        $cocheBomba = new Bomba($coche->getPosicionX(), $coche->getPosicionY());
        // Creamos un objeto Bomba con las mismas coordenadas que el coche
        // para poder usar el array_search con el array de bombas.
        // Si la posición del coche es igual que la de alguna bomba del array, entonces Boooooom!!
        if (array_search($cocheBomba, $arrayBombas) !== false) {
            echo "<div class='explosion-container'>";
                echo "<img src='./assets/images/Explosion.gif' style='width: 650px; height: 650px;'></br>";
                echo "<span style='font-size: 24px; color: red; font-weight: bold;'>¡¡¡¡¡¡BOOOOOOOOOOOMMMMMMMM!!!!!!</span>";
            echo "</div>";

        }

        // echo "<pre>";
        // var_dump($coche);
        // echo "</pre>";
   
        echo "<h1>Tablero en PHP</h1>";
 ?>

 <form method="post" action="opcionalCoche.php">
    <input type="hidden" id="numero" name="numero" value="<?php echo $fila; ?>">
    <input type="hidden" id="posX" name="posX" value="<?php echo $posx; ?>">
    <input type="hidden" id="posY" name="posY" value="<?php echo $posy; ?>">

    <!-- Vamos a generar un input de tipo hidden por cada bomba para almacenar sus coordenadas con el formato XX_YY -->
    <?php foreach ($arrayBombas as $index => $bomba): ?>
        <input type="hidden" id="bomba<?= $index ?>" name="bomba<?= $index ?>" value="<?php echo $bomba->getPosicionX()."_".$bomba->getPosicionY(); ?>">
    <?php endforeach; ?>
 </form>

    <table>
        <?php for($i = 0; $i<$fila; $i++): ?>
            <tr>
                <?php for($j = 0; $j<$columna; $j++): ?>
                    <td>
                        <div style="width: 30px; height: 30px; font-size: 15px;display:flex;align-items: center;justify-content: center;">
                        <?php 
                        // Si la columna y la fila coincide con las posiciones pintas C
                            if($i == $coche->getPosicionY() && $j == $coche->getPosicionX()) {
                                echo  "C";
                            }
                            // Pintar las bombas
                            foreach ($arrayBombas as $index => $bomba) {
                                if ($i == $bomba->getPosicionY() && $j == $bomba->getPosicionX()) {
                                    echo "B".$index;
                                }
                            }
                            // Pintar los muros
                        ?>
                        </div>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>

   

    <script>
        // Interacción del usuario: Detección del evento
        document.querySelector("body").onkeyup = function(e) { //e es el evento
            if (e.key == "a" || e.key == "s" || e.key == "d" || e.key == "w") { //key es la tecla pulsada
                console.log(e.key);

                // Respuesta al evento
                moverCoche(e.key);

            }
        }
        
        function moverCoche(tecla) {
            // Con el document.querySelector obtenemos el valor que tenemos en el input hidden y sumamos o restamos una posición
            if (tecla == "s") {
                document.querySelector("#posY").value = parseInt(document.querySelector("#posY").value) + 1; 
            }
            if (tecla == "w") {
                document.querySelector("#posY").value = parseInt(document.querySelector("#posY").value) - 1;
            }
            if (tecla == "a") {
                document.querySelector("#posX").value = parseInt(document.querySelector("#posX").value) - 1;
            }
            if (tecla == "d") {
                document.querySelector("#posX").value = parseInt(document.querySelector("#posX").value) + 1;
            }
            document.querySelector("form").submit(); // Hacemos submit sobre el formulario para que recargue la página con los inputs actualizados
        }
    </script>
</body>
</html>

