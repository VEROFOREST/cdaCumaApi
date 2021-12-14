<?php
// api/tests/BooksTest.php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\User;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class ApiTest extends ApiTestCase
{
    // This trait provided by AliceBundle will take care of refreshing the database content to a known state before each test
    // use RefreshDatabaseTrait;

    public function testGetCollection(): void
    {
//         // The client implements Symfony HttpClient's `HttpClientInterface`, and the response `ResponseInterface`
        $response = static::createClient()->request('GET', 'http://127.0.0.1:8000/api/users', ['headers' => [
            'Authorization' => 'bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MzkzMTY5OTYsImV4cCI6MTYzOTMyMDU5Niwicm9sZXMiOlsiUk9MRV9BRE1JTiJdLCJ1c2VybmFtZSI6ImVzc2FpQG9yYW5nZS5mciIsImlkIjozLCJmaXJzdE5hbWUiOiJWw6lyb25pcXVlIiwibGFzdE5hbWUiOiJGT1JFU1QifQ.dIM5rdrXECYsJrhDpd7yBiLpXqbDDNVgx7l2O5PdPQBEDnFbs1dQlvYPTjNa3LpuqsgoKZ5EpcVQIIYLLESqPCTUtA7BMIz2Y0sonWPTpARw30_1XPYo034pajZTub0eHaIN9cFpFVEcNLl6bdGph53gfWJ1MEu4F1pObRBSuJSSxEvrUJkyIcmoOdhNlSHZSlf0DdilaJM8vs8iRqFlMKl5L3Cy1lWxh1fhzlf_qfErYUEVyJ331byzZYt4yvepFF6ZGzeaM3c0FfXd0woDDrWacOSZ1t4lClrXsuvuBZddV0hMKPv2BuQzIRE_bRfIoKloqkepjL-G2yuC6T2Qu8dD0g32Be9NzQ4A8ZwTpo64_e-TxctBs5RpE9ab9hvFVfirU2QGZ9EA6GCMh-sWqLcQ5IlGSUg3dc1RS4O4yry-1J_ptnnm5WssgoHC_t7sA8vIP5DRJBj3-gC3iSUU3HFfXmA4Leaxypy52LtwZoPNH_H8BxM4ya48swANP_3EByhYrLhv9KQ0JDURrB_S1qWmrIIR7Q7wpr4N9_UdnMgMhAJ_i-o821KQU13ZxCBfN1e1iWgiTCTJIU5G4tzrq6P_LWCHpNYPYhUSvGa1Rc6SnehYgDjIBXRQs0atgRcmbT2iqbwEMxOHifb7gs099kwln7p8pRRgZzy-Q481CFg'
        ],
            
        ]);

        $this->assertResponseIsSuccessful();
//         // Asserts that the returned content type is JSON-LD (the default)
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }


    public function testLogin(): void
    {
        $response = static::createClient()->request('POST', 'http://127.0.0.1:8000/api/login_check', ['json' => [
            'email' => 'essai@orange.fr',
            'password' => '123456',
        ]]);

        $this->assertResponseIsSuccessful();
    }
}
