# ACF Fields Sync
Structural data doesn't belong in a theme. What if the user switches themes?
Should they loose their input structure? Of course not! That's why this plugin exists.

In version 5 of the excellent Advanced Custom Fields (ACF) plugin, the feature
known as local JSON was introduced. It is excellent and allows you to sync your
field groups automatically to a JSON file. You make changes, it syncs. Fantastic!

The only problem is that it needs to be in the theme, in a sub-directory named
`acf-json`. We don't like that, because again, no structural data definitions
should ever be in the theme.

Fortunately, with a few lines of code we can store it really anywhere that we want,
such as in this plugin's `json` directory. And that's what we do.

## Installation
Installation is ever so simple. Just upload the plugin to your WordPress plugins
directory as usual or upload the ZIP file through the plugin installation page in the
WordPress dashboard.

No onfiguration necessary, however we will show a dismissable warning if
you actually haven't activated ACF itself.

## Translation
There aren't any public strings in this plugin. The only strings are the
plugin information itself and the error message in case ACF isn't activated.

Currently, we have included translations for the following languages:

	- English (en_US)
	- Swedish (sv_SE)

If you want to contribute your translation, make a pull request or simply send
it to us at info@bernskioldmedia.com. A .pot file is included in
the `languages` directory.

## Support
This plugin is provided as-is and will mostly make sense for developers.
That being said, if you have any comments or questions let us know by opening
an issue at GitHub.

## Authors
This plugin was created by Erik Bernskiold at Bernskiold Media. We are a full-service
global boutique digital agency based in Stockholm, Sweden and like sharing
things like this that we use and need ourselves.

You can read more about us at our website: https://www.bernskioldmedia.com
If you want to get in touch, please do send an email at: info@bernskioldmedia.com