# enalog-php

### Installation

```
composer require enalog/enalog-php
```

### Usage 

**Sending Events**

```php
use EnaLog\EnaLogClient;


$enalogClient = new EnaLogClient('api-token');

$enalogClient->pushEvent([
    'project' => 'hello-world',
    'name' => 'testing-php',
    'description' => 'hello world event description',
    'icon' => '👀',
    'tags' => ['hello', 'world'],
    'meta' => ['meta' => 'data'],
    'channels' => [],
    'user_id' => '1234'
]);
```

------

> **Requires [PHP 8.2+](https://php.net/releases/)**

🧹 Keep a modern codebase with **Pint**:
```bash
composer lint
```

✅ Run refactors using **Rector**
```bash
composer refacto
```

⚗️ Run static analysis using **PHPStan**:
```bash
composer test:types
```

✅ Run unit tests using **PEST**
```bash
composer test:unit
```

🚀 Run the entire test suite:
```bash
composer test
```

**Skeleton PHP** was created by **[Nuno Maduro](https://twitter.com/enunomaduro)** under the **[MIT license](https://opensource.org/licenses/MIT)**.
