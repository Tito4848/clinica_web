<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FarmaciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear categorías
        $categorias = [
            [
                'nombre' => 'Analgésicos',
                'descripcion' => 'Medicamentos para el alivio del dolor',
            ],
            [
                'nombre' => 'Antibióticos',
                'descripcion' => 'Medicamentos para tratar infecciones bacterianas',
            ],
            [
                'nombre' => 'Vitaminas y Suplementos',
                'descripcion' => 'Suplementos nutricionales y vitamínicos',
            ],
            [
                'nombre' => 'Cuidado Personal',
                'descripcion' => 'Productos para el cuidado e higiene personal',
            ],
            [
                'nombre' => 'Medicamentos Crónicos',
                'descripcion' => 'Medicamentos para enfermedades crónicas',
            ],
        ];

        foreach ($categorias as $cat) {
            Categoria::create([
                'nombre' => $cat['nombre'],
                'slug' => Str::slug($cat['nombre']),
                'descripcion' => $cat['descripcion'],
                'activo' => true,
            ]);
        }

        // Crear productos
        $productos = [
            [
                'categoria' => 'Analgésicos',
                'nombre' => 'Paracetamol 500mg',
                'descripcion' => 'Analgésico y antipirético para el alivio del dolor y la fiebre',
                'precio' => 8.50,
                'stock' => 50,
                'laboratorio' => 'Bayer',
                'indicaciones' => 'Dolor de cabeza, fiebre, dolores musculares',
                'requiere_receta' => false,
            ],
            [
                'categoria' => 'Analgésicos',
                'nombre' => 'Ibuprofeno 400mg',
                'descripcion' => 'Antiinflamatorio no esteroideo para dolor e inflamación',
                'precio' => 12.00,
                'stock' => 30,
                'laboratorio' => 'Pfizer',
                'indicaciones' => 'Dolor, inflamación, fiebre',
                'requiere_receta' => false,
            ],
            [
                'categoria' => 'Antibióticos',
                'nombre' => 'Amoxicilina 500mg',
                'descripcion' => 'Antibiótico de amplio espectro',
                'precio' => 25.00,
                'stock' => 20,
                'laboratorio' => 'GlaxoSmithKline',
                'indicaciones' => 'Infecciones bacterianas',
                'requiere_receta' => true,
            ],
            [
                'categoria' => 'Vitaminas y Suplementos',
                'nombre' => 'Vitamina C 1000mg',
                'descripcion' => 'Suplemento de vitamina C para fortalecer el sistema inmunológico',
                'precio' => 15.50,
                'stock' => 100,
                'laboratorio' => 'Nature\'s Bounty',
                'indicaciones' => 'Refuerzo del sistema inmunológico',
                'requiere_receta' => false,
            ],
            [
                'categoria' => 'Vitaminas y Suplementos',
                'nombre' => 'Multivitamínico Completo',
                'descripcion' => 'Complejo vitamínico con minerales esenciales',
                'precio' => 35.00,
                'stock' => 40,
                'laboratorio' => 'Centrum',
                'indicaciones' => 'Suplemento nutricional diario',
                'requiere_receta' => false,
            ],
            [
                'categoria' => 'Cuidado Personal',
                'nombre' => 'Alcohol Antiséptico 70%',
                'descripcion' => 'Alcohol para desinfección y limpieza',
                'precio' => 6.00,
                'stock' => 80,
                'laboratorio' => 'Genérico',
                'indicaciones' => 'Desinfección de heridas y superficies',
                'requiere_receta' => false,
            ],
            [
                'categoria' => 'Cuidado Personal',
                'nombre' => 'Jabón Antibacterial',
                'descripcion' => 'Jabón líquido con propiedades antibacterianas',
                'precio' => 9.50,
                'stock' => 60,
                'laboratorio' => 'Dettol',
                'indicaciones' => 'Higiene personal diaria',
                'requiere_receta' => false,
            ],
            [
                'categoria' => 'Medicamentos Crónicos',
                'nombre' => 'Metformina 500mg',
                'descripcion' => 'Medicamento para el control de la diabetes tipo 2',
                'precio' => 18.00,
                'stock' => 25,
                'laboratorio' => 'Merck',
                'indicaciones' => 'Tratamiento de diabetes tipo 2',
                'requiere_receta' => true,
            ],
        ];

        foreach ($productos as $prod) {
            $categoria = Categoria::where('nombre', $prod['categoria'])->first();
            
            Producto::create([
                'categoria_id' => $categoria->id,
                'nombre' => $prod['nombre'],
                'slug' => Str::slug($prod['nombre']),
                'descripcion' => $prod['descripcion'],
                'precio' => $prod['precio'],
                'stock' => $prod['stock'],
                'laboratorio' => $prod['laboratorio'],
                'indicaciones' => $prod['indicaciones'],
                'requiere_receta' => $prod['requiere_receta'],
                'activo' => true,
            ]);
        }
    }
}
