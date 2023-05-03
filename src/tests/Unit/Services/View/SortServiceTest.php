<?php

namespace Tests\Unit\Services\View;

use App\Services\View\SortService;
use Tests\TestCase;

/**
 * @see App\Services\View\SortService.php
 */
class SortServiceTest extends TestCase
{
    /**
     * Test to sort from default to desc
     */
    public function testDefaultToDesc()
    {
        $search = [];

        $sortService = new SortService($search, 'your_review');

        $this->assertSame(['your_review' => 'desc'], $sortService->getSearch());

        $this->assertSame('unfold_more', $sortService->getGoogleFontName());

        $search = ['your_review' => ''];

        $sortService = new SortService($search, 'your_review');

        $this->assertSame(['your_review' => 'desc'], $sortService->getSearch());

        $this->assertSame('unfold_more', $sortService->getGoogleFontName());
    }

    /**
     * Test to sort from desc to asc
     */
    public function testDescToAsc()
    {
        $search = ['your_review' => 'desc'];

        $sortService = new SortService($search, 'your_review');

        $this->assertSame(['your_review' => 'asc'], $sortService->getSearch());

        $this->assertSame('expand_more', $sortService->getGoogleFontName());
    }

    /**
     * Test to sort from asc to default
     */
    public function testAscToDefault()
    {
        $search = ['your_review' => 'asc'];

        $sortService = new SortService($search, 'your_review');

        $this->assertSame(['your_review' => ''], $sortService->getSearch());

        $this->assertSame('expand_less', $sortService->getGoogleFontName());
    }

    /**
     * Test when someone inputs random chars on the parameter
     */
    public function testElse()
    {
        $search = ['your_review' => 'aicjr974l'];

        $sortService = new SortService($search, 'your_review');

        $this->assertSame(['your_review' => ''], $sortService->getSearch());

        $this->assertSame('expand_less', $sortService->getGoogleFontName());
    }
}
