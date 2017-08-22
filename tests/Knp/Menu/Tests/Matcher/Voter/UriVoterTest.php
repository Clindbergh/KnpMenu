<?php

namespace Knp\Menu\Tests\Matcher\Voter;

use Knp\Menu\Matcher\Voter\UriVoter;

class UriVoterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string  $uri
     * @param string  $itemUri
     * @param boolean $expected
     *
     * @dataProvider provideData
     */
    public function testMatching($uri, $itemUri, $expected)
    {
        $item = $this->getMockBuilder('Knp\Menu\ItemInterface')->getMock();
        $item->expects($this->any())
            ->method('getUri')
            ->will($this->returnValue($itemUri));

        $voter = new UriVoter($uri);

        $this->assertSame($expected, $voter->matchItem($item));
    }

    public function provideData()
    {
        return array(
            'no uri' => array(null, 'foo', null),
            'no item uri' => array('foo', null, null),
            'same uri' => array('foo', 'foo', true),
            'different uri' => array('foo', 'bar', null),
        );
    }
}
