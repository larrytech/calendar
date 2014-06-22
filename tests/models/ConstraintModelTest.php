<?php

use Larrytech\Calendar\Models\Tag;

class ConstraintModelTest extends TestCase {

    public function testNameAttributeIsFillable()
    {
        $t = new Tag(array('name' => 'Test'));
        $this->assertEquals('Test', $t->getName());
    }
}