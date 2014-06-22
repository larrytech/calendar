<?php namespace Larrytech\Calendar\Models;

use DateTime;
use Illuminate\Support\Collection;
use UnexpectedValueException;

/**
 * @author George Robinson <george.robinson@larrytech.com>
 */
 
class Event extends Model implements Constrainable, Taggable {

    /**
     * @var string
     */
    public $table = 'events';

    /**
     * @var array
     */
    public $fillable = array('description', 'ends_at', 'starts_at', 'title');

    /**
     * Gets the categories associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function constraints()
    {
        return $this->morphToMany('Larrytech\Calendar\Models\Constraint', 'constrainable')->withPivot('value')->withTimestamps();
    }

    /**
     * @inheritDoc
     */
    public function getDates()
    {
        return array('created_at', 'ends_at', 'starts_at', 'updated_at');
    }

    /**
     * {@inheritDoc}
     */
    public function addConstraint($constraint, $value)
    {
        if ($constraint instanceof Constraint)
        {
            return $this->addConstraint($constraint->getName(), $value);
        }

        try
        {
            return $this->constraints()->updateExistingPivot($this->getConstraint($constraint)->getId(), compact('value'));
        }
        catch (ConstraintNotFoundException $e)
        {
            $relation = Constraint::whereName($constraint)->first();

            if (is_null($relation))
            {
                $relation = Constraint::create(array('name' => $constraint));
            }

            return $this->constraints()->attach($relation, compact('value')); 
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addTag($tag)
    {
        if ($tag instanceof Tag)
        {
            return $this->addTag($tag->getName());
        }

        try
        {
            return $this->tags()->updateExistingPivot($this->getTag($tag)->getId());
        }
        catch (TagNotFoundException $e)
        {
            $relation = Tag::whereName($tag)->first();

            if (is_null($relation))
            {
                $relation = Tag::create(array('name' => $tag));
            }

            return $this->tags()->attach($relation); 
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getConstraint($constraint)
    {
        if ($constraint = $this->constraints()->whereName($constraint)->first())
        {
            return $constraint;
        }

        throw new ConstraintNotFoundException();
    }

    /**
     * {@inheritDoc}
     */
    public function getConstraints()
    {
        return $this->constraints()->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getTag($tag)
    {
        if ($tag = $this->tags()->whereName($tag)->first())
        {
            return $tag;
        }

        throw new TagNotFoundException();
    }

    /**
     * {@inheritDoc}
     */
    public function getTags()
    {
        return $this->tags()->get();
    }

    /**
     * Gets the description.
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Gets the ends_at timestamp.
     *
     * @return \DateTime
     */
    public function getEndsAt()
    {
        return $this->ends_at;
    }

    /**
     * Gets the title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Gets the starts at timestamp.
     *
     * @return \DateTime
     */
    public function getStartsAt()
    {
        return $this->starts_at;
    }

    /**
     * {@inheritDoc}
     */
    public function hasConstraint($constraint)
    {
        if ($constraint instanceof Constraint)
        {
            return $this->constraints->intersect($constraint)->count() > 0;
        }

        return $this->constraints()->whereName($constraint)->count() > 0;
    }

    /**
     * {@inheritDoc}
     */
    public function hasTag($tag)
    {
        if ($tag instanceof Tag)
        {
            return $this->tags->intersect($tag)->count() > 0;
        }

        return $this->constraints()->whereName($tag)->count() > 0;
    }

    /**
     * Returns true if the event is an all day event.
     *
     * @return bool
     */
    public function isAllDayEvent()
    {
        return $this->starts_at == $this->ends_at;
    }

    /**
     * Returns true if the event is hidden.
     *
     * @return bool
     */
    public function isHidden()
    {
        try
        {
           return $this->getConstraint('hidden')->getAttribute('pivot')->getAttribute('value');
        }
        catch (ConstraintNotFoundException $e)
        {
            return false;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function removeConstraint($constraint)
    {
        if ($constraint instanceof Constraint)
        {
            return $this->constraints()->detach($constraint);
        }

        try
        {
            return $this->constraints()->detach($this->getConstraint($constraint));
        }
        catch (ConstraintNotFoundException $e)
        {
            return false;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function removeTag($tag)
    {
        if ($tag instanceof Tag)
        {
            return $this->tags()->detach($tag);
        }

        try
        {
            return $this->tags()->detach($this->getTag($tag));
        }
        catch (TagNotFoundException $e)
        {
            return false;
        }

        return false;
    }

    /**
     * Gets events which are associated with a list of tags.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Support\Collection $tags
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereHasTags($query, Collection $tags)
    {
        return $query->whereHas('categories', function($constraint) use ($tags)
        {
            $constraint->whereIn('tags.id', $tags->lists('id'));
        });
    }

    /**
     * Gets events between two dates.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \DateTime $startsAt
     * @param \DateTime $endsAt
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBetweenDates($query, DateTime $startsAt, DateTime $endsAt)
    {
        return $query->whereBetween('starts_at', array($startsAt->copy()->setTime(0, 0, 0), $startsAt->copy()->setTime(23, 59, 59)))->where('ends_at', '<', $endsAt);
    }

    /**
     * Gets events which match the keywords.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $keywords
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $keywords)
    {
        return $query->where('title', 'LIKE', "%$keywords%");
    }

    /**
     * Sets the description.
     * 
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Sets the ends_at timestamp.
     *
     * @param \DateTime $endsAt
     */
    public function setEndsAt(DateTime $endsAt)
    {
        $this->ends_at = $endsAt;
    }

    /**
     * Sets if the event is an all day event.
     *
     * @param bool $value
     * @throws \UnexpectedValueException
     */
    public function setEventAsAllDayEvent()
    {
        if ($this->getStartsAt() == null)
        {
            throw new UnexpectedValueException('The starts at attribute cannot be null.');
        }

        $this->setStartsAt($this->getStartsAt()->setTime(0, 0, 0));
        $this->setEndsAt($this->getStartsAt());
    }

    /**
     * Sets the title.
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Sets the starts_at timestamp.
     *
     * @param \DateTime $startsAt
     */
    public function setStartsAt(DateTime $startsAt)
    {
        $this->starts_at = $startsAt;
    }

    /**
     * Sets the event as hidden.
     *
     * @param int $value
     */
    public function hideEvent($value)
    {
        $this->addConstraint('hidden', $value);
    }

    /**
     * Returns true if the time for the event should be hidden.
     *
     * @return bool
     */
    public function showTimeForEvent()
    {
        try
        {
            return $this->getConstraint('show_time_for_event');
        }
        catch (ConstraintNotFoundException $e)
        {
            return false;
        }
    }

    /**
     * Gets the categories associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany('Larrytech\Calendar\Models\Tag', 'taggable')->withTimestamps();
    }
}