<?php

namespace Rilr\Blog;

use PHPUnit\Framework\TestCase;


/**
 * test cases for class Dice
 */
class BlogHelperTest extends TestCase
{
    public function testCreateBlogHelp()
    {
        $blogHelp = new BlogHelp();
        $this->assertInstanceOf("\Rilr\Blog\BlogHelp", $blogHelp);
    }

    public function testBlogHelpImageCheck()
    {
        $blogHelp = new BlogHelp();
        $images = [[null, null], ["text", null], [null, "text"]];
        $expected = [[null, null], ["text", null], ["text", null]];
        $count = 0;
        foreach ($images as $image) {
            $res = $blogHelp->imageCheck($image[0], $image[1]);
            $this->assertEquals($expected[$count], $res);
            $count++;
        }
    }
    public function testBlogHelpIsPublished()
    {
        $blogHelp = new BlogHelp();
        $dates = ["1970-01-01", "2100-01-01", now()];
        $expected = [true, false, true];
        $count = 0;
        foreach ($dates as $date) {
            $res = $blogHelp->isPublished($date);
            $this->assertEquals($expected[$count], $res);
            $count++;
        }
    }

    public function testBlogType() {
        $blogHelp = new BlogHelp();
        $fakeData = new fakeData();
        $expected = ['textblog', 'standardblog', 'doubleblog'];
        $data = [[null, null],["text", null], ["text", "text"]];
        for ($i=0; $i < 3; $i++) { 
            $fakeData->image_one = $data[$i][0];
            $fakeData->image_two = $data[$i][1];
            $res = $blogHelp->blogtype($fakeData);
            $this->assertEquals($expected[$i], $res);
        }
    }

    public function testBlogCheckDateInput()
    {
        $blogHelp = new BlogHelp();
        $date = "2021-01-01";
        $time = "14:52:06";
        $exp = ["2021-01-01 14:52:06", now()->toDateString() . " " . "14:52:06", now()];

        $res = $blogHelp->checkDateInput($date, $time);
        $this->assertEquals($exp[0], $res);

        $date = null;
        $res = $blogHelp->checkDateInput($date, $time);
        $this->assertEquals($exp[1], $res);

        $time = null;
        $res = $blogHelp->checkDateInput($date, $time);
        $this->assertEquals($exp[2], $res);
    }

    public function testBlogInvalidDate()
    {
        $blogHelp = new BlogHelp();
        $date = ":)";
        $time = ":(";

        $res = $blogHelp->checkDateInput($date, $time);
        $this->assertEquals(now(), $res);
        $date = "arg-12-14";
        $time = "arg:53:06";
        $res = $blogHelp->checkDateInput($date, $time);
        $this->assertEquals(now(), $res);
    }
}

class fakeData {
    public $image_one = null;
    public $image_two = null;
}