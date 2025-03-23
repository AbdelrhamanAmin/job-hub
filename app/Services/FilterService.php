<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Constants\FilterOperators;
use App\Exceptions\InvalidOperatorException;

class FilterService
{
    private const RELATION_FILTERS = [
        'languages' => 'languages.name',
        'locations' => 'locations.city',
        'categories' => 'categories.name',
    ];

    public function __construct(private Request $request) {}

    public function apply(Builder $query): Builder
    {
        $this->applyBasicFilters($query);
        $this->applyRelationshipFilters($query);
        $this->applyEAVFilters($query);
        return $query;
    }

    /**
     * Apply basic filters to the query.
     */
    private function applyBasicFilters(Builder $query): void
    {
        $filters = $this->request->query('filter', []);


        foreach ($filters as $field => $condition) {
            if (array_key_exists($field, self::RELATION_FILTERS) || str_starts_with($field, 'attribute:')) {
                continue;
            }

            foreach ($condition as $operator => $value) {
                $this->applyOperator($query, $field, $operator, $value);
            }
        }
    }

    /**
     * Apply a single operator to the query.
     */
    private function applyOperator(Builder $query, string $field, string $operator, mixed $value): void
    {
        match ($operator) {
            FilterOperators::EQUAL  => $query->where($field, '=', $value),
            FilterOperators::NOT_EQUAL  => $query->where($field, '!=', $value),
            FilterOperators::GREATER_THAN   => $query->where($field, '>', $value),
            FilterOperators::LESS_THAN  => $query->where($field, '<', $value),
            FilterOperators::GREATER_THAN_OR_EQUAL  => $query->where($field, '>=', $value),
            FilterOperators::LESS_THAN_OR_EQUAL  => $query->where($field, '<=', $value),
            FilterOperators::LIKE  => $query->where($field, 'LIKE', "%$value%"),
            FilterOperators::IN => $query->whereIn($field, explode(',', $value)),

            default => throw new InvalidOperatorException("Invalid operator: $operator"),
        };
    }

    private function applyRelationshipFilters(Builder $query): void
    {
        foreach (self::RELATION_FILTERS as $relation => $column) {
            if (!isset($this->request->query('filter')[$relation])) {
                continue;
            }

            $conditions = $this->request->query('filter')[$relation];

            foreach ($conditions as $operator => $value) {
                $this->applyRelationOperator($query, $relation, $operator, $value);
            }
        }
    }

    /**
     * Apply filtering for relationship attributes with operators.
     */
    private function applyRelationOperator(Builder $query, string $relation, string $operator, mixed $value): void
    {
        match ($operator) {
            FilterOperators::EQUAL => $query->whereHas($relation, fn($q) => $q->where(self::RELATION_FILTERS[$relation], '=', $value)),

            FilterOperators::NOT_EQUAL => $query->whereHas($relation, fn($q) => $q->where(self::RELATION_FILTERS[$relation], '!=', $value)),

            FilterOperators::GREATER_THAN => $query->whereHas($relation, fn($q) => $q->where(self::RELATION_FILTERS[$relation], '>', $value)),

            FilterOperators::LESS_THAN => $query->whereHas($relation, fn($q) => $q->where(self::RELATION_FILTERS[$relation], '<', $value)),

            FilterOperators::GREATER_THAN_OR_EQUAL => $query->whereHas($relation, fn($q) => $q->where(self::RELATION_FILTERS[$relation], '>=', $value)),

            FilterOperators::LESS_THAN_OR_EQUAL => $query->whereHas($relation, fn($q) => $q->where(self::RELATION_FILTERS[$relation], '<=', $value)),

            FilterOperators::LIKE => $query->whereHas($relation, fn($q) => $q->where(self::RELATION_FILTERS[$relation], 'LIKE', "%$value%")),

            FilterOperators::IN => $query->whereHas($relation, fn($q) => $q->whereIn(self::RELATION_FILTERS[$relation], explode(',', $value))),

            default => throw new InvalidOperatorException("Invalid operator: $operator"),
        };
    }

    private function applyEAVFilters(Builder $query): void
    {
        $attributes = Attribute::pluck('id', 'name')->toArray();

        $filters = $this->request->query('filter', []);

        foreach ($filters as $param => $conditions) {
            if (!str_starts_with($param, 'attribute:')) {
                continue;
            }

            $attributeName = str_replace('attribute:', '', $param);

            if (!isset($attributes[$attributeName])) {
                continue;
            }

            foreach ($conditions as $operator => $value) {
                $this->applyEAVOperator($query, $attributes[$attributeName], $operator, $value);
            }
        }
    }


    /**
     * Apply filtering for EAV attributes with operators.
     */
    private function applyEAVOperator(Builder $query, int $attributeId, string $operator, mixed $value): void
    {
        $operator = trim($operator); // Remove any unintended spaces

        match ($operator) {
            FilterOperators::EQUAL => $query->whereHas('attributeValues', fn($q) =>
            $q->where('attribute_id', $attributeId)->where('value', $value)),

            FilterOperators::NOT_EQUAL => $query->whereHas('attributeValues', fn($q) =>
            $q->where('attribute_id', $attributeId)->where('value', '!=', $value)),

            FilterOperators::GREATER_THAN => $query->whereHas('attributeValues', fn($q) =>
            $q->where('attribute_id', $attributeId)->where('value', '>', $value)),

            FilterOperators::LESS_THAN => $query->whereHas('attributeValues', fn($q) =>
            $q->where('attribute_id', $attributeId)->where('value', '<', $value)),

            FilterOperators::GREATER_THAN_OR_EQUAL => $query->whereHas('attributeValues', fn($q) =>
            $q->where('attribute_id', $attributeId)->where('value', '>=', $value)),

            FilterOperators::LESS_THAN_OR_EQUAL => $query->whereHas('attributeValues', fn($q) =>
            $q->where('attribute_id', $attributeId)->where('value', '<=', $value)),

            FilterOperators::LIKE => $query->whereHas('attributeValues', fn($q) =>
            $q->where('attribute_id', $attributeId)->where('value', 'LIKE', "%$value%")),

            FilterOperators::IN => $query->whereHas('attributeValues', fn($q) =>
            $q->where('attribute_id', $attributeId)->whereIn('value', explode(',', $value))),

            default => throw new InvalidOperatorException("Invalid operator: $operator"),
        };
    }
}
