<?php

declare(strict_types=1);
use Agent\Schema\Schema;

test('it creates object schema', function () {
    $schema = Schema::object('User object')->setName('User');
    $array = $schema->toArray();

    expect($array['type'])->toEqual('object');
    expect($array['name'])->toEqual('User');
    expect($array['description'])->toEqual('User object');
});
test('it creates array schema', function () {
    $schema = Schema::array(Schema::string(), 'Tags array');
    $array = $schema->toArray();

    expect($array['type'])->toEqual('array');
    expect($array['description'])->toEqual('Tags array');
    expect($array['items'])->toEqual(['type' => 'string']);
});
test('it creates string schema', function () {
    $schema = Schema::string('Username');
    $array = $schema->toArray();

    expect($array['type'])->toEqual('string');
    expect($array['description'])->toEqual('Username');
});
test('it creates number schema', function () {
    $schema = Schema::number('Rating');
    $array = $schema->toArray();

    expect($array['type'])->toEqual('number');
    expect($array['description'])->toEqual('Rating');
});
test('it creates integer schema', function () {
    $schema = Schema::integer('Age');
    $array = $schema->toArray();

    expect($array['type'])->toEqual('integer');
    expect($array['description'])->toEqual('Age');
});
test('it creates boolean schema', function () {
    $schema = Schema::boolean('Active flag');
    $array = $schema->toArray();

    expect($array['type'])->toEqual('boolean');
    expect($array['description'])->toEqual('Active flag');
});
test('it creates enum schema', function () {
    $schema = Schema::enum(['draft', 'published'], 'Status');
    $array = $schema->toArray();

    expect($array['type'])->toEqual('string');
    // default
    expect($array['enum'])->toEqual(['draft', 'published']);
    expect($array['description'])->toEqual('Status');
});
test('it creates anyof schema', function () {
    $schema = Schema::anyOf([Schema::string(), Schema::integer()]);
    $array = $schema->toArray();

    expect($array)->toHaveKey('anyOf');
    expect($array['anyOf'])->toHaveCount(2);
});
test('it creates allof schema', function () {
    $schema = Schema::allOf([Schema::string(), Schema::integer()]);
    $array = $schema->toArray();

    expect($array)->toHaveKey('allOf');
    expect($array['allOf'])->toHaveCount(2);
});
test('it creates const schema', function () {
    $schema = Schema::const('fixed', 'Constant value');
    $array = $schema->toArray();

    expect($array['const'])->toEqual('fixed');
    expect($array['description'])->toEqual('Constant value');
});
test('it creates not schema', function () {
    $schema = Schema::not(Schema::string());
    $array = $schema->toArray();

    expect($array)->toHaveKey('not');
    expect($array['not'])->toEqual(['type' => 'string']);
});
test('it creates parameters schema', function () {
    $schema = Schema::parameters(
        'get_weather',
        'Get weather info',
        Schema::object('Weather')->property('location', Schema::string('City name'))
    );

    $array = $schema->toArray();

    expect($array['type'])->toEqual('function');
    expect($array['name'])->toEqual('get_weather');
    expect($array['description'])->toEqual('Get weather info');
    expect($array)->toHaveKey('parameters');
});
test('it creates tool schema', function () {
    $schema = Schema::tool(
        'search',
        'Search tool',
        Schema::object('Search')->property('query', Schema::string('Search query'))
    );

    $array = $schema->toArray();

    expect($array['type'])->toEqual('function');
    expect($array['name'])->toEqual('search');
    expect($array['description'])->toEqual('Search tool');
});
