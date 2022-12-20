# tg-bot
Бот для Telegram

# Usage

```php
$bot = new \Bot\Bot(
    token: '123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew1', //required
    httpClient: new \GuzzleHttp\Client(), //required
    modeClass: \Bot\Mode\NullMode::class, //optional
    commands: ['/start' => fn (): \Bot\Command\CommandInterface => new \Bot\Command\DefaultStartCommand()] //optional
);
```

# TODO

- Tests
- Documentation
- Full telegram api support