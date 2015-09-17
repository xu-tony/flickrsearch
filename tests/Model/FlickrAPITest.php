<?php
namespace FlickrSearch\Tests\Model;

use FlickrSearch\Model;
use FlickrSearch\Wrapper;

class CurlTest extends \PHPUnit_Framework_TestCase
{
    private function get_test_data_json()
    {
        return '{"photos":{"page":1,"pages":2273,"perpage":5,"total":"5","photo":[
        {"id":"21429256362","owner":"27889738@N07","secret":"711f03378e","server":"5647","farm":6,"title":"Panel for Patriot PAC-3 Guided Missile Round Trainer at JASDF Yokota Festival 2014","ispublic":1,"isfriend":0,"isfamily":0},
        {"id":"21194609688","owner":"27889738@N07","secret":"2afdd89062","server":"657","farm":1,"title":"JASDF Yokota Festival in Yokota Friendship Festival 2014","ispublic":1,"isfriend":0,"isfamily":0},
        {"id":"20844454434","owner":"27889738@N07","secret":"ff41cef669","server":"741","farm":1,"title":"Fighter Aircfrafts in Yokota Friendship Festival 2014","ispublic":1,"isfriend":0,"isfamily":0},
        {"id":"21225757978","owner":"27889738@N07","secret":"55f66e3d98","server":"5685","farm":6,"title":"Patriot PAC-3 Guided Missile Round Trainer Displayed at JASDF Yokota Festival 2014","ispublic":1,"isfriend":0,"isfamily":0},
        {"id":"21071084118","owner":"50484221@N07","secret":"f67c269f27","server":"5833","farm":6,"title":"Novembers Doom (Acoustic set), 05\/09\/2015","ispublic":1,"isfriend":0,"isfamily":0}]},"stat":"ok"}';
    }

    public function test_mock_search_image()
    {
        $text = "BMW";
        $numPerPage = 5;
        $pageSeq = 1;

        $flickrapi = $this->getMockBuilder('FlickrSearch\Model\FlickrAPI')
            ->setMethods(array('send_request'))
            ->getMock();

        $flickrapi->expects($this->once())
            ->method('send_request')
            ->willReturn($this->get_test_data_json());

        $images = $flickrapi->search_image($text, $numPerPage, $pageSeq);

        $test_json = json_decode($this->get_test_data_json(), true);
        $expected_images = array();
        $expected_total_images_number = $test_json['photos']['total'];
        foreach ($test_json['photos']['photo'] as $photo) {
            $expected_images[] = Wrapper\Flickrimage::from_array($photo);
        }

        $expected_images = array(
            new Wrapper\Flickrimage("21429256362", "27889738@N07", "711f03378e", "5647", 6, "Panel for Patriot PAC-3 Guided Missile Round Trainer at JASDF Yokota Festival 2014", 1, 0, 0),
            new Wrapper\Flickrimage("21194609688", "27889738@N07", "2afdd89062", "657", 1, "JASDF Yokota Festival in Yokota Friendship Festival 2014", 1, 0, 0),
            new Wrapper\Flickrimage("20844454434", "27889738@N07", "ff41cef669", "741", 1, "Fighter Aircfrafts in Yokota Friendship Festival 2014", 1, 0, 0),
            new Wrapper\Flickrimage("21225757978", "27889738@N07", "55f66e3d98", "5685", 6, "Patriot PAC-3 Guided Missile Round Trainer Displayed at JASDF Yokota Festival 2014", 1, 0, 0),
            new Wrapper\Flickrimage("21071084118", "50484221@N07", "f67c269f27", "5833", 6, "Novembers Doom (Acoustic set), 05/09/2015", 1, 0, 0)
        );

        $this->assertEquals($expected_images, $images);
        $this->assertEquals($expected_total_images_number, count($images));
    }

}