<?php

namespace Streak;

class Paginator
{
    protected $page;
    protected $limit;
    protected $results = [];
    protected $hasMore = true;

    /**
     * @param int $pageStart
     * @param int $limit
     */
    public function __construct($pageStart = 0, $limit = 500)
    {
        $this->page = $pageStart;
        $this->limit = $limit;
    }

    /**
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param array $results
     */
    public function addResults(array $results)
    {
        if (0 === count($results)) {
            $this->hasMore = false;
        }

        $this->results = array_merge($this->results, $results);
    }

    /**
     * @return bool
     */
    public function hasMore()
    {
        return $this->hasMore;
    }

    public function nextPage()
    {
        if ($this->hasMore()) {
            $this->page++;

            return true;
        }

        return false;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }
}
