<?php

declare(strict_types=1);
use Agent\Schema\Schema;

test('default array', function () {
    $schema = Schema::array();
    $expected = ['type' => 'array'];

    expect($schema->toArray())->toEqual($expected);
});
test('array with items schema', function () {
    $schema = Schema::array(Schema::string('Tag'), 'Tags array');

    $expected = [
        'type' => 'array',
        'description' => 'Tags array',
        'items' => [
            'type' => 'string',
            'description' => 'Tag',
        ],
    ];

    expect($schema->toArray())->toEqual($expected);
});
test('array with min and max items', function () {
    $schema = Schema::array(Schema::integer())
        ->minItems(1)
        ->maxItems(5);

    $expected = [
        'type' => 'array',
        'items' => ['type' => 'integer'],
        'minItems' => 1,
        'maxItems' => 5,
    ];

    expect($schema->toArray())->toEqual($expected);
});
test('array with min and max aliases', function () {
    $schema = Schema::array(Schema::boolean())
        ->min(2)
        ->max(4);

    $expected = [
        'type' => 'array',
        'items' => ['type' => 'boolean'],
        'minItems' => 2,
        'maxItems' => 4,
    ];

    expect($schema->toArray())->toEqual($expected);
});
