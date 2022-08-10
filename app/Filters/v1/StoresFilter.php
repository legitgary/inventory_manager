<?php

namespace App\Filters\v1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class StoresFilter extends ApiFilter {
    protected $allowedParams = [
        'id' => ['eq', 'lt', 'lte', 'gt', 'gte', 'neq'],
        'name' => ['eq'],
        'created' => ['eq', 'lt', 'lte', 'gt', 'gte', 'neq']
    ];

    protected $columnMap = [
        'created' => 'created_at'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'neq' => '!='
    ];
}