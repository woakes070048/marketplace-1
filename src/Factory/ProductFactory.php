<?php

namespace Raidros\Marketplace\Factory;

use Faker\Factory;

class ProductFactory
{
    public function generateData()
    {
        $attrs = new AttributesFactory();
        $categ = new CategoriesFactory();
        $faker = Factory::create();
        $price = $faker->randomFloat(2, 2, 999.99);

        return [
            'skuId' => $faker->randomNumber(6),
            'skuSellerId' => $faker->userName.$faker->randomNumber(6),
            'title' => $faker->catchPhrase,
            'description' => $faker->text,
            'brand' => $faker->firstName,
            'gtin' => [
                $faker->ean13,
            ],
            'categories' => $categ->generateData($faker->randomNumber(1)),
            'images' => [
                $faker->imageUrl($width = 1024, $height = 768),
            ],
            'videos' => [],
            'price' => $price,
            'offer' => $faker->randomFloat(2, 1, ($price - 1)),
            'stock' => $faker->randomNumber(1),
            'crossDockingTime' => $faker->randomNumber(1),
            "weight" => $faker->randomFloat(2, 0.1, 9.99),
            "length" => $faker->randomFloat(2, 0.1, 9.99),
            "width"  => $faker->randomFloat(2, 0.1, 9.99),
            "height" => $faker->randomFloat(2, 0.1, 9.99),
            'attributes' => $attrs->generateData($faker->randomNumber(1)),
        ];
    }
}
