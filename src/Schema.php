<?php

declare(strict_types=1);

namespace Agent\Schema;

class Schema extends BaseSchema
{
    /**
     * Create a new object schema
     */
    public static function object(?string $description = null, ?string $name = null): ObjectSchema
    {
        return new ObjectSchema($description, $name);
    }

    /**
     * Create a new array schema.
     */
    public static function array(?BaseSchema $itemsSchema = null, ?string $description = null): ArraySchema
    {
        return new ArraySchema($itemsSchema, $description);
    }

    /**
     * Create a new string schema.
     */
    public static function string(?string $description = null): StringSchema
    {
        return new StringSchema($description);
    }

    /**
     * Create a new number schema.
     */
    public static function number(?string $description = null): NumberSchema
    {
        return new NumberSchema($description);
    }

    /**
     * Create a new Integer schema.
     */
    public static function integer(?string $description = null): IntegerSchema
    {
        return new IntegerSchema($description);
    }

    /**
     * Create a new boolean schema.
     */
    public static function boolean(?string $description = null): BooleanSchema
    {
        return new BooleanSchema($description);
    }

    /**
     * Create a new enum schema.
     */
    public static function enum(array $enum, ?string $description = null): EnumSchema
    {
        return new EnumSchema($enum, $description);
    }

    /**
     * Create a new anyOf schema.
     *
     * @param  array<int, BaseSchema>  $schemas
     */
    public static function anyOf(array $schemas): AnyOfSchema
    {
        return new AnyOfSchema($schemas);
    }

    /**
     * Create a new allOf schema.
     *
     * @param  array<int, BaseSchema>  $schemas
     */
    public static function allOf(array $schemas): AllOfSchema
    {
        return new AllOfSchema($schemas);
    }

    /**
     * Create a new const schema.
     */
    public static function const(mixed $value, ?string $description = null): ConstSchema
    {
        return new ConstSchema($value, $description);
    }

    /**
     * Create a new const schema.
     */
    public static function not(BaseSchema $schema): NotSchema
    {
        return new NotSchema($schema);
    }

    /**
     * Create a new parameter schema
     */
    public static function parameters(string $name, string $description, ObjectSchema $schema): ParameterSchema
    {
        return new ParameterSchema($name, $description, $schema);
    }

    /**
     * Create a new tool schema
     */
    public static function tool(string $name, string $description, ObjectSchema $schema): ParameterSchema
    {
        return new ParameterSchema($name, $description, $schema);
    }
}
