<?php namespace Larrytech\Calendar\Database;

use Illuminate\Cache\CacheManager;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

/**
 * Connector is a database connector for Capsule, a component of the 
 * Illuminate\Database package.
 *
 * @author George Robinson <george.robinson@larrytech.com>
 */

class Connector {

    /**
     * @var \Illuminate\Database\Capsule\Manager
     */
    protected $capsule;

    /**
     * Class Constructor
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Initializes the connection manager and its dependencies.
     */
    protected function initialize()
    {
        $this->capsule = new Capsule();
        $this->capsule->setEventDispatcher(new Dispatcher(new Container));
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }
    
    /**
     * Register a connection.
     *
     * @param array $connection
     * @param string $name
     */
    public function addConnection($connection = array(), $name = 'default')
    {
        $this->capsule->addConnection($connection, $name);
    }

    /**
     * Get a registered connection instance.
     *
     * @param string $name
     * @return \Illuminate\Database\Connection
     */
    public function getConnection($connection)
    {
        return $this->capsule->getConnection($connection);
    }

    /**
     * Get the current event dispatcher instance.
     *
     * @return \Illuminate\Events\Dispatcher
     */
    public function getEventDispatcher()
    {
        return $this->capsule->getEventDispatcher();
    }

    /**
     * Set the event dispatcher instance to be used by connections.
     *
     * @param \Illuminate\Events\Dispatcher $dispatcher
     * @return void
     */
    public function setEventDispatcher(Dispatcher $dispatcher)
    {
        $this->capsule->setEventDispatcher($dispatcher);
    }

    /**
     * Get the current cache manager instance.
     *
     * @return \Illuminate\Cache\Manager
     */
    public function getCacheManager()
    {
        return $this->capsule->getCacheManager();
    }

    /**
     * Set the cache manager to be used by connections.
     *
     * @param \Illuminate\Cache\CacheManager $cache
     * @return void
     */
    public function setCacheManager(CacheManager $cache)
    {
        $this->capsule->setCacheManager($cache);
    }

    /**
     * Get the IoC container instance.
     *
     * @return \Illuminate\Container\Container
     */
    public function getContainer()
    {
        return $this->capsule->getContainer();
    }

    /**
     * Set the IoC container instance.
     *
     * @param \Illuminate\Container\Container $container
     * @return void
     */
    public function setContainer(Container $container)
    {
        $this->capsule->setContainer($container);
    }
}