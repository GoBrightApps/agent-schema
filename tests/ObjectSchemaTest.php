<?php

declare(strict_types=1);
use Agent\Schema\Schema;

test('object with properties', function () {
    $schema = Schema::object('User object')
        ->required(['id', 'email'])
        ->property('id', Schema::integer(), 'User ID')
        ->property('email', Schema::string()->format('email'), 'User email');

    $array = $schema->toArray();

    expect($array['type'])->toEqual('object');
    expect($array['required'])->toEqual(['id', 'email']);
    expect($array['properties'])->toHaveKey('id');
    expect($array['properties'])->toHaveKey('email');
});
