<?php

namespace App\Utils\GenerateTags;

class GenerateTags implements IGenerateTags {

    private $config;

    public function __construct(array $config) {
        $this->config = $config;
    }

    /**
     * @param string $string
     * @return array
     */
    public function generate(string $string): array {
        
        $string = preg_replace('/[^\p{L}0-9 ]/', ' ', $string);
        $string = trim(preg_replace('/\s+/', ' ', $string));
        $words = explode(' ', strtolower($string));

        if ($this->config['allowed']) {
            $allowedWords = $this->config['allowedWords'];
            $words = array_uintersect($words, $allowedWords, 'strcasecmp');
        }

        $keywords = array();

        while (($c_word = array_shift($words)) !== null) {
            if (strlen($c_word) >= $this->config['min_word_length']) {
                $c_word = strtolower($c_word);
                if (array_key_exists($c_word, $keywords)) {
                    $keywords[$c_word][1] ++;
                } else {
                    $keywords[$c_word] = array($c_word, 1);
                }
            }
        }

        usort($keywords, function($first, $sec) {
            return $sec[1] - $first[1];
        });

        $final_keywords = array();
        foreach ($keywords as $keyword_det) {
            if ($keyword_det[1] >= $this->config['min_word_occurrence']) {
                array_push($final_keywords, $keyword_det[0]);
            }
        }
        return array_slice($final_keywords, 0, $this->config['max_words']);
        
    }

}
