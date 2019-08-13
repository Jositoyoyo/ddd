<?php

namespace App\Utils\GenerateTags;

class GenerateTags implements IGenerateTags
{

    private $config;
    private $tags;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function tags(): array
    {
        return $this->tags;
    }

    /**
     * @param string $string
     * @return \App\Utils\GenerateTags\this
     */
    public function generate(string $string): this
    {

        $stringInicial = preg_replace('/[^\p{L}0-9 ]/', ' ', $string);
        $stringFinal = trim(preg_replace('/\s+/', ' ', $stringInicial));
        $words = explode(' ', strtolower($stringFinal));

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
        $this->tags = array_slice($final_keywords, 0, $this->config['max_words']);
        return ($this);
    }

}
