<?php

use Larrytech\Calendar\Database\Connector;

class ConnectorTest extends TestCase {
    
    /**
     * Tests that a connection is added to the manager.
     */
    public function testAddConnection()
    {
        $connector = new Connector();
        $container = $connector->getContainer();
        $connector->addConnection($this->getCOnnectionStub(), 'test');
        $this->assertEquals($this->getCOnnectionStub(), $container['config']['database.connections']['test']);
    }

    /**
     * Gets a configuration stub for a connection.
     * 
     * @return array
     */
    protected function getCOnnectionStub()
    {
        return array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'database',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ); 
    }
}