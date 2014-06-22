<?php

use Carbon\Carbon;
use Mockery\Mockery as m;
use Larrytech\Calendar\Models\Event;

class EventModelTest extends TestCase {

    public function testDescriptionIsFillable()
    {
        $e = new Event(array('description' => 'Hello World'));
        $this->assertEquals('Hello World', $e->getDescription());
    }

    public function testTitleIsFillable()
    {
        $e = new Event(array('title' => 'Test'));
        $this->assertEquals('Test', $e->getTitle());
    }
}