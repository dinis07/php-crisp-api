<?php

namespace Crisp\Resources;

use Crisp\CrispError;

abstract class Resource
{
    public function __construct($parent)
    {
        $this->crisp = $parent;
    }

    protected function prepareQuery($query)
    {
        return (is_array($query) && count($query) > 0) ? '?'.http_build_query($query) : '';
    }

    protected function formatResponse($response)
    {
        $responseData = $response->decode_response();
        if ($responseData['error']) {
            throw new CrispError($response->info, $responseData);
        }
        return $responseData['data'];
    }
}
