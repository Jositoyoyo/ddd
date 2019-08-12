<?php

namespace App\Utils\WebServices\AdysaGroup;

class arrayCustom {

    /**
     * @var mixed[] $array
     */
    protected $array = null;

    /**
     * @param mixed[] $array
     */
    public function __construct(array $array) {
        $this->array = $array;
    }

    /**
     * @return mixed[]
     */
    public function getArray() {
        return $this->array;
    }

    /**
     * @param mixed[] $array
     * @return array
     */
    public function setArray(array $array) {
        $this->array = $array;
        return $this;
    }

}
