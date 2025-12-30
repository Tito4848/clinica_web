<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PedidoController extends Controller
{
    public function checkout()
    {
        if (Auth::check()) {
            $carritoQuery = Carrito::where('user_id', Auth::id());
        } else {
            $sessionId = session('cart_session_id');
            if (!$sessionId) {
                return redirect()->route('farmacia.carrito')->with('error', 'Tu carrito está vacío.');
            }
            $carritoQuery = Carrito::where('session_id', $sessionId);
        }

        $items = $carritoQuery->with('producto')->get();

        if ($items->isEmpty()) {
            return redirect()->route('farmacia.carrito')->with('error', 'Tu carrito está vacío.');
        }

        $subtotal = $items->sum(function($item) {
            return $item->cantidad * $item->precio_unitario;
        });

        $impuesto = $subtotal * 0.18;
        $total = $subtotal + $impuesto;

        return view('farmacia.checkout', compact('items', 'subtotal', 'impuesto', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'email_cliente' => 'required|email|max:255',
            'telefono_cliente' => 'required|string|max:20',
            'direccion_entrega' => 'required|string|max:500',
            'notas' => 'nullable|string|max:1000',
        ]);

        if (Auth::check()) {
            $carritoQuery = Carrito::where('user_id', Auth::id());
        } else {
            $sessionId = session('cart_session_id');
            if (!$sessionId) {
                return redirect()->route('farmacia.carrito')->with('error', 'Tu carrito está vacío.');
            }
            $carritoQuery = Carrito::where('session_id', $sessionId);
        }

        $items = $carritoQuery->with('producto')->get();

        if ($items->isEmpty()) {
            return redirect()->route('farmacia.carrito')->with('error', 'Tu carrito está vacío.');
        }

        // Verificar stock de todos los productos
        foreach ($items as $item) {
            if (!$item->producto->tieneStock($item->cantidad)) {
                return back()->with('error', "El producto {$item->producto->nombre} no tiene suficiente stock.");
            }
        }

        // Calcular totales
        $subtotal = $items->sum(function($item) {
            return $item->cantidad * $item->precio_unitario;
        });

        $impuesto = $subtotal * 0.18;
        $total = $subtotal + $impuesto;

        // Crear pedido
        $pedido = Pedido::create([
            'user_id' => Auth::id(), // Puede ser null si no está autenticado
            'nombre_cliente' => $request->nombre_cliente,
            'email_cliente' => $request->email_cliente,
            'telefono_cliente' => $request->telefono_cliente,
            'direccion_entrega' => $request->direccion_entrega,
            'subtotal' => $subtotal,
            'impuesto' => $impuesto,
            'total' => $total,
            'estado' => 'pendiente',
            'notas' => $request->notas,
        ]);

        // Crear detalles del pedido y actualizar stock
        foreach ($items as $item) {
            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $item->producto_id,
                'cantidad' => $item->cantidad,
                'precio_unitario' => $item->precio_unitario,
                'subtotal' => $item->cantidad * $item->precio_unitario,
            ]);

            // Actualizar stock
            $item->producto->decrement('stock', $item->cantidad);
        }

        // Vaciar carrito
        $carritoQuery->delete();

        return redirect()->route('farmacia.pedido.confirmacion', $pedido->id)
            ->with('success', 'Pedido realizado exitosamente.');
    }

    public function confirmacion(Pedido $pedido)
    {
        // Verificar que el pedido pertenece al usuario (si está autenticado)
        if (Auth::check() && $pedido->user_id && $pedido->user_id !== Auth::id()) {
            abort(403);
        }

        $pedido->load('detallePedidos.producto');

        return view('farmacia.confirmacion', compact('pedido'));
    }

    public function misPedidos()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus pedidos.');
        }

        $pedidos = Pedido::where('user_id', Auth::id())
            ->with('detallePedidos')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('farmacia.mis-pedidos', compact('pedidos'));
    }

    public function show(Pedido $pedido)
    {
        // Verificar que el pedido pertenece al usuario
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver los detalles del pedido.');
        }

        if ($pedido->user_id !== Auth::id()) {
            abort(403);
        }

        $pedido->load('detallePedidos.producto');

        return view('farmacia.detalle-pedido', compact('pedido'));
    }
}
