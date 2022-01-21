<?php

namespace App\Tests;

use PHPUnit\Runner\AfterLastTestHook;
use PHPUnit\Runner\BeforeFirstTestHook;

final class TestsExtension implements BeforeFirstTestHook, AfterLastTestHook
{
    public function executeAfterLastTest(): void
    {
    	$this->clearTmpDir();
    }

    public function executeBeforeFirstTest(): void
    {
    	$this->clearTmpDir();
    }

    private function clearTmpDir(): void
    {
    	if (file_exists('tmp/')) {
    		foreach (glob('tmp/*') as $file) {
    			if ($file === '.keep') {
    				continue;
    			}
    			unlink($file);
    		}
    	}
    }
}