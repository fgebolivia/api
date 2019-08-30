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
		//return $data;
		return $data->response()->setStatusCode($code);
	}

	function successResponseCollection($data, $code = 200)
	{	//dd($data);
		return response()->json($data, $code);
	}

	function errorResponse ($message, $code)
	{
		return response()->json(['error'=> $message, 'code' => $code],$code);
	}

	function successMesagesResponse ($message, $code)
	{
		return response()->json(['success'=> $message, 'code' => $code],$code);
	}

	function errorsResponse ($message, $code)
	{
		return response()->json($message,$code);
	}

	function showAllCollection(Collection $collection, $code = 200)
	{
		//dd($collection);
		if ($collection->isEmpty()) {
			return $this->successResponseCollection(['data'=> $collection], $code);
		}

		$collection = $this->paginadorColecciones($collection);

		return $this->successResponseCollection($collection, $code);
		
	}

	function showAll($collection, $code = 200)
	{
		
		if ($collection->isEmpty()) {
			return $this->successResponse(['data'=> $collection], $code);
		}

		if ($collection instanceof Collection) {

			$collection = $this->paginadorColecciones($collection);
		}

		//$collection = $this->paginadorColecciones($collection);
		/*** metodos para transfrormas las colecciones y no tengan el mismo nombre que la BD ***/
		$recurso = $collection->first()->resource;
		$colecionTransformada = $recurso::collection($collection);
		/**** paginador de colecciones  ****/

		return $this->successResponse($colecionTransformada, $code);	
	}

	function showOne(Model $instance, $code = 200)
	{
		$recurso = $instance->recurso;
		$transInstance = new $recurso($instance);
		return $this->successResponse(['data' => $transInstance], $code);
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