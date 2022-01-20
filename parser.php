<?php

require('vendor/autoload.php');

use App\Exceptions\FileNotExistsException;
use App\Exceptions\UrlNotExistsException;
use App\Exceptions\WrongFormatException;
use App\Exceptions\WrongNameFormatException;
use App\Exceptions\WrongTypeException;
use App\Loaders\LoaderCreator;
use App\Parsers\ParserCreator;
use App\Designers\DesignerCreator;
use App\Utils\Messages;
use App\Utils\RegularExpressions;

$options = getopt('', ['help', 'name:', 'type:', 'format:']);

try {
	if (array_key_exists('help', $options)) {
		print(Messages::help());
	} elseif (
		array_key_exists('name', $options) && 
		array_key_exists('type', $options) &&
		array_key_exists('format', $options)
	) {
		$handle = LoaderCreator::create($options['name'])->load();
		$data   = ParserCreator::create($options['type'])->parse($handle);
		$result = DesignerCreator::create($options['format'])->design($data);

		print("\n\n" . $result . "\n\n");
	} else {
		print(Messages::invalidArgument());
	}
} catch (FileNotExistsException $e) {
	fwrite(STDERR, Messages::fileNotExists());
} catch (FileOpenException $e) {
	fwrite(STDERR, Messages::fileOpen());
} catch (InvalidFormatException $e) {
	fwrite(STDERR, Messages::invalidFormat());
} catch (UrlNotExistsException $e) {
	fwrite(STDERR, Messages::urlNotExists());
} catch (WrongFormatException $e) {
	fwrite(STDERR, Messages::wrongFormat());
} catch (WrongNameFormatException $e) {
	fwrite(STDERR, Messages::wrongName());
} catch (WrongTypeException $e) {
	fwrite(STDERR, Messages::wrongType());
}
