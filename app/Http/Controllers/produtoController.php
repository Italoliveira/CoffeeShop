<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;
use App\Models\products;

class produtoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = products::join('categories', 'products.category','=','categories.id')
        ->select('products.id','products.name','products.status','products.description','products.price','categories.name as category','products.image','products.quantity_unit')
        ->get();

        
        $categorias = categories::all();

        return view('admin.produtos.index', [
            'produtos' => $produtos,
            'categorias' => $categorias
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $produtos = new products();

        $data = $request->only(['name', 'category', 'quantity', 'value', 'describe']);

        $produtos->name = $data['name'];
        $produtos->description = $data['describe'];
        $produtos->price = $data['value'];
        $produtos->quantity_unit = $data['quantity'];
        $produtos->category = $data['category'];
        $produtos->status = 'D';

        if($request->hasFile('file-image')){

            $image = $request->file('file-image');
            $produtos->image = "storage/" . $image->store('uploads','public');
        }

        $produtos->save();

        return redirect()->route('produtos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   

        $produto = products::find($id);
        $categorias = categories::all();

        return view('admin.produtos.show', [
            'produto' => $produto,
            'categorias' => $categorias
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only(['name', 'category', 'quantity_unit', 'price', 'description', 'status']);

        if($produto = products::find($id)){

            if($request->hasFile('file-image')){

                $image = $request->file('file-image');
    
                $produto->image = "storage/" . $image->store('uploads','public');
            }
            
            $produto->update($data);

            $produto->save();
            
            return redirect()->route('produtos.show',['produto' => $id]);

        }    
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($produto = products::find($id)){
            $produto->delete();
            return redirect()->route('produtos.index');
        }
    }
}
