<?php

namespace App\Utils;

use Illuminate\Support\Str;
use JsonMachine\Items as Json;
use JsonMachine\JsonDecoder\ExtJsonDecoder;

class JsonConvertor
{
    /**
     * @param string $path Json file path
     * @param string $pointer
     * @return string Output file path
     */
    public static function csv(string $path, string $pointer)
    {
        $output = Str::replaceLast('.json', '.csv', $path);

        file_put_contents($output, null);

        $csv = fopen($output, 'w');

        $items = Json::fromFile($path, [
            'pointer' => $pointer,
            'decoder' => new ExtJsonDecoder(true)
        ]);

        foreach ($items as $item) {
            fputcsv($csv, $item);
        }

        fclose($csv);

        return $output;
    }
}
