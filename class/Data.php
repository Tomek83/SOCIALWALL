<?php
namespace classes;

class Data
{
    /**
     * @param string $file
     * @param array $data
     */
    public static function store($file, array $data)
    {
        $fp = fopen($file, 'w+');

        if (flock($fp, LOCK_EX)) {
            fwrite($fp, serialize($data));
            fflush($fp);
            flock($fp, LOCK_UN);
        }

        fclose($fp);
    }

    /**
     * @param string $file
     * @return string
     */
    public static function restore($file)
    {
        return trim(@file_get_contents($file));
    }

    /**
     * @param string $text
     * @param integer|null $maxLen
     * @return string
     */
    public static function trim($text, $maxLen = 200)
    {
        $decoded = html_entity_decode($text, ENT_COMPAT, 'UTF-8');
        if (mb_strlen($decoded) <= $maxLen) return $text;
        $result = mb_substr($decoded, 0, $maxLen - 3);
        $result .= '...';
        return htmlentities($result, ENT_COMPAT, 'UTF-8');
    }
}