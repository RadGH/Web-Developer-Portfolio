<?php
if( function_exists('acf_add_local_field_group') ):
	
	acf_add_local_field_group(array (
		'key' => 'group_58c24d835ac88',
		'title' => 'Testimonial Information',
		'fields' => array (
			array (
				'key' => 'field_58c24d91b4221',
				'label' => 'Company',
				'name' => 'company',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array (
				'key' => 'field_58c24da3b4222',
				'label' => 'Project',
				'name' => 'project',
				'type' => 'post_object',
				'instructions' => 'Changing this value also assigns this testimonial to the project (two-way).',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array (
					0 => 'project',
				),
				'taxonomy' => array (
				),
				'allow_null' => 1,
				'multiple' => 0,
				'return_format' => 'object',
				'ui' => 1,
			),
			array (
				'key' => 'field_58c24d8cb4220',
				'label' => 'Image',
				'name' => 'image',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'testimonial',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

endif;