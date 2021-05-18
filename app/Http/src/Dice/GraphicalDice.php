<?php

declare(strict_types=1);

namespace Rilr\Dice;

use Rilr\Dice\Dice;

class GraphicalDice extends Dice
{
    /**
     * @var int $diceResult which is used to return html string
     * @return string html string where the span element is added depending on $diceresult value
     */
    public function renderDice($diceResult): string
    {
        $span = "<span class='dot'></span>";
        $htmlDice = "<div class='face'>";
        $end = '</div>';
        for ($i = 0; $i < $diceResult; $i++) {
            $htmlDice = $htmlDice . $span;
        }
        $htmlDice = $htmlDice . $end;
        return $htmlDice;
    }
}
