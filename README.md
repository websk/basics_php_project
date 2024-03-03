# basics_php_project

## MAMP
https://www.mamp.info/en/downloads/

* Настройка переменных сред: C:\MAMP\bin\php\php8.1.0

## IDE
### Visual Studio Code
https://code.visualstudio.com/download

Настройки settings.json:

    {
        "workbench.colorTheme": "Default Light Modern",
        "php.validate.executablePath": "C:/MAMP/bin/php/php8.1.0/php.exe",
        "php.suggest.basic": true,
        "php.validate.enable": true,
        "php.executablePath": "C:/MAMP/bin/php/php8.1.0/php.exe"
        "phpCodeSniffer.exec.windows": "C:\\MAMP\\htdocs\\vendor\\bin\\phpcs.bat",
        "composer.bin": "",
        "phpCodeSniffer.standard": "Default",
        "files.eol": "\n
    }

### PHPStorm
https://www.jetbrains.com/phpstorm/
https://www.jetbrains.com/ru-ru/community/education/#students

# Composer

https://getcomposer.org/doc/00-intro.md#installation-windows

## PSR
https://www.php-fig.org/psr/

* PSR-1: Basic Coding Standard
* PSR-12: Extended Coding Style

### PHP_CodeSniffer

    composer require "squizlabs/php_codesniffer=*"

## Встроенный сервер PHP
    php -S localhost:8000

