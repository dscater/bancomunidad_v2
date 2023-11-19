<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    // Funcion encargada de enviar la información mediante API
    public function enviaDatos(Request $request)
    {
        // indicamos la URL del archivo donde se donde se ejecutara la función
        // y también la url de acceso donde se encuentra el archivo
        $url = "http://loggin";
        $uri = "http://loggin.test/";

        // instanciamos el CLIENTE API
        $cliente = new APIClient(null, array('location' => $url, 'uri' => $uri));

        // rescatamos la información del REQUEST
        $ci_funcionario = $request->ci_funcionario;
        $acceso = $request->acceso;

        // ejecutamos la funcion, pasandole los parametros que necesita la función
        $resultado = $cliente->acceso($ci_funcionario, $acceso);

        // devolvemos el resultado obtenido que puede ser true o false
        return $resultado;
    }
}
