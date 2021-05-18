<?php

declare(strict_types=1);

namespace Rilr\Blog;

/**
 * Class BlogHelp.
 */
class BlogHelp
{
    private const BLOG_TYPES = ['textblog', 'standardblog', 'doubleblog'];
    
    /**
     * @param object $sqldata object of sql data
     * @return string string based on how many images are in $sqldata
     */
    public function blogtype($sqldata)
    {
         $count = 0;
        if ($sqldata->image_one != null) {
            $count++;
            if($sqldata->image_two != null) {
                $count++;
            }
        }
        return self::BLOG_TYPES[$count];
    }

    /**
     * $image1 and $image2 around if $image1 is empty and $iamge2 isn't
     * @param string $image1 string or null that of image name
     * @param string $image2 string or null that of image name
     * @return array that with $image1 and $image2
     */
    public function imageCheck($image1, $image2)
    {
        if ($image2 != null && $image1 == null) {
            return [$image2, $image1];
        }
        return [$image1, $image2];
    }
    /**
     * checks if the current blog is published or not
     * @param dateTime dateFime object 
     * @return boolean true if date is less than now false if not
     */
    public function isPublished($blogDate) 
    {
        if ($blogDate <= now()) {
            return true;
        }
        return false;
    }
    /**
     *  @param string $date date string 
     *  @param string $time time string
     *  @return string string that combines date and time values after being validated
     */
    public function checkDateInput($date, $time)
    {
        $date = $this->checkdate($date);
        $time = $this->checkTime($time);
        // $date = ($date == null) ? now()->toDateString() : $date;
        // $time = ($time == null) ? now()->toTimeString() : $time;

        return $date . " ". $time;
    }
    /**
     * @param string $date string of current or past date
     * @return string checks if date is valid
     */
    private function checkDate($date)
    {
        try {
            $explodedDate = explode("-", $date);
            //code...
        } catch (\Throwable $th) {
            $date = now()->toDateString();
            $explodedDate = [];
        }
        if (count($explodedDate) == 3) {
            foreach ($explodedDate as $input) {
                if (!is_numeric($input)) {
                    $date = now()->toDateString();
                    break;
                }
            }
        } else {
            $date = now()->toDateString();
        }
        return $date;
    }
    /**
     *  @param string $time string of current or past time
     *  @return string checks if time is valid
     */
    private function checkTime($time)
    {
        try {
            $explodeTime = explode(":", $time);
        } catch(\Throwable $th) {
            $time = now()->toTimeString();
            $explodeTime = []; 
        }
        if (count($explodeTime) == 3) {
            foreach ($explodeTime as $input) {
                if(!is_numeric($input)) {
                    $time = now()->toTimeString();
                    break;
                }
            }
        } else {
            $time = now()->toTimeString();
        }
        return $time;
    }
}
