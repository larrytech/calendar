<?php namespace Larrytech\Calendar\Models;

use DateTime;

/**
 * @author George Robinson <george.robinson@larrytech.com>
 */
 
class Tag extends Model {

    /**
     * @var string
     */
    public $table = 'tags';

    /**
     * @var array
     */
    public $fillable = array('name');

    /**
     * Gets the name.
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name.
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}