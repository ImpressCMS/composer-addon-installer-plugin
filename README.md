composer-module-installer-plugin
================================

a plugin for Composer to allow the installation of ImpressCMS modules. Instead of forcing the
installation in the /vendor folder, these modules will be installed in the /modules folder.

Currently, only modules are supported. In the future, this should be able to handle other types of addons, such as language packs, themes, plugins, editors, ...

How to use
==========
You need to have a composer.json file in your module root that contains something like this:

{
	"name": "<package name>",
  "description": "<Package description>",
  "type": "impresscms-module",
  "require":
  {
    "impresscms/composer-module-installer-plugin": "*"
  }

}

Including this module as required will make composer use the composer-module-installer-plugin for all the 'impresscms-module' types.
