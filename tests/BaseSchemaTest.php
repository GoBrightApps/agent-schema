<?php

declare(strict_types=1);
use Agent\Schema\BaseSchema;

test('default schema is empty', function () {
    $schema = new BaseSchema();
    expect($schema->toArray())->toEqual([]);
});
test('add description', function () {
    $schema = new BaseSchema();
    $schema->description('Test schema');

    expect($schema->toArray())->toEqual(['description' => 'Test schema']);
});
test('add default value', function () {
    $schema = new BaseSchema();
    $schema->default('N/A');

    expect($schema->toArray())->toEqual(['default' => 'N/A']);
});
test('to json and to string', function () {
    $schema = new BaseSchema();
    $schema->description('Json test');

    $json = $schema->toJson();
    expect($json)->toBeJson();
    $this->assertStringContainsString('"description":"Json test"', $json);

    // __toString should behave the same as toJson
    expect((string) $schema)->toEqual($json);
});
test('to json returns a string when encoding fails', function () {
    $schema = new BaseSchema();
    $schema->default("\xB1\x31");

    expect($schema->toJson())->toBe('');
});
test('serialize', function () {
    $schema = new BaseSchema();
    $schema->description('Serializable');

    $serialized = $schema->__serialize();
    expect($serialized)->toEqual(['description' => 'Serializable']);
});
