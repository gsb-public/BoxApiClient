<?php

namespace BoxApiClient;

use GuzzleHttp\Command\ResultInterface;

class ResponseTransformer {
  public function __invoke($response, $request) {
    return $response;
  }
}
