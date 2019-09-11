<?php

namespace App\Http\Controllers\Casos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConnectionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successConection('la coneccion se establecio con exito', 200);
    }

}
