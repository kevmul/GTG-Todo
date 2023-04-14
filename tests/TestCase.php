<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function assertMissingValidationError($response, $field, $message = null)
    {
        $this->assertFalse(
            (session('error') !== null && session('errors')->has($field)),
            $message ?? "There was an issue with {$field}"
        );
        $response->assertStatus(201);
    }

    public function assertHasValidationError($response, $field, $error_message = null, $status = 302)
    {
        $response->assertStatus($status);

        $response->assertSessionHasErrors($field);

        if ($error_message) {
            $this->assertEquals($error_message, session('errors')->get($field)[0]);
        }
    }


}
