<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

trait ApiResponser
{
	function successResponse($data, $code = 200)
	{	//dd($data);
		return response()->json($data, $code);
	}

	function errorResponse ($message, $code)
	{
		return response()->json(['error'=> $message, 'code' => $code],$code);
	}

	function errorsResponse ($message, $code)
	{
		return response()->json($message,$code);
	}

	function showAll(Collection $collection, $code = 200)
	{
		//dd($collection);
		if ($collection->isEmpty()) {
			return $this->successResponse(['data'=> $collection], $code);
		}
		$collection = $this->paginadorColecciones($collection);

		//$resource = $collection->first()->resource


		return $this->successResponse($collection, $code);
		
	}

	function showMessage($message, $code = 200)
	{
		return $this->seccessResponse($message, $code);
	}

	function showOne(Model $instance, $code = 200)
	{
		return $this->successResponse($instance, $code);
	}

	function paginadorColecciones(Collection $collection)
	{
		//$perPage = $this->determinePageSize();

		$page = LengthAwarePaginator::resolveCurrentPage();

		$resultado = $collection->slice(($page - 1) * 5, 5)->values();

		$paginated = new LengthAwarePaginator($resultado, $collection->count(),5, $page,[
			'path' => LengthAwarePaginator::resolveCurrentPath(),
		]);

		$paginated->appends(request()->query());
		return $paginated;
	}	

	//funcion para determinar las paginas por defecto
	/*function determinePageSize()
	{
		$rules = [
			'per_page'=>'integer|min:5|max:50'
		];

		try {
            dd($validator = request()->validate($rules));
        } catch (Exception $e) {
            return json_encode($e);
            //return response()->json(['Cargo' => json_encode($respuesta)], 201);
        };

		return isset($perPage['per_page'])? $perPage['per_page']:10;
	}*/
}