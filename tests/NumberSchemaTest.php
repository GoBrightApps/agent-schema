<?php

declare(strict_types=1);
use Agent\Schema\Schema;

test('number with constraints', function () {
    $schema = Schema::number('Rating')
        ->min(1)
        ->max(5)
        ->multipleOf(1);

    $expected = [
        'type' => 'number',
        'description' => 'Rating',
        'minimum' => 1,
        'maximum' => 5,
        'multipleOf' => 1,
    ];

    expect($schema->toArray())->toEqual($expected);
});
