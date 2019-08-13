<?php

namespace App\Utils\WebServices\AdysaGroup;

class SearchResult {

    /**
     * @var string $title
     */
    protected $title = null;

    /**
     * @var string $url
     */
    protected $url = null;

    /**
     * @param string $title
     * @param string $url
     */
    public function __construct($title, $url) {
        $this->title = $title;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     * @return SearchResult
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @param string $url
     * @return SearchResult
     */
    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }

}
