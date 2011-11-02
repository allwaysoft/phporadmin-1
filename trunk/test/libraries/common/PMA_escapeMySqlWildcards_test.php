<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Test for MySQL Wildcards escaping/unescaping
 *
 * @package PhpMyAdmin-test
 * @version $Id: PMA_escapeMySqlWildcards_test.php
 * @group common.lib-tests
 */

/*
 * Include to test.
 */
require_once 'libraries/common.lib.php';

class PMA_escapeMySqlWildcards_test extends PHPUnit_Framework_TestCase
{

    public function escapeDataProvider() {
        return array(
            array('\_test', '_test'),
            array('\_\\', '_\\'),
            array('\\_\%', '_%'),
            array('\\\_', '\_'),
            array('\\\_\\\%', '\_\%'),
            array('\_\\%\_\_\%', '_%__%'),
            array('\%\_', '%_'),
            array('\\\%\\\_', '\%\_')
        );
    }

    /** 
     * PMA_escape_mysql_wildcards tests 
     * @dataProvider escapeDataProvider
     */

    public function testEscape($a, $b)
    {
        $this->assertEquals($a, PMA_escape_mysql_wildcards($b));
    }

    /** 
     * PMA_unescape_mysql_wildcards tests 
     * @dataProvider escapeDataProvider
     */

    public function testUnEscape($a, $b)
    {
        $this->assertEquals($b, PMA_unescape_mysql_wildcards($a));
    }
}
?>
