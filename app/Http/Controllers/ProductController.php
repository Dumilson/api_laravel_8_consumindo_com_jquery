<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
    
            try {
                $validator = Validator::make($request->all(), [
                   
                    'preco' => "regex:/^\d+(\.\d{1,2})?$/",
                ]);
        
                if (!$validator->fails()) {
              
                    
                    return response(
                       [
                            'sucess' => false,
                            'message' => "Producto adicionado com sucesso !",
                            'status' => 400
                        ],
                    )->header('content-type', 'application/json');
                }
        
                return response(
                     [
                        'sucess' => false,
                        'message' => "Dados invalidos",
                        'status' => 400
                    ],
                )->header('content-type', 'application/json');
            } catch (\Throwable $th) {
                return response(
                     [
                        'sucess' => false,
                        'message' => "Erro na api, contate o prevedor",
                        'status' => 400 
                    ]
                )->header('content-type', 'application/json');
            }
        
    }

 
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

 
    public function destroy($id)
    {
        //
    }
}
