<?php

namespace App\Filters;
use App\Filters\ApiFilter;

class PackageMovesFilter extends ApiFilter {
    protected $safeParms = [
        'id'=> ['eq'],
        'packageId'=> ['eq'],
        'status'=> ['eq'],
        'location'=> ['eq'],
        'handledBy'=> ['eq'],
    ];

    protected $columnMap = [
        'packageId' => 'package_id',
        'handledBy' => 'handled_by'
    ];

    protected $operatorMap = [
        'eq' => '='
    ];

}