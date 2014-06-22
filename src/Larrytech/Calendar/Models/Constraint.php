<?php namespace Larrytech\Calendar\Models;

/**
 * @author George Robinson <george.robinson@larrytech.com>
 */
 
class Constraint extends Model {

    /**
     * @var string
     */
    public $table = 'constraints';

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
}