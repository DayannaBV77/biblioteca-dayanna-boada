<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Comprueba la redirección inicial a la lista de libros.
     */
    public function test_the_application_redirects_root_to_libros(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('libros.index'));
    }

    /**
     * Comprueba que la lista de libros responde con éxito (HTTP 200).
     */
    public function test_libros_catalog_returns_a_successful_response(): void
    {
        $response = $this->get('/libros');

        $response->assertStatus(200);
    }
}
