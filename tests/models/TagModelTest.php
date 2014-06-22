<?php

use Larrytech\Calendar\Models\Tag;

class TagModelTest extends TestCase {

    public function testNameAttributeIsFillable()
    {
        $t = new Tag(array('name' => 'Test'));
        $this->assertEquals('Test', $t->getName());
    }

    public function testOrderAttributeIsFillable()
    {
        $t = new Tag(array('order' => 10));
        $this->assertEquals(10, $t->getOrder());
    }
}