<?php

function  photographe_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'sec_hero',
        array(
            'title' => __( 'Home section', 'photographe' ),
            'priority' => 30
        )
    );

//title H1 home
    $wp_customize->add_setting(
        'set_hero_title',
        array(
            'type' => 'theme_mod',
            'default' => 'Please, add some title',
            'sanitize_callback' => 'sanitize_textarea_field'
        )
    );

    $wp_customize->add_control(
        'set_hero_title',
        array(
            'label' => 'Home Title',
            'description' => 'Please, type your title here',
            'section' => 'sec_hero',
            'type' => 'textarea'
        )
    );    

// color h1 home
    $wp_customize->add_setting( 'colors' , array(
        'default'   => '',
        'transport' => 'refresh',
    ) );
    
    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 'link_color', 
                array(
                    'label'    => __( 'H1 Color', 'photographe' ),
                    'description' => 'Please, chose your title and subtitle color',
                    'section'  => 'sec_hero',
                    'settings' => 'colors'
            ) 
        ) 
    );

// color background home

    $wp_customize->add_setting( 'colorsbg' , array(
        'default'   => '#fff',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 'link_color_bg', 
                array(
                    'label'    => __( 'Background Color', 'photographe' ),
                    'section'  => 'sec_hero',
                    'settings' => 'colorsbg'
                ) 
        ) 
    );

// home img

    $wp_customize->add_setting(
        'set_hero_background',
        array(
            'type' => 'theme_mod',
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize,
        'set_hero_background',
            array(
                'label' => 'Home Image',
                'section'   => 'sec_hero',
                'mime_type' => 'image'
            )
        )
    );


}

add_action( 'customize_register', 'photographe_customizer' );