<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function enviar(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'email'    => 'required|email',
            'fecha'    => 'required|date',
            'consulta' => 'required|string|max:1000',
        ]);

        // Aquí puedes guardar en la base de datos o enviar email (opcional)

        return redirect()->back()->with('success', '¡Tu mensaje fue enviado correctamente!');
    }
}
