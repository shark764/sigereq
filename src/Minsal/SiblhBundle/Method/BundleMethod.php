<?php

namespace Minsal\SiblhBundle\Method;

class BundleMethod {
    /*
     * calcularEdad => Método que calcula mediante postgres la edad
     *                  de una persona comparandola con la fecha actual
     *                  luego cambia a español el resultado para que
     *                  aparesca Años, meses y días
     *
     * $conn => Es la conexión para poder realizar la consulta
     * $fechaNacimiento => Es la fecha de nacimiento de la persona
     * $fechaHoraNacimiento => Es la horaNacimiento de la persona
     * @return string
     *
     *
     * ANALISTA PROGRAMADOR: Ing. Karen Peñate
     */

    public function calcularEdad($conn, $fechaNacimiento, $horaNacimiento = null) {
        $fecha_actual = getdate();
        $fecha_actual = $fecha_actual['mday'] . '-' . $fecha_actual['mon'] . '-' . $fecha_actual['year'];
        $sql = "SELECT age(timestamp '$fecha_actual', timestamp '$fechaNacimiento')";
        $query = $conn->query($sql);
        if ($query->rowCount() > 0) {
            $edad = $query->fetch();
            $edad = $edad['age'];
            $edad = str_replace('years', 'años,', $edad);
            $edad = str_replace('year', 'año,', $edad);
            $edad = str_replace('mons', 'meses,', $edad);
            $edad = str_replace('mon', 'mes,', $edad);
            $edad = str_replace('days', 'días,', $edad);
            $edad = str_replace('day', 'día,', $edad);
            $edad = str_replace('[,]$', '', $edad);
        }
        /* AGREGAR LO DE SI ES = 000000 COLOCAR LA FECHA */
        if (strcmp($edad, '00:00:00') == 0) {
            if (is_null($horaNacimiento)) {
                $edad = '0 días';
            } else {
                $sql = "SELECT concat_ws(' ',regexp_replace(to_char((now()::TIME - '$horaNacimiento'),'HH24:MI'),':',' Horas '),'Minutos') AS age";
                $query = $conn->query($sql);
                $edad = $query->fetch();
                $edad = $edad['age'];
            }
        }
        return $edad;
    }

    /*
     * encriptarClave => Encripta la cadena que se envía como parámetro
     *
     * $cadena => Cadena a encriptar
     *
     * @return string
     *
     *
     *
     * ANALISTA PROGRAMADOR: Ing. Karen Peñate
     */

    public function encriptarClave($cadena) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $key = md5('m1ns4l-s14ps');

        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $cadena, MCRYPT_MODE_ECB, $iv);
        return base64_encode($crypttext);
    }

    /*
     * desencriptarClave( => Desencripta la cadena que se envía como parámetro
     *
     * $cadena => Cadena a desencriptar
     *
     * @return string
     *
     *
     *
     * ANALISTA PROGRAMADOR: Ing. Karen Peñate
     */

    public function desencriptarClave($cadena) {
        $cadena = base64_decode($cadena);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $key = md5('m1ns4l-s14ps');

        $texto = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $cadena, MCRYPT_MODE_ECB, $iv);
        return $texto;
    }

    /*
     * calcularAniosMesesDiasFecha => Método que calcula la cantidad de años
     *                                meses y días de una determinada edad     *
     * $edad => Edad en un string
     * @return string
     *
     *
     *
     * ANALISTA PROGRAMADOR: Ing. Karen Peñate
     */

    public function calcularAniosMesesDiasEdad($edad) {
        $edad = explode(' ', $edad);

        if (strstr($edad[1], 'año')) {
            $resultado['anios'] = $edad[0];
            if (isset($edad[3])) {
                if (strstr($edad[3], 'mes')) {
                    $resultado['meses'] = $edad[2];
                    if (isset($edad[5])) {
                        if (strstr($edad[5], 'día')) {
                            $resultado['dias'] = $edad[4];
                        } else {
                            $resultado['dias'] = 0;
                        }
                    } else {
                        $resultado['meses'] = 0;
                        $resultado['dias'] = 0;
                    }
                } else {
                    $resultado['meses'] = 0;
                    $resultado['dias'] = $edad[2];
                }
            } else {
                $resultado['meses'] = 0;
                $resultado['dias'] = 0;
            }
        } else {
            $resultado['anios'] = 0;
            if (strstr($edad[1], 'mes')) {
                $resultado['meses'] = $edad[0];
                if (isset($edad[3])) {
                    if (strstr($edad[3], 'día')) {
                        $resultado['dias'] = $edad[2];
                    } else {
                        $resultado['dias'] = 0;
                    }
                } else {
                    $resultado['meses'] = 0;
                    $resultado['dias'] = 0;
                }
            } else {
                $resultado['meses'] = 0;
                $resultado['dias'] = $edad[0];
            }
        }
        return $resultado;
    }

    /*
     * eliminarArticulosPreposiciones => Método que devuelve una cadena sin articulos
     *                                   ni preposiciones
     * $cadena => cadena a transformar
     * @return string
     *
     *
     *
     * ANALISTA PROGRAMADOR: Ing. Karen Peñate
     */

    public function eliminarArticulosPreposiciones($cadena) {
        $articulos='[ el | la | los | las | un | una | unos | unas | lo | al | del ]';
        $preposiciones ='[ a | ante | bajo | cabe | con | contra | de | desde | durante | en | entre | hacia | hasta | mediante | para | por | segun | si | sin | so | sobre | tras | versus ]';

        $cadena=strtolower ($cadena);
        $cadena=' '.$cadena.' ';
        $cadena=$this->limpiarCadena($cadena);


        $cadena = preg_replace($articulos,' ', $cadena,-1);
        $cadena = preg_replace($preposiciones,' ' ,$cadena,-1);

        return $cadena;
    }

    /*
     * obtenerUsername => Método que devuelve un username valido
     *PARAMETROS:
     *                $em => Model Manager
     *                $firstname => Nombres
     *                $lastname => apellidos
     * @return string
     *
     */

    public function obtenerUsername($em,$firstname,$lastname){
      $primerApellido='';
      $segundoApellido='';

      if (strpos($lastname, " "))
          list($primerApellido, $segundoApellido) = explode(" ", $lastname);
      else
          $primerApellido = $lastname;
      $bandera = false;
      $i = 0;
      $primero = '';
      $username = '';

      while (!$bandera) {
          $primero.=$firstname[$i];
          $username = strtolower($primero . $primerApellido);
          $valor = $em
          ->getRepository('ApplicationSonataUserBundle:User')
                       ->findOneBy(array('username' => $username));
          if (count($valor) == 0)
              $bandera = true;
          else
              $i++;
      }

      $username=$this->limpiarCadena($username);
      $username=preg_replace('[ñ]','n', $username,-1);

      return $username;
    }


    /*
     * limpiarCadena => Método que devuelve una cadena sin caracteres especiales
     * $cadena => cadena limpiar
     * @return string
     *
     */

    public function limpiarCadena($cadena){
        $cadena=preg_replace('[á|à|ä|â|å]','a', $cadena,-1);
        $cadena=preg_replace('[é|è|ë|ê]','e', $cadena,-1);
        $cadena=preg_replace('[í|ì|ï|î]','i', $cadena,-1);
        $cadena=preg_replace('[ó|ò|ö|ô]','o', $cadena,-1);
        $cadena=preg_replace('[ú|ù|ü|û]','u', $cadena,-1);
        $cadena=preg_replace('[ý|ÿ]','y', $cadena,-1);

        return $cadena;
    }

}