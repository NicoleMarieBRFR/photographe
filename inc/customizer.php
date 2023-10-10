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

}

add_action( 'customize_register', 'photographe_customizer' );