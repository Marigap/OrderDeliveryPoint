<?php

use App\Http\ApiV1\Support\Tests\ApiV1ComponentTestCase;

use function Pest\Laravel\delete;
use function Pest\Laravel\getJson;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

uses(ApiV1ComponentTestCase::class);
uses()->group('component');

test('GET http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries 200', function () {
    getJson('http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries')
        ->assertStatus(200);
});

test('POST http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries 201', function () {
    post('http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries')
        ->assertStatus(201);
});

test('POST http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries 400', function () {
    post('http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries')
        ->assertStatus(400);
});

test('GET http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries/{delivery_id} 200', function () {
    getJson('http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries/{delivery_id}')
        ->assertStatus(200);
});

test('GET http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries/{delivery_id} 404', function () {
    getJson('http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries/{delivery_id}')
        ->assertStatus(404);
});

test('PUT http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries/{delivery_id} 200', function () {
    put('http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries/{delivery_id}')
        ->assertStatus(200);
});

test('PUT http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries/{delivery_id} 404', function () {
    put('http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries/{delivery_id}')
        ->assertStatus(404);
});

test('DELETE http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries/{delivery_id} 200', function () {
    delete('http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries/{delivery_id}')
        ->assertStatus(200);
});

test('DELETE http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries/{delivery_id} 404', function () {
    delete('http://localhost:8000/OrderDeliveryAPI/v1/order-deliveries/{delivery_id}')
        ->assertStatus(404);
});
