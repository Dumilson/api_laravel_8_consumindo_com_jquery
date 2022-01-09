<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        try {
            $data = DB::table('products')->orderBy('created_at','desc')->get();

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
                'nome_produto' => 'required',
                'info' => 'required',
                'preco' => "regex:/^\d+(\.\d{1,2})?$/",
            ]);

            if (!$validator->fails()) {
                $query = Product::insert([
                    'nome_do_produto' => $request->nome_produto,
                    'info' => $request->info,
                    'preco' => $request->preco,
                ]);
                return response(
                    [
                        'sucess' => $query ? true : false,
                        'message' => "Producto adicionado com sucesso !",
                        'status' => 200
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
        try {
            Validator::make($id, [
                'id' => "required|regex:/^\d+(\.\d{1,2})?$/",
            ]);
            
            $query =  DB::table('products')->where('id',$id)->first();
           
            if(!$query){
                return response(
                    [
                        'status' => 404,
                        'sucess' => false,
                        'message' => "Dados invalidos",
                    ]
                )->header('content-type', 'application/json');
            }

    
            return response(
                [
                    'status' => 200,
                    'sucess' => true,
                    'data' =>$query
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


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        
        try {
            Validator::make($request->all(), [
                'id' => "required|regex:/^\d+(\.\d{1,2})?$/",
            ]);
            
            $query =  DB::table('products')->where('id',$request->id)->delete();
           
            if(!$query){
                return response(
                    [
                        'status' => 404,
                        'sucess' => false,
                        'message' => "Dados invalidos",
                    ]
                )->header('content-type', 'application/json');
            }

        

            return response(
                [
                    'status' => 200,
                    'sucess' => true,
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

}
