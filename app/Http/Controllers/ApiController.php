<?php

namespace Ddondola\Http\Controllers;

use Illuminate\Http\Request;
use Nuwave\Lighthouse\Support\Http\Controllers\GraphQLController;

class ApiController extends GraphQLController
{
    /**
     * Inject middleware into request.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware(['web']);

        parent::__construct($request);
    }
}
