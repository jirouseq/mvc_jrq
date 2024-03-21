<?php

namespace library;

class Translations
{
    private $translations = [];

    /**
     * Method loadFile
     * 
     * Uploads a language file
     * 
     * @param string path to file "framework/languages/cs" 
     */

    public function loadFile(string $pathFile): void
    {
        if (file_exists(ROOT . $pathFile . '.json')) {
            $file = file_get_contents($pathFile . '.json');
            $translations = json_decode($file, true);
            if ($translations !== null) {
                $this->translations = array_merge_recursive($this->translations, $translations);
            }
        }
    }

    /**
     * Method translateText
     * 
     * returns translated text
     * 
     * @param string  key
     * @return string value
     */

    public function translateText($text): string
    {
        return $this->translations[$text] ?? '';
    }

    /**
     * Method translateContent
     * 
     * returns translated content
     * 
     * @param string  content section
     * @return string newContent
     */

    public function translateContent($content): string
    {
        $newContent = $content;
        foreach ($this->translations as $tag => $value) {
            if (is_string($value)) {
                $newContent = str_replace('[~' . $tag . '~]', $value, $newContent);
            } else {
                continue;
            }
        }
        return $newContent;
    }

    /**
     * Method getTableDiacritic
     * 
     * returns array for translate chars 
     * 
     * @return array diacritic
     */

    public function getTableDiacritic()
    {
        return array(
            'ä' => 'a',
            'Ä' => 'A',
            'á' => 'a',
            'Á' => 'A',
            'à' => 'a',
            'À' => 'A',
            'ã' => 'a',
            'Ã' => 'A',
            'â' => 'a',
            'Â' => 'A',
            'č' => 'c',
            'Č' => 'C',
            'ć' => 'c',
            'Ć' => 'C',
            'ď' => 'd',
            'Ď' => 'D',
            'ě' => 'e',
            'Ě' => 'E',
            'é' => 'e',
            'É' => 'E',
            'ë' => 'e',
            'Ë' => 'E',
            'è' => 'e',
            'È' => 'E',
            'ê' => 'e',
            'Ê' => 'E',
            'í' => 'i',
            'Í' => 'I',
            'ï' => 'i',
            'Ï' => 'I',
            'ì' => 'i',
            'Ì' => 'I',
            'î' => 'i',
            'Î' => 'I',
            'ľ' => 'l',
            'Ľ' => 'L',
            'ĺ' => 'l',
            'Ĺ' => 'L',
            'ń' => 'n',
            'Ń' => 'N',
            'ň' => 'n',
            'Ň' => 'N',
            'ñ' => 'n',
            'Ñ' => 'N',
            'ó' => 'o',
            'Ó' => 'O',
            'ö' => 'o',
            'Ö' => 'O',
            'ô' => 'o',
            'Ô' => 'O',
            'ò' => 'o',
            'Ò' => 'O',
            'õ' => 'o',
            'Õ' => 'O',
            'ő' => 'o',
            'Ő' => 'O',
            'ř' => 'r',
            'Ř' => 'R',
            'ŕ' => 'r',
            'Ŕ' => 'R',
            'š' => 's',
            'Š' => 'S',
            'ś' => 's',
            'Ś' => 'S',
            'ť' => 't',
            'Ť' => 'T',
            'ú' => 'u',
            'Ú' => 'U',
            'ů' => 'u',
            'Ů' => 'U',
            'ü' => 'u',
            'Ü' => 'U',
            'ù' => 'u',
            'Ù' => 'U',
            'ũ' => 'u',
            'Ũ' => 'U',
            'û' => 'u',
            'Û' => 'U',
            'ý' => 'y',
            'Ý' => 'Y',
            'ž' => 'z',
            'Ž' => 'Z',
            'ź' => 'z',
            'Ź' => 'Z'
        );
    }
}
