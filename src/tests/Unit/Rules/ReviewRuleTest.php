<?php

namespace Tests\Unit\Rules;

use App\Rules\ReviewRule;
use Tests\TestCase;

/**
 * @see App\Rules\ReviewRule.php
 */
class ReviewRuleTest extends TestCase
{
    /**
     * Test true cases
     */
    public function testTrueCases()
    {
        $rule = new ReviewRule;

        $cases = ['0', '0.0', '1', '1.0', '1.2', '4.0', '4.9', '5', '5.0'];

        foreach ($cases as $case) {
            $this->assertTrue($rule->passes('test', $case));
        }
    }

    /**
     * Test false cases
     */
    public function testFalseCases()
    {
        $rule = new ReviewRule;

        $cases = ['-0.1', '0.00', '5.6'];

        foreach ($cases as $case) {
            $this->assertFalse($rule->passes('test', $case));
        }
    }
}
