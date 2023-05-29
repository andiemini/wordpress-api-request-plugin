# Api Requests Widget Plugin

The Api Requests Widget plugin allows you to redirect API requests from a widget to a custom URL in your WordPress website. This enables seamless integration of third-party APIs into your site. The plugin version is 1.0.1, developed by Andi Emini.

## Installation

1. Download the plugin files or clone the repository into your WordPress plugins directory (`wp-content/plugins/`).

2. Activate the plugin through the WordPress admin panel (`Plugins > Installed Plugins`).

3. Customize the plugin settings as needed.

## Functionality

The plugin provides the following functionality:

- **Enqueuing Styles and Scripts:** The plugin enqueues the `styles.css` and `scripts.js` files located in the `assets` directory. These files are essential for the proper functioning of the widget.

- **Widget Form:** The plugin includes a widget form that can be used in your WordPress sidebar or any other widgetized area. To place the widget, use the `[widget]` shortcode in your WordPress content, pages, or posts.

- **Google Maps Integration:** The widget form includes a Google Maps API script that loads the necessary resources and initializes the map.

- **Form Submission Handling:** Upon form submission, the plugin captures the form data and redirects the request to a custom URL. It utilizes the Google Maps Geocoding API to retrieve latitude and longitude coordinates based on the provided location.

## Usage

To use the Api Requests Widget plugin:

1. Add the widget form to your desired location by adding the `[widget]` shortcode in your WordPress content, pages, or posts.

2. Customize the widget form as needed. You can modify the form structure, styling, and behavior by editing the `widget_form()` function in the plugin file.

3. Configure the plugin settings according to your requirements. Update the Google Maps API key in the widget form's JavaScript URL.

4. Customize the URL used for redirection in the `handle_booking_form()` function. Modify the API endpoint and parameters to match your desired API integration.

## Support and Contributions

This is an open-source project, and anyone is welcome to contribute to its development. Feel free to fork the repository, make improvements, and submit pull requests to share your enhancements with the community.

For support or reporting issues, please contact Andi Emini through their [LinkedIn profile](https://www.linkedin.com/in/andi-emini/).

## License

The Api Requests Widget plugin is licensed under GPL2. Feel free to modify and distribute it according to the terms of the license.

Enjoy using the Api Requests Widget plugin for seamless integration of third-party APIs into your WordPress site!
