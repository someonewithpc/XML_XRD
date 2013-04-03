<?php
require_once 'XML/XRD.php';

class XML_XRD_Serializer_JSONTest extends PHPUnit_Framework_TestCase
{
    public function testXrdRfc6415A()
    {
        $filePath = __DIR__ . '/../../../';
        $x = new XML_XRD();
        $x->loadFile($filePath . 'xrd/rfc6415-A.xrd');
        $this->assertEquals(
            json_decode(file_get_contents($filePath . 'jrd/rfc6415-A.jrd')),
            json_decode($x->toJSON())
        );
    }

    public function testRemoveEmptyLinksArray()
    {
        $x = new XML_XRD();
        $x->subject = 'foo';

        $res = new stdClass();
        $res->subject = 'foo';
        $this->assertEquals(
            $res,
            json_decode($x->toJSON())
        );
    }
}

?>