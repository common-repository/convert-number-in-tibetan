<?php
/* Admin option page function */

function tbdateformat_options_page() {
     if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
    ?>

    <div>
      
        <h2>Tibetan Date Format</h2>
        <form method="post" action="options.php">

            <?php settings_fields('tbdateformat_settings_group'); ?>
            <?php do_settings_sections('tbdateformat_settings_group'); ?>
            <h4>Select Date Format</h4>
            <table>               
                <tr>
                    <td>

                        <?php
                        /**
                         * Filters the default date formats.
                         *
                         * @since 2.7.0
                         * @since 4.0.0 Added ISO date standard YYYY-MM-DD format.
                         *
                         * @param array $default_date_formats Array of default date formats.
                         */
                       
                        $date_formats = array_unique(apply_filters('date_formats', array(__('F j, Y'), 'Y-m-d', 'm/d/Y', 'd/m/Y', 'ཕྱི་ལོ། Y ཟླ། m ཚེས། d')));
                        $custom = true;

                        foreach ($date_formats as $format) {
                            echo "\t<label><input type='radio' name='date_format' value='" . esc_attr($format) . "'";
                            if (get_option('date_format') === $format) { // checked() uses "==" rather than "==="
                                echo " checked='checked'";
                                //$custom = false;
                            }
                           if($format=='ཕྱི་ལོ། Y ཟླ། m ཚེས། d') 
                               $dateformat = '';
                           else
                               $dateformat= $format;
                            echo ' /> <span class="date-time-text format-i18n">' . date_i18n($format) . '</span><code>' . esc_html($dateformat) . "</code></label><br />\n";
                        }
                        ?>

                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>

    <?php
}

if(is_admin()) {
    add_action('admin_init', 'entotb_register_settings');
    add_action('admin_menu', 'entotb_register_options_page');
}

function entotb_register_settings() {
    register_setting('tbdateformat_settings_group', 'date_format', 'entotb_callback');
}

function entotb_register_options_page() {
    add_options_page('Tibetan Date Format', 'Tibetan Date Format', 'manage_options', 'translate-to-tb', 'tbdateformat_options_page');
}