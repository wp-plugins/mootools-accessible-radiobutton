<?php
/*
Plugin Name: MooTools Accessible Radiobutton
Plugin URI: http://wordpress.org/extend/plugins/mootools-accessible-radiobutton/
Description: WAI-ARIA Enabled Radiobutton Plugin for Wordpress
Author: Kontotasiou Dionysia
Version: 1.0
Author URI: http://www.iti.gr/iti/people/Dionisia_Kontotasiou.html
*/


add_action("plugins_loaded", "MooToolsAccessibleRadiobutton_init");
function MooToolsAccessibleRadiobutton_init() {
    register_sidebar_widget(__('MooTools Accessible Radiobutton'), 'widget_MooToolsAccessibleRadiobutton');
    register_widget_control(   'MooTools Accessible Radiobutton', 'MooToolsAccessibleRadiobutton_control', 200, 200 );
    if ( !is_admin() && is_active_widget('widget_MooToolsAccessibleRadiobutton') ) {
        wp_deregister_script('jquery');

        // add your own script
        wp_register_script('mootools-core', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-radiobutton/lib/mootools-core.js'));
        wp_enqueue_script('mootools-core');

        wp_register_script('mootools-more', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-radiobutton/lib/mootools-more.js'));
        wp_enqueue_script('mootools-more');

        wp_register_style('MooToolsAccessibleRadiobutton_css', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-radiobutton/lib/demo.css'));
        wp_enqueue_style('MooToolsAccessibleRadiobutton_css');

        wp_register_script('MooToolsAccessibleRadiobutton', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-radiobutton/lib/demo.js'));
        wp_enqueue_script('MooToolsAccessibleRadiobutton');
		
		wp_register_script('radiobutton', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-radiobutton/lib/radiobutton.js'));
        wp_enqueue_script('radiobutton');
    }
}

function widget_MooToolsAccessibleRadiobutton($args) {
    extract($args);

    $options = get_option("widget_MooToolsAccessibleRadiobutton");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'MooTools Accessible Radiobutton',
        );
    }

    echo $before_widget;
    echo $before_title;
    echo $options['title'];
    echo $after_title;

    //Our Widget Content
    MooToolsAccessibleRadiobuttonContent();
    echo $after_widget;
}

function MooToolsAccessibleRadiobuttonContent() {

    $options = get_option("widget_MooToolsAccessibleRadiobutton");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'MooTools Accessible Radiobutton',
        );
    }

    echo '
		<div class="sa_demo_contentScreen">
			<form action="" id="MooAccessRadiobutton">
				<p>
					<input type="radio" name="accessible" value="apple" checked>
					<span>Apple</span>
					<br>
					<input type="radio" name="accessible" value="banana">
					<span>Banana</span>
					<br>
					<input type="radio" name="accessible" value="orange">
					<span>Orange</span>
					<br>
					<input type="radio" name="accessible" value="pineapple">
					<span>Pineapple</span>
					<br>
					<input type="radio" name="accessible" value="melon">
					<span>Melon</span>
				</p>
			</form>
		</div>
		';
}

function MooToolsAccessibleRadiobutton_control() {
    $options = get_option("widget_MooToolsAccessibleRadiobutton");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'MooTools Accessible Radiobutton',
        );
    }

    if ($_POST['MooToolsAccessibleRadiobutton-SubmitTitle']) {
        $options['title'] = htmlspecialchars($_POST['MooToolsAccessibleRadiobutton-WidgetTitle']);
        update_option("widget_MooToolsAccessibleRadiobutton", $options);
    }
   
    ?>
    <p>
        <label for="MooToolsAccessibleRadiobutton-WidgetTitle">Widget Title: </label>
        <input type="text" id="MooToolsAccessibleRadiobutton-WidgetTitle" name="MooToolsAccessibleRadiobutton-WidgetTitle" value="<?php echo $options['title'];?>" />
        <input type="hidden" id="MooToolsAccessibleRadiobutton-SubmitTitle" name="MooToolsAccessibleRadiobutton-SubmitTitle" value="1" />
    </p>
   
    <?php
}

?>
