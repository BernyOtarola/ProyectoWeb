<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Item;
use App\Models\User;

class DefaultCategoriesAndItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Asegúrate de que existe un usuario para asignar las categorías e ítems
        $user = User::first(); // Esto asigna las categorías e ítems al primer usuario en la base de datos
        
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Default User',
                'email' => 'default@example.com',
                'password' => bcrypt('password'), // Cambia esto según tu necesidad
            ]);
        }

        // Crear categorías por defecto
        $categories = [
            ['nombre' => 'Electrónica', 'user_id' => $user->id],
            ['nombre' => 'Muebles', 'user_id' => $user->id],
            ['nombre' => 'Ropa', 'user_id' => $user->id],
        ];

        foreach ($categories as $categoryData) {
            $category = Categoria::create($categoryData);

            // Crear ítems por defecto para cada categoría
            $items = [
                ['nombre' => 'Televisor', 'categoria_id' => $category->id, 'user_id' => $user->id],
                ['nombre' => 'Sofá', 'categoria_id' => $category->id, 'user_id' => $user->id],
                ['nombre' => 'Camisa', 'categoria_id' => $category->id, 'user_id' => $user->id],
            ];

            foreach ($items as $itemData) {
                Item::create($itemData);
            }
        }
    }
}
