<?php

namespace Raidros\Marketplace\Factory;

use Faker\Factory;

class AttributesFactory
{
    /**
     * Generate a list of faker product attributes.
     *
     * @param int $max
     *
     * @return array
     */
    public function generateData($max = 1)
    {
        $faker = Factory::create();
        $attributes = [];

        for ($i = 1; $i <= $max; $i++) {
            $attributes[] = [
                'name' => $faker->firstName,
                'value' => $faker->lastName,
            ];
        }

        return $attributes;
    }
}
