<?php

namespace AnthonyEdmonds\SilverOwl\Relationships;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Creates a new keyless relationship between two models by passing an array
 * of "where" conditions in a remote_column, comparator, local_column format
 *
 * return $this->keylessRelationship(OtherModel::class, [
 *     [
 *         'remote_column' => 'any_column',
 *         'comparator' => '=',
 *         'local_column' => 'another_column',
 *     ],
 * ]);
 *
 * You may use any column that exists on the local and remote tables, and you
 * may add as many "where" conditions that you like
 *
 * You may also use an arbitrary value by providing the "value" key instead:
 *
 * return $this->keylessRelationship(OtherModel::class, [
 *     [
 *         'remote_column' => 'any_column',
 *         'comparator' => 'LIKE',
 *         'value' => 'Some value%',
 *     ],
 * ]);
 *
 * Use joins to cross tables and indirect relationships
 *
 * return $this->keylessRelationship(OtherModel::class, [
 *     [
 *         'remote_column' => 'pivot_table.any_column',
 *         'comparator' => '=',
 *         'local_column' => 'another_column',
 *     ],
 * ])
 *     ->leftJoin('pivot_table', 'pivot_table.id', '=', 'other_model.pivot_id');
 * 
 * You may use the "IN" comparator to add a whereIn condition. Ensure that the
 * provided local_column or value can be converted to an array either by the model
 * or by providing a `delimiter` to perform an `explode`
 * 
 * return $this->keylessRelationship(OtherModel::class, [
 *     [
 *         'remote_column' => 'pivot_table.any_column',
 *         'comparator' => 'IN',
 *         'local_column' => 'another_column',
 *         'delimiter' => ',',
 *     ],
 * ])
 *
 * @mixin Builder
 *
 * @author Anthony Edmonds
 *
 * @link https://github.com/AnthonyEdmonds
 */
class KeylessRelationship extends Relation
{
    /** @property array $wheres The set of conditions to match relationships with */
    protected $wheres;

    /**
     * @param Model $parent The original model that bears the relationships
     * @param string|Model $related The related Eloquent model or fully qualified name
     * @param array $wheres The list of parameters to execute on the related model
     * @throws Exception
     */
    public function __construct(Model $parent, $related, array $wheres)
    {
        if (is_string($related) === true) {
            $related = new $related;
        }

        if (is_a($related, Model::class) === false) {
            throw new Exception('Related object must be an Eloquent model');
        }

        $query = $related->newQuery();
        $this->wheres = $wheres;

        parent::__construct($query, $parent);
    }

    /**
     * Add query constraints when performing lazy loading
     */
    public function addConstraints(): void
    {
        if (static::$constraints) {
            $this->addQueryConstraints($this->parent);
        }
    }

    /**
     * Add query constraints when performing eager loading
     *
     * @param array $models The pre-retrieved models
     */
    public function addEagerConstraints(array $models): void
    {
        foreach ($models as $model) {
            $this->addQueryConstraints($model);
        }
    }

    /**
     * Initialise the relationship key on the target models with the retrieved object type
     *
     * @param array $models The pre-retrieved models
     * @param string $relation The name of the relation key
     */
    public function initRelation(array $models, $relation): array
    {
        foreach ($models as $model) {
            $model->setRelation($relation, $this->related->newCollection());
        }

        return $models;
    }

    /**
     * Match the eagerly loaded results to their parents.
     *
     * @param array $models The pre-retrieved models
     * @param string $relation
     */
    public function match(array $models, Collection $results, $relation): array
    {
        foreach ($models as $model) {
            $model->setRelation($relation, $this->matchResultsToModel($results, $model));
        }

        return $models;
    }

    public function getResults(): mixed
    {
        return $this->query->get();
    }

    /**
     * Add constraints to the query based on a known model
     *
     * @param Model $model The model to constrain against
     */
    protected function addQueryConstraints(Model $model): void
    {
        foreach ($this->wheres as $where) {
            $this->addQueryConstraint($model, $where);
        }
    }

    /**
     * Add a constraint to the query based on a known model and where condition
     *
     * @param Model $model The model to constrain against
     * @param array $where The where clause to apply
     */
    protected function addQueryConstraint(Model $model, array $where): void
    {
        $remote = $where['remote_column'];
        $local = $where['value'] ?? $model[$where['local_column']];
        
        if ($where['comparator'] === 'IN') {
            if (is_array($local) === false) {
                $local = explode($where['delimiter'], $local);
            }
            
            $this->query->whereIn($remote, $local);
            
        } else {
            $this->query->where($remote, $where['comparator'], $local);
        }
    }

    protected function matchResultsToModel(Collection $results, Model $model): Collection
    {
        return $results->filter(function ($result) use ($model) {
            foreach ($this->wheres as $where) {
                if ($this->matchResultToModel($result, $model, $where) === false) {
                    return false;
                }
            }

            return true;
        });
    }

    protected function matchResultToModel($result, Model $model, array $where): bool
    {
        $remote = $result[$where['remote_column']];
        $local = $where['value'] ?? $model[$where['local_column']];

        if ($where['comparator'] === 'LIKE') {
            $startsWithWildcard = str_starts_with($local, '%');
            $endsWithWildcard = str_ends_with($local, '%');
            $local = trim($local, '%');

            if ($startsWithWildcard === true && $endsWithWildcard === true) {
                return str_contains($remote, $local) === true;
            } elseif ($startsWithWildcard === true) {
                return str_starts_with($remote, $local) === true;
            } else {
                return str_ends_with($remote, $local) === true;
            }
            
        } elseif ($where['comparator'] === 'IN') {
            return str_contains($local, $remote) === true;
            
        } else {
            return match ($where['comparator']) {
                '<' => $remote < $local,
                '>' => $remote > $local,
                '<=' => $remote <= $local,
                '>=' => $remote >= $local,
                '!=' => $remote != $local,
                '<>', '!==' => $remote !== $local,
                '==' => $remote == $local,
                default => $remote === $local,
            };
        }
    }
}
