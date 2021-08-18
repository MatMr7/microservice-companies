<?php
namespace App\Services;

use Matmr7\MicroservicesCommom\Services\Traits\ConsumeExternalService;

class EvaluationService
{
    use ConsumeExternalService;

    protected $url;
    protected $token;

    public function __construct()
    {
        $this->url = config('services.micro_evaluations.url');
        $this->token = config('services.micro_evaluations.token');
    }

    public function getEvaluationsCompany(string $company)
    {
        $response = $this->request('GET',"/evaluations/$company");
        return $response->body();
    }
}
