<?php

namespace Tests\Unit\Rules;

use App\Rules\ReviewRule;
use PHPUnit\Framework\TestCase;

class ReviewRuleTest extends TestCase
{
    public function testTrueCases()
    {
        $rule = new ReviewRule;

        $cases = ['0', '0.0', '1', '1.0', '1.2', '4.0', '4.9', '5', '5.0'];

        foreach ($cases as $case) {
            $this->assertTrue($rule->passes('test', $case));
        }
    }

    public function testFalseCases()
    {
        $rule = new ReviewRule;

        $cases = ['-0.1', '0.00', '5.6'];

        foreach ($cases as $case) {
            $this->assertFalse($rule->passes('test', $case));
        }
    }
}