<?php

namespace Sameh\LaravelFCM;

use Illuminate\Http\Client\Response;

interface FCMManagerResponse
{

    static function onSuccess(Response $response);

    static function onError(Response $response);

}
