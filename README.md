# t3/cli-config

A TYPO3 CMS extension that provides a command-line interface (CLI) for setting or unsetting 
global system settings. 

This extension leverages the capabilities of Helmut Hummel's 
[helhum/typo3-console](https://github.com/TYPO3-Console/TYPO3-Console) package.


## Requirements

* TYPO3 v13.x
* PHP 8.2 or higher
* Cannot be installed alongside `helhum/typo3-console` due to conflicts.


## Installation

Install this extension like any other TYPO3 CMS extension.

For direct installation via TYPO3 Extension Repository (TER), visit:
https://extensions.typo3.org/extension/cli_config

For installation using Composer:

```bash
composer require t3/cli-config
```

**Important:** After installation, make sure to clear all caches to register and 
activate the newly included Symfony command.


## Usage of command `configuration:set`

Adds a new entry to the TYPO3 CLI command list, allowing configuration adjustments directly from the CLI.


### Syntax

```
vendor/bin/typo3 configuration:set [options] [--] <path> [<value>]
```


### Arguments

* `path`: The path to the system configuration (e.g., `SYS/displayErrors`).
* `value`: The new value to set for the given configuration path (optional if using `--unset`).


### Options

* `--unset`: Removes the entire entry at the specified configuration path.


### Examples

#### Setting a value

```bash
vendor/bin/typo3 configuration:set SYS/displayErrors 1
```

#### Unsetting a value

```bash
vendor/bin/typo3 configuration:set --unset SYS/displayErrors
```

#### Setting negative numbers

To set a negative number, use `--` before the value to prevent the CLI from interpreting it as an option:

```bash
vendor/bin/typo3 configuration:set -- SYS/displayErrors -1
```

Otherwise you will get an error like:

> The "-1" option does not exist.


## Additional Resources

* [Git Repository](https://github.com/a-r-m-i-n/cli-config)
* [Issue tracker](https://github.com/a-r-m-i-n/cli-config/issues)
* [EXT:cli_config in TER](https://extensions.typo3.org/extension/cli_config)
* [EXT:cli_config on Packagist](https://packagist.org/packages/t3/cli-config)
* [The author](https://v.ieweg.de)
* [**Donate**](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=2DCCULSKFRZFU)
