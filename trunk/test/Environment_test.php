<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * tests for environment like OS, PHP, modules, ...
 *
 * @package PhpMyAdmin-test
 */

/**
 *
 */
require_once 'config.sample.inc.php';

/**
 * @package PhpMyAdmin-test
 */
class Environment_test extends PHPUnit_Framework_TestCase
{
    public function testPhpVersion()
    {
        $this->assertTrue(version_compare('5.2', phpversion(), '<='),
            'phpMyAdmin requires PHP 5.2 or above');
    }

    public function testOracle()
    {
        try{
            $conn = oci_connect(TESTSUITE_USER, TESTSUITE_PASSWORD, TESTSUITE_DATABASE);
            //print_r($conn);
            $this->assertFalse(!$conn, "Error when trying to connect to database");

            //$pdo->beginTransaction();
            $st = oci_parse($conn, 'SELECT * FROM USER_TABLES');
            $result = oci_execute($st);
            //print_r($result);
            //$pdo->commit();
            $this->assertTrue($result, 'Error trying to show tables for database');
        }
        catch (Exception $e){
            $this->fail("Error: ".$e->getMessage());
        }

        // Check id MySQL server is 5 version
        //preg_match("/^(\d+)?\.(\d+)?\.(\*|\d+)/", $pdo->getAttribute(constant("PDO::ATTR_SERVER_VERSION")), $version_parts);
        //$this->assertEquals(5, $version_parts[1]);
    }

    //TODO: Think about this test
//    public function testSession()
//    {
//        $this->markTestIncomplete();
//    }
}
?>
