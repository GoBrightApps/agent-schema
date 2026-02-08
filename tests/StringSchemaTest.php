<?php

declare(strict_types=1);
use Agent\Schema\Schema;

test('string with length and pattern', function () {
    $schema = Schema::string('Username')
        ->min(3)
        ->max(20)
        ->pattern('^[a-z]+$');

    $expected = [
        'type' => 'string',
        'description' => 'Username',
        'minLength' => 3,
        'maxLength' => 20,
        'pattern' => '^[a-z]+$',
    ];

    expect($schema->toArray())->toEqual($expected);
});
test('string nullable', function () {
    $schema = Schema::string()->nullable();

    expect($schema->toArray())->toEqual(['type' => ['string', 'null']]);
});
