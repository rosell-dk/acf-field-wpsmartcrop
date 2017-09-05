# ACF Field WP SmartCrop

This Wordpress plugin is a new "Image with focal point for cropping" Field Type for Advanced Custom Fields. The user can select an image and mark the most important part of the image with a focal point. All thumbnails that are set to be cropped in Wordpress will be cropped with respect to that focal point, using WP SmartCrop. You have to have that plugin installed.

I have only implemented the ACF v5 hooks. So it does not work in ACF v4. It will not take much efford to do, though.

The field was made with a standard template. The rest of this README is the remains of that template. The plugin generally needs to be cleaned up from remains of the template. 






# Type Template

Welcome to the Advanced Custom Fields field type template repository.
Here you will find a starter-kit for creating a new ACF field type. This starter-kit will work as a normal WP plugin.

For more information about creating a new field type, please read the following article:
http://www.advancedcustomfields.com/resources/tutorials/creating-a-new-field-type/


### step 1.

This template uses `PLACEHOLDERS` such as `wpsmartcrop` throughout the file names and code. Use the following list of placeholders to do a 'find and replace':

* `wpsmartcrop`: Single word, no spaces. Underscores allowed. eg. donate_button
* `WP SmartCrop`: Multiple words, can include spaces, visible when selecting a field type. eg. Donate Button
* `PLUGIN_URL`: Url to the github or WordPress repository
* `PLUGIN_TAGS`: Comma separated list of relevant tags
* `SHORT_DESCRIPTION`: Brief description of the field type, no longer than 2 lines
* `EXTENDED_DESCRIPTION`: Extended description of the field type
* `Bjørn Rosell`: Name of field type author
* `AUTHOR_URL`: URL to author's website

### step 2.

Edit the `wpsmartcrop-v5.php` and `wpsmartcrop-v4.php` files (now renamed using your field name) and include your custom code in the appropriate functions. 
Please note that v4 and v5 field classes have slightly different functions. For more information, please read:
* http://www.advancedcustomfields.com/resources/tutorials/creating-a-new-field-type/

### step 3.

Edit this `README.md` file with the appropriate information and delete all content above and including the following line.

-----------------------

# ACF WP SmartCrop Field

SHORT_DESCRIPTION

-----------------------

### Description

EXTENDED_DESCRIPTION

### Compatibility

This ACF field type is compatible with:
* ACF 5
* ACF 4

### Installation

1. Copy the `acf-wpsmartcrop` folder into your `wp-content/plugins` folder
2. Activate the WP SmartCrop plugin via the plugins admin page
3. Create a new field via ACF and select the WP SmartCrop type
4. Please refer to the description for more info regarding the field type settings

### Changelog
Please see `readme.txt` for changelog
