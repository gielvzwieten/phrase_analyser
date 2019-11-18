<?php

namespace Tests\Feature;

use App\Helpers\Helper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhraseAnalyserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_traverse_the_graph()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $phrase = 'footballvssoccer';
        $symbol = 'f';
        $count = 1;
        $uniqueCharsInPhrase = (trim(count_chars($phrase, 3)));

        $uniqueCharsPushedToArray = [];

        for($i = 0; $i < strlen($phrase); $i++)
        {
            for($j = 0; $j < strlen($uniqueCharsInPhrase); $j++) {
                if($phrase[$i] == $uniqueCharsInPhrase[$j] && !in_array($phrase[$i], $uniqueCharsPushedToArray)){
                    array_push($uniqueCharsPushedToArray, $phrase[$i]);
                }
            }
        }

        $this->assertEquals('f', $uniqueCharsPushedToArray[0]);

        $this->assertEquals('1', substr_count($phrase, $uniqueCharsPushedToArray[0]));

        $this->assertEquals(['f', 'o', 't', 'b', 'a', 'l', 'v', 's', 'c', 'e', 'r'], $uniqueCharsPushedToArray);

        $this->assertEquals('o', Helper::characterInfoBefore($phrase, $symbol, $count));

        $this->assertEquals('none', Helper::characterInfoAfter($phrase, $symbol, $count));

        $this->assertEquals('10', strrpos($phrase, $uniqueCharsPushedToArray[1]) - strpos($phrase, $uniqueCharsPushedToArray[1]));

    }

}
