<?php

namespace App\Filters\v1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class ItemsFilter extends ApiFilter {
    protected $allowedParams = [
        'id' => ['eq', 'lt', 'lte', 'gt', 'gte', 'neq'],
        'storeId' => ['eq'],
        'fullName' => ['eq'],
        'itemCode' => ['eq'],
        'quantity' => ['eq', 'lt', 'lte', 'gt', 'gte', 'neq'],
        'purchasePrice' => ['eq', 'lt', 'lte', 'gt', 'gte', 'neq'],
        'markup' => ['eq', 'lt', 'lte', 'gt', 'gte', 'neq'],
        'created' => ['eq', 'lt', 'lte', 'gt', 'gte', 'neq']
    ];

    protected $columnMap = [
        'storeId' => 'store_id',
        'fullName' => 'full_name',
        'itemCode' => 'item_code',
        'purchasePrice' => 'purchase_price',
        'created' => 'created_at',
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