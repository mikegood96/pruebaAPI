<?php

namespace App\Http\Controllers;

use App\Fruta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FrutaController extends Controller
{
    public function index()
    {
        return response()->json([
            'error' => false,
            'frutas'  => Fruta::all(),
        ], 200);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'nombre' => 'required',
            'size' => 'required',
            'color' => 'nullable',
        ]);

        if ($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        } else {
            $fruta = new Fruta;
            $fruta->nombre = $request->input('nombre');
            $fruta->size = $request->input('size');
            $fruta->color = $request->input('color');
            $fruta->save();

            return response()->json([
                'error' => false,
                'fruta'  => $fruta,
            ], 200);
        }
    }

    public function show($id)
    {
        $fruta = Fruta::find($id);

        if(is_null($fruta)){
            return response()->json([
                'error' => true,
                'message'  => "La fruta con id $id no se encuentra",
            ], 404);
        }

        return response()->json([
            'error' => false,
            'fruta'  => $fruta,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'nombre' => 'required',
            'size' => 'required',
            'color' => 'nullable',
        ]);

        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else
        {
            $fruta = Fruta::find($id);
            $fruta->nombre = $request->input('nombre');
            $fruta->size = $request->input('size');
            $fruta->color = $request->input('color');
            $fruta->save();

            return response()->json([
                'error' => false,
                'fruta'  => $fruta,
            ], 200);
        }
    }

    public function destroy($id)
    {
        $fruta = Fruta::find($id);

        if(is_null($fruta)){
            return response()->json([
                'error' => true,
                'message'  => "La fruta con id $id no se encuentra",
            ], 404);
        }

        $fruta->delete();

        return response()->json([
            'error' => false,
            'message'  => "La fruta con id $id ha sido eliminada correctamente",
        ], 200);
    }
}
