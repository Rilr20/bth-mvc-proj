<?php

namespace Rilr\Dice;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DiceTest extends TestCase
{

    public function testCreateDice()
    {
        $sides = 6;
        $dice = new Dice($sides);

        $this->assertEquals($sides, $dice->sides);
    }

    public function testDiceRoll()
    {
        $dice = new Dice(4);

        $this->assertEquals(0, $dice->getLastRoll());
        $dice->throw();
        $this->assertNotEquals(0, $dice->getLastRoll());
    }
}
