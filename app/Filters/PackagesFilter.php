<?php

namespace App\Filters;
use App\Filters\ApiFilter;

class PackagesFilter extends ApiFilter {
    protected $safeParms = [
        'id'=> ['eq'],
        'trackingNumber'=> ['eq'],
        'description'=> ['eq'],
        'weight'=> ['eq', 'gt', 'lt'],
        'dimensions'=> ['eq', 'gt', 'lt'],
        'status'=> ['eq'],
    ];

    protected $columnMap = [
        'trackingNumber' => 'tracking_number'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '=<',
        'gt' => '>',
        'gte' => '>=',
    ];

}