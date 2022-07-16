<?php
add_action('init','websima_comment_sms_init');
function websima_comment_sms_init(){
    if( function_exists('acf_add_options_page') ) {
        acf_add_options_sub_page(array(
            'page_title' 	=> 'دیدگاه',
            'menu_title'	=> 'دیدگاه',
            'menu_slug'	    => 'websima-package-comment-sms-settings',
            'parent_slug'	=> 'websima-package-general-settings',
            'capability'	=> 'edit_posts'
        ));
    }
}

/**
 * Mobile validation.
 */
function websima_comment_sms_mobile_validation($mobile){
    if(strlen($mobile) == '11'){
        if(is_numeric($mobile)){
            if(preg_match( '/^09[0-9]{9}$/', $mobile )){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }else{
        return false;
    }
}

/**
 * Active.
 */
if(get_field('comment_sms_active', 'option')){
	//add_filter('acf/load_field/name=comment_sms_cpt', 'websima_comment_sms_cpt_load_field');
	//add_filter('comment_form_defaults','websima_comment_sms_add_mobile_field');
	add_action('comment_form_after_fields','websima_comment_sms_add_mobile_field2');
	add_action('comment_form_logged_in_after','websima_comment_sms_add_mobile_field2');
	add_filter('pre_comment_on_post','websima_comment_sms_pre_comment_on_post');
	add_action('comment_post','websima_comment_sms_save_meta_data');
	add_filter('manage_edit-comments_columns','websima_comment_sms_add_columns');
	add_action('manage_comments_custom_column','websima_comment_sms_columns_content',10,2);
	add_action('comment_post','websima_comment_sms_submission',10,2);
	add_action('transition_comment_status','websima_comment_sms_change_status',10,3);
}

/**
 * ACF cpt field.
 */
function websima_comment_sms_cpt_load_field($field){
    $field['choices'] = array();

    $post_types = get_post_types(array('publicly_queryable' => true),'objects','and');
    unset($post_types['attachment']);
    if(is_array($post_types)){
        foreach($post_types as $post_type){
            $field['choices'][esc_attr($post_type->name)] = esc_html($post_type->labels->singular_name);
        }
    }

    return $field;
}

/**
 * Comment form.
 */
// https://www.smashingmagazine.com/2012/05/adding-custom-fields-in-wordpress-comment-form/
// https://artisansweb.net/how-to-customize-comment-form-in-wordpress/
// https://wpengineer.com/2214/adding-input-fields-to-the-comment-form/
// https://webappguides.com/add-extra-fields-to-wordpress-comment-form-without-plugin/
function websima_comment_sms_add_mobile_field($default){
    $commenter = wp_get_current_commenter();

    $default['fields']['email'] .= '<p class="comment-form-mobile">' .
        '<label for="mobile">شماره موبایل <span class="required">*</span></label>
        <input type="text" name="mobile" id="mobile" class="field-ltr" placeholder="09*********" maxlength="11" value="" required /></p>';
    return $default;
}


function websima_comment_sms_add_mobile_field2() {
    echo '<p class="comment-form-mobile">' .
        '<label for="mobile">شماره موبایل <span class="required">*</span></label>
        <input type="text" name="mobile" id="mobile" class="field-ltr" placeholder="09*********" maxlength="11" value="" required /></p>';
}

function websima_comment_sms_pre_comment_on_post($comment_data){
    if($_POST['mobile'] != ''){
        if(!websima_comment_sms_mobile_validation($_POST['mobile'])){
            wp_die('شماره موبایل وارد شده معتبر نمی باشد');
        }
    }else{
        wp_die('لطفا شماره موبایل را وارد نمایید');
    }

    return $comment_data;
}

function websima_comment_sms_save_meta_data($comment_id){
    if((isset($_POST['mobile'])) and ($_POST['mobile'] != '') and websima_comment_sms_mobile_validation($_POST['mobile'])){
        add_comment_meta(esc_attr($comment_id), 'mobile',sanitize_text_field($_POST['mobile']));
    }
}

/**
 * Admin columns.
 */
function websima_comment_sms_add_columns($my_cols){
    $custom_columns = array(
        'mobile' => 'شماره موبایل'
    );
    $my_cols = array_slice( $my_cols, 0, 3, true ) + $custom_columns + array_slice( $my_cols, 3, NULL, true );

    return $my_cols;
}

function websima_comment_sms_columns_content($column,$comment_ID){
    global $comment;
    $mobile = get_comment_meta(esc_attr($comment_ID),'mobile',true);
    if($mobile == ''){ $mobile = ' - '; }

    switch($column){
        case 'mobile':
            echo esc_attr($mobile);
            break;
    }
}

/**
 * SMS functions.
 */
function websima_comment_sms_send_farapayamak($mobile,$num,$msg){
    $client = new SoapClient('http://api.payamak-panel.com/post/send.asmx?wsdl', array('encoding'=>'UTF-8'));
    $parameters['username'] = get_field('comment_sms_username', 'option');
    $parameters['password'] = get_field('comment_sms_password', 'option');
    $parameters['bodyId'] = esc_attr($num);
    $parameters['to'] = esc_attr($mobile);
    $parameters['text'] = esc_attr($msg);

    $client->SendByBaseNumber2($parameters);
}

function websima_comment_sms_send_kavenegar($mobile,$template,$token1,$token2=null,$token3=null,$token10=null,$token20=null){
    $api = get_field('comment_sms_api_key', 'option');
    $url = 'https://api.kavenegar.com/v1/'.$api.'/verify/lookup.json?receptor='.$mobile.'&template='.$template.'&token='.urlencode($token1).'&token2='.urlencode($token2).'&token3='.urlencode($token3).'&token10='.urlencode($token10).'&token20='.urlencode($token20);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
}

/**
 * Send sms.
 */
function websima_comment_sms_submission($comment_id,$comment_approved){
    if(1 === $comment_approved){
        websima_comment_sms_send_operation(esc_attr($comment_id));
    }
}

function websima_comment_sms_change_status($new_status,$old_status,$comment){
    if($new_status == 'approved'){
        websima_comment_sms_send_operation(esc_attr($comment->comment_ID));
    }
}

/**
 * Send sms operation.
 */
function websima_comment_sms_send_operation($comment_id){
    $send_sms_permission = false;
    $comment = get_comment(esc_attr($comment_id));
    $post_id = $comment->comment_post_ID;
    $user_id = $comment->user_id;
    $parent_id = $comment->comment_parent;

    $comment_temp_id = $comment_id;
    $comment_toplevel_parent_id = '';
    $parent_comment_id = 1;
    while($parent_comment_id > 0){
        $temp_comment = get_comment(esc_attr($comment_temp_id));
        $comment_toplevel_parent_id = $temp_comment->comment_ID;
        $parent_comment_id = $temp_comment->comment_parent;
        $comment_temp_id = $parent_comment_id;
    }

    if($parent_id != 0){
        if($comment_toplevel_parent_id){
            $parent_mobile = get_comment_meta(esc_attr($comment_toplevel_parent_id),'mobile',true);
            if($parent_mobile != ''){
                if(websima_comment_sms_mobile_validation($parent_mobile)){
                    $sms_company = get_field('comment_sms_company', 'option');
                    $sms_template = get_field('comment_sms_template', 'option');
                    $all_users = get_field('comment_sms_all_users', 'option');

                    $parent_full_name = get_comment(esc_attr($comment_toplevel_parent_id))->comment_author;
                    $link = wp_get_shortlink(esc_attr($post_id)).'#comment-'.esc_attr($comment_id);

                    $user_can = user_can(esc_attr($user_id),'manage_options');

                    if($all_users){
                        $send_sms_permission = true;
                    }else{
                        if($user_can){
                            $send_sms_permission = true;
                        }
                    }

                    if($send_sms_permission){
                        if($sms_company == 'kavenegar'){
                            websima_comment_sms_send_kavenegar(esc_attr($parent_mobile),esc_attr($sms_template),esc_url($link),'','','',esc_attr($parent_full_name));
                        }elseif($sms_company == 'farapayamak'){
                            $msg = esc_attr($parent_full_name).';'.esc_url($link);
                            websima_comment_sms_send_farapayamak(esc_attr($parent_mobile),esc_attr($sms_template),esc_attr($msg));
                        }
                    }
                }
            }
        }
    }
}