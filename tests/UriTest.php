<?php

namespace BinSoul\Test\Bridge\Http\Message;

use BinSoul\Bridge\Http\Message\Uri;
use BinSoul\Net\URI as NetURI;

class UriTest extends \PHPUnit_Framework_TestCase
{
    const DEFAULT_URI = 'http://username:password@www.example.com:8080/foo/bar/?empty&simple=simple&array[]=0&&array[]=1#fragment';

    /** @var Uri */
    private $defaultUri;
    /** @var NetUri */
    private $defaultNetUri;

    public function setUp()
    {
        $this->defaultNetUri = new NetURI(
            'http',
            'www.example.com',
            '/foo/bar/',
            'empty&simple=simple&array[]=0&&array[]=1',
            '#fragment',
            'username',
            'password',
            '8080'
        );

        $this->defaultUri = new Uri($this->defaultNetUri);
    }

    public function test_returns_all_properties()
    {
        $uri = new Uri(NetURI::parse(self::DEFAULT_URI));
        $this->assertEquals($this->defaultNetUri->getScheme(), $uri->getScheme());
        $this->assertEquals($this->defaultNetUri->getUserInfo(), $uri->getUserInfo());
        $this->assertEquals($this->defaultNetUri->getHost(), $uri->getHost());
        $this->assertEquals($this->defaultNetUri->getPort(), $uri->getPort());
        $this->assertEquals($this->defaultNetUri->getAuthority(), $uri->getAuthority());
        $this->assertEquals($this->defaultNetUri->getPath(), $uri->getPath());
        $this->assertEquals($this->defaultNetUri->getQuery(), $uri->getQuery());
        $this->assertEquals($this->defaultNetUri->getFragment(), $uri->getFragment());
    }

    public function test_withScheme_returns_instance_with_new_scheme()
    {
        $new = $this->defaultUri->withScheme('https');
        $this->assertNotSame($this->defaultUri, $new);
        $this->assertEquals('https', $new->getScheme());
    }

    public function test_withUserInfo_returns_instance_with_new_user_and_password()
    {
        $new = $this->defaultUri->withUserInfo('foo');
        $this->assertNotSame($this->defaultUri, $new);
        $this->assertEquals('foo', $new->getUserInfo());

        $new = $this->defaultUri->withUserInfo('foo', 'bar');
        $this->assertEquals('foo:bar', $new->getUserInfo());
    }

    public function test_withHost_returns_instance_with_new_host()
    {
        $new = $this->defaultUri->withHost('foobar.com');
        $this->assertNotSame($this->defaultUri, $new);
        $this->assertEquals('foobar.com', $new->getHost());
    }

    public function test_withPort_returns_instance_with_new_port()
    {
        $new = $this->defaultUri->withPort(9090);
        $this->assertNotSame($this->defaultUri, $new);
        $this->assertEquals(9090, $new->getPort());

        $new = $this->defaultUri->withPort(null);
        $this->assertNotSame($this->defaultUri, $new);
        $this->assertEquals(null, $new->getPort());
    }

    public function test_withPath_return_instance_with_new_path()
    {
        $new = $this->defaultUri->withPath('/abc/def');
        $this->assertNotSame($this->defaultUri, $new);
        $this->assertEquals('/abc/def', $new->getPath());
    }

    public function test_withQuery_returns_instance_with_new_query()
    {
        $new = $this->defaultUri->withQuery('foo=bar&baz=qux');
        $this->assertNotSame($this->defaultUri, $new);
        $this->assertEquals('foo=bar&baz=qux', $new->getQuery());
    }

    public function test_withFragment_returns_instance_with_new_fragment()
    {
        $new = $this->defaultUri->withFragment('foobar');
        $this->assertNotSame($this->defaultUri, $new);
        $this->assertEquals('foobar', $new->getFragment());
    }
}
