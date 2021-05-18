<?php

declare(strict_types=1);

namespace Rilr\Blog;

/**
 * Class BlogHelp.
 */
class BlogHelp
{
    private const BLOG_TYPES = ['textblog', 'standardblog', 'doubleblog'];
    
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

    public function imageCheck($image1, $image2)
    {
        if ($image2 != null && $image1 == null) {
            return [$image2, $image1];
        }
        return [$image1, $image2];
    }

    public function isPublished($blogDate) 
    {
        if ($blogDate <= now()) {
            return true;
        }
        return false;
    }

    public function checkDateInput($date, $time)
    {
        $date = $this->checkdate($date);
        $time = $this->checkTime($time);
        // $date = ($date == null) ? now()->toDateString() : $date;
        // $time = ($time == null) ? now()->toTimeString() : $time;

        return $date . " ". $time;
    }

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
