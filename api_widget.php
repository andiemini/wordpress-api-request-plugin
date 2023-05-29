<?php
/*
Plugin Name: Api Requests Widget
Description: This plugin redirects API requests from a widget to a custom URL, allowing you to integrate third-party APIs seamlessly into your website.
Version: 1.0.1
Author: Andi Emini
Author URI: https://www.linkedin.com/in/andi-emini/
License: GPL2
*/

function my_function() {
    // Enqueue the stylesheet
    wp_enqueue_style( 'my-style', plugins_url( 'assets/styles.css', __FILE__ ), array(), '1.0.0', 'all' );

    // Enqueue the script
    wp_enqueue_script( 'my-script', plugins_url( 'assets/scripts.js', __FILE__ ), array('jquery'), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'my_function' );


function widget_form()
{
    ob_start();
?>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZ9TLQFEQR3tH8N1EYZSii1HtoxJ6_pUA&libraries=places&callback=initMap" onerror="alert('Google Maps could not be loaded.')"></script>

    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="widget__form">
        <div class="widget__form__data location_input">
            <img src="<?= plugins_url( 'assets/images/cil-location-pin.svg', __FILE__ ); ?>" alt="Location" class="widget__form__data__icon location_icon">
            <input type="text" id="location-input" name="location" required class="widget__form__data__input first__input-border" placeholder="Location">
        </div>
        <div class="widget__form__data check_in_date_wrapper">
            <img src="<?= plugins_url( 'assets/images/cil-calendar.svg', __FILE__ ); ?>" alt="Location" class="widget__form__data__icon calendar_icon">
            <input type="text" name="check_in_date" id="check-in-date" class="date-picker widget__form__data__date widget__form__data__input" placeholder="Check-in — Check-out">
            <div id="daterangepicker"></div>
            <!-- THIS -->
        </div>
        <div class="widget__form__data people_form">
            <div class="people-custom-select custom-select">
                <img src="<?= plugins_url( 'assets/images/cil-people.svg', __FILE__ ); ?>" alt="Location" class="widget__form__data__icon people_icon">
                <span id="adults-children">Guests</span>
                <div class="select-options">
                    <div class="select-option-bar">
                        <span>Who</span>
                    </div>
                    <div class="input-group adults-tab">
                        <div class="adults-info">
                            <label for="adults">Adults</label>
                            <span class="adults-age">aged 13 and over</span>
                        </div>
                        <div class="person_adult_buttons">
                            <button id="decrement-adults" type="button"></button>
                            <input type="number" name="adults" id="adults" value="0" class="incrementing_input">
                            <button id="increment-adults" type="button"></button>
                        </div>
                    </div>
                    <div class="input-group childrens-tab">
                        <div class="children-info">
                            <label for="children">Children</label>
                            <span class="children-age">3 to 12 years</span>
                        </div>
                        <div class="person_children_buttons">
                            <button id="decrement-children" type="button"></button>
                            <input type="number" name="children" id="children" value="0" class="incrementing_input">
                            <button id="increment-children" type="button"></button>
                        </div>
                    </div>
                    <input type="hidden" name="number_of_persons" id="number_of_persons" value="0">
                </div>
            </div>
        </div>

        <input type="submit" value="Search" class="widget__form__search">
        <input type="hidden" name="action" value="booking_form">
    </form>

<?php
    $form = ob_get_clean(); // Get the output buffer and clean it up
    return $form; // Return the form HTML code
}

// Register the shortcode
function widget_shortcode()
{
    add_shortcode('widget', 'widget_form');
}
add_action('init', 'widget_shortcode');
add_action('admin_post_booking_form', 'handle_booking_form');
add_action('admin_post_nopriv_booking_form', 'handle_booking_form');

function handle_booking_form()
{
    $location = $_POST['location'];
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($location) . "&key={YOUR API KEY}";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);

    $latitude = $response['results'][0]['geometry']['location']['lat'];
    $longitude = $response['results'][0]['geometry']['location']['lng'];

    $check_in_date = (explode(" - ", $_POST['check_in_date'])[0]);
    $check_out_date = (explode(" - ", $_POST['check_in_date'])[1]);

    $check_in_date = str_replace("-", '', $check_in_date);
    $check_out_date = str_replace("-", '', $check_out_date);

    $number_of_persons = $_POST['number_of_persons'];

    //Modify the url how it would work best for you
    $api_link = "{URL}/rooms?number_of_persons=$number_of_persons&check_in_date=$check_in_date&check_out_date=$check_out_date?lat=$latitude&?long=$longitude";
    wp_redirect($api_link);
    exit();
}



?>