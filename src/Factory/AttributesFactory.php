<?php

namespace Raidros\Marketplace\Factory;

use Faker\Factory;

class AttributesFactory
{
    public function generateData($max = 1)
    {
        $faker = Factory::create();
        $attributes = [];

        for ($i = 1; $i <= $max; $i++) {

            $attributes[] = [
                "name" => $faker->firstName,
                "value" => $faker->lastName,
            ];
        }

        return $attributes;
    }
}
