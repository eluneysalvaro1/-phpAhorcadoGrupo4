<?php
/******************************************
*Completar:
* NOMBRE Y APELLIDOS - LEGAJOS
******************************************/
//Eluney Salvaro - FAI-3143 
//Felipe Flores - FAI-2466
//Ezequiel Araya Nadal - 122578

/**
* genera un arreglo de palabras para jugar
* @return array
*/
function cargarPalabras(){
  $coleccionPalabras = array();
  $coleccionPalabras[0]= array("palabra"=> "papa" , "pista" => "se cultiva bajo tierra", "puntosPalabra"=>7);
  $coleccionPalabras[1]= array("palabra"=> "hepatitis" , "pista" => "enfermedad que inflama el higado", "puntosPalabra"=> 7);
  $coleccionPalabras[2]= array("palabra"=> "volkswagen" , "pista" => "marca de vehiculo", "puntosPalabra"=> 10);
  $coleccionPalabras[3]= array("palabra"=> "perro" , "pista" => "se mete en una cucha", "puntosPalabra"=>7);
  $coleccionPalabras[4]= array("palabra"=> "casa" , "pista" => "se vive en ella", "puntosPalabra"=>6);
  $coleccionPalabras[5]= array("palabra"=> "rata" , "pista" => "raza del maestro splinter", "puntosPalabra"=>4);
  $coleccionPalabras[6]= array("palabra"=> "palta" , "pista" => "aguacate", "puntosPalabra"=>5);
  $coleccionPalabras[7]= array("palabra"=> "rojo" , "pista" => "color de la bandera comunista", "puntosPalabra"=>8);
  return $coleccionPalabras;
}

/**
*Carga diferentes juegos para luego mostrar el mejor
*return $coleccionJuegos Array
*/
function cargarJuegos(){
	$coleccionJuegos = array();
	$coleccionJuegos[0] = array("puntos"=> 0, "indicePalabra" => 1);
	$coleccionJuegos[1] = array("puntos"=> 10,"indicePalabra" => 2);
    $coleccionJuegos[2] = array("puntos"=> 0, "indicePalabra" => 1);
    $coleccionJuegos[3] = array("puntos"=> 8, "indicePalabra" => 0);
    $coleccionJuegos[4] = array("puntos"=> 5, "indicePalabra" => 4);
    $coleccionJuegos[5] = array("puntos"=> 0, "indicePalabra" => 7);
    $coleccionJuegos[6] = array("puntos"=> 8, "indicePalabra" => 7);
    $coleccionJuegos[7] = array("puntos"=> 5, "indicePalabra" => 6);
    
    return $coleccionJuegos;
};

/**
* a partir de la palabra genera un arreglo para determinar si sus letras fueron o no descubiertas
* @param string $palabra 
* @return array
*/
function dividirPalabraEnLetras($palabra){
    //STRING $palabraMin;
    //ARRAY $coleccionLetras; 
    $coleccionLetras = []; 
    $palabraMin = strtolower($palabra);
    for ($i=0; $i < strlen($palabraMin) ; $i++) { 
     $coleccionLetras[$i] = ["letra" => $palabraMin[$i] , "descubierta" => false];
    };
    
    return $coleccionLetras;
};

/**
* muestra y obtiene una opcion de menú ***válida***
* @return int
*/
function seleccionarOpcion(){
    
    echo "--------------------------------------------------------------\n";
    echo "\n ( 1 ) Jugar con una palabra aleatoria"; 
    echo "\n ( 2 ) Jugar con una palabra elegida:";
    echo "\n ( 3 ) Agregar una palabra al listado:";
    echo "\n ( 4 ) Mostrar la información completa de un numero de juego:";
    echo "\n ( 5 ) Mostrar la información completa del primer juego con más puntaje:";
    echo "\n ( 6 ) Mostrar la información completa del primer juego que supere un puntaje indicado por el usuario:";
    echo "\n ( 7 ) Mostrar la lista de palabras ordenadas por puntaje:";
    echo "\n ( 8 ) Salir!!"; 
    
    echo "\n    +-----+    ";
	echo "\n    |	  |    ";  
	echo "\n    O     |    ";
	echo "\n   /|\    |    ";
	echo "\n   / \    |    ";
	echo "\n M=====M  ---- ";
    echo "\n JUEGO DEL AHORCADO \n";

    /*>>> Además controlar que la opción elegida es válida. Puede que el usuario se equivoque al elegir una opción <<<*/

    do {
        echo "Elija una opcion valida: "; 
        $opcion = trim(fgets(STDIN));
    } while (($opcion < 1) || ($opcion > 8));

    echo "--------------------------------------------------------------\n";


    return $opcion;
}

/**
* Determina si una palabra existe en el arreglo de palabras
* @param array $coleccionPalabras
* @param string $palabra
* @return boolean
*/
function existePalabra($coleccionPalabras,$palabra){
    //Int $i $cantPal Boolean $existe 
    $i=0;
    $cantPal = count($coleccionPalabras);
    $existe = false;
    while($i<$cantPal && !$existe){
        $existe = $coleccionPalabras[$i]["palabra"] == $palabra;
        $i++;
    }
    
    return $existe;
}


/**
* Determina si una letra existe en el arreglo de letras
* @param array $coleccionLetras
* @param string $letra
* @return boolean
*/
function existeLetra($coleccionLetras, $letra){
    //int $i, $cantL
	//boolean $existe
	$i=0;
    $cantL = count($coleccionLetras); //$cantL es cantidad de Letras.
    $existe = false;
    while($i<$cantL && !$existe){
        $existe = $coleccionLetras[$i]["letra"] == $letra;
        $i = $i + 1;
    }
    return $existe;
};

/**
* Solicita los datos correspondientes a un elemento de la coleccion de palabras: palabra, pista y puntaje. 
* Internamente la función también verifica que la palabra ingresada por el usuario no exista en la colección de palabras.
* @param array $coleccionPalabras
* @return array  colección de palabras modificada con la nueva palabra.
*/
        function agregarNuevaPalabra($coleccionPalabras){
            echo "Ingrese una nueva palabra: "; 
            $nuevaPalabra = trim(fgets(STDIN)); 
            $palabraNueva = existePalabra($coleccionPalabras,$nuevaPalabra);
            $noExiste = true;
            while ($palabraNueva) {
                echo "Esa palabra ya existe \nIngrese una nueva palabra: "; 
                $nuevaPalabra = trim(fgets(STDIN)); 
                $palabraNueva = existePalabra($coleccionPalabras,$nuevaPalabra);
            };    
                echo "Ingrese la pista: "; 
                $pistaNueva = trim(fgets(STDIN)); 
                echo "Ingrese los puntos: "; 
                $puntosNuevos = trim(fgets(STDIN));
                $cantidadPalabras = count($coleccionPalabras);
                $coleccionPalabras[8]["palabra"] = $nuevaPalabra; 
                $coleccionPalabras[8]["pista"] = $pistaNueva; 
                $coleccionPalabras[8]["puntaje"] = $puntosNuevos;
            return $coleccionPalabras; 
        }


/**
* Obtener indice aleatorio
* @param Int $min $max
* return Float 
*/
function indiceAleatorioEntre($min,$max){
    $i = rand($min,$max); /* Genera un numero entero aleatorio*/
    return $i;
};

/**
* solicitar un valor entre min y max
* @param int $min
* @param int $max
* @return int
*/
function solicitarIndiceEntre($min,$max){ 
    do{
        echo "Seleccione un valor entre $min y $max: ";
        $i = trim(fgets(STDIN));
    }while(!($i>=$min && $i<=$max));
    
    return $i;
}



/**
* Determinar si la palabra fue descubierta, es decir, todas las letras fueron descubiertas
* @param array $coleccionLetras
* @return boolean
*/
function palabraDescubierta($coleccionLetras){
    $retorno = false;
    $sumador = 0;
    for ($i=0; $i < count($coleccionLetras); $i++) { 
        if ($coleccionLetras[$i]["descubierta"] == true ) {
            $sumador = $sumador + 1; 
        }
    }
    if ($sumador == count($coleccionLetras) ) {
        $retorno = true;
    }

        return $retorno; 

}

/**
*Solicita al usuario que ingrese una letra
* 
*return string
*/
function solicitarLetra(){
    //Boolean $letraCorrecta
    //String $letra
    $letraCorrecta = false;
    do{
        echo "Ingrese una letra: ";
        $letra = strtolower(trim(fgets(STDIN)));
        if(strlen($letra)!=1){
            echo "Debe ingresar 1 letra!\n";
        }else{
            $letraCorrecta = true;
        }
        
    }while(!$letraCorrecta);
    
    return $letra;
}

/**
* Descubre todas las letras de la colección de letras iguales a la letra ingresada.
* Devuelve la coleccionLetras modificada, con las letras descubiertas
* @param array $coleccionLetras
* @param string $letra
* @return array colección de letras modificada.
*/
function destaparLetra($coleccionLetras, $letra){
    //Int $i
    for ($i=0; $i < count($coleccionLetras); $i++) { 
        if ($coleccionLetras[$i]["letra"] == $letra){
            $coleccionLetras[$i] = ["letra" => $letra , "descubierta" => true];
        };
    }
    return $coleccionLetras;
};
/**
* obtiene la palabra con las letras descubiertas y * (asterisco) en las letras no descubiertas. Ejemplo: he**t*t*s
* @param array $coleccionLetras
* @return string  Ejemplo: "he**t*t*s"
*/
function stringLetrasDescubiertas($coleccionLetras){
    $pal = "";
    for ($i=0; $i < count($coleccionLetras) ; $i++) { 
        if ($coleccionLetras[$i]["descubierta"] == true ) {
            $pal = $pal . $coleccionLetras[$i]["letra"];
        }else{
            $pal = $pal . "*";
        }
    };
    return $pal;
   };


/**
* Desarrolla el juego y retorna el puntaje obtenido
* Si descubre la palabra se suma el puntaje de la palabra más la cantidad de intentos que quedaron
* Si no descubre la palabra el puntaje es 0.
* @param array $coleccionPalabras
* @param int $indicePalabra
* @param int $cantIntentos
* @return int puntaje obtenido
*/
function jugar($coleccionPalabras, $indicePalabra, $cantIntentos){
    $pal = $coleccionPalabras[$indicePalabra]["palabra"];
    $coleccionLetras = dividirPalabraEnLetras($pal);
    $puntaje = 0;
    $palabraFueDescubierta=false;

	echo "pista: " . $coleccionPalabras[$indicePalabra]["pista"] ."\n"; //mostrar pista al usuario 
    $descubiertas = array();
    	
    do{
    $letra= solicitarLetra();
    $existe= existeLetra($coleccionLetras,$letra);
    if($existe){
      echo "La letra: ". $letra ." ha sido descubierta  \n";
		$descubiertas= destaparLetra($coleccionLetras,$letra);
		$letraDos= stringLetrasDescubiertas($descubiertas);
	  echo $letraDos. "\n";
	    $coleccionLetras=$descubiertas;
	 
	}else{
		$cantIntentos--;	
	  echo "la letra: " . $letra  ." no pertenece a la palabra. QUEDAN "  . $cantIntentos . " INTENTOS  \n";
	}
	$palabraFueDescubierta= palabraDescubierta($descubiertas);
    }while(0<$cantIntentos && !$palabraFueDescubierta); 
     
    if($palabraFueDescubierta){
        $puntaje = $coleccionPalabras[$indicePalabra]["puntosPalabra"]+$cantIntentos;
        echo "\n¡¡¡¡¡¡GANASTE ". $puntaje ." puntos!!!!!!\n";
    }else{
        echo "\n¡¡¡¡¡¡AHORCADO AHORCADO!!!!!!\n";   
        
        echo "\n    +-----+    ";
	    echo "\n    |	  |    ";  
	    echo "\n    O     |    ";
	    echo "\n   /|\    |    ";
	    echo "\n   / \    |    ";
	    echo "\n M=====M  ---- ";
    }
    return $puntaje;
}

/**
* Agrega un nuevo juego al arreglo de juegos
* @param array $coleccionJuegos
* @param int $ptos
* @param int $indicePalabra
* @return array coleccion de juegos modificada
*/
function agregarJuego($coleccionJuegos,$puntos,$indicePalabra){
    $coleccionJuegos[] = array("puntos"=> $puntos, "indicePalabra" => $indicePalabra);    
    return $coleccionJuegos;
}

/**
* Muestra los datos completos de un registro en la colección de palabras
* @param array $coleccionPalabras
* @param int $indicePalabra
*/
function mostrarPalabra($coleccionPalabras,$indicePalabra){
    echo "Palabra: " .$coleccionPalabras[$indicePalabra]["palabra"]."\n";
    echo "Pista: " .$coleccionPalabras[$indicePalabra]["pista"]."\n";
    echo "Puntos: " .$coleccionPalabras[$indicePalabra]["puntosPalabra"]."\n";
};


/**
* Muestra los datos completos de un juego
* @param array $coleccionJuegos
* @param array $coleccionPalabras
* @param int $indiceJuego
*/
function mostrarJuego($coleccionJuegos,$coleccionPalabras,$indiceJuego){
    //array("puntos"=> 8, "indicePalabra" => 1)
    echo "\n\n";
    echo "<-<-< Juego ".$indiceJuego." >->->\n";
    echo "  Puntos ganados: " . $coleccionJuegos[$indiceJuego]["puntos"]."\n";
    echo "  Información de la palabra:\n";
    mostrarPalabra($coleccionPalabras,$coleccionJuegos[$indiceJuego]["indicePalabra"]);
    echo "\n";
}


/*>>> Implementar las funciones necesarias para la opcion 5 del menú <<<*/
/**
 * MUESTRA EL MAYOR PUNTAJE OBTENIDO DE LOS DIFERENTES JUEGOS
 * 
 * Int $numeroAuxiliar , $i , $indiceMayor
 */
function juegoConMasPuntaje($coleccionJuegos,$coleccionPalabras){
    $numeroAuxiliar = 0;
    for ($i=0; $i < count($coleccionJuegos) ; $i++) { 
        if ($coleccionJuegos[$i]["puntos"] > $numeroAuxiliar ) {
            $numeroAuxiliar = $coleccionJuegos[$i]["puntos"];
            $indiceMayor = $i; 
        };
    };
        mostrarJuego($coleccionJuegos,$coleccionPalabras,$indiceMayor);
};


/*>>> Implementar las funciones necesarias para la opcion 6 del menú <<<*/

//Mostrar la información completa del primer juego que supere un puntaje indicado por el usuario

function puntajeIngresadoPorUsuario($coleccionJuegos,$coleccionPalabras){
    //boolean $primerP 
    //int $i, $cont, $info1, $info2, $info3
   $primerPal=false;
   echo "Ingrese puntaje a comparar: \n";
   $puntosUsuario=trim(fgets(STDIN));
   $cont=count($coleccionJuegos);
   $i=0;
       do{
           if($coleccionJuegos[$i]["puntos"]>$puntosUsuario){
             $info1=$coleccionJuegos[$i]["puntos"];
             $primerIndice=$i;
             $primerPal=true;
        }else{
            $i=$i+1;
   }
}
 while(!$primerPal && $i<$cont);
 mostrarJuego($coleccionJuegos,$coleccionPalabras,$primerIndice);
};
/*>>> Implementar las funciones necesarias para la opcion 7 del menú <<<*/
/*
* Mostrar la lista de palabras ordenada por orden alfabético
 * @param array $coleccionPalabras
 */
 function mostrarOrdenado($coleccionPalabras){
	 uasort($coleccionPalabras,"cmp");
	 print_r($coleccionPalabras);
}
/**
 * @param string $a
 * @param string $b
 * @return int
 */
function cmp($a,$b){
    //INT $orden
	if($a["puntosPalabra"] == $b["puntosPalabra"]){
		$orden = 0;
	}elseif($a["puntosPalabra"] > $b["puntosPalabra"]){
		$orden = -1;
	}else{
		$orden = 1;
	}
	return $orden;
};



/******************************************/
/************** PROGRAMA PRINCIAL *********/
/******************************************/
$cantDeIntentos = 6; //Constante en php para cantidad de intentos que tendrá el jugador para adivinar la palabra.
$coleccionJuegos = cargarJuegos();
$coleccionPalabras = cargarPalabras();
do{
    $num1=0;
	$num2=count($coleccionPalabras);
	$var1=0;
	$var2=count($coleccionJuegos);
	$contJ=count($coleccionJuegos);
    $opcion = seleccionarOpcion();
    switch ($opcion) {
    case 1: //Jugar con una palabra aleatoria
            $indiceAleatorioEntre = indiceAleatorioEntre($num1,$num2);
			$indicePalabra = $indiceAleatorioEntre;
			$puntos = jugar($coleccionPalabras,$indicePalabra,$cantDeIntentos);
			$coleccionJuegos = agregarJuego($coleccionJuegos,$puntos,$indicePalabra);
            $var2=count($coleccionJuegos);
        break;
    case 2: //Jugar con una palabra elegida
            $selec1=0;
            $selec1=solicitarIndiceEntre($num1,$num2-1);
           
            $puntos = jugar($coleccionPalabras,$selec1,$cantDeIntentos);
            $coleccionJuegos=agregarJuego($coleccionJuegos,$puntos,$selec1);
			$var2=count($coleccionJuegos);
        break;
    case 3: //Agregar una palabra al listado
        $coleccionPalabras= agregarNuevaPalabra($coleccionPalabras);
        $num2=$num2 +1;
        break;
    case 4: //Mostrar la información completa de un número de juego
        $obteniendoIndice=0;
			$obteniendoIndice=solicitarIndiceEntre($var1,$var2-1);
			$mostrandoJuego= mostrarJuego($coleccionJuegos,$coleccionPalabras,$obteniendoIndice);

        break;
    case 5: //Mostrar la información completa del primer juego con más puntaje
        $mostrarElmasAltoPuntaje = juegoConMasPuntaje($coleccionJuegos,$coleccionPalabras);

        break;
    case 6: //Mostrar la información completa del primer juego que supere un puntaje indicado por el usuario
        $mostrarPrimerDato= puntajeIngresadoPorUsuario($coleccionJuegos,$coleccionPalabras);
			
        break;
    case 7: //Mostrar la lista de palabras ordenada por orden alfabetico
        $mostrarOrdenados = mostrarOrdenado($coleccionPalabras);
			
        break;
    }

}while($opcion != 8);
