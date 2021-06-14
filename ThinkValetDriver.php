<?php

class ThinkValetDriver extends ValetDriver
{
    public function serves($sitePath, $siteName, $uri)
    {
        return file_exists($sitePath . '/public/index.php') && file_exists($sitePath . '/think');
    }

    public function isStaticFile($sitePath, $siteName, $uri)
    {
        if (file_exists($staticFilePath = $sitePath . '/public' . $uri)
            && is_file($staticFilePath)) {
            return $staticFilePath;
        }
        return false;
    }

    public function frontControllerPath($sitePath, $siteName, $uri)
    {
        $_SERVER['SCRIPT_FILENAME'] = $sitePath . '/public/index.php';
        $_SERVER['SERVER_NAME'] = $_SERVER['HTTP_HOST'];
        $_SERVER['SCRIPT_NAME'] = '/index.php';
        $_SERVER['PHP_SELF'] = '/index.php';
        $_GET['s'] = $uri;
        return $sitePath . '/public/index.php';
    }
}
