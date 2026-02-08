<?php

declare(strict_types=1);
use Agent\Schema\Schema;

test('default boolean schema', function () {
    $schema = Schema::boolean();

    $expected = [
        'type' => 'boolean',
    ];

    expect($schema->toArray())->toEqual($expected);
});
test('boolean schema with description', function () {
    $schema = Schema::boolean('Whether the user is active');

    $expected = [
        'type' => 'boolean',
        'description' => 'Whether the user is active',
    ];

    expect($schema->toArray())->toEqual($expected);
});
