<?php

namespace Raidros\Marketplace\Factory;

use Faker\Factory;

class CategoriesFactory
{
    /**
     * Generate a list of faker product categories.
     *
     * @param integer $max]
     *
     * @return array
     */
    public function generateData($max = 1)
    {
        $faker = Factory::create();
        $categories = [];

        for ($i = 1; $i <= $max; $i++) {
            $categories[] = [
                $faker->randomNumber(1) => $faker->firstName,
                $faker->randomNumber(2) => $faker->firstName,
                $faker->randomNumber(3) => $faker->firstName,
                $faker->randomNumber(4) => $faker->firstName,
            ];
        }

        return $categories;
    }
}
