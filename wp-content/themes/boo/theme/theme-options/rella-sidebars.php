<?php
/*
 * Sidebar Section
*/

$this->sections[] = array(
	'title' => esc_html__( 'Sidebars', 'boo' ),
	'icon'  => 'el-icon-photo'
);

// Page Sidebar
$this->sections[] = array(
	'title'      => esc_html__( 'Page', 'boo' ),
	'subsection' => true,
	'fields' => array(

		array(
			'id'       => 'page-enable-global',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Activate Global Sidebar For Pages', 'boo' ),
			'subtitle' => esc_html__( 'Turn on if you want to use the same sidebars on all pages. This option overrides the page options.', 'boo' ),
			'options'  => array(
				'on'  => 'On',
				'off' => 'Off'
			),
			'default' => 'off'
		),
		array(
			'id'       => 'page-sidebar-enable-sticky',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Sticky Sidebar For Pages', 'boo' ),
			'subtitle' => esc_html__( 'Turn on if you want to add sticky effect for sidebars on all pages. This option overrides the page options.', 'boo' ),
			'options'  => array(
				'on'  => 'On',
				'off' => 'Off'
			),
			'default' => 'off'
		),
		array(
			'id'       => 'page-sidebar-one',
			'type'     => 'select',
			'title'    => esc_html__( 'Global Page Sidebar', 'boo' ),
			'subtitle' => esc_html__( 'Select sidebar that will display on all pages.', 'boo' ),
			'data'     => 'sidebars'
		),
		array(
			'id'       => 'page-sidebar-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Global Page Sidebar Position', 'boo' ),
			'subtitle' => esc_html__( 'Controls the position of sidebar for all pages.', 'boo' ),
			'options'  => array(
				'left' => esc_html__( 'Left', 'boo' ),
				'right' => esc_html__( 'Right', 'boo' )
			),
			'default' => 'right'
		)
	)
);

// Portfolio Sidebar
$this->sections[] = array(
	'title'      => esc_html__( 'Portfolio Posts', 'boo' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'portfolio-enable-global',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Activate Global Sidebar For Portfolio Posts', 'boo' ),
			'subtitle' => esc_html__( 'Turn on if you want to use the same sidebars on all portfolio posts. This option overrides the portfolio options.', 'boo' ),
			'options' => array(
				'on'  => 'On',
				'off' => 'Off'
			),
			'default' => 'off'
		),
		array(
			'id'       => 'portfolio-sidebar-enable-sticky',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Sticky Sidebar For Portfolio Posts', 'boo' ),
			'subtitle' => esc_html__( 'Turn on if you want to add sticky effect for sidebars on all portfolios posts. This option overrides the portfolio options.', 'boo' ),
			'options'  => array(
				'on'  => 'On',
				'off' => 'Off'
			),
			'default' => 'off'
		),
		array(
			'id'       => 'portfolio-sidebar-one',
			'type'     => 'select',
			'title'    => esc_html__( 'Global Portfolio Posts Sidebar', 'boo' ),
			'subtitle' => esc_html__( 'Select sidebar that will display on all portfolio posts.', 'boo' ),
			'data'     => 'sidebars'
		),
		array(
			'id'       => 'portfolio-sidebar-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Global Portfolio Sidebar Position', 'boo' ),
			'subtitle' => esc_html__( 'Controls the position of the sidebar for all portfolio posts.', 'boo' ),
			'options'  => array(
				'left'  => esc_html__( 'Left', 'boo' ),
				'right' => esc_html__( 'Right', 'boo' )
			),
			'default' => 'right'
		)
	)
);

// Portfolio Archive Sidebar
$this->sections[] = array(
	'title'      => esc_html__( 'Portfolio Archive', 'boo' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'portfolio-archive-sidebar-enable-sticky',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Sticky Sidebar For Portfolio Archive', 'boo' ),
			'subtitle' => esc_html__( 'Turn on if you want to add sticky effect for sidebars on all portfolios archives.', 'boo' ),
			'options'  => array(
				'on'  => 'On',
				'off' => 'Off'
			),
			'default' => 'off'
		),
		array(
			'id'       => 'portfolio-archive-sidebar-one',
			'type'     => 'select',
			'title'    => esc_html__( 'Portfolio Archive Sidebar', 'boo' ),
			'subtitle' => esc_html__( 'Select sidebar that will display on the portfolio archive pages.', 'boo' ),
			'data' => 'sidebars'
		),
		array(
			'id'       => 'portfolio-archive-sidebar-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Global Portfolio Archive Sidebar Position', 'boo' ),
			'subtitle' => esc_html__( 'Controls the position of the sidebar for portfolio archive pages.', 'boo' ),
			'options'  => array(
				'left'  => esc_html__( 'Left', 'boo' ),
				'right' => esc_html__( 'Right', 'boo' )
			),
			'default' => 'right'
		)
	)
);

// Blog Posts Sidebar
$this->sections[] = array(
	'title'      => esc_html__( 'Blog Posts', 'boo' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'blog-enable-global',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Activate Global Sidebar For Blog Posts', 'boo' ),
			'subtitle' => esc_html__( 'Turn on if you want to use the same sidebars on all blog posts. This option overrides the blog options.', 'boo' ),
			'options'  => array(
				'on'  => 'On',
				'off' => 'Off'
			),
			'default' => 'off'
		),
		array(
			'id'       => 'blog-sidebar-enable-sticky',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Sticky Sidebar For blog posts', 'boo' ),
			'subtitle' => esc_html__( 'Turn on if you want to add sticky effect for sidebars on all blog posts. This option overrides the blog options.', 'boo' ),
			'options'  => array(
				'on'  => 'On',
				'off' => 'Off'
			),
			'default' => 'off'
		),
		array(
			'id'       => 'blog-sidebar-one',
			'type'     => 'select',
			'title'    => esc_html__( 'Global Blog Posts Sidebar', 'boo' ),
			'subtitle' => esc_html__( 'Select sidebar that will display on all blog posts.', 'boo' ),
			'data'     => 'sidebars'
		),
		array(
			'id'       => 'blog-sidebar-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Global Blog Sidebar Position', 'boo' ),
			'subtitle' => esc_html__( 'Controls the position of the sidebar for all blog posts.', 'boo' ),
			'options'  => array(
				'left' => esc_html__( 'Left', 'boo' ),
				'right' => esc_html__( 'Right', 'boo' )
			),
			'default' => 'right'
		)
	)
);

// Blog Archive Sidebar
$this->sections[] = array(
	'title'      => esc_html__( 'Blog Archive', 'boo' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'blog-archive-sidebar-enable-sticky',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Sticky Sidebar For blog archives', 'boo' ),
			'subtitle' => esc_html__( 'Turn on if you want to add sticky effect for sidebars on blog archives.', 'boo' ),
			'options'  => array(
				'on'  => 'On',
				'off' => 'Off'
			),
			'default' => 'off'
		),
		array(
			'id'       => 'blog-archive-sidebar-one',
			'type'     => 'select',
			'title'    => esc_html__( 'Blog Archive Sidebar ', 'boo' ),
			'subtitle' => esc_html__( 'Select sidebar that will display on the blog archive pages.', 'boo' ),
			'data'     => 'sidebars'
		),
		array(
			'id'       => 'blog-archive-sidebar-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Global Blog Archive Sidebar Position', 'boo' ),
			'subtitle' => esc_html__( 'Controls the position of the sidebar for blog archive pages.', 'boo' ),
			'options'  => array(
				'left' => esc_html__( 'Left', 'boo' ),
				'right' => esc_html__( 'Right', 'boo' )
			),
			'default' => 'right'
		)
	)
);

// Search page Sidebar
$this->sections[] = array(
	'title'      => esc_html__('Search Page', 'boo'),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'seach-sidebar-enable-sticky',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Sticky Sidebar For search page', 'boo' ),
			'subtitle' => esc_html__( 'Turn on if you want to add sticky effect for sidebar on search result page', 'boo' ),
			'options'  => array(
				'on'  => 'On',
				'off' => 'Off'
			),
			'default' => 'off'
		),
		array(
			'id'       => 'search-sidebar-one',
			'type'     => 'select',
			'title'    => esc_html__( 'Search Page Sidebar', 'boo' ),
			'subtitle' => esc_html__( 'Select the sidebar that will display on the search results page.', 'boo' ),
			'data'     => 'sidebars'
		),
		array(
			'id'       => 'search-sidebar-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Search Sidebar Position', 'boo' ),
			'subtitle' => esc_html__( 'Controls the position of the sidebar for the search results page.', 'boo' ),
			'options'  => array(
				'left'  => esc_html__( 'Left', 'boo' ),
				'right' => esc_html__( 'Right', 'boo' )
			),
			'default' => 'right'
		)
	)
);

rella_action( 'option_sidebars', $this );