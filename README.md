[![License](https://img.shields.io/github/license/imponeer/criteria.svg)](LICENSE) [![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/impresscms/composer-addon-installer-plugin)](https://php.net) [![GitHub release (latest by date)](https://img.shields.io/github/v/release/ImpressCMS/composer-addon-installer-plugin)](https://github.com/ImpressCMS/composer-addon-installer-plugin/releases) [![Packagist Downloads](https://img.shields.io/packagist/dm/ImpressCMS/composer-addon-installer-plugin)](https://packagist.org/packages/impresscms/composer-addon-installer-plugin)

# Composer Add-on Installer Plugin (for [ImpressCMS](https://impresscms.org))

Composer plugin to correctly install modules, themes and translations to required locations for ImpressCMS.

## How to use it?

Normally this package must be required only by ImpressCMS itself. So, basically that means you don't need you must install the CMS if you want to use functionality provided by this package.

## Handled package types 

At current moment this plugin handles `impresscms-module`, `impresscms-theme` and `impresscms-translation` composer package types.

Below are supported composer.json file samples/descriptions.

### `impresscms-module` format

```yaml
{
   "name": "MODULE/NAME",
   "description": "HERE CAN BE WRITTEN SOME TEXT",
   "authors": [ // this becomes teammembers internaly
          {
              "name": "Someones Name",
              "email": "someones@email.lt",
              "homepage": "https://www.someone-website.be",
              "role": "Developer"
          }
    ],
    "license": "package-license",
    "extra": {
      "credits": "Anything that you would like to know about creator in module admin",
      "author": "somebody", // if you want specify first person or company who created this module write it here
      "help": "",
      "icon": {
        "small": "file_in_module_directory_to_be_shown_as_small_image_for_module.png",
        "big": "file_in_module_directory_to_be_shown_as_big_image_for_module.png",
      },
      "warning": "if you want to put any warning about release, you can but it here",
      "website_url": "https://website_for_project.com",
      "email": "email@for_project.us",
      "people": [], // array with involved people data
      "autotasks": [], // array to describe autotasks that will be installed with this module
      "manual": "",
      "admin": { // if module doesn't have admin do not specify this key
        "index": "if specified must be url to admin page",
        "menu": [], // describes admin menu
      },
      "object_items": [], // if module use IPF objects here you can specify names list that would be automatically processed
      "search": { // if module doesn't have search do not specify this key
          "file": "php file for gathering search results",
          "func": "function name in that file"
      },
      "comments": {}, // if module uses build in comments configuration is specified here, otherwise don't specify this key
      "templates": [], // specify templates that must be registered to be used by this module
      "has_main": true, // if specified and has value true ImpressCMS thinks that this module has old-school main page
      "events": {
        "update": {}, // if specified update callback function is invoked when module is updated
      },
      "blocks": [], // if module uses blocks here you must specify blocks configuration
      "menu": [], // if module has submenu, here is possible to specify menu items
      "config": [], // specified options that can be configurated in module settings
      "notification": [], // describes notifications that is provided by this module,
      "assets": [], // if module needs to copy non automatically copied assets files to public directory, all these assets must be specified here
    }
}
```

### `impresscms-theme` format

```yaml
{
   "name": "THEME/NAME",
   "description": "HERE CAN BE WRITTEN SOME TEXT",
   "type": "impresscms-theme",
   "license": "", // see composer.json docs 
   "extra": {
       "screenshots": {
          "user": "", // url with user side theme screenshot, if this specified icms thinks that theme supports user side
          "admin": "" // same as user but for admin side
        },
       "name": "THEME NAME TO USE IN LIST" // if specified this value will be used in all theme names lists
    }
}
```

### `impresscms-translation` format
```yaml
{
   "name": "TRANSLATION/NAME",
   "description": "HERE CAN BE WRITTEN SOME TEXT",
   "type": "impresscms-translation",
   "license": "", // see composer.json docs 
}
```

Note: this format only works for core translations, all others must come from modules
 
## How to contribute?

If you want to add some functionality or fix bugs, you can fork, change and create pull request. If you not sure how this works, try [interactive GitHub tutorial](https://skills.github.com).

If you found any bug or have some questions, use [issues tab](https://github.com/ImpressCMS/composer-addon-installer-plugin/issues) and write there your questions.
