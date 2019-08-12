<?php

namespace App\Tests\Utils;

use App\Utils\GenerateTags\GenerateTags;
use PHPUnit\Framework\TestCase;

class GenerateTagsTest extends TestCase {

    private $generateTags;
    private $config = [
        'min_word_length' => 3,
        'min_word_occurrence' => 2,
        'max_words' => 8,
        'allowedWords' => ['PHP', 'MYSQL', 'SYMFONY', 'CAKEPHP'],
        'restrict' => false,
        'allowed' => true
    ];

    public function setUp() {
        parent::setUp();
        $this->generateTags = new GenerateTags($this->config);
    }

    public function testGenerateTags() {
        $result = $this->generateTags->generate('PHP, PHP, PHP, hola soy Symfony. Symfony, Symfony');
        $this->assertEquals([
            'php',
            'symfony'
                ], $result);
    }

}
