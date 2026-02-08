# Schema Builder for AI Workflow

A type-safe PHP library for building **Structured Outputs** schemas (based on JSON Schema).  
Easily create, validate, and serialize schemas for AI Tooling/functions calling structured output.


## Features

- Fluent builder API (`Schema::string()->min(3)->max(20)`)
- Full support for JSON Schema types (`string`, `number`, `integer`, `boolean`, `array`, `object`, `enum`, `const`)
- Composition helpers (`anyOf`, `allOf`, `not`)
- Nullable support (`->nullable()`)
- Enum with type inference (`Schema::enum([...])->inferTypes()`)
- Type-safe object properties (`->property('name', Schema::string())`)
- Laravel-ready (`Arrayable`, `Jsonable`, `Stringable`)

---

## Installation

```bash
composer require bright/agent-schema
```

---

## Usage

### Simple string schema

```php
use Agent\Schema;

$schema = Schema::string('User name')
    ->min(3)
    ->max(50)
    ->pattern('^[a-zA-Z ]+$');

echo $schema->toJson(JSON_PRETTY_PRINT);
```

Output:

```json
{
    "type": "string",
    "description": "User name",
    "minLength": 3,
    "maxLength": 50,
    "pattern": "^[a-zA-Z ]+$"
}
```

---

### Object schema with properties

```php
$schema = Schema::object("Schema for a user profile")
    ->required(['id', 'email'])
    ->property('id', Schema::string()->pattern('^[0-9]+$'), 'User ID')
    ->property('email', Schema::string()->format('email'), 'User email')
    ->property('age', Schema::integer()->min(18), 'User age')
    ->property('status', Schema::enum(['active', 'inactive', null])->inferTypes(), 'User status');
```

---

### Enums with type inference

```php
Schema::enum(['draft', 'published']);                 // default "string"
Schema::enum([1, 2, 3])->inferTypes();                // auto → "integer"
Schema::enum([true, false, null])->inferTypes();      // auto → ["boolean","null"]
Schema::enum([1, "two"])->setType(["integer","string"]); // manual override
```

---

### Array schema

```php
$schema = Schema::array(Schema::string(), "Tags")
    ->min(1)
    ->max(5);
```

---

### Advanced composition

```php
$schema = Schema::allOf([
    Schema::object()->setName('base')->property('id', Schema::integer()),
    Schema::object()->setName('extra')->property('extra', Schema::string())
]);
```

---

## Real Example: Function Schema

Here’s how you can directly pass a schema built with this package to structured outputs:

```php
use OpenAI\Client;
use Agent\Schema;

$client = OpenAI::client('sk-your-api-key');

// Define schema for a weather function
$weatherSchema = Schema::object("Get the weather in a city")
    ->required(['location'])
    ->property('location', Schema::string("City name"))
    ->property('unit', Schema::enum(['celsius', 'fahrenheit'], "Temperature unit"));

// Build function definition
$function = [
    'name' => 'get_weather',
    'description' => 'Retrieve the current weather for a location',
    'parameters' => $weatherSchema->toArray(),
];

// Call OpenAI with structured function
$response = $client->chat()->create([
    'model' => 'gpt-4o-mini',
    'messages' => [
        ['role' => 'user', 'content' => 'What is the weather in Paris in celsius?']
    ],
    'tools' => [
        [
            'type' => 'function',
            'function' => $function
        ]
    ]
]);

print_r($response);
```

This will enforce that OpenAI returns structured JSON like:

```json
{
    "location": "Paris",
    "unit": "celsius"
}
```

---

## API Overview

- **`Schema::string($description)`**
    - `->minLength()`, `->maxLength()`, `->pattern()`, `->format()`, `->nullable()`
- **`Schema::number()` / `Schema::integer()`**
    - `->minimum()`, `->maximum()`, `->exclusiveMinimum()`, `->exclusiveMaximum()`, `->multipleOf()`
- **`Schema::boolean()`**
- **`Schema::enum([...])`**
    - `->setType()`, `->inferTypes()`, `->nullable()`
- **`Schema::array($itemsSchema)`**
    - `->minItems()`, `->maxItems()`
- **`Schema::object($description)`**
    - `->property($name, BaseSchema $schema, ?string $description)`
    - `->required([...])`
    - `->additional(bool)`
- **Combinators**
    - `Schema::anyOf([...])`
    - `Schema::allOf([...])`
    - `Schema::not($schema)`
    - `Schema::const($value)`

---

## License

MIT License
