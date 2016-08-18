<?php

namespace Raidros\Marketplace\Factory;

use Faker\Factory;

class ProductFactory
{
    public static function generateData()
    {
        $faker = Factory::create();

        return [
            'skuId' => $faker->randomNumber(6),
            'skuSellerId' => $faker->userName.$faker->randomNumber(6),
            'title' => $faker->catchPhrase,
            'description' => $faker->text,
            'brand' => $faker->firstName,
            'gtin' => GtinFactory::generateData($faker->numberBetween(1, 5)),
            'categories' => CategoriesFactory::generateData($faker->numberBetween(1, 5)),
            'images' => ImagesFactory::generateData($faker->numberBetween(1, 5)),
            'price' => $faker->randomFloat(2, 500, 999.99),
            'offer' => $faker->randomFloat(2, 100, 499.99),
            'stock' => $faker->randomNumber(1),
            'crossDockingTime' => $faker->randomNumber(1),
            'weight' => $faker->randomFloat(2, 0.1, 9.99),
            'length' => $faker->randomFloat(2, 0.1, 9.99),
            'width' => $faker->randomFloat(2, 0.1, 9.99),
            'height' => $faker->randomFloat(2, 0.1, 9.99),
            'attributes' => AttributesFactory::generateData($faker->numberBetween(10, 20)),
        ];
    }
}
