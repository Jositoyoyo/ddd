<?php

namespace App\Utils\WebServices\AdysaGroup;

class SearchResult_array {

    /**
     * @var SearchResult[] $SearchResult_array
     */
    protected $SearchResult_array = null;

    /**
     * @param SearchResult[] $SearchResult_array
     */
    public function __construct(array $SearchResult_array) {
        $this->SearchResult_array = $SearchResult_array;
    }

    /**
     * @return SearchResult[]
     */
    public function getSearchResult_array() {
        return $this->SearchResult_array;
    }

    /**
     * @param SearchResult[] $SearchResult_array
     * @return SearchResult_array
     */
    public function setSearchResult_array(array $SearchResult_array) {
        $this->SearchResult_array = $SearchResult_array;
        return $this;
    }

}
