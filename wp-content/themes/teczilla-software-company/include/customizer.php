<?php
function teczilla_software_company_sections_settings( $wp_customize ) {
    $wp_customize->remove_setting( 'teczilla_menubar_bg_color' );
     $wp_customize->remove_setting( 'teczilla_menu_item_color' );
      $wp_customize->remove_setting( 'teczilla_menu_item_hover_color' );
       $wp_customize->remove_setting( 'teczilla_menu_link_bg_color' );
       $wp_customize->remove_setting( 'teczilla_submnubg_scheme' );
        $wp_customize->remove_setting( 'teczilla_submnu_link' );
        $wp_customize->remove_section( 'teczilla_top_header' );
        $wp_customize->remove_control('blogdescription');

        
        $wp_customize->add_setting('teczilla_theme_color_scheme',array(
        'default' => esc_html__('#67c27c','teczilla-software-company'),
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    
    $wp_customize->add_control(
        new WP_Customize_Color_Control($wp_customize,'teczilla_theme_color_scheme',array(
            'label' => esc_html__('Theme Color','teczilla-software-company'),           
            'description' => esc_html__('Change Theme Color','teczilla-software-company'),
            'section' => 'colors',
            'settings' => 'teczilla_theme_color_scheme'
        ))
    );


    $wp_customize->add_section('teczilla_main_top_header',array(
            'title' => esc_html__('Top Header','teczilla-software-company'),
            'panel' => 'section_settings',
            'priority'       => 7,
            ));

$wp_customize->add_setting('teczilla_top_header_enable',
        array(
            'sanitize_callback' => 'teczilla_sanitize_checkbox',
            'default'           => 1,
        )
    );
    $wp_customize->add_control('teczilla_top_header_enable',
        array(
            'type'        => 'checkbox',
            'label'       => esc_html__('Enable Top Header Section?', 'teczilla-software-company'),
            'section'     => 'teczilla_main_top_header',
            'description' => esc_html__('Check this box to Enable Top Header section.', 'teczilla-software-company'),
        )
    );

    for( $i = 1; $i <=4; $i++ ){
        $wp_customize->add_setting(
            'teczilla_service_page_icon'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'teczilla_sanitize_text'
            )
        );

        $wp_customize->add_control(
            new Avadanta_Fontawesome_Icon_Chooser(
                $wp_customize,
                'teczilla_service_page_icon'.$i,
                array(
                    'settings'      => 'teczilla_service_page_icon'.$i,
                    'section'       => 'teczilla_main_top_header',
                    'type'          => 'icon',
                    'label'         => esc_html__( 'Social Media Icon', 'teczilla-multipurpose' )
                )
            )
        );

          $wp_customize->add_setting(
            'teczilla_service_page_url'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'teczilla_sanitize_text'
            )
        );

        $wp_customize->add_control(
                'teczilla_service_page_url'.$i,
                array(
                    'settings'      => 'teczilla_service_page_url'.$i,
                    'section'       => 'teczilla_main_top_header',
                    'type'          => 'url',
                    'label'         => esc_html__( 'Social Media Icon url', 'teczilla-multipurpose' )
                
            )
        );
    }



    // Navigation Button
    $wp_customize->add_setting('teczilla_header_mail',   
        array(
            'sanitize_callback' => 'teczilla_sanitize_text',
            'default'           => '',
            ));

    $wp_customize->add_control('teczilla_header_mail',
        array(
            'label'       => esc_html__('Header Email', 'teczilla-software-company'),
            'section'     => 'teczilla_main_top_header',
            'type'        => 'text',
        )
    );

    $wp_customize->add_setting('teczilla_header_phone',   
        array(
            'sanitize_callback' => 'teczilla_sanitize_text',
            'default'           => '',
            ));

    $wp_customize->add_control('teczilla_header_phone',
        array(
            'label'       => esc_html__('Header Contact', 'teczilla'),
            'section'     => 'teczilla_main_top_header',
            'type'        => 'text',
        )
    );

    $wp_customize->add_setting('teczilla_header_address',   
        array(
            'sanitize_callback' => 'teczilla_sanitize_text',
            'default'           => '',
            ));

    $wp_customize->add_control('teczilla_header_address',
        array(
            'label'       => esc_html__('Header Address', 'teczilla-software-company'),
            'section'     => 'teczilla_main_top_header',
            'type'        => 'text',
        )
    );

}
add_action( 'customize_register', 'teczilla_software_company_sections_settings', 30);