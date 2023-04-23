<?php

namespace AnthonyEdmonds\SilverOwl\Traits;

use AnthonyEdmonds\SilverOwl\Relationships\KeylessRelationship;
use Illuminate\Database\Eloquent\Model;

trait HasKeylessRelationships
{
    /**
     * Creates a new keyless relationship between two models by passing an array
     * of "where" conditions in a remote_field, comparator, local_field format
     *
     * @author Anthony Edmonds
     *
     * @link https://github.com/AnthonyEdmonds
     *
     * @param  string|Model  $related The related Eloquent model or fully qualified name
     * @param  array  $wheres The list of parameters to execute on the related model
     */
    public function keylessRelation($related, array $wheres): KeylessRelationship
    {
        return new KeylessRelationship($this, $related, $wheres);
    }
}
