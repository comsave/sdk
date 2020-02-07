<?php

namespace Comsave\SDK\Exception;

use Exception;

class RequestFailedException extends Exception
{
    public function __construct($httpStatus, $message)
    {
        parent::__construct(sprintf("Failed webservice request with http status %s and message '%s'",
            $httpStatus,
            $message
        ));
    }
}
