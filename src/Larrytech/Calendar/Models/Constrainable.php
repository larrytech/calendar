<?php namespace Larrytech\Calendar\Models;

interface Constrainable {

    /**
     * Associates a constraint with the model.
     *
     * @param string $constraint
     * @param mixed $value
     */
    public function addConstraint($constraint, $value);

    /**
     * Gets a constraint associated with the model.
     *
     * @param mixed $constraint
     * @throws \Larrytech\Calendar\Models\ConstraintNotFoundException
     */
    public function getConstraint($constraint);

    /**
     * Gets all constraints associated with the model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getConstraints();

    /**
     * Returns true if the model is associated with the constraint.
     *
     * @param mixed $constraint
     * @return bool
     */
    public function hasConstraint($constraint);

    /**
     * Removes an constraint associated with the model.
     *
     * @param mixed $constraint
     * @return bool
     */
    public function removeConstraint($constraint);   
}