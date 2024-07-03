<?php 

namespace App\Filters;
use App\Filters\ApiFilter;

class SupermarketsFilter extends ApiFilter {
    protected $safeParms = [
        'id'=> ['eq'],
        'name'=> ['eq'],
        'address'=> ['eq'],
        'contactEmail'=> ['eq'],
    ];

    protected $columnMap = [
        'contactEmail' => 'contact_email',
    ];

    protected $operatorMap = [
        'eq' => '=',
    ];
}