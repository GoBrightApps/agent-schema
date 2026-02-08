<?php

declare(strict_types=1);
use Agent\Schema\Schema;

test('all of composition', function () {
    $schema = Schema::allOf([
        Schema::object()->property('id', Schema::integer()),
        Schema::object()->property('tag', Schema::string()),
    ]);

    $array = $schema->toArray();
    expect($array)->toHaveKey('allOf');
    expect($array['allOf'])->toHaveCount(2);
});
test('not composition', function () {
    $schema = Schema::not(Schema::string());
    $array = $schema->toArray();

    expect($array)->toHaveKey('not');
    expect($array['not'])->toEqual(['type' => 'string']);
});
