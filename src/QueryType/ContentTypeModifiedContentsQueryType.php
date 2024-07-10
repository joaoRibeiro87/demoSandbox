<?php

namespace App\QueryType;

use Ibexa\Contracts\Core\Repository\Values\Content\Query;
use Ibexa\Core\QueryType\QueryType;

class ContentTypeModifiedContentsQueryType implements QueryType
{
    public function getQuery(array $parameters = []): Query
    {
        return new Query([
            'filter' => new Query\Criterion\LogicalAnd([
                new Query\Criterion\ContentTypeIdentifier($parameters['identifier']),
                new Query\Criterion\DateMetadata(Query\Criterion\DateMetadata::MODIFIED, Query\Criterion\Operator::GTE, $parameters['modified']),
            ]),
            'sortClauses' => [new Query\SortClause\DateModified(Query::SORT_DESC)],
        ]);
    }

    public function getSupportedParameters(): array
    {
        return ['identifier', 'modified'];
    }

    public static function getName(): string
    {
        return 'ContentTypeModifiedContents';
    }
}