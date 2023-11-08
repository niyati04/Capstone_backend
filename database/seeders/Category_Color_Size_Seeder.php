<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Category_Color_Size_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ['tshirt', 'jeans'];
        foreach ($category as $key => $value) {
            Category::updateOrCreate(
                ['name' => $value],
                ['name' => $value]
            );
        }

        $color = [
            [
                'color' => '#000000',
                'color_name' => 'back'
            ],
            [
                'color' => '#FCF5ED',
                'color_name' => 'white'

            ],
            [
                'color' => '#CE5A67',
                'color_name' => 'pink'
            ]
        ];

        foreach ($color as $key => $value) {
            Color::updateOrCreate(
                [
                    'color' => $value['color']
                ],
                [
                    'color' => $value['color'],
                    'color_name' => $value['color_name']
                ]
            );
        }

        $size = ['30', '32', '34', '36', '38'];
        foreach ($size as $key => $value) {
            Size::updateOrCreate(
                ['size' => $value],
                ['size' => $value]
            );
        }
    }
}
