# Schnittstabil\Saika\Cli

> SAIKA – Simple All-Inkl Kas Api - WIP.


## Install

```bash
composer global require schnittstabil/saika-cli
```


## Usage

```bash
Console Tool

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display this help message
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  chown  Change file owner.
  help   Displays help for a command
  list   Lists commands
```


### `chown`

```bash
Usage:
  chown [options] [--] <file> [<owner>]

Arguments:
  file
  owner                 e.g. www-data; defaults to $KAS_AUTH_USER

Options:
  -R, --recursive       Operate on files and directories recursively
      --user=USER       all-inkl KAS login, defaults to $KAS_AUTH_USER environment variable
      --pass=PASS       all-inkl KAS password, defaults to $KAS_AUTH_PASS environment variable
  -h, --help            Display this help message
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Help:
  Change file owner.
```


## Related

* [SAIKA](https://github.com/schnittstabil/saika) – PHP library


## License

MIT © [Michael Mayer](http://schnittstabil.de)
