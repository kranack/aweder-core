<?php

namespace Tests\Unit\Rules;

use App\Rules\MaxWordsRule;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class MaxWordsRuleTest
 * @package Tests\Unit\Rules
 * @group Rules
 * @coversDefaultClass \App\Rules\MaxWordsRule
 */
class MaxWordsRuleTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function below_min_words_passes_validation(): void
    {
        $words = $this->faker->words(199, true);

        $rule = new MaxWordsRule(200);
        $this->assertTrue($rule->passes('test', $words));
    }
    /**
     * @test
     */
    public function above_max_words_returns_false(): void
    {
        $words = $this->faker->words(300, true);
        $rule = new MaxWordsRule(200);
        $this->assertFalse($rule->passes('test', $words));
    }
}
