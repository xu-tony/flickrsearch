<?php
namespace FlickrSearch\Tests\Wrapper;

use FlickrSearch\Wrapper;

class FlickrimageTest extends \PHPUnit_Framework_TestCase
{
    /** @var Wrapper\Flickrimage $flickrimage */
    protected $flickrimage;

    public function setUp()
    {

        $id = '21429256362';
        $owner = '27889738';
        $secret = '711f03378e';
        $server = '5647';
        $farm = 6;
        $title = 'Panel for Patriot PAC-3 Guided Missile Round Trainer at JASDF Yokota Festival 2014';
        $ispublic = 1;
        $isfriend = 0;
        $isfamily = 0;

        $this->flickrimage = new Wrapper\Flickrimage($id, $owner, $secret, $server, $farm, $title, $ispublic, $isfriend, $isfamily);
    }


    public function test_get_id()
    {
        $this->assertEquals('21429256362', $this->flickrimage->get_id());
    }

    public function test_get_owner()
    {
        $this->assertEquals("27889738", $this->flickrimage->get_owner());
    }

    public function test_get_secret()
    {
        $this->assertEquals('711f03378e', $this->flickrimage->get_secret());
    }

    public function test_get_server()
    {
        $this->assertEquals('5647', $this->flickrimage->get_server());
    }

    public function test_get_farm()
    {
        $this->assertEquals(6, $this->flickrimage->get_farm());
    }

    public function test_get_title()
    {
        $this->assertEquals('Panel for Patriot PAC-3 Guided Missile Round Trainer at JASDF Yokota Festival 2014', $this->flickrimage->get_title());
    }

    public function test_get_ispublic()
    {
        $this->assertEquals(1, $this->flickrimage->get_ispublic());
    }

    public function test_get_isfrien()
    {
        $this->assertEquals(0, $this->flickrimage->get_isfriend());
    }

    public function test_get_isfamily()
    {
        $this->assertEquals(0, $this->flickrimage->get_isfamily());
    }

    public function test_from_array()
    {
        $raw_array = array();
        $raw_array['id'] = '21429256362';
        $raw_array['owner'] = '27889738';
        $raw_array['secret'] = '711f03378e';
        $raw_array['server'] = '5647';
        $raw_array['farm'] = 6;
        $raw_array['title'] = 'Panel for Patriot PAC-3 Guided Missile Round Trainer at JASDF Yokota Festival 2014';
        $raw_array['ispublic'] = 1;
        $raw_array['isfriend'] = 0;
        $raw_array['isfamily'] = 0;

        $flickrimage = Wrapper\Flickrimage::from_array($raw_array);
        $this->assertEquals($this->flickrimage, $flickrimage);
    }

}