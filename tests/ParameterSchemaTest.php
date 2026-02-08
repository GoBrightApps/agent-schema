<?php

declare(strict_types=1);
use Agent\Schema\Schema;

test('parameter schema base structure', function () {
    $schema = Schema::parameters(
        'get_weather',
        'Get weather info',
        Schema::object('Weather object')
            ->required(['location'])
            ->property('location', Schema::string('City name'))
    );

    $array = $schema->toArray();

    expect($array['type'])->toEqual('function');
    expect($array['name'])->toEqual('get_weather');
    expect($array['description'])->toEqual('Get weather info');
    expect($array)->toHaveKey('parameters');
    expect($array['parameters'])->toHaveKey('properties');
});
test('parameter schema with strict trait', function () {
    $schema = Schema::parameters(
        'get_weather',
        'Get weather info',
        Schema::object('Weather object')
    );

    $schema->strict();
    // from StrictableSchema trait
    expect($schema->toArray()['strict'])->toBeTrue();
});
test('parameter schema with type override', function () {
    $schema = Schema::parameters(
        'get_weather',
        'Get weather info',
        Schema::object('Weather object')
    );

    $schema->setType('custom_function');

    // from TypeableSchema trait
    expect($schema->toArray()['type'])->toEqual('custom_function');
});
