<?php

namespace App\Http\Controllers\Casos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
* @group Estado Servicio
*
*/

class ConnectionApiController extends Controller
{
    /**
     * Estado - Estado de la API REST.
     *
     * @return \Illuminate\Http\Response
     * @response
     *  {
     *  "message": "El servicio de Ministerio Publico v2 se encuentra disponible",
     *  "code": 200
     *  }
     */
    public function index()
    {
        return $this->successConection('El servicio de Ministerio Publico v2 se encuentra disponible', 200);
    }

}
