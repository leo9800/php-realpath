<?php

namespace Leo980\Realpath\Tests;

use function Leo980\Realpath\realpath;
use PHPUnit\Framework\TestCase;

/**
 * @testdox function Leo980\Realpath\realpath
 */
class realpathTest extends TestCase
{
    public function testCanonicalizeEmptyPath(): void
    {
        $this->assertSame(getcwd(), realpath(''));
    }

    public function testCanonicalizeRelativePaths(): void
    {
        $this->assertSame(
            getcwd() . DIRECTORY_SEPARATOR . 'test123.bin',
            realpath('a/b/../../test123.bin'),
        );
    }

    public function testCanonicalizeAbsolutePaths(): void
    {
        $this->assertSame(
            '/path/to/some/file',
            realpath('/path/to/somewhere/else/./../../some/file'),
        );
    }
}
