<?php
add_action('init','of_options');

if (!function_exists('of_options'))
{

    function of_options()
    {

        /*
        *	Theme Shortname
        */
        $themename = "theme";
        $shortname = "theme";

        /*
        *	Populate the options array
        */
        global $tt_options;

        $tt_options = get_option('of_options');

       

        /*-----------------------------------------------------------------------------------*/
        /* Create The Custom Theme Options Panel
        /*-----------------------------------------------------------------------------------*/
        $options = array(); // do not delete this line - sky will fall
  
        /* Option Page - Header Options */
        $options[] = array( "name" => __('General Settings','themename'),
            "id" => $shortname."_header_heading",
            "type" => "heading");

        $options[] = array( "name" => __('Logo Header','themename'),
        "desc" => __('Upload logo for your Website.','themename'),
        "id" => $shortname."_sitelogo",
        "std" => "",
        "type" => "upload");
        $options[] = array( "name" => __('Logo Footer','themename'),
            "desc" => __('Upload logo for your Website.','themename'),
            "id" => $shortname."_footerlogo",
            "std" => "",
            "type" => "upload");
        $options[] = array( "name" => __('Favicon','themename'),
            "desc" => __('Upload a 16px by 16px PNG image that will represent your website favicon.','themename'),
            "id" => $shortname."_favicon",
            "std" => "",
            "type" => "upload");
        /* Option Page - Social Link */
        $options[] = array( "name" => __('Social Links','themename'),
            "id" => $shortname."_sociallinks_heading",
            "type" => "heading");
        $options[] = array( "name" => __('All social links','themename'),
            "id" => $shortname."_sociallinks",
            "type" => "addremoveblock");
        //Option Page - Phones
        $options[] = array( "name" => __('Phones','themename'),
            "id" => $shortname."_phones_heading",
            "type" => "heading");
        $options[] = array( "name" => __('All phones','themename'),
            "id" => $shortname."_phones",
            "type" => "phonesblock");
        $options[] = array( "name" => __('Contact','themename'),
            "id" => $shortname."_contactus_heading",
            "type" => "heading");
        $options[] = array( "name" => __('Phone Number','themename'),
            "desc" => '',
            "id" => $shortname."_phone",
            "std" => "",
            "type" => "text");
        $options[] = array( "name" => __('E-Mail','themename'),
            "desc" => '',
            "id" => $shortname."_mail",
            "std" => "",
            "type" => "text");
        $options[] = array( "name" => __('Organization Address','themename'),
        "desc" => '',
        "id" => $shortname."_address",
        "std" => "",
        "type" => "text");
        $options[] = array( "name" => __('Map Link','themename'),
            "desc" => '',
            "id" => $shortname."_map_link",
            "std" => "",
            "type" => "text");


        $options = apply_filters('framework_theme_options',$options);

        update_option('of_template',$options);
        update_option('of_themename',$themename);
        update_option('of_shortname',$shortname);

    }
}

?>