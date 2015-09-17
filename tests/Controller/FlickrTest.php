<?php
namespace FlickrSearch\Tests\Controller;

use FlickrSearch\Controller;
use FlickrSearch\Wrapper;

class FlickrTest extends \PHPUnit_Framework_TestCase
{
    private function get_test_data()
    {
        return array(
            new Wrapper\Flickrimage("21429256362", "27889738@N07", "711f03378e", "5647", 6, "Panel for Patriot PAC-3 Guided Missile Round Trainer at JASDF Yokota Festival 2014", 1, 0, 0),
            new Wrapper\Flickrimage("21194609688", "27889738@N07", "2afdd89062", "657", 1, "JASDF Yokota Festival in Yokota Friendship Festival 2014", 1, 0, 0),
            new Wrapper\Flickrimage("20844454434", "27889738@N07", "ff41cef669", "741", 1, "Fighter Aircfrafts in Yokota Friendship Festival 2014", 1, 0, 0),
            new Wrapper\Flickrimage("21225757978", "27889738@N07", "55f66e3d98", "5685", 6, "Patriot PAC-3 Guided Missile Round Trainer Displayed at JASDF Yokota Festival 2014", 1, 0, 0),
            new Wrapper\Flickrimage("21071084118", "50484221@N07", "f67c269f27", "5833", 6, "Novembers Doom (Acoustic set), 05/09/2015", 1, 0, 0)
        );
    }

    public function test_app()
    {
        $request = $this->getMockBuilder('FlickrSearch\Http\Request')
            ->disableOriginalConstructor()
            ->getMock();

        $flickr = $this->getMock('FlickrSearch\Controller\Flickr', array('search_image'), array($request));
        $flickr->expects($this->any())
            ->method('search_image')
            ->willReturn($this->get_test_data());

        $body = $flickr->action_search();
    }
}