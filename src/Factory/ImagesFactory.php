<?php

namespace Raidros\Marketplace\Factory;

use Faker\Factory;

class ImagesFactory
{
    /**
     * Generate a list of faker images.
     *
     * @param int $max
     *
     * @return array
     */
    public static function generateData($max = 1)
    {
        $faker = Factory::create();
        $images = [];

        for ($i = 1; $i <= $max; $i++) {
            $images[] = $faker->imageUrl($width = 1024, $height = 768);
        }

        return $images;
    }
}
