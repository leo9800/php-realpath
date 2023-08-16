<?php

namespace Leo980\Realpath;

/**
 * Retrieve canonical path, also works on non-exist paths.
 * @param  string $path Input path
 * @return string       Canonical path
 */
function realpath(string $path): string
{
    // If input path is empty, return current working directory
    if (strlen($path) == 0)
        return getcwd();

    // Canonicalize path separator
    $path = str_replace(['/', '\\'], \DIRECTORY_SEPARATOR, $path);

    // If the path does not start with '/', then it is a relative path,
    // prepend current working directory as prefix
    if ($path[0] != DIRECTORY_SEPARATOR)
        $path = getcwd() . DIRECTORY_SEPARATOR . $path;

    $stack = explode(DIRECTORY_SEPARATOR, $path);
    $abspath = [];

    foreach ($stack as $i) {
        // Ignore empty component or single dot (current directory)
        if ($i === '.' || $i === '')
            continue;
        // Pop stack on double dot (parent directory)
        elseif ($i === '..')
            array_pop($abspath);
        // Otherwise, push stack
        else
            $abspath[] = $i;
    }

    return DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $abspath);
}
