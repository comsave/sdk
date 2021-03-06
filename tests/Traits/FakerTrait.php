<?php

namespace Comsave\Tests\Traits;

use Faker\Factory;
use Faker\Generator;

trait FakerTrait
{
    /** @var Generator */
    protected $faker;

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function getFaker(): Generator
    {
        if (!$this->faker) {
            $this->faker = Factory::create();
        }

        return $this->faker;
    }
}
