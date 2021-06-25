<?php

namespace Tests\Feature\Api;

use App\Models\{
    Company,
    Category
    };
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    protected $endpoint = '/company';
    /**
     * Get all Companies
     *
     * @return void
     */
    public function test_get_all_companies()
    {
        Company::factory()->count(6)->create();

        $response = $this->getJson($this->endpoint);
        $response->assertJsonCount(6, 'data');
        $response->assertStatus(200);
    }

    /**
     * Error Geting a single company that does not exists
     *
     * @return void
     */
    public function test_error_get_single_company()
    {
        $response = $this->getJson("{$this->endpoint}/fake-uuid");

        $response->assertStatus(404);
    }

    /**
     * Error Geting a single company that does not exists
     *
     * @return void
     */
    public function test_get_single_company()
    {
        $category = Company::factory()->create();

        $response = $this->getJson("{$this->endpoint}/$category->identify");

        $response->assertStatus(200);
    }

    /**
     * Validation Store Company
     * @return void
     */
    public function test_validations_store_company()
    {
        $response = $this->postJson($this->endpoint,[
            'category_id' => '',
            'name' => '',
            'email' => '',
            'whatsapp' => ''
        ]);
        
        $response->assertStatus(422);
    }

    /**
     * Store Company
     */
    public function test_store_company()
    {
        $category = Category::factory()->create();

        $response = $this->postJson($this->endpoint,[
            'category_id' => $category->id,
            'name' => 'Company test',
            'email' => 'testCompany@mail',
            'whatsapp' => '21973824836'
        ]);
        
        $response->assertStatus(201);

        $countCompanies = Company::count();

        assert(1,$countCompanies);
    }

    /**
     * Update Company
     * @return void
     */
    public function test_update_company()
    {
        $company = Company::factory()->create();
        $category = Category::factory()->create();

        $data = [
            'category_id' => $category->id,
            'name' => 'Company test',
            'email' => 'testCompany@mail',
            'whatsapp' => '21973824836'
        ];

        $response = $this->putJson("{$this->endpoint}/'fake-uuid",$data);
        $response->assertStatus(404);

        $response = $this->putJson("{$this->endpoint}/'fake-category",['title'=> '','description' => '']);
        $response->assertStatus(422);

        $response = $this->putJson("{$this->endpoint}/{$company->uuid}",['title'=> '','description' => '']);
        $response->assertStatus(422);

        $response = $this->putJson("{$this->endpoint}/{$company->uuid}",$data);
        $response->assertStatus(200);
    }

    /**
     * Delete Company
     * @return void
     */
    public function test_delete_company()
    {
        $company = Company::factory()->create();

        $response = $this->deleteJson("{$this->endpoint}/'fake-uuid");
        $response->assertStatus(404);

        $response = $this->deleteJson("{$this->endpoint}/{$company->uuid}");
        $response->assertStatus(204);
    }
}
