<?php

namespace App\Services\View;

/**
 * A service to get the view elements when it is sorted
 */
class SortService
{
    /**
     * @var array Searched contents
     */
    private array $search;

    /**
     * @var string google font's name
     */
    private string $google_font_name;

    /**
     * Constructor
     *
     * @param array $search Searched contents
     * @param string $key a key of the search array
     */
    public function __construct(array $search, string $key)
    {
        if (empty($search[$key])) {
            $search[$key] = 'desc';
            $this->search = $search;
            $this->google_font_name = 'unfold_more';
            return;
        }

        if ($search[$key] === 'desc') {
            $search[$key] = 'asc';
            $this->search = $search;
            $this->google_font_name = 'expand_more';
            return;
        }

        $search[$key] = '';
        $this->search = $search;
        $this->google_font_name = 'expand_less';
    }

    /**
     * Get the searched contents
     *
     * @return array
     */
    public function getSearch(): array
    {
        return $this->search;
    }

    /**
     * Get the google font's name
     *
     * @return string
     */
    public function getGoogleFontName(): string
    {
        return $this->google_font_name;
    }
}
