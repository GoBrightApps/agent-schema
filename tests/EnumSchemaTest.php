<?php

declare(strict_types=1);
use Agent\Schema\Schema;

test('enum default string type', function () {
    $schema = Schema::enum(['draft', 'published']);

    $expected = [
        'type' => 'string',
        'enum' => ['draft', 'published'],
    ];

    expect($schema->toArray())->toEqual($expected);
});
test('enum infer types', function () {
    $schema = Schema::enum(['draft', 1, null])->inferTypes();

    $expected = [
        'enum' => ['draft', 1, null],
        'type' => ['string', 'integer', 'null'],
    ];

    expect($schema->toArray())->toEqual($expected);
});
