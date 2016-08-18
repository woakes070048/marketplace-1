<?php

namespace Raidros\Marketplace\Factory;

use Faker\Factory;

class GtinFactory
{
    /**
     * Generate a list of faker gtins.
     *
     * @param int $max
     *
     * @return array
     */
    public static function generateData($max = 1)
    {
        $faker = Factory::create();
        $gtins = [];

        for ($i = 1; $i <= $max; $i++) {
            $gtins[] = $faker->ean13;
        }

        return $gtins;
    }
}
