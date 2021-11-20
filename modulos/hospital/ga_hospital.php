<?php 
    for ($i=0; $i <5 ; $i++) { 
    echo "<h1> hola desde php </h1>";
    }

<<<<<<< HEAD
    //---------------------- Verficar si todo esta OK
    if ($respuesta["db"] && $respuesta["img"]) {
        $db->commit();
        echo 1;
    } else {
        if ($respuesta["img"] != 1) {
            echo  $respuesta["img"] . " ";
        }
    }
} catch (Exception $e) {
    $db->rollback();
    $v = explode('|', $e);
    // echo $v[1];
    $n = explode("'", $v[1]);
    $n[0];
    echo $db->m_error($n[0]);
    echo "ERROR EN LA BASE DE DATOS";
}
=======
    ?>
>>>>>>> 455b9f21be1c4aba2a2eaf9ec4682f43caabca61
