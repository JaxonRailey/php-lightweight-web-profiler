# Lightweight web profiler
Lightweight web profiler with user interface showing essential information for PHP pages, no configuration required.

![Lightweight web profiler](https://github.com/JaxonRailey/php-lightweight-web-profiler/blob/main/php-lightweight-web-profiler.jpg?raw=true)

The information it shows is:

- version of PHP in use;
- how many PHP files were included;
- HTTP response status code;
- HTTP request method;
- page load time;
- memory usage for the execution of page;
- list of loaded extensions;



To install, just include profiler.php at the beginning of the script.

```php
include 'profiler.php';
```

**Remember, never use in production!**
