<?php namespace Larrytech\Calendar\Models;

interface Taggable {

    /**
     * Associates a tag with the model.
     *
     * @param mixed $tag
     */
    public function addTag($tag);

    /**
     * Gets a tag associated with the model.
     *
     * @param mixed $tag
     * @throws \Larrytech\Calendar\Models\TagNotFoundException
     */
    public function getTag($tag);

    /**
     * Gets all tags associated with the model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTags();

    /**
     * Returns true if the model is associated with the tag.
     *
     * @param mixed $tag
     * @return bool
     */
    public function hasTag($tag);

    /**
     * Removes an tag associated with the model.
     *
     * @param mixed $tag
     * @return bool
     */
    public function removeTag($tag);
}