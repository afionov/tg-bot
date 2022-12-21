# tg-bot
Бот для Telegram

# Usage

```php
$configuration = new \Bot\Configuration(
    token: '123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew1',
    httpClient: new \GuzzleHttp\Client()
)

$configuration->setCommands(
    [
        '/start' => fn (): \Bot\Command\CommandInterface => new \Bot\Command\DefaultStartCommand()
    ]
);
$configuration->setMode(\Bot\Mode\NullMode::class);

$bot = new \Bot\Bot($configuration);

*** endpoint
$bot->handleWebhook();
```

# TODO

- Tests
- Documentation
- Full telegram api support