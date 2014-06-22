<?php namespace Larrytech\Calendar\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Abstract base class of a model.
 * 
 * @author George Robinson <george.robinson@larrytech.com>
 */

abstract class Model extends Eloquent {
    
    /**
     * Gets the id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the created_at timestamp.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    } 

    /**
     * Gets the updated_at timestamp.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}