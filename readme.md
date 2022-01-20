# Парсер
## Описание
Предложенный парсер позволяет разобрать информацию с помощью некоторого алгоритма и выдать сводную информацию в удобном формате. 
<br/>
Данные на вход парсера могут подаваться разными способами: из коробки есть возможность дать путь к файлу из локальной файловой системы или ip-адрес, где этот файл можно получить по протоколу HTTP.
<br/>
На данный момент парсер может разбирать только файлы access_log, которые генерируют веб-серверы.
<br/>
Вывод формируется в формате JSON и сериализованном виде php.

## Использование
Утилита запускается через точку входа `parser.php`
`php parser.php [OPTIONS]`
<br/>
`OPTIONS:`
<br/>
`--help print this information message`
<br/>
`--name input object (file path, ip-address...) (required)`
<br/>
`--format output format type (json, ser...) (required)`
<br/>
`--type type of giving object (access...) (required)`
<br/>

## Примеры
Примеры использования утилиты:
<br/>
Данный скрипт выведет информацию об использовании утилиты и краткое ее описание:
<br/>
`php parser.php --help`
<br/>
![help](doc/help.png)
<br/>
Вывод информации о файле `../access_log` в формате JSON:
<br/>
`php parser.php --name=../access_log --type=access --format=json`
<br/>
![JSON](doc/json.png)
<br/>
Вывод информации о файле `access_log`, который находится по адресу `127.0.0.1/access_log`, в сериализованном формате PHP:
<br/>
`php parser.php --name=127.0.0.1/access_log --type=access --format=ser`
<br/>
![HTTP](doc/http.png)
<br/>

## Как расширить данный скрипт
Структурно приложение состоит из следущих частей:
<br/>
![UML](doc/uml.png)
<br/>
1. Для того, чтобы добавить форматы помимо JSON и сериализации, нужно создать новый файл в директории `src/Designers/{Name}Designer.php` с соответстующим классом и реализовать в нем метод `design(array $data): string`, также следует добавить создание объекта этого класса в методе `create(string $format): Designer` класса `DesignerCreator`.
2. Для того, чтобы добавить парсеры помимо AccessLog, нужно создать новый файл в директории `src/Parsers/{Name}Parser.php` с соответствующим классом и реализовать в нем метод `parse(resource $handle): array`, также следует добавить создание объекта этого класса в методе `create(string $type): Parser` класса `ParserCreator`.
3. Для того, чтобы добавить загрузчики помимо `HttpLoader` и `FileLoader`, нужно создать новый файл в директории `src/Loaders/{Name}Loader.php` с соответствующим классом и реализовать в нем метод `load(): resource`, также следует добавить создание объекта этого класса в методе `create(string $name): Loader` класса `LoaderCreator`. При передаче `$handle` файл можно сохранить в директории `tmp/`.