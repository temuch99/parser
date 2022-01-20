<?php

namespace App\Utils;

class Messages
{
    /**
     * @return string
     */
    public static function help(): string
    {
        $message  = "\nThe script analyzes access_log file and outputs some summary information\n\n";
        $message .= "USAGE: php parser.php [OPTIONS]\n\n";
        $message .= "OPTIONS:\n";
        $message .= "\t--help   \tprint this information message\n";
        $message .= "\t--name   \tinput object (file path, ip-address...) (required)\n";
        $message .= "\t--format \toutput format type (json, ser...) (required)\n";
        $message .= "\t--type   \ttype of giving object (access...) (required)\n\n";
        $message .= "Examples:\n";
        $message .= "\tphp parser.php --help                                            \tprint help message\n";
        $message .= "\tphp parser.php --name=<path/to/file> --format=json --type=access \tparse access_log file by path and print summary information in JSON format\n";
        $message .= "\tphp parser.php --name=<ip> --format=ser --type=access            \tparse access_log file by ip or url and print summary information in serialize format\n";

        return $message;
    }

    /**
     * @return string
     */
    public static function error(): string
    {
        $message = "\nThere are some error in app\n";

        return $message;
    }

    /**
     * @return string
     */
    public static function invalidArgument(): string
    {
        $message = "\nThere are invalid arguments\n";

        return $message;
    }

    /**
     * @return string
     */
    public static function fileNotExists(): string
    {
        $message = "\nInput file is not exists\n";

        return $message;
    }

    /**
     * @return string
     */
    public function urlNotExists(): string
    {
        $message = "\nUrl not exists or is unavailable\n";

        return $message;
    }

    /**
     * @return string
     */
    public function wrongFormat(): string
    {
        $message = "\nWrong format parameter\n";

        return $message;
    }

    /**
     * @return string
     */
    public function wrongType(): string
    {
        $message = "\nWrong type parameter\n";

        return $message;
    }

    /**
     * @return string
     */
    public function wrongName(): string
    {
        $message = "\nWrong name parameter\n";

        return $message;
    }

    /**
     * @return string
     */
    public function fileOpen(): string
    {
        $message = "\nFile cannot be opened\n";

        return $message;
    }

    /**
     * @return string
     */
    public function invalidFormat(): string
    {
        $message = "\nApplication cannot parse the text\n";

        return $message;
    }
}
