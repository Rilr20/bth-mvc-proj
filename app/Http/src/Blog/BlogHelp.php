<?php

declare(strict_types=1);

namespace Rilr\Blog;

/**
 * Class Dice.
 */
class BlogHelp
{
    private const BLOG_TYPES = ['textblog', 'standardblog', 'doubleblog'];
    /**
     * array med olika vyer 
     * om 0 bilder finns skicka vy1  om 1 bild fins skicka vy2 om 2 bilder finns skicka v3 
     * 
     * Om bild nummer två är i fylld medans bild nummer 1 inte är
     * 
     * Bildcheck kolla om det är null eller inte på bildkollumnerna från sql query
     * 
     * Kolla om det är gårdagens datum
     * 
     * En check om datumet på ett inlägg är publiserat eller inte
     * 
     */
    public function blogtype($sqldata) {
         $count = 0;
        if ($sqldata->image_one != null) {
            $count++;
            if($sqldata->image_two != null) {
                $count++;
            }
        }
        return self::BLOG_TYPES[$count];
    }

    public function checkDateInput($date, $time) {
        $date = ($date == null) ? now()->toDateString() : $date;
        $time = ($time == null) ? now()->toTimeString() : $time;

        return $date . " ". $time;
    }
}
