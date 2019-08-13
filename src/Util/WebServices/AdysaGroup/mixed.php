<?php

namespace App\Utils\WebServices\AdysaGroup;

class mixed {

    /**
     * @var string $varString
     */
    protected $varString = null;

    /**
     * @var int $varInt
     */
    protected $varInt = null;

    /**
     * @var float $varFloat
     */
    protected $varFloat = null;

    /**
     * @var arrayCustom $varArray
     */
    protected $varArray = null;

    /**
     * @param string $varString
     * @param int $varInt
     * @param float $varFloat
     * @param arrayCustom $varArray
     */
    public function __construct($varString, $varInt, $varFloat, $varArray) {
        $this->varString = $varString;
        $this->varInt = $varInt;
        $this->varFloat = $varFloat;
        $this->varArray = $varArray;
    }

    /**
     * @return string
     */
    public function getVarString() {
        return $this->varString;
    }

    /**
     * @param string $varString
     * @return mixed
     */
    public function setVarString($varString) {
        $this->varString = $varString;
        return $this;
    }

    /**
     * @return int
     */
    public function getVarInt() {
        return $this->varInt;
    }

    /**
     * @param int $varInt
     * @return mixed
     */
    public function setVarInt($varInt) {
        $this->varInt = $varInt;
        return $this;
    }

    /**
     * @return float
     */
    public function getVarFloat() {
        return $this->varFloat;
    }

    /**
     * @param float $varFloat
     * @return mixed
     */
    public function setVarFloat($varFloat) {
        $this->varFloat = $varFloat;
        return $this;
    }

    /**
     * @return arrayCustom
     */
    public function getVarArray() {
        return $this->varArray;
    }

    /**
     * @param arrayCustom $varArray
     * @return mixed
     */
    public function setVarArray($varArray) {
        $this->varArray = $varArray;
        return $this;
    }

}
