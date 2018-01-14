<?php

namespace Slim\Handlers;

use Psr\Log\LoggerInterface;
use Crell\ApiProblem\ApiProblem;

final class ApiError {

    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

   public function __invoke($request, $response, $exception) {
     $this->logger->critical($exception->getMessage());

     $status = $exception->getCode() ?: 500;
         $problem = new ApiProblem($exception->getMessage(), "about:blank");
         $problem->setStatus($status);
         $body = $problem->asJson(true);

         return $response
                 ->withStatus($status)
                 ->withHeader("Content-type", "application/problem+json")
                 ->write($body);
   }
}
