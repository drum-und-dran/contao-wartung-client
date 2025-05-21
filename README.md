# Contao Wartung Client Bundle

Dieses Symfony-Bundle stellt eine API für Contao-Installationen zur Verfügung, 
um Systeminformationen (PHP-Version, Contao-Version, MySQL-Version) bereitzustellen.

## Installation

```bash
composer require dud/contao-wartung-client
```

Oder über den Contao Manager als ZIP hochladen.

## API-Endpunkt

```
GET /contao-wartung/api?auth=...
```

## Sicherheit

Die Authentifizierung erfolgt per SHA256-Hash über die Domain + Salt-Zeichenkette.

## Autor

[Gunnar Haeuschkel](mailto:example@example.com)

