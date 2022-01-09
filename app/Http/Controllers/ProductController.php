<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        try {
            $data = Product::all();
        
            return response(
                [
                    'status' => 200,
                    'sucess' => true,
                    'data' => $data
                ]
            )->header('content-type', 'application/json');
        } catch (\Throwable $th) {
            return response(
                 [
                    'sucess' => false,
                    'message' => "Erro na api, contate o prevedor",
                    'status' => 400 
                ],
            )->header('content-type', 'application/json');
        }
    }

  
    public function store(Request $request)
    {
    
            try {
                $validator = Validator::make($request->all(), [
                    'nome_produto'=> 'required',
                    'info'=>'required',
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
