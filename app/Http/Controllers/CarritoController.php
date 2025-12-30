<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CarritoController extends Controller
{
    private function getSessionId()
    {
        if (!session()->has('cart_session_id')) {
            session(['cart_session_id' => Str::random(40)]);
        }
        return session('cart_session_id');
    }

    private function getCarritoQuery()
    {
        if (Auth::check()) {
            return Carrito::where('user_id', Auth::id());
        } else {
            $sessionId = $this->getSessionId();
            return Carrito::where('session_id', $sessionId);
        }
    }

    public function index()
    {
        $items = $this->getCarritoQuery()
            ->with('producto')
            ->get();

        $subtotal = $items->sum(function($item) {
            return $item->cantidad * $item->precio_unitario;
        });

        $impuesto = $subtotal * 0.18; // 18% IGV
        $total = $subtotal + $impuesto;

        return view('farmacia.carrito', compact('items', 'subtotal', 'impuesto', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if (!$producto->activo) {
            return back()->with('error', 'Este producto no está disponible.');
        }

        if (!$producto->tieneStock($request->cantidad)) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        $carritoQuery = $this->getCarritoQuery()->where('producto_id', $producto->id);
        $itemCarrito = $carritoQuery->first();

        if ($itemCarrito) {
            $nuevaCantidad = $itemCarrito->cantidad + $request->cantidad;
            
            if (!$producto->tieneStock($nuevaCantidad)) {
                return back()->with('error', 'No hay suficiente stock disponible.');
            }

            $itemCarrito->update([
                'cantidad' => $nuevaCantidad,
            ]);
        } else {
            Carrito::create([
                'user_id' => Auth::id(),
                'session_id' => Auth::check() ? null : $this->getSessionId(),
                'producto_id' => $producto->id,
                'cantidad' => $request->cantidad,
                'precio_unitario' => $producto->precio,
            ]);
        }

        return back()->with('success', 'Producto agregado al carrito.');
    }

    public function update(Request $request, Carrito $carrito)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        // Verificar que el carrito pertenece al usuario o sesión
        if (Auth::check()) {
            if ($carrito->user_id !== Auth::id()) {
                return back()->with('error', 'No tienes permiso para modificar este item.');
            }
        } else {
            if ($carrito->session_id !== $this->getSessionId()) {
                return back()->with('error', 'No tienes permiso para modificar este item.');
            }
        }

        $carrito->load('producto');
        
        if (!$carrito->producto || !$carrito->producto->tieneStock($request->cantidad)) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        $carrito->update([
            'cantidad' => $request->cantidad,
        ]);

        return back()->with('success', 'Carrito actualizado.');
    }

    public function destroy(Carrito $carrito)
    {
        // Verificar que el carrito pertenece al usuario o sesión
        if (Auth::check()) {
            if ($carrito->user_id !== Auth::id()) {
                return back()->with('error', 'No tienes permiso para eliminar este item.');
            }
        } else {
            if ($carrito->session_id !== $this->getSessionId()) {
                return back()->with('error', 'No tienes permiso para eliminar este item.');
            }
        }

        $carrito->delete();

        return back()->with('success', 'Producto eliminado del carrito.');
    }

    public function clear()
    {
        $this->getCarritoQuery()->delete();

        return back()->with('success', 'Carrito vaciado.');
    }
}
