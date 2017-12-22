<?php
use PHPUnit\Framework\IncompleteTestError;
use Phalcon\Test\UnitTestCase as PhalconTestCase;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Http\Response\Cookies;
use Phalcon\Http\Response;
use Phalcon\Http\Request;
use Phalcon\Filter;

/**
 * Class UnitTestCase
 */
abstract class UnitTestCase extends PhalconTestCase
{

    /**
     * @var bool
     */
    protected $_loaded = false;


    public function setUp()
    {
        parent::setUp();

        // Load any additional services that might be required during testing
        $di = $this->getDI();

        // Get any DI components here. If you have a config, be sure to pass it to the parent

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $di->set('db', function () {
            return require INJECT_PATH . '/db.php';
        }, true);

        $di->set('config', function () {
            return require INJECT_PATH . '/config.php';
        }, true);

        $di->set('parameter',function(){
            return require INJECT_PATH . '/parameter.php';
        }, true);

        $di->set('eventsManager', function () {
            return new EventsManager();
        }, true);

        $di->set('session', function () {
            $session = new Session();
            return $session;
        }, true);

        $di->set('cookies', function () {
            return new Cookies();
        }, true);

        $di->set('request', function () {
            return new Request();
        }, true);

        $di->set('response', function () {
            return new Response();
        }, true);

        $di->set('filter', function () {
            return new Filter();
        }, true);



        $this->setDI($di);

        $this->_loaded = true;

    }

    /**
     * Check if the test case is setup properly
     *
     * @throws IncompleteTestError
     */
    public function tearDown()
    {

        if (!$this->_loaded) {
            throw new IncompleteTestError('Please run parent::setUp().');
        }

        parent::tearDown();
    }
}