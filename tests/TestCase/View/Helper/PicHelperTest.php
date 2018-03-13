<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\PicHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\PicHelper Test Case
 */
class PicHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\PicHelper
     */
    public $Pic;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Pic = new PicHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pic);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
