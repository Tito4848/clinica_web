<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class FarmaciaController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::where('activo', true)->with('categoria');

        // Búsqueda
        if ($request->has('buscar') && $request->buscar) {
            $query->where(function($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->buscar . '%')
                  ->orWhere('descripcion', 'like', '%' . $request->buscar . '%')
                  ->orWhere('laboratorio', 'like', '%' . $request->buscar . '%');
            });
        }

        // Filtro por categoría
        if ($request->has('categoria') && $request->categoria) {
            $query->where('categoria_id', $request->categoria);
        }

        // Ordenamiento
        $orden = $request->get('orden', 'nombre');
        $direccion = $request->get('direccion', 'asc');
        
        if ($orden === 'precio') {
            $query->orderBy('precio', $direccion);
        } else {
            $query->orderBy('nombre', $direccion);
        }

        $productos = $query->paginate(12);
        $categorias = Categoria::where('activo', true)->get();

        return view('farmacia.index', compact('productos', 'categorias'));
    }

    public function show($slug)
    {
        $producto = Producto::where('slug', $slug)
            ->where('activo', true)
            ->with('categoria')
            ->firstOrFail();

        $productosRelacionados = Producto::where('categoria_id', $producto->categoria_id)
            ->where('id', '!=', $producto->id)
            ->where('activo', true)
            ->limit(4)
            ->get();

        return view('farmacia.show', compact('producto', 'productosRelacionados'));
    }
}
