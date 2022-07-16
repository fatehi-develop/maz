<?php

if (!function_exists('websima_pagination')) {
	function websima_pagination($query = null)
	{
		$args = array(
			'type' => 'list',
			'prev_text' => "<i class='icon-chevron-thin-right'></i>",
			'next_text' => "<i class='icon-chevron-thin-left'></i>",
		);
		if ($query != '') $args['total'] = $query->max_num_pages;
		echo paginate_links($args);
	}
}

if (!function_exists('websima_socials')) {
	function websima_socials(){
		$socials = '';
		$fields = get_field_object('social_wbs', 'option');
		if ($fields) {
			foreach ($fields['value'] as $key => $value) {
				if ($value) {
					$socials .= "<a href='" . $value . "' target='_blank' rel='nofollow noopener noreferrer' title='" . ucfirst($key) . "'><i class='icon-" . $key . "'></i></a>" . PHP_EOL;
				}
			}
			echo $socials;
		}
	}
}


if (!function_exists('websima_shares')) {
	function websima_shares()
	{
		$title = urlencode(get_the_title());
		$url = urlencode(get_permalink());
		$homeurl = urlencode(get_bloginfo('url'));
		$share = '';
		$share .= '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '&amp;t=' . $title . '" title="Share on Facebook" target="_blank" rel="noreferrer nofollow noopener"><i class="icon-facebook"></i></a>';
		$share .= '<a href="https://twitter.com/intent/tweet?source=' . $url . '&amp;text=' . $title . ':' . $homeurl . '" target="_blank" title="Tweet" rel="noreferrer nofollow noopener"><i class="icon-twitter"></i></a>';
		$share .= '<a href="https://telegram.me/share/url?url=' . $url . '&amp;text=' . $title . ':' . $homeurl . '" title="telegram" rel="noreferrer nofollow noopener" target="_blank"><i class="icon-telegram"></i></a>';
		$share .= '<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=' . $url . '&amp;title=' . $title . '&amp;source=' . $homeurl . '" target="_blank" title="Share on LinkedIn" rel="noreferrer nofollow noopener" ><i class="icon-linkedin"></i></a>';
		$share .= '<a href="whatsapp://send?text=' . $url . '" data-action="share/whatsapp/share" title="whatsapp" rel="noreferrer nofollow noopener" target="_blank"><i class="icon-whatsapp"></i></a>';
		return $share;
	}
}


/* Create Post type  */
add_action('init', 'websima_cpt_init');
function websima_cpt_init(){
	$contact_labels = array(
		'name'                => _x('پیام ها', 'Post Type General Name', 'websima'),
		'singular_name'       => _x('پیام', 'Post Type Singular Name', 'websima'),
		'menu_name'           => __('فرم تماس', 'websima'),
		'all_items'           => __('همه پیام ها', 'websima'),
		'view_item'           => __('', 'websima'),
		'add_new_item'        => __('افزودن پیام جدید', 'websima'),
		'add_new'             => __('افزودن پیام جدید', 'websima'),
		'edit_item'           => __('ویرایش پیام', 'websima'),
		'update_item'         => __('بروزرسانی پیام', 'websima'),
		'search_items'        => __('جستجو پیام', 'websima'),
	);

	$contact_args = array(
		'label'               => __('پیام ها', 'websima'),
		'description'         => __('پیام ها', 'websima'),
		'labels'              => $contact_labels,
		'show_in_rest'        => true,
		'supports'            => array('title', 'custom-fields',),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'       => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => false,
		'capability_type'     => 'page',
		'rewrite'             => false,
		'query_var'             => false,
	);
	register_post_type('contact', $contact_args);
}



/* FAQs with category */
if (!function_exists('websima_faq_cat')) {
	function websima_faqs_cat()
	{
		$faqs = get_field('faqs_cat');
		if ($faqs) {
			$i = 1;
			$j = 1;
			echo '<ul class="faq-cats tab-links faq-carousel owl-carousel space-nav">';
			foreach ($faqs as $faq) :
				$clasees = (1 == $i) ? 'active' : '';
				if ($faq['cat'] != '') {
					echo '<li class="faq-cat ' . $clasees . '">';
						echo '<a href="#tab' . $i . '">';
						if ($faq['img_cat']) echo wp_get_attachment_image($faq['img_cat'], 'thumbnail');
						if ($faq['cat']) echo '<span>' . $faq['cat'] . '</span>';
						echo '</a>';
					echo '</li>';
				}
				$i++;
			endforeach;
			echo '</ul>';
			echo '<div class="faqs-content">';
			foreach ($faqs as $faq) :
				$k = 1;
				$faq_items = $faq['faqs'];
				$clasees = ($j == 1) ? 'in active' : ' ';
				echo '<div class="tab-content faq-content fade ' . $clasees . '" id="tab' . $j . '">';
				if ($faq_items != null) {
					foreach ($faq_items as $faq_item) :
						echo '<div class="faqs-item">';
							echo '<div class="faqs-question accordion" >';
								echo '<b class="faq-num">' . sprintf("%02d", $k) . '</b>';
								echo $faq_item['question'];
								echo '<i class="icon-arrow-bottom"></i>';
							echo '</div>';
							echo '<div class="faqs-answer accordion-content">';
								echo '<div class="editor-content main-content">';
							    	echo $faq_item['answer'];
								echo '</div>';
							echo '</div>';
						echo '</div>';
						$k++;
					endforeach;
				} else {
					if (is_user_logged_in() && current_user_can('administrator')) {
						echo '<p>محتوایی برای این بخش در نظر گرفته نشده است، از پنل مدیریت سوالات را وارد کنید.</p>';
					} else {
						echo '<p>متاسفانه هنوز محتوایی برای این بخش در نظر گرفته نشده است.</p>';
					}
				}
				echo '</div>';
				$j++;
			endforeach;
			echo '</div>';
		}
	}
}

/* FAQs without category */
if (!function_exists('websima_faq')) {
	function websima_faqs($term = null, $title = null)
	{
		$faqs = get_field('faqs');

		if ($term != null) {
			$faqs = get_field('faqs', $term);
		}
		if (get_sub_field('faqs')) {
			$faqs = get_sub_field('faqs');
		}
		if ($title == 'true' && $faqs) {
			echo '<div class="title-site faq-title mb-3">';
			echo '<h4 class="title-heading">سوالات متداول</h4>';
			echo '</div>';
		}
		if ($faqs) {
			$j = 1;
			echo '<div class="faqs-content">';
			foreach ($faqs as $faq) :
				$clasees = ($j == 1) ? 'in active' : ' ';
				echo '<div class="faqs-item">';
					echo '<div class="faqs-question accordion" >';
						echo '<b class="faq-num">' . sprintf("%02d", $j) . '</b>';
						echo $faq['question'];
						echo '<i class="icon-arrow-bottom"></i>';
					echo '</div>';
					echo '<div class="faqs-answer accordion-content">';
							echo '<div class="editor-content main-content">';
							    echo $faq['answer'];
					        echo '</div>';
					echo '</div>';
				echo '</div>';
				$j++;
			endforeach;
			echo '</div>';
		}
	}
}

/* map */

if (!function_exists('websima_map')) {
	function websima_custom_map($map_type)
	{
		if ($map_type == 'single') {
			/* Show one locations on a map */
			if (have_rows('branch_repeater')) :
				$counter = 1;
				while (have_rows('branch_repeater')) : the_row();
					$location = get_sub_field('location');
					$marker = get_sub_field('marker');
					$name = get_sub_field('name');
					$show_google_dir = get_sub_field('show_google_dir');
					$show_waze = get_sub_field('show_waze');

					$location = explode(",", $location);
					$lat = $location[0];
					$lng = $location[1];
					if ($lat == '') {
						$lat = esc_attr('35.7315026');
					}
					if ($lng == '') {
						$lng = esc_attr('51.3743093');
					}

					if ($marker == '') {
						$marker = get_template_directory_uri() . '/includes/websima-map/assets/images/websima-marker.png';
					}
					echo '<div class="row">';
					echo '<div class="col-12 col-md-6">';
					get_template_part('includes/websima-map/template-part/info');
					echo '<div class="social-links">';
					echo '<span>ما را در شبکه های اجتماعی دنبال کنید</span>';
					websima_socials();
					echo '</div>';
					echo '</div>';
					echo '<div class="col-12 col-md-6">';
					if ($lat and $lng) {
						echo '<div id="websima-map-' . esc_attr($counter) . '" class="websima-map">';
						echo '<div class="marker" data-lat="' . esc_attr($lat) . '" data-lng="' . esc_attr($lng) . '" data-marker="' . esc_url($marker) . '"></div>';
						echo '</div>';
					}
					/* direction link */
					echo '<div class="contact-dir-button">';
					if ($show_google_dir) :
						echo '<a href="https://www.waze.com/ul?ll=' . $lat . '%2C ' . $lng . '&amp;navigate=yes" class="button waze" target="_blank" rel="nofollow" >Waze map</a>';
					endif;
					if ($show_waze) :
						echo '<a href="https://www.google.com/maps/dir/?api=1&amp;destination=' . $lat . ', ' . $lng . '" class="button google-map" target="_blank" rel="nofollow"> Google Maps</a>';
					endif;
					echo '</div>';
					echo '</div>';
					echo '</div>';

					$counter++;
				endwhile;
			endif;
		} elseif ($map_type == 'cluster') {
			/* Show multiple locations on a map */
			if (have_rows('branch_repeater')) :
				$counter = 1;
				$accordion_counter = 1;
				echo '<div class="row">';
				echo '<div class="col-12 col-md-6">';
				echo '<div id="websima-map-' . esc_attr($counter) . '" class="websima-map">';
				while (have_rows('branch_repeater')) : the_row();
					$location = get_sub_field('location');
					$marker = get_sub_field('marker');
					if ($marker == '') {
						$marker = get_template_directory_uri() . '/includes/websima-map/assets/images/websima-marker.png';
					}

					$location = explode(",", $location);
					$lat = $location[0];
					$lng = $location[1];
					if ($lat == '') {
						$lat = esc_attr('35.7315026');
					}
					if ($lng == '') {
						$lng = esc_attr('51.3743093');
					}

					echo '<div class="marker" data-lat="' . esc_attr($lat) . '" data-lng="' . esc_attr($lng) . '" data-marker="' . esc_url($marker) . '"></div>';

				endwhile;
				echo '</div>';
				echo '</div>';
				echo '<div class="col-12 col-md-6">';
				echo '<div  id="contactaccordion">';
				while (have_rows('branch_repeater')) : the_row();
					$name = get_sub_field('name');
					$show_google_dir = get_sub_field('show_google_dir');
					$show_waze = get_sub_field('show_waze');

					$location = get_sub_field('location');
					$location = explode(",", $location);
					$lat = $location[0];
					$lng = $location[1];
					if ($lat == '') {
						$lat = esc_attr('35.7315026');
					}
					if ($lng == '') {
						$lng = esc_attr('51.3743093');
					}

					echo '<div class="card">';
					echo '<div class="accordion card-header">';
						echo '<h2>';
							echo '<div class="accordion-title" >';
							echo esc_html($name);
							echo '</div>';
							echo'<i class="icon-arrow-bottom"></i>';
						echo '</h2>';
					echo '</div>';

					echo '<div class="accordion-content">';
					echo '<div class="card-body">';
					get_template_part('includes/websima-map/template-part/info');
					/* direction link */
					echo '<div class="contact-dir-button">';
					if ($show_google_dir) :
						echo '<a href="https://www.waze.com/ul?ll=' . $lat . '%2C ' . $lng . '&amp;navigate=yes" class="button waze" target="_blank" rel="nofollow" >Waze map</a>';
					endif;
					if ($show_waze) :
						echo '<a href="https://www.google.com/maps/dir/?api=1&amp;destination=' . $lat . ', ' . $lng . '" class="button google-map" target="_blank" rel="nofollow"> Google Maps</a>';
					endif;
					echo '</div>';
					echo '</div>';
					echo '</div>';
					echo '</div>';

					$accordion_counter++;
				endwhile;
				echo '</div>';
				echo '</div>';
				echo '</div>';
			endif;
		} elseif ($map_type == 'tab') {
			/* Show tab locations on a map */
			if (have_rows('branch_repeater')) :
				$counter = 1;
				$tab_title_counter = 1;
				$tab_content_counter = 1;
				echo '<ul class="tab-links" id="contact-tab" role="tablist">';
				while (have_rows('branch_repeater')) : the_row();
					$name = get_sub_field('name');
					echo '<li class="nav-item ' . (($tab_title_counter == 1) ? 'active' : '') . '">';
					echo '<a class="nav-link" data-toggle="tab" href="#tab_' . esc_attr($tab_title_counter) . '" role="tab" aria-controls="tab_' . esc_attr($tab_title_counter) . '" aria-selected="' . (($tab_title_counter == 1) ? 'true' : 'false') . '">';
					echo esc_html($name);
					echo '</a>';
					echo '</li>';

					$tab_title_counter++;
				endwhile;
				echo '</ul>';

				echo '<div id="contact-tab-content">';
				while (have_rows('branch_repeater')) : the_row();
					$location = get_sub_field('location');
					$marker = get_sub_field('marker');
					$show_google_dir = get_sub_field('show_google_dir');
					$show_waze = get_sub_field('show_waze');

					if ($marker == '') {
						$marker = get_template_directory_uri() . '/includes/websima-map/assets/images/websima-marker.png';
					}

					$location = explode(",", $location);
					$lat = $location[0];
					$lng = $location[1];
					if ($lat == '') {
						$lat = esc_attr('35.7315026');
					}
					if ($lng == '') {
						$lng = esc_attr('51.3743093');
					}

					echo '<div class="tab-content fade ' . (($tab_content_counter == 1) ? ' active' : '') . '" id="tab_' . esc_attr($tab_content_counter) . '" role="tabpanel" >';
					echo '<div class="row">';
					echo '<div class="col-12 col-md-6">';
					if ($lat and $lng) {
						echo '<div id="websima-map-' . esc_attr($counter) . '" class="websima-map">';
						echo '<div class="marker" data-lat="' . esc_attr($lat) . '" data-lng="' . esc_attr($lng) . '" data-marker="' . esc_url($marker) . '"></div>';
						echo '</div>';
					}
					/* direction link */
					echo '<div class="contact-dir-button">';
					if ($show_google_dir) :
						echo '<a href="https://www.waze.com/ul?ll=' . $lat . '%2C ' . $lng . '&amp;navigate=yes" class="button waze" target="_blank" rel="nofollow" >Waze map</a>';
					endif;
					if ($show_waze) :
						echo '<a href="https://www.google.com/maps/dir/?api=1&amp;destination=' . $lat . ', ' . $lng . '" class="button google-map" target="_blank" rel="nofollow"> Google Maps</a>';
					endif;
					echo '</div>';
					echo '</div>';

					echo '<div class="col-12 col-md-6">';
					get_template_part('includes/websima-map/template-part/info');
					echo '</div>';

					echo '</div>';
					echo '</div>';

					$counter++;
					$tab_content_counter++;
				endwhile;
				echo '</div>';
			endif;
		}
	}
}


/* Contact function */

/* acf contact form */
if (!function_exists('websima_contact_form')) {
	function websima_contact_form()
	{
		$setting = array(
			'id'    =>     12,
			'post_id'		=> 'new_post',
			'post_title'	=> false,
			'post_content' => false,
			'submit_value'	=> 'ارسال',
			'updated_message' => __("از پیام شما متشکریم، پیام شما با موفقیت ارسال شد.", 'acf'),
			'html_submit_button'	=> '<button type="submit" class="acf-button button" value="%s">ارسال</button>',
			'new_post'		=> array(
				'post_type'		=> 'contact',
				'post_status'	=> 'draft'
			),
		);
		acf_form($setting);
	}


	add_action('acf/save_post', 'send_email_cform');
	function send_email_cform($post_id){
		if (get_post_type($post_id) !== 'contact') {
			return;
		}
		if (is_admin()) {
			return;
		}
		/* change name of post in cform */
		$content = array(
			'ID' => $post_id,
			'post_title' => 'پیام-' . $post_id . ''
		);
		wp_update_post($content);

		$page_id = websima_find_page_id('templates/template-contact.php');
		$name = get_field('name_cform', $post_id);
		$email = get_field('email_cform', $post_id);
		$subject = 'فرم تماس با ما';
		$body = get_field('comment_cform', $post_id);
		$to = get_field('emailsend_cform', $page_id);
		$headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n";


		// send email
		wp_mail($to, $subject, $body, $headers);
	}
}


if (!function_exists('remove_editor')) {
	function remove_editor()
	{
		if (isset($_GET['post'])) {
			$id = $_GET['post'];
			$template = get_post_meta($id, '_wp_page_template', true);
			switch ($template) {
				case 'templates/template-home.php':
					remove_post_type_support('page', 'editor', 'thumbnail');
					break;
				default:
					// Don't remove any other template.
					break;
			}
		}
	}
	add_action('init', 'remove_editor');
}

/* add to upload svg */

function add_file_types_to_uploads($file_types)
{
	if (is_admin()) {
		$new_filetypes = array();
		$new_filetypes['svg'] = 'image/svg+xml';
		$file_types = array_merge($file_types, $new_filetypes);
	}
	return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');



if (!function_exists('websima_layouts_page_builder')) {
	function websima_layouts_page_builder($exclude = array())
	{
		global $wp_query;
		$post_id = null;
		if ($wp_query->is_archive()) {
			$term = get_queried_object();
			$post_id = $term->taxonomy . '_' . $term->term_id;
		}
		$layouts = array('feature', 'categories', 'products', 'counter', 'content', 'blog', 'banner', 'brands', 'faq', 'cta', 'testimonial', 'hero', 'teams');
		if ($exclude != null) {
			$layouts = array_diff($layouts, $exclude);
		}
		if (have_rows('home_layouts', $post_id)) :
			while (have_rows('home_layouts', $post_id)) : the_row();
				foreach ($layouts as $layout) {
					if ($layout == get_row_layout()) {
						get_template_part('template-parts/home/section', $layout);
					}
				}
			endwhile;
		endif;
	}
}
add_action('admin_head', function () {
	add_filter('acf/load_field/name=home_layouts', 'websima_hide_layouts_page_builder');
	function websima_hide_layouts_page_builder($field)
	{
		$screen = get_current_screen();
		if ($screen->base == 'term') {
			foreach ($field['layouts'] as $layout_key => $layout) {
				$layouts = $field['layouts'];
				$field['layouts'] = array();
				$remove = array('counter', 'teams', 'blog', 'feature');
				foreach ($layouts as $k => $layout) {
					$name = $layout['name'];
					if (!in_array($name, $remove)) {
						$field['layouts'][$layout['name']] = $layout;
					}
				}
			}
		}
		return $field;
	}
});

function acf_load_deliverables($field)
{
	$field = array();
	if (get_row_layout() == "listproducts") {

		$field = array(
			array(
				'acf_fc_layout' => 'listproducts',

			)
		);
	}

	return $field;
}
//add_filter('acf/load_field/name=home_layouts', 'acf_load_deliverables');


add_filter('the_content', 'add_id_heading_content');
function add_id_heading_content($content)
{
	global $post;
	if (is_single()) {
		if (get_field('help_post', $post->ID)) {
			// Add ID to heading
			$content = preg_replace_callback("/\<h([2])\>(.*?)\<\/h([2])\>/", function ($matches) {
				static $i = 1;
				$hTag = $matches[1];
				$title = $matches[2];
				return '<h' . $hTag . ' id="section-' . $i++ . '">' . $title . '</h' . $hTag . '>';
			}, $content);
			//var_dump($content);
		}
	}
	return $content;
}



add_filter('the_content', 'filter_scroll_heading_content');
function filter_scroll_heading_content($content)
{
	global $post;
	if (is_single()) {
		if (get_field('help_post', $post->ID)) {
			// Make Help Box by headings
			$find_heading = preg_match_all('/<h2 ?.*>(.*)<\/h2>/i', $content, $finds);
			if (is_array($finds)) {
				unset($finds[0]);
				$help_heading = '';
				$help_heading .= '<div class="help-heading"><span>آنچه در این مقاله میخوانید</span><ul>';
				$i = 1;
				foreach ($finds[1] as $heading) {
					$num = $i++;
					$help_heading .= "<li><a href='#section-" . $num . "'>" . $heading . "</a></li>";
				}
				$help_heading .= "</ul></div>";
			}
			add_action('single_help_post', function () use ($help_heading) {
				echo $help_heading;
			});
		}
	}
	remove_filter('the_content', 'filter_scroll_heading_content');
	return $content;
}

if (!function_exists('websima_banner_show')) {
	function websima_banner_show($item, $col)
	{
		echo "<div class='" . $col . "'>";
		echo "<a class='item-banner' href='" . $item['url'] . "' target='_blank'>";
		echo wp_get_attachment_image($item['image'], 'full');
		echo "</a>";
		echo "</div>";
	}
}
function wpdocs_custom_excerpt_length($length)
{
	return 20;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);
/**
 * Find page id.
 */
if (!function_exists('websima_find_page_id')) {
	function websima_find_page_id($redirect_slug)
	{
		$template_page_property_comparison_array = get_pages(
			array(
				'meta_key' => '_wp_page_template',
				'meta_value' => $redirect_slug
			)
		);
		if ($template_page_property_comparison_array) {
			return $template_page_property_comparison_array[0]->ID;
		} else {
			return 0;
		}
	}
}
add_filter( 'wpseo_breadcrumb_links', 'wbs_breadcrumb_detail' );

function wbs_breadcrumb_detail( $links ) {

    if(is_singular( 'post' )){
        $breadcrumb[] = array(
            'url' => get_permalink( websima_find_page_id('templates/template-blog.php') ),
            'text' => 'آرشیو مقالات',
        );
        array_splice( $links, 1, -2, $breadcrumb );
    }
    
    return $links;
}
