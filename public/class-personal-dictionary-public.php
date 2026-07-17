<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://ays-pro.com
 * @since      1.0.0
 *
 * @package    Personal_Dictionary
 * @subpackage Personal_Dictionary/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Personal_Dictionary
 * @subpackage Personal_Dictionary/public
 * @author     Personal Dictionary Team <info@ays-pro.com>
 */
class Personal_Dictionary_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $html_class_prefix = 'ays-pd-';
	private $html_name_prefix = 'ays-pd-';
	private $name_prefix = 'pd_';
	private $options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_shortcode('ayspd_userpage', array($this, 'ays_generate_pd_method'));
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Personal_Dictionary_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Personal_Dictionary_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/personal-dictionary-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-select2', plugin_dir_url(__FILE__) . 'css/select2.min.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Personal_Dictionary_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Personal_Dictionary_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script("jquery");
		wp_enqueue_script("jquery-effects-core");
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/personal-dictionary-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . '-plugin', plugin_dir_url( __FILE__ ) . 'js/personal-dictionary-public-plugin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . '-select2', plugin_dir_url(__FILE__) . 'js/select2.min.js', array('jquery'), $this->version, true);
        wp_localize_script( $this->plugin_name, 'aysPersonalDictionaryAjaxPublic', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
			'icons' => array(
				'close_icon' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>',
				'edit_icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
										<path d="M1.56681 11.5658C1.44504 11.5657 1.32601 11.5296 1.22478 11.4619C1.12354 11.3943 1.04463 11.2981 0.998037 11.1856C0.951442 11.0731 0.939248 10.9493 0.962997 10.8299C0.986745 10.7105 1.04537 10.6008 1.13146 10.5146L10.7541 0.892027C10.8109 0.833215 10.8788 0.786304 10.9539 0.754033C11.0291 0.721761 11.1099 0.704774 11.1916 0.704064C11.2734 0.703353 11.3545 0.718933 11.4302 0.749895C11.5058 0.780856 11.5746 0.826579 11.6324 0.884395C11.6902 0.942211 11.7359 1.01096 11.7669 1.08664C11.7979 1.16231 11.8134 1.2434 11.8127 1.32516C11.812 1.40692 11.795 1.48772 11.7628 1.56285C11.7305 1.63797 11.6836 1.70592 11.6248 1.76272L2.00216 11.3853C1.88208 11.5054 1.72445 11.5658 1.56681 11.5658Z" fill="#0E294A" fill-opacity="0.8"/>
										<path d="M0.61626 16.0002C0.524378 16.0003 0.433644 15.9798 0.350709 15.9403C0.267775 15.9007 0.194743 15.8431 0.136967 15.7717C0.0791917 15.7002 0.038137 15.6167 0.0168128 15.5274C-0.00451143 15.438 -0.00556453 15.345 0.0137308 15.2551L0.965093 10.8207C0.981839 10.7414 1.01407 10.6662 1.05993 10.5994C1.10579 10.5326 1.16439 10.4755 1.23235 10.4314C1.30032 10.3873 1.37633 10.3571 1.45601 10.3424C1.5357 10.3277 1.6175 10.3289 1.69672 10.3459C1.77595 10.3629 1.85104 10.3953 1.91769 10.4414C1.98435 10.4875 2.04125 10.5463 2.08515 10.6144C2.12904 10.6825 2.15907 10.7586 2.17349 10.8383C2.18792 10.918 2.18647 10.9998 2.16923 11.079L1.21787 15.5135C1.18836 15.6512 1.11256 15.7746 1.00308 15.8632C0.893608 15.9517 0.757081 16.0001 0.61626 16.0002ZM5.0501 15.0489C4.92833 15.0488 4.8093 15.0127 4.70807 14.945C4.60683 14.8774 4.52792 14.7812 4.48133 14.6687C4.43473 14.5562 4.42254 14.4324 4.44629 14.313C4.47004 14.1936 4.52866 14.0839 4.61475 13.9977L14.2374 4.37544C14.2942 4.31663 14.3621 4.26972 14.4372 4.23745C14.5124 4.20517 14.5932 4.18819 14.6749 4.18748C14.7567 4.18677 14.8378 4.20235 14.9134 4.23331C14.9891 4.26427 15.0579 4.30999 15.1157 4.36781C15.1735 4.42562 15.2192 4.49438 15.2502 4.57005C15.2812 4.64573 15.2967 4.72681 15.296 4.80857C15.2953 4.89033 15.2783 4.97114 15.2461 5.04626C15.2138 5.12139 15.1669 5.18933 15.1081 5.24614L5.48576 14.8684C5.42861 14.9257 5.36071 14.9712 5.28594 15.0021C5.21117 15.0331 5.13102 15.049 5.0501 15.0489Z" fill="#0E294A" fill-opacity="0.8"/>
										<path d="M0.615412 16.0002C0.46368 15.9996 0.317522 15.943 0.20495 15.8412C0.0923771 15.7395 0.0213089 15.5998 0.00536509 15.4489C-0.0105787 15.298 0.0297234 15.1465 0.118548 15.0235C0.207372 14.9005 0.33847 14.8146 0.486717 14.7822L4.92117 13.8309C5.08063 13.7972 5.24694 13.8281 5.38365 13.9168C5.52036 14.0055 5.61632 14.1448 5.65051 14.3042C5.68469 14.4635 5.65431 14.6299 5.56602 14.7669C5.47773 14.9039 5.33873 15.0003 5.17949 15.035L0.745032 15.9864C0.702453 15.9957 0.658993 16.0003 0.615412 16.0002ZM12.9314 7.16795C12.8505 7.1681 12.7704 7.15223 12.6957 7.12127C12.621 7.0903 12.5531 7.04485 12.496 6.98752L9.01295 3.50443C8.95414 3.44763 8.90723 3.37968 8.87496 3.30456C8.84269 3.22943 8.8257 3.14863 8.82499 3.06687C8.82428 2.98511 8.83986 2.90402 8.87082 2.82835C8.90178 2.75267 8.9475 2.68392 9.00532 2.6261C9.06314 2.56829 9.13189 2.52256 9.20756 2.4916C9.28324 2.46064 9.36432 2.44506 9.44608 2.44577C9.52785 2.44648 9.60865 2.46347 9.68377 2.49574C9.7589 2.52801 9.82685 2.57492 9.88365 2.63374L13.3667 6.11683C13.4528 6.20295 13.5115 6.31265 13.5352 6.43208C13.559 6.55151 13.5468 6.6753 13.5002 6.7878C13.4536 6.9003 13.3747 6.99646 13.2734 7.06413C13.1722 7.13179 13.0532 7.16792 12.9314 7.16795ZM14.6731 5.42655C14.5512 5.42665 14.4321 5.39059 14.3307 5.32293C14.2294 5.25528 14.1504 5.15907 14.1037 5.04649C14.0571 4.93392 14.0449 4.81003 14.0687 4.69052C14.0925 4.57101 14.1512 4.46125 14.2374 4.37513C14.5801 4.03245 14.7688 3.56847 14.7688 3.06908C14.7688 2.5697 14.5801 2.10571 14.2374 1.76304C13.8945 1.42006 13.4305 1.23132 12.9311 1.23132C12.4317 1.23132 11.9677 1.42006 11.625 1.76304C11.5679 1.82023 11.5 1.8656 11.4252 1.89655C11.3505 1.9275 11.2704 1.94343 11.1895 1.94343C11.1087 1.94343 11.0286 1.9275 10.9538 1.89655C10.8791 1.8656 10.8112 1.82023 10.754 1.76304C10.6968 1.70585 10.6515 1.63795 10.6205 1.56323C10.5896 1.48851 10.5736 1.40842 10.5736 1.32754C10.5736 1.24666 10.5896 1.16657 10.6205 1.09184C10.6515 1.01712 10.6968 0.949226 10.754 0.892035C11.3292 0.316599 12.1023 -0.000213623 12.9311 -0.000213623C13.7596 -0.000213623 14.533 0.316599 15.1081 0.892035C15.6836 1.46716 16.0004 2.24026 16.0004 3.06908C16.0004 3.89791 15.6836 4.671 15.1081 5.24613C15.0511 5.30342 14.9833 5.34885 14.9086 5.37981C14.834 5.41078 14.7539 5.42666 14.6731 5.42655Z" fill="#0E294A" fill-opacity="0.8"/>
									</svg>',
				'delete_icon' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>',
				'more_icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="4" height="16" viewBox="0 0 4 16" fill="none">
										<path d="M2.00045 3.55558C2.9823 3.55558 3.77824 2.75964 3.77824 1.77779C3.77824 0.795944 2.9823 0 2.00045 0C1.0186 0 0.222656 0.795944 0.222656 1.77779C0.222656 2.75964 1.0186 3.55558 2.00045 3.55558Z" fill="#0E294A" fill-opacity="0.8"/>
										<path d="M2.00045 9.7778C2.9823 9.7778 3.77824 8.98185 3.77824 8.00001C3.77824 7.01816 2.9823 6.22221 2.00045 6.22221C1.0186 6.22221 0.222656 7.01816 0.222656 8.00001C0.222656 8.98185 1.0186 9.7778 2.00045 9.7778Z" fill="#0E294A" fill-opacity="0.8"/>
										<path d="M2.00045 16C2.9823 16 3.77824 15.2041 3.77824 14.2222C3.77824 13.2404 2.9823 12.4444 2.00045 12.4444C1.0186 12.4444 0.222656 13.2404 0.222656 14.2222C0.222656 15.2041 1.0186 16 2.00045 16Z" fill="#0E294A" fill-opacity="0.8"/>
									</svg>',
				// 'open_fs' => '<svg xmlns="http://www.w3.org/2000/svg" height="20" fill="#fff" viewBox="0 0 24 24" width="20" class="open_full_screen"><path d="M0 0h24v24H0z" fill="none"></path><path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"></path></svg>',
				'open_group_word' => '<img src="'.PERSONAL_DICTIONARY_PUBLIC_URL.'/images/icons/plus.svg">',
			),
        ) );

		wp_localize_script( $this->plugin_name, 'aysPdLangObj', array(
            'save' => __( 'Save', 'personal-dictionary' ),
            'saveAndClose' => __( 'Save and close', 'personal-dictionary' ),
            'settingsMessage' => __( 'Game require 4 or more words.', 'personal-dictionary' ),
            'all' => __( 'All', 'personal-dictionary' ),
            'result' => __( 'Result', 'personal-dictionary' ),
            'groups' => __( 'Groups', 'personal-dictionary' ),
            'games' => __( 'Games', 'personal-dictionary' ),
            'reset' => __( 'Reset', 'personal-dictionary' ),
            'delete' => __( 'Delete', 'personal-dictionary' ),
            'word' => __( 'Word', 'personal-dictionary' ),
            'translation' => __( 'Translation', 'personal-dictionary' ),
            'createFirstGroup' => __( 'Create your first Group', 'personal-dictionary' ),
            'createFirstWord' => __( 'Add your words', 'personal-dictionary' ),
            'from' => __( 'From', 'personal-dictionary' ),
            'to' => __( 'To', 'personal-dictionary' ),
            'move' => __( 'Move', 'personal-dictionary' ),
            'moved_to' => __( 'The word moved to', 'personal-dictionary' ),
            'group' => __( 'Group', 'personal-dictionary' ),
            'addWord' => __( 'Add a Word', 'personal-dictionary' ),
            'addGroup' => __( 'Add a Group', 'personal-dictionary' ),
            'defaultSort' => __( 'Default', 'personal-dictionary' ),
            'deleteWordConfirm' => __( 'Are you sure you want to delete the word?', 'personal-dictionary' ),
            'intervalMessage' => __( 'There are not enough words in that interval', 'personal-dictionary' ),
            'learnedPoints' => __( 'Learned', 'personal-dictionary' ),
			'cancel' => __( 'Cancel', 'personal-dictionary' ),
        ) );
	}

	public function ays_pd_ajax(){
		global $wpdb;

		$response = array(
			"status" => false
		);
		$function = isset($_REQUEST['function']) ? sanitize_text_field( $_REQUEST['function'] ) : null;

		if($function !== null){

			$response = array();
			if( is_callable( array( $this, $function ) ) ){
				$results = $this->$function();
				$response = array(
					"status" => true,
					"results" => $results,
				);
	            ob_end_clean();
	            $ob_get_clean = ob_get_clean();
				echo json_encode( $response );
				wp_die();
			}

		}


        ob_end_clean();
        $ob_get_clean = ob_get_clean();
		echo json_encode( $response );
		wp_die();
	}

	public function ays_groups_add_ajax(){
		global $wpdb;
		$categories_table 	= esc_sql( $wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'categories' );
		$group_name 		= (isset($_REQUEST['value']) && $_REQUEST['value'] != '') ? stripslashes(sanitize_text_field( $_REQUEST['value'] )) : null;
		$command			= (isset($_REQUEST['command']) && $_REQUEST['command'] != '') ? sanitize_text_field( $_REQUEST['command'] ) : null;
		$catId				= (isset($_REQUEST['catId']) && $_REQUEST['catId'] != '') ? absint( sanitize_text_field( $_REQUEST['catId'] ) ) : null;
		$unique_id = $this->ays_create_cookies();
		$detect_db_column_type = "%d";
		if (get_current_user_id() > 0) {
			$id_row = 'user_id';
			$user_id = absint(get_current_user_id());
		} else {
			$id_row = 'unique_id';
			$user_id = $unique_id;
			$detect_db_column_type = "%s";
		}
		
		$lastId = false;
		if ($group_name != null) {
			if($command == null && $catId == null){
				$insert_results = $wpdb->insert(
					$categories_table,
					array(
						$id_row => $user_id,
						'name' => $group_name,
						'date_created' => current_time( 'mysql' ),
					),
					array(
						$detect_db_column_type, // user_id
						'%s', // name
						'%s', // date
					)
				);
				$lastId = $wpdb->insert_id;
			}else{
				$insert_results = $wpdb->update(
                    $categories_table,
                    array(
						'name' => $group_name,

                    ),
                    array( 'id' => $catId ),
                    array(
                        '%s', // name
                    ),
                    array( '%d' )
                );
			}


			$response = array(
				"status" => true,
				"last_id" => $lastId,
				"added_group" => $insert_results,
			);
            ob_end_clean();
            $ob_get_clean = ob_get_clean();
			echo json_encode( $response );
			wp_die();
		}
	}

	public function ays_words_add_ajax(){
		global $wpdb;
		$words_table 		= esc_sql( $wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'words' );
		$category_id		= (isset($_REQUEST['category_id']) && $_REQUEST['category_id'] != '') ? absint( sanitize_text_field( $_REQUEST['category_id'] ) ) : null;
		$word				= (isset($_REQUEST['word']) && $_REQUEST['word'] != '') ? stripslashes(sanitize_text_field( $_REQUEST['word'] )) : null;
		$translation		= (isset($_REQUEST['translation']) && $_REQUEST['translation'] != '') ? stripslashes(sanitize_text_field( $_REQUEST['translation'] )) : '';
		$command			= (isset($_REQUEST['command']) && $_REQUEST['command'] != '') ? absint( sanitize_text_field( $_REQUEST['command'] ) ) : null;
		$wordId				= (isset($_REQUEST['wordId']) && $_REQUEST['wordId'] != '') ? absint( sanitize_text_field( $_REQUEST['wordId'] ) ) : null;
		$unique_id = $this->ays_create_cookies();
		$detect_db_column_type = "%d";
		if (get_current_user_id() > 0) {
			$id_row = 'user_id';
			$user_id = absint(get_current_user_id());
		} else {
			$id_row = 'unique_id';
			$user_id = $unique_id;
			$detect_db_column_type = "%s";
		}

		if ($word !== null && $category_id !== null) {

			if($command == null && $wordId == null){
				$insert_results = $wpdb->insert(
					$words_table,
					array(
						$id_row			 	=> $user_id,
						'category_id'	 	=> $category_id,
						'word'			 	=> $word,
						'translation'    	=> $translation,
						'date_created'		=> current_time( 'mysql' ),
						'date_modified'		=> current_time( 'mysql' ),
					),
					array(
						$detect_db_column_type, // user_id
						'%d', // category_id
						'%s', // word
						'%s', // translation
						'%s', // date_created
						'%s', // date_modified
					)
				);
			}else{
				$insert_results = $wpdb->update(
                    $words_table,
                    array(
						'word'			 	=> $word,
						'translation'    	=> $translation,
                        'date_modified'     => current_time( 'mysql' ),

                    ),
                    array( 'id' => $wordId ),
                    array(
                        '%s', // word
                        '%s', // translation
                        '%s', // date_modified
                    ),
                    array( '%d' )
                );
			}
				
			$response = array(
				"status" => true,
				"added_words" => $insert_results,
			);
            ob_end_clean();
            $ob_get_clean = ob_get_clean();
			echo json_encode( $response );
			wp_die();
		}
	}

	public function ays_groups_delete_ajax(){
		global $wpdb;
		$categories_table 	= esc_sql($wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'categories');
		$words_table 		= esc_sql($wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'words');
		$catId				= (isset($_REQUEST['catId']) && $_REQUEST['catId'] != '') ? absint( sanitize_text_field( $_REQUEST['catId'] ) ) : null;

		if ($catId !== null) {
			
			$deleted_group = $wpdb->delete(
				$categories_table,
				array( 'id' => $catId ),
				array( '%d' )
			);

			$deleted_words = $wpdb->delete(
				$words_table,
				array( 'category_id' => $catId ),
				array( '%d' )
			);
				
			$response = array(
				"status" => true,
				"deleted_group" => $deleted_group,
				"deleted_words" => $deleted_words,
			);
            ob_end_clean();
            $ob_get_clean = ob_get_clean();
			echo json_encode( $response );
			wp_die();
		}
	}

	public function ays_group_reset_ajax(){
		global $wpdb;

		$words_table 		= esc_sql($wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'words');
		$catId				= (isset($_REQUEST['catId']) && $_REQUEST['catId'] != '') ? absint( sanitize_text_field( $_REQUEST['catId'] ) ) : null;

		if($catId !== null){
			
			$update_result = $wpdb->update(
				$words_table,
				array(
					'point'				=> 0,
					'completed'    		=> 0,
					'percentage'    	=> 0,
					'corrects_count'    => 0,
					'failed_count'    	=> 0,
					'attempts_count'    => 0,
					'date_modified'     => current_time( 'mysql' ),
				),
				array( 'category_id' => $catId ),
				array(
					'%f', // point
					'%d', // completed
					'%f', // percentage
					'%d', // corrects_count
					'%d', // failed_count
					'%d', // attempts_count
					'%s', // date_modified
				),
				array( '%d' )
			);
				
			$response = array(
				"status" => true,
				"update_word" => $update_result,
			);

            ob_end_clean();
            $ob_get_clean = ob_get_clean();
			echo json_encode( $response );
			wp_die();
		}
	}

	public function ays_words_delete_ajax(){
		global $wpdb;
		$words_table 	= esc_sql($wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'words');
		$wordId			= (isset($_REQUEST['wordId']) && $_REQUEST['wordId'] != '') ? absint( sanitize_text_field( $_REQUEST['wordId'] ) ) : null;

		if($wordId !== null){
			
			$delete_result = $wpdb->delete(
				$words_table,
				array( 'id' => intval($wordId) ),
				array( '%d' )
			);
				
			$response = array(
				"status" => true,
				"deleted_words" => $delete_result,
			);

            ob_end_clean();
            $ob_get_clean = ob_get_clean();
			echo json_encode( $response );
			wp_die();
		}
	}

	public function ays_word_reset_ajax(){
		global $wpdb;
		$words_table 	= esc_sql($wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'words');
		$wordId			= (isset($_REQUEST['wordId']) && $_REQUEST['wordId'] != '') ? absint( sanitize_text_field( $_REQUEST['wordId'] ) ) : null;

		if($wordId !== null){
			
			$update_result = $wpdb->update(
				$words_table,
				array(
					'point'				=> 0,
					'completed'    		=> 0,
					'percentage'    	=> 0,
					'corrects_count'    => 0,
					'failed_count'    	=> 0,
					'attempts_count'    => 0,
					'date_modified'     => current_time( 'mysql' ),
				),
				array( 'id' => $wordId ),
				array(
					'%f', // point
					'%d', // completed
					'%f', // percentage
					'%d', // corrects_count
					'%d', // failed_count
					'%d', // attempts_count
					'%s', // date_modified
				),
				array( '%d' )
			);
				
			$response = array(
				"status" => true,
				"update_word" => $update_result,
			);

            ob_end_clean();
            $ob_get_clean = ob_get_clean();
			echo json_encode( $response );
			wp_die();
		}
	}

	public function ays_show_words_ajax(){
		global $wpdb;
		$cat_id = (isset($_REQUEST['catId']) && $_REQUEST['catId'] != '') ? absint( sanitize_text_field( $_REQUEST['catId'] ) ) : null;
		$unique_id = $this->ays_create_cookies();
		$detect_db_column_type = "%d";
		if (get_current_user_id() > 0) {
			$id_row = 'user_id';
			$user_id = absint(get_current_user_id());
		} else {
			$id_row = 'unique_id';
			$user_id = "'" . $unique_id . "'";
			$detect_db_column_type = "%s";
		}

		$results = array();
		if( $cat_id !== null ){
			$categories_table = esc_sql($wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'categories');
			$words_table = esc_sql($wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'words');
			$sql  = "SELECT * FROM ".$words_table . " WHERE category_id = " . $cat_id ."  AND " . $id_row . " = " . $user_id . " ORDER BY id DESC " ;
			$words = $wpdb->get_results($sql, 'ARRAY_A');

			$sql2 = "SELECT `name` FROM ".$categories_table . " WHERE id = " . $cat_id ." ";
			$group_name = $wpdb->get_var($sql2);
			
			$pd = Personal_Dictionary_Data::get_pd_globsettings();
			$this->options = Personal_Dictionary_Data::get_pd_validated_data_from_array( $pd );
			$learnt_point = $this->options[ $this->name_prefix . 'learned_points' ];

			foreach ($words as $key => $value) {
				$percentage = 0;
				if( floatval( $value['point'] ) > 0){
					$percentage = round( ( floatval( $value['point'] ) / $learnt_point ) * 100, 1 );
				}else{
					$percentage = 0;
				}

				$words[$key]['percentage'] = $percentage;
			}

			$results[] = $words;
			$results[] = $group_name;
		}

		return $results;
	}

	public function ays_groups_pd(){
		global $wpdb;
		$unique_id = $this->ays_create_cookies();
		if (get_current_user_id() > 0) {
			$id_row = 'user_id';
			$user_id = absint(get_current_user_id());
		} else {
			$id_row = 'unique_id';
			$user_id = "'" . $unique_id . "'";
		}
		$words_table = esc_sql($wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'words');
		$categories_table = esc_sql($wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'categories');
		$sql = "SELECT * FROM ". $categories_table ." WHERE " . $id_row . " = " . $user_id . "  ORDER BY id DESC";
		$groups = $wpdb->get_results($sql, 'ARRAY_A');
		
		$pd = Personal_Dictionary_Data::get_pd_globsettings();
		$this->options = Personal_Dictionary_Data::get_pd_validated_data_from_array( $pd );

		$learnt_point = $this->options[ $this->name_prefix . 'learned_points' ];
		foreach ($groups as $key => $value) {
			$percentage = 0;
			$w_count = 0;
			$sql2  = "SELECT SUM( point ) as sum, COUNT(id) as count FROM ".$words_table . " WHERE category_id = " . $value['id'] ."  AND " . $id_row . " = " . $user_id . " ";
			$completed_words = $wpdb->get_row($sql2,'ARRAY_A');
			if($completed_words['count'] > 0){
				$percentage = ( floatval( $completed_words['sum'] ) / ( $learnt_point * absint( $completed_words['count'] ) ) ) * 100;
			}else{
				$percentage = 0;
			}

			$w_count = isset($completed_words['count']) ? absint( $completed_words['count'] ) : 0;
			$groups[$key]['percentage'] = $percentage;
			$groups[$key]['w_count'] = $w_count;
		}

		return $groups;
	}

	public function ays_games_pd(){
		global $wpdb;
		$unique_id = $this->ays_create_cookies();
		if (get_current_user_id() > 0) {
			$id_row = 'user_id';
			$user_id = absint(get_current_user_id());
		} else {
			$id_row = 'unique_id';
			$user_id = "'" . $unique_id . "'";
		}
		$categories_table = esc_sql($wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'categories');
		$words_table 	= esc_sql($wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'words');
		$sql = "SELECT * FROM ".$categories_table ." WHERE " . $id_row . " = " . $user_id . " ORDER BY id DESC";
		$groups = $wpdb->get_results($sql, 'ARRAY_A');


		foreach ($groups as $key => $value) {
			$sql2  = "SELECT COUNT(id) as count FROM ".$words_table . " WHERE category_id = " . $value['id'] ."  AND " . $id_row . " = " . $user_id . " AND completed = 0 AND translation != '' ";
			$group_words_count = $wpdb->get_row($sql2,'ARRAY_A');
			$groups[$key]['words_count'] = $group_words_count['count'];
		}

		return $groups;
	}

	public function ays_pd_add_game_results(){
		global $wpdb;
		$reports_table = esc_sql($wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'reports');
		$unique_id = $this->ays_create_cookies();
		$detect_db_column_type = "%d";
		if (get_current_user_id() > 0) {
			$id_row = 'user_id';
			$user_id = absint(get_current_user_id());
		} else {
			$id_row = 'unique_id';
			$user_id = "'" . $unique_id . "'";
			$detect_db_column_type = "%s";
		}

		$game_type = (isset($_REQUEST['gameType']) && $_REQUEST['gameType'] != '') ? ( sanitize_text_field( $_REQUEST['gameType'] ) ) : null;
		$ays_pd_words = (isset($_REQUEST['ays-pd-word']) && !empty($_REQUEST['ays-pd-word'])) ? array_map( 'sanitize_text_field', $_REQUEST['ays-pd-word'] ) : array();
		$ays_pd_translations = (isset($_REQUEST['ays-pd-translation']) && !empty($_REQUEST['ays-pd-translation'])) ? array_map( 'sanitize_text_field', $_REQUEST['ays-pd-translation'] ) : array();
		$words_str = implode(',',$ays_pd_words);
		$translation_str = implode(',',$ays_pd_translations);
		$groups_ids = (isset($_REQUEST['groupsIds']) && !empty($_REQUEST['groupsIds'])) ? array_map( 'sanitize_text_field', $_REQUEST['groupsIds'] ) : null;
		$groups_ids = implode(',',$groups_ids);

		$pd = Personal_Dictionary_Data::get_pd_globsettings();
		$this->options = Personal_Dictionary_Data::get_pd_validated_data_from_array( $pd );

		$right_points = (isset($this->options[ $this->name_prefix . 'right_points' ]) && $this->options[ $this->name_prefix . 'right_points' ] != '') ? abs( floatval( $this->options[ $this->name_prefix . 'right_points' ] ) ) : 1;

		switch ($game_type) {
			case 'find_word':
				$score_count = 0;
				$words_count = count($ays_pd_words);
				foreach ($ays_pd_translations as $key => $value) {
					if($key == $value){
						$score_count = $score_count + 1;
					}
				}
				if($words_count == 0 || empty($ays_pd_words)){
					$score = 0;
				}else{
					$score = round( ( $score_count / $words_count ) * 100, 1 );
				}
				$points = $score_count * $right_points;

				$insert_results = $wpdb->insert(
					$reports_table,
					array(
						$id_row			 	=> $user_id,
						'words_ids' 		=> $words_str,
						'categories_ids' 	=> $groups_ids,
						'score' 			=> $score,
						'words_count' 		=> $words_count,
						'game_type' 		=> $game_type,
						'points' 			=> $points,
						'complete_date' 	=> current_time( 'mysql' ),
					),
					array(
						$detect_db_column_type, // user_id
						'%s', // words_ids
						'%s', // categories_ids
						'%s', // score
						'%d', // words_count
						'%s', // game_type
						'%f', // points
						'%s', // complete_date
					)
				);
				break;
			case 'find_translation':
				$score_count = 0;
				$words_count = count($ays_pd_translations);
				foreach ($ays_pd_words as $key => $value) {
					if($key == $value){
						$score_count = $score_count + 1;
					}
				}
				$points = $score_count * $right_points;

				if($words_count == 0 || empty($ays_pd_translations)){
					$score = 0;
				}else{
					$score = round( ( $score_count / $words_count ) * 100, 1 );
				}
	
				$insert_results = $wpdb->insert(
					$reports_table,
					array(
						$id_row		 	    => $user_id,
						'words_ids' 		=> $translation_str,
						'categories_ids' 	=> $groups_ids,
						'score' 			=> $score,
						'words_count' 		=> $words_count,
						'game_type' 		=> $game_type,
						'points' 			=> $points,
						'complete_date' 	=> current_time( 'mysql' ),
					),
					array(
						$detect_db_column_type, // user_id
						'%s', // words_ids
						'%s', // categories_ids
						'%s', // score
						'%d', // words_count
						'%s', // game_type
						'%f', // points
						'%s', // complete_date
					)
				);
				break;
			default:
				$score_count = 0;
				$words_count = count($ays_pd_words);
				foreach ($ays_pd_translations as $key => $value) {
					if($key == $value){
						$score_count = $score_count + 1;
					}
				}
				$points = $score_count * $right_points;

				if($words_count == 0 || empty($ays_pd_words)){
					$score = 0;
				}else{
					$score = round( ( $score_count / $words_count ) * 100, 1 );
				}
	
				$insert_results = $wpdb->insert(
					$reports_table,
					array(
						$id_row  		 	=> $user_id,
						'words_ids' 		=> $words_str,
						'categories_ids' 	=> $groups_ids,
						'score' 			=> $score,
						'words_count' 		=> $words_count,
						'game_type' 		=> $game_type,
						'points' 			=> $points,
						'complete_date' 	=> current_time( 'mysql' ),
					),
					array(
						$detect_db_column_type, // user_id
						'%s', // words_ids
						'%s', // categories_ids
						'%s', // score
						'%d', // words_count
						'%s', // game_type
						'%f', // points
						'%s', // complete_date
					)
				);
			break;
		}

		$response = array(
			"status" => true,
			"added_report" => $insert_results,
		);
		ob_end_clean();
		$ob_get_clean = ob_get_clean();
		echo json_encode( $response );
		wp_die();
	}

	public function ays_pd_update_word(){
		global $wpdb;
		$unique_id = $this->ays_create_cookies();
		if (get_current_user_id() > 0) {
			$id_row = 'user_id';
			$user_id = absint(get_current_user_id());
		} else {
			$id_row = 'unique_id';
			$user_id = "'" . $unique_id . "'";
		}

		$word_id = (isset($_REQUEST['wordId']) && $_REQUEST['wordId'] != '') ? absint( sanitize_text_field( $_REQUEST['wordId'] ) ) : null;
		$voted = (isset($_REQUEST['voted']) && $_REQUEST['voted'] != '') ? absint( sanitize_text_field( $_REQUEST['voted'] ) ) : null;
		$words_table = esc_sql($wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'words');
		$sql = "SELECT * FROM ".$words_table . " WHERE id = " . $word_id ."  AND " . $id_row . " = " . $user_id . " " ;
		$words = $wpdb->get_row($sql,'ARRAY_A');
		$point = (isset($words['point']) && $words['point'] != '') ? floatval( sanitize_text_field( $words['point'] ) ) : 0;
		$completed = (isset($words['completed']) && $words['completed'] != '') ? absint( sanitize_text_field( $words['completed'] ) ) : 0;
		$percentage = (isset($words['percentage']) && $words['percentage'] != '') ? floatval( sanitize_text_field( $words['percentage'] ) ) : 0;
        $corrects_count = (isset($words['corrects_count']) && $words['corrects_count'] != '') ? absint( sanitize_text_field( $words['corrects_count'] ) ) : 0;
		$failed_count = (isset($words['failed_count']) && $words['failed_count'] != '') ? absint( sanitize_text_field( $words['failed_count'] ) ) : 0;
		$attempts_count = (isset($words['attempts_count']) && $words['attempts_count'] != '') ? absint( sanitize_text_field( $words['attempts_count'] ) ) : 0;
		$response = array();

		$pd = Personal_Dictionary_Data::get_pd_globsettings();
		$this->options = Personal_Dictionary_Data::get_pd_validated_data_from_array( $pd );

		$learnt_point = $this->options[ $this->name_prefix . 'learned_points' ];
		$right_points = $this->options[ $this->name_prefix . 'right_points' ];
		$wrong_points = $this->options[ $this->name_prefix . 'wrong_points' ];

		$user_answer = $voted;
		$correct_answer = $word_id;
		
		if($user_answer !== null && $correct_answer !== null) {
			$attempts_count = $attempts_count + 1;
			if($user_answer == $correct_answer){
				$corrects_count = $corrects_count + 1;
				$point = $point + $right_points;
			} else {
				$failed_count = $failed_count + 1;
				if( $point > 0 ){
					$point = $point - $wrong_points;
				}
			}
			
			if ($point < 0) {
				$point = 0;
			}
			if ($point >= $learnt_point) {
				$completed = 1;
				$point = $learnt_point;
			}

			if ($learnt_point == 0) {
				$percentage = 0;
			} else {
				$percentage = ($point / $learnt_point) * 100;
			}

			if ($percentage > 100) {
				$percentage = 100;
			}

			$update_result = $wpdb->update(
				$words_table,
				array(
					'point'				=> $point,
					'completed'    		=> $completed,
					'percentage'    	=> $percentage,
					'corrects_count'    => $corrects_count,
					'failed_count'    	=> $failed_count,
					'attempts_count'    => $attempts_count,
					'date_modified'     => current_time( 'mysql' ),
				),
				array( 'id' => $word_id ),
				array(
					'%f', // point
					'%d', // completed
					'%f', // percentage
					'%d', // corrects_count
					'%d', // failed_count
					'%d', // attempts_count
					'%s', // date_modified
				),
				array( '%d' )
			);
			$response = array(
				"status" => true,
				"update_words" => $update_result,
			);
            ob_end_clean();
            $ob_get_clean = ob_get_clean();
			echo json_encode( $response );
			wp_die();
		}

		return $response;
	}

	public function ays_pd_game_find_word(){
		global $wpdb;
		$words_table = esc_sql($wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'words');
		$unique_id = $this->ays_create_cookies();
		if (get_current_user_id() > 0) {
			$id_row = 'user_id';
			$user_id = absint(get_current_user_id());
		} else {
			$id_row = 'unique_id';
			$user_id = "'" . $unique_id . "'";
		}

		$groups_ids = (isset($_REQUEST['groupsIds']) && !empty($_REQUEST['groupsIds'])) ? array_map( 'absint', $_REQUEST['groupsIds'] ) : null;
		$ids = (isset($_REQUEST['ids']) && !empty($_REQUEST['ids'])) ? array_map( 'absint', $_REQUEST['ids'] ) : array();
		$words_count = (isset($_REQUEST['wordsCount']) && $_REQUEST['wordsCount'] != '' ) ? sanitize_text_field( $_REQUEST['wordsCount'] ) : 10;
		$limit_number = (isset($_REQUEST['number']) && $_REQUEST['number'] != '') ? sanitize_text_field( $_REQUEST['number'] ) : 0;
		$words_percentage_from = (isset($_REQUEST['wordsPercentageFrom']) && $_REQUEST['wordsPercentageFrom'] != '') ? intval(sanitize_text_field( $_REQUEST['wordsPercentageFrom'] )) : 0;
		$words_percentage_to = (isset($_REQUEST['wordsPercentageTo']) && $_REQUEST['wordsPercentageTo'] != '') ? intval(sanitize_text_field( $_REQUEST['wordsPercentageTo'] )) : 100;

		if ($words_percentage_from == 0) {
			$sql_word_percentage = "AND (`percentage` BETWEEN " . $words_percentage_from . " AND " . $words_percentage_to . " OR `percentage` IS NULL)";
		} else {
			$sql_word_percentage = "AND (`percentage` BETWEEN " . $words_percentage_from . " AND " . $words_percentage_to . ")";
		}

		$limit_number_min = $limit_number;
		$words = array();
		$result_arr = array();

		$sql = "SELECT COUNT(`id`) FROM " . $words_table . " WHERE `category_id` IN(" . sanitize_text_field( implode( ',', $groups_ids ) ) . ") AND `" . $id_row . "` = " . $user_id . " AND `completed` = 0 AND `translation` != '' " . $sql_word_percentage;
		$completed_count = absint( $wpdb->get_var( $sql ) );
		$hidden_count = (isset($_REQUEST['hiddenCount']) && $_REQUEST['hiddenCount'] != null ) ? absint( sanitize_text_field( $_REQUEST['hiddenCount'] ) ) : $completed_count;
		$sql = "SELECT `id` FROM " . $words_table . " WHERE `category_id` IN(" . sanitize_text_field( implode( ',', $groups_ids ) ) . ") AND `" . $id_row . "` = " . $user_id . " AND `completed` = 1 AND `translation` != ''";
		$completed_res = $wpdb->get_results($sql,'ARRAY_A');

		foreach ($completed_res as $key => $value) {	
			array_push($ids,$value['id']);
		}

		$not_in = '';
		if(!empty($ids)){
			$not_in = " AND `id` NOT IN (" . sanitize_text_field( implode( ',', $ids ) ) . ")";
		}else{
			$not_in = '';
		}
		
		if ( $groups_ids !== null && ( $limit_number_min != $words_count || $limit_number_min == 'all' ) ) {
			$sql = "SELECT * FROM " . $words_table . " WHERE `category_id` IN(" . sanitize_text_field( implode( ',', $groups_ids ) ) . ") AND `" . $id_row . "` = " . $user_id . " AND `translation` != ''";
			$words = $wpdb->get_results($sql, 'ARRAY_A');

			$sql2 = "SELECT * FROM " . $words_table . " WHERE `category_id` IN(" . sanitize_text_field( implode( ',', $groups_ids ) ) . ") AND `" . $id_row . "` = " . $user_id . $not_in . " AND `translation` != '' " . $sql_word_percentage . " ORDER BY RAND() LIMIT 10";
			$ten_words = $wpdb->get_results($sql2, 'ARRAY_A');
			$limit_number_min = $limit_number + 10;

			if($completed_count >= 4){

				$translations_arr = array();
				foreach ($ten_words as $key => $value) {
					$limit_number = $limit_number + 1;
					
					$result_arr[$value['id']]['id'] = $value['id'];
					$result_arr[$value['id']]['word'] = $value['word'];

					$result_arr[$value['id']]['translations'][] = array(
						intval( $value['id'] ),
						$value['translation']
					);

					$result_arr[$value['id']]['correct_answer'] = intval($value['id']);
					$result_arr[$value['id']]['count'] = intval($hidden_count);
					$result_arr[$value['id']]['limitNumber'] = $limit_number_min;
					$result_arr[$value['id']]['dataId'] = $limit_number;
					
				}
				
				foreach($words as $k => $v){
					$translations_arr[$v['id']] = $v['translation'];
				}
				
				foreach ($result_arr as $key => $value) {
					$translations_arr2 = $translations_arr;
					unset($translations_arr2[$key]);
					$rand_keys = array_rand($translations_arr2,3);
			
					foreach ($rand_keys as $key2 => $value2) {
						$result_arr[$key]['translations'][] = array( $value2, $translations_arr2[$value2] );
						shuffle($result_arr[$key]['translations']);					
					}
				}
			}
		
		}
		shuffle($result_arr);
		return $result_arr;
	}

	public function ays_pd_game_find_translation(){
		global $wpdb;
		$words_table = esc_sql($wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'words');
		$unique_id = $this->ays_create_cookies();
		if (get_current_user_id() > 0) {
			$id_row = 'user_id';
			$user_id = absint(get_current_user_id());
		} else {
			$id_row = 'unique_id';
			$user_id = "'" . $unique_id . "'";
		}

		$groups_ids = (isset($_REQUEST['groupsIds']) && !empty($_REQUEST['groupsIds'])) ? array_map( 'absint', $_REQUEST['groupsIds'] ) : null;
		$ids = (isset($_REQUEST['ids']) && !empty($_REQUEST['ids'])) ? array_map( 'absint', $_REQUEST['ids'] ) : array();
		$words_count = (isset($_REQUEST['wordsCount']) && $_REQUEST['wordsCount'] != '' ) ? sanitize_text_field( $_REQUEST['wordsCount'] ) : 10;
		$limit_number = (isset($_REQUEST['number']) && $_REQUEST['number'] != '') ? sanitize_text_field( $_REQUEST['number'] ) : 0;
		$words_percentage_from = (isset($_REQUEST['wordsPercentageFrom']) && $_REQUEST['wordsPercentageFrom'] != '') ? intval(sanitize_text_field( $_REQUEST['wordsPercentageFrom'] )) : 0;
		$words_percentage_to = (isset($_REQUEST['wordsPercentageTo']) && $_REQUEST['wordsPercentageTo'] != '') ? intval(sanitize_text_field( $_REQUEST['wordsPercentageTo'] )) : 100;

		if ($words_percentage_from == 0) {
			$sql_word_percentage = "AND (`percentage` BETWEEN " . $words_percentage_from . " AND " . $words_percentage_to . " OR `percentage` IS NULL)";
		} else {
			$sql_word_percentage = "AND (`percentage` BETWEEN " . $words_percentage_from . " AND " . $words_percentage_to . ")";
		}

		$limit_number_min = $limit_number;
		$words = array();
		$result_arr = array();

		$sql = "SELECT COUNT(`id`) FROM " . $words_table . " WHERE `category_id` IN(" . sanitize_text_field( implode( ',', $groups_ids ) ) . ") AND `" . $id_row . "` = " . $user_id . " AND `completed` = 0 AND `translation` != '' " . $sql_word_percentage;
		$completed_count = absint( $wpdb->get_var( $sql ) );
		$hidden_count = (isset($_REQUEST['hiddenCount']) && $_REQUEST['hiddenCount'] != null ) ? absint( sanitize_text_field( $_REQUEST['hiddenCount'] ) ) : $completed_count;
		
		$sql = "SELECT `id` FROM " . $words_table . " WHERE `category_id` IN(" . sanitize_text_field( implode( ',', $groups_ids ) ) . ") AND `" . $id_row . "` = " . $user_id . " AND `completed` = 1 AND `translation` != ''";
		$completed_res = $wpdb->get_results($sql,'ARRAY_A');

		foreach ($completed_res as $key => $value) {	
			array_push($ids,$value['id']);
		}

		$not_in = '';
		if(!empty($ids)){
			$not_in = " AND `id` NOT IN (" . sanitize_text_field( implode( ',', $ids ) ) . ")";
		}else{
			$not_in = '';
		}
	
		if ( $groups_ids !== null && ( $limit_number_min != $words_count || $limit_number_min == 'all' ) ) {
			$sql = "SELECT * FROM " . $words_table . " WHERE `category_id` IN(" . sanitize_text_field( implode( ',', $groups_ids ) ) . ") AND `" . $id_row . "` = " . $user_id . " AND `translation` != ''";
			$words = $wpdb->get_results($sql, 'ARRAY_A');

			$sql2 = "SELECT * FROM " . $words_table . " WHERE `category_id` IN(" . sanitize_text_field( implode( ',', $groups_ids ) ) . ") AND `" . $id_row . "` = " . $user_id . $not_in . " AND `translation` != '' " . $sql_word_percentage . " ORDER BY RAND() LIMIT 10";
			$ten_translations = $wpdb->get_results($sql2, 'ARRAY_A');
			$limit_number_min = $limit_number + 10;
			
			if($completed_count >= 4){

				$words_arr = array();
				foreach ($ten_translations as $key => $value) {
					$limit_number = $limit_number + 1;
					
					$result_arr[$value['id']]['id'] =  $value['id'];
					$result_arr[$value['id']]['translation'] = $value['translation'];
					
					$result_arr[$value['id']]['words'][] = array(
						intval( $value['id'] ),
						$value['word']
					);
					
					$result_arr[$value['id']]['correct_answer'] = intval($value['id']);
					$result_arr[$value['id']]['count'] = intval($hidden_count);
					$result_arr[$value['id']]['limitNumber'] = $limit_number_min;
					$result_arr[$value['id']]['dataId'] = $limit_number;
					
				}
				
				foreach($words as $k => $v){
					$words_arr[$v['id']] =  $v['word'];
				}
				
				foreach ($result_arr as $key => $value) {
					$words_arr2 = $words_arr;
					unset($words_arr2[$key]);
					$rand_keys = array_rand($words_arr2,3);
			
					foreach ($rand_keys as $key2 => $value2) {
						$result_arr[$key]['words'][] = array($value2,$words_arr2[$value2]);
						shuffle($result_arr[$key]['words']);					
					}
				}
			}
		
		}

		shuffle($result_arr);
		return $result_arr;
	}

	public function ays_create_cookies () {
		if (!is_user_logged_in()) {
			if (!isset($_COOKIE['ays_pd_unique_id'])) {
				$unique_id = uniqid();
				setcookie('ays_pd_unique_id', $unique_id, time() + (365 * 24 * 60 * 60));
			} else {
				$unique_id = $_COOKIE['ays_pd_unique_id'];
			}
		} else {
			$unique_id = '';
		}
		
		return $unique_id;
	}

	public function ays_generate_pd_method(){
        $this->enqueue_styles();
        $this->enqueue_scripts();
		$pd = Personal_Dictionary_Data::get_pd_globsettings();

		$this->options = Personal_Dictionary_Data::get_pd_validated_data_from_array( $pd );

		$custom_class = $this->options[ $this->name_prefix . 'custom_class' ];

		$pd_title = isset($this->options[ $this->name_prefix . 'title' ]) && $this->options[ $this->name_prefix . 'title' ] != '' ?  stripslashes ( esc_attr($this->options[ $this->name_prefix . 'title' ])) : "Dictionary" ;

		$content = array();

		$this->ays_create_cookies();

		$show_pd_description = $this->options[ $this->name_prefix . 'show_description' ];
		$show_description_mobile = $this->options[ $this->name_prefix . 'show_description_mobile' ];

		$menu_position_class = $this->html_class_prefix . 'menu-position-' . $this->options[ $this->name_prefix . 'menu_position' ];
		$menu_position_mobile_class = $this->html_class_prefix . 'menu-position-mobile-' . $this->options[ $this->name_prefix . 'menu_position_mobile' ];

		$content[] = '<h2 class="ays-pd-title" id="ays-pd-title-id">'. $pd_title .'</h2>';
		if($show_pd_description == 'on' || $show_description_mobile == 'on'){
        	$pd_description = isset($this->options[ $this->name_prefix . 'description' ]) && $this->options[ $this->name_prefix . 'description' ] != '' ?  stripslashes ( $this->options[ $this->name_prefix . 'description' ] ) : "" ;
			$pd_description = Personal_Dictionary_Data::ays_autoembed( $pd_description );
        }else{
            $pd_description = "";
        }
		$content[] = '<div class="ays-pd-description" id="ays-pd-description-id">'. $pd_description .'</div>';
		$content[] = '<div id="' . $this->html_class_prefix . 'box_id' . '" class="' . $this->html_class_prefix . 'box' . " " . $custom_class .'">';
			$content[] = '<div id="' . $this->html_class_prefix . 'container_id' . '" class="' . $this->html_class_prefix . 'container ' . $menu_position_class . ' ' . $menu_position_mobile_class . '">';

				$content[] = $this->show_pd();

			$content[] = '</div>';

		$content[] = $this->get_styles();
		$content[] = $this->get_custom_css();
		$content[] = $this->get_encoded_options(); // get_encoded_options( $limit );
		$content[] = '</div>';

		$content = implode( '', $content );
		return str_replace( array( "\r\n", "\n", "\r" ), '', $content );    
	}

	public function show_pd(){
		$enable_full_screen_mode = $this->options[ $this->name_prefix . 'enable_full_screen_mode' ];
		$enable_full_screen_mode_mobile = $this->options[ $this->name_prefix . 'enable_full_screen_mode_mobile' ];

        $fullcsreen_mode = '';
        $fullcsreen_mode_html = '<div class="ays-pd-open-full-screen">
	                <a class="ays_pd_open_full_screen">
						<svg xmlns="http://www.w3.org/2000/svg" class="ays-pd-icon-main-color-fill" height="20" viewBox="0 0 24 24" width="20" class="open_full_screen">
	                        <path d="M0 0h24v24H0z" fill="none"/>
	                        <path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"/>
	                    </svg>
	                </a>
	            </div>';
        if ( ! wp_is_mobile() ) {
	        if( $enable_full_screen_mode ){
	            $fullcsreen_mode = $fullcsreen_mode_html;
	        }        	
        }
        if ( wp_is_mobile() ) {
	        if( $enable_full_screen_mode_mobile ){
	            $fullcsreen_mode = $fullcsreen_mode_html;
	        }        	
        }

		$texts = array(
			'groups' => __( "Groups", 'personal-dictionary' ),
			'games' => __( "Games", 'personal-dictionary' ),
		);

		$group_tab_url = esc_url_raw( add_query_arg( array("ays-pd-tab"  => "groups")));
		$games_tab_url = esc_url_raw( add_query_arg( array("ays-pd-tab"  => "games")));
		$content = array();
		$current_menu = (isset($_GET['ays-pd-tab']) && $_GET['ays-pd-tab'] != '' ) ? sanitize_text_field($_GET['ays-pd-tab']) : 'groups';

		$menu_name = isset( $texts[ $current_menu ] ) ? $texts[ $current_menu ] : $texts[ 'groups' ];
		$menu_name = '<h3>'. $menu_name .'</h3>';

		$active_tab_group = ($current_menu == 'groups') ? 'ays-pd-nav-tab-active' : '';
		$active_tab_games = ($current_menu == 'games') ? 'ays-pd-nav-tab-active' : '';

		$prevIcon = '<svg width="8" height="12" viewBox="0 0 8 12" xmlns="http://www.w3.org/2000/svg" class="ays-pd-icon-main-color-fill"><path d="M0.727757 5.99993C0.727685 5.92829 0.741769 5.85734 0.769198 5.79117C0.796627 5.72499 0.83686 5.66488 0.887588 5.6143L6.34231 0.159943C6.55545 -0.0531861 6.90059 -0.0531745 7.11358 0.159969C7.32657 0.373112 7.3267 0.718248 7.11355 0.93124L2.04448 5.99997L7.11321 11.069C7.32634 11.2822 7.32633 11.6273 7.11319 11.8403C6.90004 12.0533 6.55491 12.0534 6.34192 11.8403L0.887562 6.38557C0.836837 6.33498 0.796608 6.27487 0.769184 6.20869C0.74176 6.14251 0.727681 6.07156 0.727757 5.99993Z"/></svg>';
		$addWordIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="ays-pd-icon-main-color-fill" width="12" height="12" viewBox="0 0 24 24" trtur><path d="M21.8906 9.89062H14.1094V2.10938C14.1094 0.944391 13.165 0 12 0C10.835 0 9.89062 0.944391 9.89062 2.10938V9.89062H2.10938C0.944391 9.89062 0 10.835 0 12C0 13.165 0.944391 14.1094 2.10938 14.1094H9.89062V21.8906C9.89062 23.0556 10.835 24 12 24C13.165 24 14.1094 23.0556 14.1094 21.8906V14.1094H21.8906C23.0556 14.1094 24 13.165 24 12C24 10.835 23.0556 9.89062 21.8906 9.89062Z"/></svg>';
		$sortIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="ays-pd-icon-main-color-fill" width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M11.0753 1.52588e-05C10.9236 0.00187891 10.7786 0.0627681 10.671 0.169766L8.33767 2.50428C8.25612 2.58586 8.20058 2.68979 8.17808 2.80293C8.15558 2.91607 8.16714 3.03334 8.21128 3.13992C8.25542 3.24649 8.33017 3.33759 8.42607 3.40169C8.52198 3.46579 8.63474 3.50001 8.75009 3.50004H10.5001V10.5001H8.75009C8.63474 10.5001 8.52198 10.5343 8.42607 10.5984C8.33017 10.6625 8.25542 10.7536 8.21128 10.8602C8.16714 10.9668 8.15558 11.084 8.17808 11.1972C8.20058 11.3103 8.25612 11.4143 8.33767 11.4958L10.671 13.8292C10.7804 13.9385 10.9288 14 11.0834 14C11.2381 14 11.3865 13.9385 11.4959 13.8292L13.8292 11.4958C13.9108 11.4143 13.9663 11.3103 13.9888 11.1972C14.0113 11.084 13.9997 10.9668 13.9556 10.8602C13.9115 10.7536 13.8367 10.6625 13.7408 10.5984C13.6449 10.5343 13.5321 10.5001 13.4168 10.5001H11.6668V3.50004H13.4168C13.5321 3.50001 13.6449 3.46579 13.7408 3.40169C13.8367 3.33759 13.9115 3.24649 13.9556 3.13992C13.9997 3.03334 14.0113 2.91607 13.9888 2.80293C13.9663 2.68979 13.9108 2.58586 13.8292 2.50428L11.4959 0.169766C11.4407 0.114999 11.3751 0.0718205 11.3029 0.0427691C11.2308 0.0137177 11.1536 -0.00062027 11.0759 0.000598554L11.0753 1.52588e-05ZM0.59154 2.9167H6.40858C7.19725 2.92837 7.19725 1.73836 6.40858 1.75003H0.59154C0.513735 1.74885 0.436484 1.76327 0.364342 1.79244C0.292201 1.8216 0.226631 1.86492 0.1715 1.91983C0.116369 1.97474 0.0727938 2.04014 0.0433451 2.11217C0.0138964 2.18419 -0.000829583 2.26139 3.60643e-05 2.3392C0.00586943 2.66412 0.269538 2.92137 0.59154 2.9167ZM0.59154 7.5834H6.40858C7.19725 7.59506 7.19725 6.40506 6.40858 6.41672H0.59154C0.513735 6.41555 0.436484 6.42997 0.364342 6.45913C0.292201 6.4883 0.226631 6.53161 0.1715 6.58653C0.116369 6.64144 0.0727938 6.70684 0.0433451 6.77886C0.0138964 6.85089 -0.000829583 6.92808 3.60643e-05 7.00589C0.00586943 7.33081 0.269538 7.58806 0.59154 7.5834ZM0.59154 12.2501H6.40858C7.19725 12.2618 7.19725 11.0718 6.40858 11.0834H0.59154C0.513735 11.0822 0.436484 11.0967 0.364342 11.1258C0.292201 11.155 0.226631 11.1983 0.1715 11.2532C0.116369 11.3081 0.0727938 11.3735 0.0433451 11.4456C0.0138964 11.5176 -0.000829583 11.5948 3.60643e-05 11.6726C0.00586943 11.9975 0.269538 12.2548 0.59154 12.2501Z"/></svg>';

		$show_games = $this->options[ $this->name_prefix . 'show_games' ];

		$menu_layout_class = $this->html_class_prefix . 'menu-layout-' . $this->options[ $this->name_prefix . 'menu_layout' ];
		$menu_layout_mobile_class = $this->html_class_prefix . 'menu-layout-mobile-' . $this->options[ $this->name_prefix . 'menu_layout_mobile' ];

		$content[] = '<div class="' . $this->html_class_prefix . 'nav-menu ' . $menu_layout_class . ' ' . $menu_layout_mobile_class . '">';
			$content[] = '<div class="' . $this->html_class_prefix . 'nav-menu-item">';
				$content[] = '<a href="' . $group_tab_url . '"  class="' . $this->html_class_prefix . 'nav-tab ' . $active_tab_group . '">';
					$content[] = '<img src="'. PERSONAL_DICTIONARY_PUBLIC_URL .'/images/icons/group-white.svg" class=" ' . $this->html_class_prefix . 'nav-tab-image-white">';
					$content[] = '<img src="'. PERSONAL_DICTIONARY_PUBLIC_URL .'/images/icons/group-black.svg" class=" ' . $this->html_class_prefix . 'nav-tab-image-black">';
					$content[] = '<span>'. $texts['groups'] .'</span>';
				$content[] = '</a>';
			$content[] = '</div>';
			if ($show_games == 'on') {
				$content[] = '<div class="' . $this->html_class_prefix . 'nav-menu-item">';
					$content[] = '<a href="' . $games_tab_url . '"  class="' . $this->html_class_prefix . 'nav-tab ' . $active_tab_games . '">';
						$content[] = '<img src="'. PERSONAL_DICTIONARY_PUBLIC_URL .'/images/icons/game-white.svg" class=" ' . $this->html_class_prefix . 'nav-tab-image-white">';
						$content[] = '<img src="'. PERSONAL_DICTIONARY_PUBLIC_URL .'/images/icons/game-black.svg" class=" ' . $this->html_class_prefix . 'nav-tab-image-black">';
						$content[] = '<span>'. $texts['games'] .'</span>';
					$content[] = '</a>';
				$content[] = '</div>';
			}
		$content[] = '</div>';

		
		$content[] = '<div class="' . $this->html_class_prefix . 'content' . ' ' . $this->html_class_prefix . 'content-' . $current_menu . '">';
			$content[] = '<div class="' . $this->html_class_prefix . 'content-div">';
				$content[] = '<div class="' . $this->html_class_prefix . 'header-wrap">';
					$content[] = '<div class="' . $this->html_class_prefix . 'header">';
						$content[] = '<div class="' . $this->html_class_prefix . 'header-main">';
							$content[] = '<div class="' . $this->html_class_prefix . 'header-previous-page-btn-box ' . $this->html_class_prefix . 'header-btn-box ays_display_none">';
								$content[] = '<div class="' . $this->html_class_prefix . 'header-previous-page-btn ' . $this->html_class_prefix . 'header-btn">';
									$content[] = $prevIcon;
								$content[] = '</div>';
							$content[] = '</div>';
							$content[] = $menu_name;
							$content[] = '<div class="' . $this->html_class_prefix . 'header-add-word-btn-box ' . $this->html_class_prefix . 'header-btn-box ays_display_none">';
								$content[] = '<div class="' . $this->html_class_prefix . 'header-add-word-btn ' . $this->html_class_prefix . 'header-btn">';
									$content[] = $addWordIcon;
								$content[] = '</div>';
							$content[] = '</div>';
							$content[] = '<div class="' . $this->html_class_prefix . 'header-sort-btn-box ' . $this->html_class_prefix . 'header-btn-box ays_display_none">';
								$content[] = '<div class="' . $this->html_class_prefix . 'header-sort-btn ' . $this->html_class_prefix . 'header-btn">';
									$content[] = $sortIcon;
								$content[] = '</div>';
								$content[] = '<div class="' . $this->html_class_prefix . 'sort-words-in-group-popup"></div>';
							$content[] = '</div>';
						$content[] = '</div>';
						$content[] = '<div class="' . $this->html_class_prefix . 'header-full-screen">';
							$content[] = $fullcsreen_mode;
						$content[] = '</div>';
					$content[] = '</div>';
				$content[] = '</div>';
				switch ($current_menu) {
					case 'groups':
						$content[] = $this->groups_tab();
						break;
					case 'games':
						$content[] = $this->games_tab();
						break;
					default:
						$content[] = $this->groups_tab();
						break;
				}
			$content[] = '</div>';
		$content[] = '</div>';
		$content = implode( '', $content );
		return $content;
	}

	public function groups_tab() {

		$content = array();
		$content[] = '<div class="' . $this->html_class_prefix . 'save-groups-block '.  $this->html_class_prefix . 'group-tab-add-layer" data-function="">';
		$content[] = '</div>';
		$content[] = '<div class="' . $this->html_class_prefix . 'group-tab-words '. $this->html_class_prefix . 'group-tab-add-layer" data-function="ays_groups_pd">';
		$content[] = '</div>';
		$content[] = '<div class="' . $this->html_class_prefix . 'group-tab '. $this->html_class_prefix . 'tab-content" data-function="ays_groups_pd"></div>';
		$content[] =  '<div class="ays-pd-preloader">
                <img class="loader" src="'. PERSONAL_DICTIONARY_PUBLIC_URL .'/images/loaders/3-1.svg">
            </div>';
		
		$content = implode( '',$content );
		return $content;
	}

	public function games_tab() {
		$content = array();

		$findTheWordIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="33" height="24" viewBox="0 0 33 24" class="ays-pd-icon-main-color-fill" >
		<path d="M31.6412 18.8334L24.4847 11.6752C25.8275 8.62665 25.2529 4.93029 22.76 2.43674C19.512 -0.812029 14.2546 -0.812467 11.0062 2.43674C7.76577 5.67789 7.76577 10.9516 11.0062 14.1928C13.5812 16.7683 17.3548 17.2587 20.3674 15.866L27.4874 22.9877C28.6353 24.1359 30.4935 24.136 31.6415 22.9874C32.7863 21.8421 32.7862 19.9787 31.6412 18.8334ZM12.3322 12.867C9.82261 10.3569 9.82261 6.27267 12.3322 3.76249C14.8473 1.24675 18.9184 1.24631 21.434 3.76249C23.9435 6.27267 23.9435 10.3569 21.434 12.867C18.9188 15.3828 14.8477 15.3832 12.3322 12.867ZM30.3153 21.6619C29.9003 22.0771 29.2285 22.0773 28.8133 21.6619L22.0109 14.8579C22.5699 14.4184 23.0707 13.9095 23.5011 13.3434L30.3152 20.1591C30.7294 20.5734 30.7294 21.2475 30.3153 21.6619ZM1.43754 11.2343H5.43535C5.95312 11.2343 6.37289 10.8146 6.37289 10.2968C6.37289 9.77901 5.95312 9.35925 5.43535 9.35925H1.43754C0.919769 9.35925 0.5 9.77901 0.5 10.2968C0.5 10.8146 0.919769 11.2343 1.43754 11.2343ZM1.43754 15.2345H6.93454C7.45232 15.2345 7.87208 14.8147 7.87208 14.297C7.87208 13.7792 7.45232 13.3594 6.93454 13.3594H1.43754C0.919769 13.3594 0.5 13.7792 0.5 14.297C0.5 14.8147 0.919769 15.2345 1.43754 15.2345ZM1.43754 19.2347H10.9324C11.4502 19.2347 11.87 18.8149 11.87 18.2972C11.87 17.7794 11.4502 17.3596 10.9324 17.3596H1.43754C0.919769 17.3596 0.5 17.7794 0.5 18.2972C0.5 18.8149 0.919769 19.2347 1.43754 19.2347ZM21.9265 21.3598H1.43754C0.919769 21.3598 0.5 21.7796 0.5 22.2973C0.5 22.8151 0.919769 23.2349 1.43754 23.2349H21.9265C22.4443 23.2349 22.8641 22.8151 22.8641 22.2973C22.8641 21.7796 22.4443 21.3598 21.9265 21.3598Z"/>
		</svg>';
		
		$findTheTranslationIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="29" height="28" viewBox="0 0 29 28" fill="none">
		<path d="M12.6381 16.7537L10.7631 7.37862C10.7206 7.16611 10.6058 6.97489 10.4382 6.83749C10.2706 6.70008 10.0606 6.625 9.84389 6.625H7.96889C7.75217 6.625 7.54214 6.70008 7.37455 6.83749C7.20695 6.97489 7.09214 7.16611 7.04964 7.37862L5.17464 16.7536C5.07308 17.2614 5.40239 17.7553 5.91008 17.8568C6.41777 17.9583 6.9117 17.629 7.0132 17.1213L7.61245 14.125H10.2003L10.7996 17.1214C10.9011 17.6293 11.3953 17.9584 11.9027 17.8568C12.4104 17.7553 12.7397 17.2614 12.6381 16.7537ZM7.98745 12.25L8.73745 8.5H9.07533L9.82533 12.25H7.98745ZM27.6564 14.125H24.8439V13.1875C24.8439 12.6698 24.4241 12.25 23.9064 12.25C23.3886 12.25 22.9689 12.6698 22.9689 13.1875V14.125H20.1564C19.6386 14.125 19.2189 14.5448 19.2189 15.0625C19.2189 15.5802 19.6386 16 20.1564 16H20.3833C20.9175 17.7257 21.7217 19.0504 22.6067 20.1119C21.8864 20.7708 21.1575 21.3111 20.5083 21.8304C20.104 22.1539 20.0384 22.7438 20.3619 23.1481C20.6855 23.5526 21.2755 23.6178 21.6796 23.2945C22.3325 22.7722 23.115 22.1917 23.9064 21.4655C24.6983 22.1923 25.4823 22.7738 26.1332 23.2945C26.5375 23.618 27.1275 23.5524 27.4509 23.1481C27.7743 22.7438 27.7088 22.1538 27.3045 21.8304C26.657 21.3122 25.9271 20.7714 25.2061 20.1119C26.0911 19.0504 26.8953 17.7257 27.4295 16H27.6564C28.1741 16 28.5939 15.5802 28.5939 15.0625C28.5939 14.5448 28.1741 14.125 27.6564 14.125ZM23.9064 18.7341C23.308 17.9828 22.7696 17.0861 22.3637 15.9937H25.449C25.0432 17.0861 24.5048 17.9828 23.9064 18.7341Z" class="ays-pd-icon-main-color-fill"/>
		<path d="M25.9453 4.97656H14.1109L13.7592 2.15567C13.6056 0.926734 12.5558 0 11.3173 0H2.86719C1.51023 0 0.40625 1.10398 0.40625 2.46094V20.5625C0.40625 21.9195 1.51023 23.0234 2.86719 23.0234H9.78423L10.1314 25.8443C10.2847 27.0708 11.3345 28 12.5733 28H25.9453C27.3023 28 28.4062 26.896 28.4062 25.5391V7.4375C28.4062 6.08054 27.3023 4.97656 25.9453 4.97656ZM2.86719 21.3828C2.41487 21.3828 2.04688 21.0148 2.04688 20.5625V2.46094C2.04688 2.00862 2.41487 1.64062 2.86719 1.64062H11.3173C11.7302 1.64062 12.0801 1.9495 12.1312 2.35889L14.5027 21.3828H2.86719ZM11.7115 25.252L11.4372 23.0234H13.6381L11.7115 25.252ZM26.7656 25.5391C26.7656 25.9914 26.3976 26.3594 25.9453 26.3594H12.9228L16.0457 22.7471C16.1244 22.6584 16.1829 22.5537 16.2172 22.4401C16.2514 22.3266 16.2606 22.207 16.2441 22.0895L14.3154 6.61719H25.9453C26.3976 6.61719 26.7656 6.98518 26.7656 7.4375V25.5391Z" class="ays-pd-icon-main-color-fill"/>
		</svg>';

		$show_games = $this->options[ $this->name_prefix . 'show_games' ];
		$show_game_find_the_word = $this->options[ $this->name_prefix . 'show_game_find_the_word' ];
		$show_game_find_the_translation = $this->options[ $this->name_prefix . 'show_game_find_the_translation' ];

		$games_animation_effect = $this->options[ $this->name_prefix . 'games_animation_effect' ];
		$games_animation_effect_mobile = $this->options[ $this->name_prefix . 'games_animation_effect_mobile' ];
		
		$animation_effect = 'none';
		if ( ! wp_is_mobile() ) {
	        if( $games_animation_effect ){
	            $animation_effect = $games_animation_effect;
	        }        	
        }
        if ( wp_is_mobile() ) {
	        if( $games_animation_effect_mobile ){
	            $animation_effect = $games_animation_effect_mobile;
	        }       	
        }		

		if ($show_games == 'on') {
			$content[] = '<div class="' . $this->html_class_prefix . 'games-tab '. $this->html_class_prefix . 'tab-content'.'" data-animation-effect="' . $animation_effect . '" data-function="ays_games_pd">';
				$content[] = '<div class="' . $this->html_class_prefix . 'games-choosing-type">';

				if($show_game_find_the_word == 'on') {
					$content[] = '<div class="' . $this->html_class_prefix . 'games-choosing-type-each">';
						$content[] = '<label>';
							$content[] = '<input class="' . $this->html_class_prefix . 'game-type-rad'.'" id="' . $this->html_class_prefix . 'games-type-find-word'. '" type="radio" name="ays-pd[game_type]" value="find_word">';
							$content[] = '<div class="' . $this->html_class_prefix . 'game-type-item">';
								$content[] = '<div class="' . $this->html_class_prefix . 'game-type-item-image">' . $findTheWordIcon . '</div>';
								$content[] = '<div class="' . $this->html_class_prefix . 'game-type-item-title">'. __("Find the word", 'personal-dictionary' ) . '</div>';
							$content[] = '</div>';
						$content[] = '</label>';
					$content[] = '</div>';
				}

				if($show_game_find_the_translation == 'on') {
					$content[] = '<div class="' . $this->html_class_prefix . 'games-choosing-type-each">';
						$content[] = '<label>';
							$content[] = '<input class="' . $this->html_class_prefix . 'game-type-rad'.'" id="' . $this->html_class_prefix . 'games-type-find-translation'. '" type="radio" name="ays-pd[game_type]" value="find_translation">';
							$content[] = '<div class="' . $this->html_class_prefix . 'game-type-item">';
								$content[] = '<div class="' . $this->html_class_prefix . 'game-type-item-image">' . $findTheTranslationIcon . '</div>';
								$content[] = '<div class="' . $this->html_class_prefix . 'game-type-item-title">'. __("Find the translation", 'personal-dictionary' ) . '</div>';
							$content[] = '</div>';
						$content[] = '</label>';
					$content[] = '</div>';
				}
	
				$content[] = '</div>';
	
				$content[] = '<div class="' . $this->html_class_prefix . 'games-type-content" style="display:none">';
					$content[] = '<div class="' . $this->html_class_prefix . 'games-type-content-settings"></div>';
					$content[] = '<form method="POST" class="' . $this->html_class_prefix . 'games-type-content-game"></form>';
				$content[] = '</div>';
	
			$content[] = '</div>';

			$content[] = '<div class="ays-pd-preloader">
				<img class="loader" src="'. PERSONAL_DICTIONARY_PUBLIC_URL .'/images/loaders/3-1.svg">
			</div>';
		}


		$content = implode( '', $content );
		return $content;
	}

	public function get_custom_css() {

        $content = array();
        if( $this->options[ $this->name_prefix . 'custom_css' ] != '' ){

            $content[] = '<style type="text/css">';
            
	        	$content[] = $this->options[ $this->name_prefix . 'custom_css' ];
            
            $content[] = '</style>';
            
        }

        $content = implode( '', $content );

    	return $content;
    }

	// public function get_encoded_options( $limit ){
	public function get_encoded_options () {

        
        $content = array();

        // if( $limit ){
                
            $content[] = '<script type="text/javascript">';

            // $this->options['is_user_logged_in'] = is_user_logged_in();
        
            $content[] = "
                    if(typeof aysPdOptions === 'undefined'){
                        var aysPdOptions = [];
                    }
                    aysPdOptions  = '" . base64_encode( json_encode( $this->options ) ) . "';";
            
            $content[] = '</script>';
            
        // }

        $content = implode( '', $content );

    	return $content;
    }

	public function get_styles(){
		
		$content = array();

		// generate styles for hiding/showing menu icons
		if ($this->options[ $this->name_prefix . 'menu_items' ] == 'text') {
			$menu_item_styles = '
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab img {
				display: none !important;
			}';
		} else if ($this->options[ $this->name_prefix . 'menu_items' ] == 'icon') {
			$menu_item_styles = '
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab span {
				display: none !important;
			}
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab img {
				margin-right: 0 !important;
			}';
		} else {
			$menu_item_styles = '
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab {
				justify-content: flex-start !important;
			}';
		}

		// generate styles for hiding/showing menu icons for mobile devices
		if ($this->options[ $this->name_prefix . 'menu_items_mobile' ] == 'text') {
			$menu_item_styles_mobile = '
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab span {
				display: block !important;
			}
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab img {
				display: none !important;
			}';
		} else if ($this->options[ $this->name_prefix . 'menu_items_mobile' ] == 'icon') {
			$menu_item_styles_mobile = '
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab span,
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab img.' . $this->html_class_prefix . 'nav-tab-image-white {
				display: none !important;
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab img.' . $this->html_class_prefix . 'nav-tab-image-black {
				display:block !important;
			}
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab.' . $this->html_class_prefix . 'nav-tab-active img.' . $this->html_class_prefix . 'nav-tab-image-white {
				display: block !important;
				margin-right: 0 !important;
            }
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab.' . $this->html_class_prefix . 'nav-tab-active img.' . $this->html_class_prefix . 'nav-tab-image-black {
				display: none !important;
            }
			';
		} else {
			$menu_item_styles_mobile = '
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab span {
				display: block !important;
			}
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab img.' . $this->html_class_prefix . 'nav-tab-image-white {
				display: none !important;
			}
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab img.' . $this->html_class_prefix . 'nav-tab-image-black,
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab.' . $this->html_class_prefix . 'nav-tab-active img.' . $this->html_class_prefix . 'nav-tab-image-white {
				display:block !important;
			}
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab.' . $this->html_class_prefix . 'nav-tab-active img.' . $this->html_class_prefix . 'nav-tab-image-black {
				display: none !important;
            }
			';
		}

		$ays_pd_container_box_shadow = '';
		if ($this->options[ $this->name_prefix . 'enable_container_box_shadow']) {
			$box_shadow_offsets = $this->options[ $this->name_prefix . 'container_box_shadow_x_offset' ] . 'px ' . $this->options[ $this->name_prefix . 'container_box_shadow_y_offset' ] . 'px ' . $this->options[ $this->name_prefix . 'container_box_shadow_z_offset' ] . 'px ';
			$ays_pd_container_box_shadow = 'box-shadow:'.$box_shadow_offsets.$this->options[ $this->name_prefix . 'container_box_shadow_color' ];
		}

		$ays_pd_answer_box_shadow = '';
		if ($this->options[ $this->name_prefix . 'enable_answer_box_shadow']) {
			$answer_box_shadow_offsets = $this->options[ $this->name_prefix . 'answer_box_shadow_x_offset' ] . 'px ' . $this->options[ $this->name_prefix . 'answer_box_shadow_y_offset' ] . 'px ' . $this->options[ $this->name_prefix . 'answer_box_shadow_z_offset' ] . 'px ';
			$ays_pd_answer_box_shadow = $answer_box_shadow_offsets.$this->options[ $this->name_prefix . 'answer_box_shadow_color' ];
		}

        $content[] = '<style type="text/css">';
		

       
        $content[] = ' 

			input[type="search"]:focus{
				box-shadow: unset !important;
			}

			.ays-pd-icon-main-color-fill {
				fill: ' . $this->options[ $this->name_prefix . 'main_color' ] . ';
			}

			div#' . $this->html_class_prefix . 'box_id input[type="button"], div#' . $this->html_class_prefix . 'box_id input[type="submit"] {
                font-size: ' . $this->options[ $this->name_prefix . 'button_font_size' ] . 'px;
                border-radius: ' . $this->options[ $this->name_prefix . 'buttons_border_radius' ] . 'px; 
                padding: ' . $this->options[ $this->name_prefix . 'buttons_top_bottom_padding' ] . 'px ' . $this->options[ $this->name_prefix . 'buttons_left_right_padding' ] . 'px; 
            }

			div#' . $this->html_class_prefix . 'box_id input[type="button"]:not(.' . $this->html_class_prefix . 'secondary-input-fields) , input[type="submit"] {
				background-color: ' . $this->options[ $this->name_prefix . 'main_color' ] . ';
                color: ' . $this->options[ $this->name_prefix . 'button_text_color' ] .';
				border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color' ] . ' !important;
				background-image: unset;
			}

			div#' . $this->html_class_prefix . 'box_id input[type="button"].' . $this->html_class_prefix . 'secondary-input-fields {
				color: ' . $this->options[ $this->name_prefix . 'main_color' ] . ';
				border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color' ] . ' !important;
				background-color: ' . $this->options[ $this->name_prefix . 'button_text_color' ] .';
				background-image: unset;
			}


			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content,
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu {
				' . $ays_pd_container_box_shadow . '
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu,
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content {
				background-color: ' . $this->options[ $this->name_prefix . 'bg_color' ] . ';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab.' . $this->html_class_prefix . 'nav-tab-active {
				background-color: ' . $this->options[ $this->name_prefix . 'main_color' ] . ';
            }
			'.
			$menu_item_styles
			.'
            div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'header-wrap div.' . $this->html_class_prefix . 'header-main div.' . $this->html_class_prefix . 'header-btn-box {
				background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color' ] , 0.2 ) . ';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'header-wrap div.' . $this->html_class_prefix . 'header-full-screen div.' . $this->html_class_prefix . 'open-full-screen a {
				background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color' ] , 0.2 ) . ';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'empty-groups-content div.' . $this->html_class_prefix . 'add_group_btn,
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'empty-groups-content div.' . $this->html_class_prefix . 'add_word_btn,
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'add-group-word-buttons-container div.' . $this->html_class_prefix . 'add_group_btn {
				background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color' ] , 0.2 ) . ';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'each_group_item {
				background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color' ] , 0.2 ) . ';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab a.' . $this->html_class_prefix . 'group-delete-button-item,
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'word-save-and-delete-button-block span {
				color: ' . $this->options[ $this->name_prefix . 'main_color' ] . ' !important;
				border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color' ] . ' !important;
				background-color: ' . $this->options[ $this->name_prefix . 'button_text_color' ] .' !important;
				border-radius: ' . $this->options[ $this->name_prefix . 'buttons_border_radius' ] . 'px !important; 
				padding: ' . $this->options[ $this->name_prefix . 'buttons_top_bottom_padding' ] . 'px ' . $this->options[ $this->name_prefix . 'buttons_left_right_padding' ] . 'px !important;
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'words-each-item-block {
				background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color' ] , 0.2 ) . ';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'save-groups-block {
				background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color' ] , 0.2 ) . ';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-choosing-type label {
				background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color' ] , 0.2 ) . ';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-choosing-type label div.' . $this->html_class_prefix . 'game-type-item-title{
				color: ' . $this->options[ $this->name_prefix . 'main_color' ] .';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'group-tab-words {
				background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color' ] , 0.2 ) . ';
				color: ' . $this->options[ $this->name_prefix . 'text_color' ] .';
			}

			div.' . $this->html_class_prefix . 'group-tab-words  input[type="text"].' . $this->html_class_prefix . 'word_saving_fields {
				border-bottom: 1px solid ' . $this->options[ $this->name_prefix . 'main_color' ] .';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-type-content .' . $this->html_class_prefix . 'games-type-content-settings {
				background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color' ] , 0.2 ) . ';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-check-words-count label.' . $this->html_class_prefix .'form-check-label {
				border: 1px solid ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color' ] , 0.2 ) .';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-check-words-count label.' . $this->html_class_prefix .'form-check-label-active {
				border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color' ] .';
			}
			
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-check-words-count label.' . $this->html_class_prefix .'form-check-label input[type="radio"] {
				accent-color: ' . $this->options[ $this->name_prefix . 'main_color' ] .';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-words-learned-percentage label.' . $this->html_class_prefix .'form-input-label input[type="number"]:focus-visible {
				border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color' ] .';
				color: ' . $this->options[ $this->name_prefix . 'main_color' ] .';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'games-type-content-game-box {
				background-color: ' . $this->options[ $this->name_prefix . 'bg_color'] . ';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'games-logo-block {
				background-color: ' . $this->options[ $this->name_prefix . 'bg_color'] . ';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'games-type-content-game-box  div.' . $this->html_class_prefix . 'game-fields label {
				border: 1px solid ' . $this->options[ $this->name_prefix . 'bg_color' ] .';
				font-size: ' . $this->options[ $this->name_prefix . 'answer_font_size' ] . 'px;
				text-transform: ' . $this->options[ $this->name_prefix . 'answer_text_transform' ] . ';
				background-color: ' . $this->options[ $this->name_prefix . 'answer_bg_color' ] . ';
				color: ' . $this->options[ $this->name_prefix . 'text_color' ] .';				
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'games-type-content-game-box  div.' . $this->html_class_prefix . 'game-fields {
				box-shadow: ' . $ays_pd_answer_box_shadow .';
			}			

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'games-type-content-game-box  div.' . $this->html_class_prefix . 'game-fields	 .checked_answer {
				border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color' ] .';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'game-fields:not(.correct_div) .no_selected {
				border: 1px solid ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color' ] , 0.2 ) .' !important;
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'each_group_item .ays-pd_each_group_name {
				color: ' . $this->options[ $this->name_prefix . 'text_color' ] .';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'add_word_button_under_words_list>div {
				border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color' ] .';
				border-radius: ' . $this->options[ $this->name_prefix . 'buttons_border_radius' ] . 'px;
				padding: ' . $this->options[ $this->name_prefix . 'buttons_top_bottom_padding' ] . 'px ' . $this->options[ $this->name_prefix . 'buttons_left_right_padding' ] . 'px;
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'add_word_button_under_words_list>div>span {
				color: ' . $this->options[ $this->name_prefix . 'main_color' ] .' !important;
			}

			div#' . $this->html_class_prefix . 'box_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'close-button-div-word-top {
				border-bottom: 1px solid ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color' ] , 0.2 ) .';
			}

			.' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'words-each-item-block div.' . $this->html_class_prefix . 'group-tab-edit-layer div.' . $this->html_class_prefix . 'word-translation-fields-parent input {
				border-bottom: 1px solid ' . $this->options[ $this->name_prefix . 'main_color' ] .';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'each_group_item .ays-pd_each_group_title_words_count {
				color: ' . $this->options[ $this->name_prefix . 'text_color' ] .';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'words-each-item-block span.' . $this->html_class_prefix . 'each_word_span,
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'words-each-item-block span.' . $this->html_class_prefix . 'each_translation,
			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'words-each-item-block p.' . $this->html_class_prefix . 'each_word_number {
				color: ' . $this->options[ $this->name_prefix . 'text_color' ] .';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'each_group_item div.' . $this->html_class_prefix . 'dropdown-buttons button:hover {
				background-color: ' .  Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color' ], 0.2 ) . ';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'groups-modal-main-container div.' . $this->html_class_prefix . 'groups-modal-content div.' . $this->html_class_prefix . 'groups-modal-header{
				background-color: ' .  $this->options[ $this->name_prefix . 'main_color' ] . ';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'groups-modal-main-container div.' . $this->html_class_prefix . 'groups-modal-content div.' . $this->html_class_prefix . 'groups-modal-header span{
				color: #fff;
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'groups-modal-main-container div.' . $this->html_class_prefix . 'groups-modal-content div#' . $this->html_class_prefix . 'groups-modal-body{
				background-color: ' . $this->options[ $this->name_prefix . 'bg_color' ] . ';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'groups-modal-main-container div.' . $this->html_class_prefix . 'groups-modal-content div#' . $this->html_class_prefix . 'groups-modal-body div.ays-pd-each_group_item-move{
				background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color' ] , 0.2 ) . ';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'groups-modal-main-container div.' . $this->html_class_prefix . 'groups-modal-content div#' . $this->html_class_prefix . 'groups-modal-body div.ays-pd-each_group_item-move p.ays-pd_each_group_name-move{
				color: ' . $this->options[ $this->name_prefix . 'text_color' ] .';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'confirm-modal-main-container div.' . $this->html_class_prefix . 'confirm-modal-content{
				background-color: ' . $this->options[ $this->name_prefix . 'bg_color' ] . ';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'confirm-modal-main-container div.' . $this->html_class_prefix . 'confirm-modal-header p{
				color: ' . $this->options[ $this->name_prefix . 'text_color' ] .';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'confirm-modal-main-container button.' . $this->html_class_prefix . 'confirm-modal-submit{
				background-color: ' .  $this->options[ $this->name_prefix . 'main_color' ] . ';
				color: ' . $this->options[ $this->name_prefix . 'button_text_color' ] .';
				font-size: ' . $this->options[ $this->name_prefix . 'button_font_size' ] . 'px; 
				border-radius: ' . $this->options[ $this->name_prefix . 'buttons_border_radius' ] . 'px; 
				padding: ' . $this->options[ $this->name_prefix . 'buttons_top_bottom_padding' ] . 'px ' . $this->options[ $this->name_prefix . 'buttons_left_right_padding' ] . 'px;
			}

			div#' . $this->html_class_prefix . 'box_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-tab .ays-pd-games-question-para {
				font-size: ' . $this->options[ $this->name_prefix . 'question_font_size' ] . 'px;
				color: ' . $this->options[ $this->name_prefix . 'text_color' ] .';
			}

			div#' . $this->html_class_prefix . 'box_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-tab .ays-pd-games-find-translation{
				font-size: ' . $this->options[ $this->name_prefix . 'question_font_size' ] . 'px;
				color: ' . $this->options[ $this->name_prefix . 'text_color' ] .';
			}

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id input[type="submit"]:hover {
				background-color: ' . $this->options[ $this->name_prefix . 'main_color' ] . ';
				color: ' . $this->options[ $this->name_prefix . 'button_text_color' ] .';
			}';

			$content[] = $this->get_css_mobile_part($menu_item_styles_mobile);

			if( $this->options[ $this->name_prefix . 'container_border_radius'] ){
				$content[] = '
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content,
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu {
					border-radius: ' . $this->options[ $this->name_prefix . 'container_border_radius' ] . 'px;
	            }
				';
			}

			if( $this->options[ $this->name_prefix . 'container_border_width'] ){
				$content[] = '
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content,
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu {
					border-width: ' . $this->options[ $this->name_prefix . 'container_border_width' ] . 'px;
	            }
				';
			}

			if( $this->options[ $this->name_prefix . 'container_border_color'] ){
				$content[] = '
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content,
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu {
					border-color: ' . $this->options[ $this->name_prefix . 'container_border_color' ] . ';
	            }
				';
			}

			if( $this->options[ $this->name_prefix . 'container_border_style'] ){
				$content[] = '
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content,
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu {
					border-style: ' . $this->options[ $this->name_prefix . 'container_border_style' ] . ';
	            }
				';
			}

			if( $this->options[ $this->name_prefix . 'enable_answer_border'] == 'on' ){
				$answ_border_width = $this->options[ $this->name_prefix . 'answer_border_width'] ? $this->options[ $this->name_prefix . 'answer_border_width'] : 1;
				$answ_border_radius = $this->options[ $this->name_prefix . 'answer_border_radius'] ? $this->options[ $this->name_prefix . 'answer_border_radius'] : 0;
				$answ_border_color = $this->options[ $this->name_prefix . 'answer_border_color'] ? $this->options[ $this->name_prefix . 'answer_border_color'] : 'rgba(148,148,148,0.85)';
				$answ_border_style = $this->options[ $this->name_prefix . 'answer_border_style'] ? $this->options[ $this->name_prefix . 'answer_border_style'] : 'solid';
				$content[] = '

				.' . $this->html_class_prefix . 'box div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'game-fields  {                
	                border: '.$answ_border_width.'px '.$answ_border_style.' '.$answ_border_color.';
	                border-radius: '. $answ_border_radius .'px;
	            }

	            div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'games-type-content-game-box  div.' . $this->html_class_prefix . 'game-fields:hover {
						border: '.$answ_border_width.'px solid ' . $this->options[ $this->name_prefix . 'main_color' ] .';
						border-radius: '. $answ_border_radius .'px;
				}
				
				';
			}else{
				$content[] = '
					div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'games-type-content-game-box  div.' . $this->html_class_prefix . 'game-fields:hover {
						border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color' ] .' !important;
					}
					';
			}
			
			$ays_pd_title_text_shadow = '';
	        if ($this->options[ $this->name_prefix . 'enable_title_text_shadow']) {
        		$text_shadow_offsets = $this->options[ $this->name_prefix . 'title_text_shadow_x_offset' ] . 'px ' . $this->options[ $this->name_prefix . 'title_text_shadow_y_offset' ] . 'px ' . $this->options[ $this->name_prefix . 'title_text_shadow_z_offset' ] . 'px ';
	            $ays_pd_title_text_shadow = 'text-shadow:'.$text_shadow_offsets.$this->options[ $this->name_prefix . 'title_text_shadow_color' ];
	        }
			
			// Answer View
			if( $this->options[ $this->name_prefix . 'answer_view'] == 'list' ){
				$content[] = '				
				div.' . $this->html_class_prefix . 'box div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'game-fields-container div.' . $this->html_class_prefix . 'game-fields{
					flex-basis: 90%;
	            }
				';
			}

	        $ays_pd_title_alignment = 'text-align:'.$this->options[ $this->name_prefix . 'title_alignment'];

	        $ays_pd_title_alignment_mobile = 'text-align:'.$this->options[ $this->name_prefix . 'title_alignment_mobile'];

	        $ays_pd_title_font_size = 'font-size:'. $this->options[ $this->name_prefix . 'title_font_size'] . 'px';

	        $ays_pd_title_text_transform = 'text-transform:'. $this->options[ $this->name_prefix . 'title_text_transform'];
	        
	        $ays_pd_title_text_transform_mobile = 'text-transform:'. $this->options[ $this->name_prefix . 'title_text_transform_mobile'];

	        $ays_pd_title_text_color = 'color:'. $this->options[ $this->name_prefix . 'title_text_color'] . ';';
     
			// Show PD Title
			if($this->options[ $this->name_prefix . 'show_title' ] == 'on'){
				$content[] = 'h2.' . $this->html_class_prefix . 'title{
					display: block;
					'. $ays_pd_title_font_size .';
					'. $ays_pd_title_text_transform .';
					'. $ays_pd_title_text_color .';
					'. $ays_pd_title_text_shadow .';
					'. $ays_pd_title_alignment .';
				}';
			}else if($this->options[ $this->name_prefix . 'show_title' ] == 'off'){
				$content[] = 'h2.' . $this->html_class_prefix . 'title{
					display: none;				
				}';
			}
     
			// Show PD Title mobile
			if($this->options[ $this->name_prefix . 'show_title_mobile' ] == 'on'){
				$show_title_mobile = 'h2.' . $this->html_class_prefix . 'title{
					display: block;
					'. $ays_pd_title_font_size .';
					'. $ays_pd_title_text_transform_mobile .';
					'. $ays_pd_title_text_color .';
					'. $ays_pd_title_text_shadow .';
					'. $ays_pd_title_alignment_mobile .';
				}';
			}else if($this->options[ $this->name_prefix . 'show_title_mobile' ] == 'off'){
				$show_title_mobile = 'h2.' . $this->html_class_prefix . 'title{
					display: none;				
				}';
			}

			$ays_pd_desc_text_transform = 'text-transform:'. $this->options[ $this->name_prefix . 'desc_text_transform'];
	        
	        $ays_pd_desc_text_transform_mobile = 'text-transform:'. $this->options[ $this->name_prefix . 'desc_text_transform_mobile'];

			$ays_pd_description_font_size = 'font-size:'. $this->options[ $this->name_prefix . 'description_font_size'] . 'px';

			$ays_pd_description_alignment = 'text-align:'. $this->options[ $this->name_prefix . 'desc_alignment'];

			$ays_pd_description_alignment_mobile = 'text-align:'.$this->options[ $this->name_prefix . 'desc_alignment_mobile'];

			$ays_pd_description_text_shadow = '';
	        if ($this->options[ $this->name_prefix . 'enable_description_text_shadow']) {
        		$description_text_shadow_offsets = $this->options[ $this->name_prefix . 'description_text_shadow_x_offset' ] . 'px ' . $this->options[ $this->name_prefix . 'description_text_shadow_y_offset' ] . 'px ' . $this->options[ $this->name_prefix . 'description_text_shadow_z_offset' ] . 'px ';
	            $ays_pd_description_text_shadow = 'text-shadow:'.$description_text_shadow_offsets.$this->options[ $this->name_prefix . 'description_text_shadow_color' ];
	        }

	        // Show PD Description
			if($this->options[ $this->name_prefix . 'show_description' ] == 'on'){
				$content[] = 'div.' . $this->html_class_prefix . 'description{
					'.$ays_pd_desc_text_transform.';
					'.$ays_pd_description_font_size.';
					'.$ays_pd_description_alignment.';
					'.$ays_pd_description_text_shadow.';
				}';
			}else if($this->options[ $this->name_prefix . 'show_description' ] == 'off'){
				$content[] = 'div.' . $this->html_class_prefix . 'description{
					display: none;				
				}';
			}

			// Show PD Description mobile
			if($this->options[ $this->name_prefix . 'show_description_mobile' ] == 'on'){
				$show_description_mobile = 'div.' . $this->html_class_prefix . 'description{
					display: block;
					'.$ays_pd_desc_text_transform_mobile.';
					'.$ays_pd_description_font_size.';
					'.$ays_pd_description_alignment_mobile.';
					'.$ays_pd_description_text_shadow.';
				}';
			}else if($this->options[ $this->name_prefix . 'show_description_mobile' ] == 'off'){
				$show_description_mobile = 'div.' . $this->html_class_prefix . 'description{
					display: none;				
				}';
			}

			$content[] = '@media screen and (max-width: 768px){
				'.$show_title_mobile.'
				'.$show_description_mobile.'
			}';

    	$content[] = '</style>';
    	$content = implode( '', $content );
    	return $content;
    }

    public function get_css_mobile_part($menu_item_styles_mobile) {
		$content = '';

		if( $this->options[ $this->name_prefix . 'enable_answer_border'] == 'on' ){
			$answ_border_width_mobile = $this->options[ $this->name_prefix . 'answer_border_width_mobile'] ? $this->options[ $this->name_prefix . 'answer_border_width_mobile'] : 1;
			$answ_border_radius_mobile = $this->options[ $this->name_prefix . 'answer_border_radius_mobile'] ? $this->options[ $this->name_prefix . 'answer_border_radius_mobile'] : 0;
			$answ_border_style_mobile = $this->options[ $this->name_prefix . 'answer_border_style_mobile'] ? $this->options[ $this->name_prefix . 'answer_border_style_mobile'] : 'solid';
			$answ_border_color_mobile = $this->options[ $this->name_prefix . 'answer_border_color_mobile'] ? $this->options[ $this->name_prefix . 'answer_border_color_mobile'] : 'rgba(148,148,148,0.85)';

			$answer_border_mobile_styles = '
			.' . $this->html_class_prefix . 'box div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'game-fields {                
	                border: '. $answ_border_width_mobile .'px '. $answ_border_style_mobile .' ' . $answ_border_color_mobile .' !important;
	                border-radius: '. $answ_border_radius_mobile .'px !important;
            }

			div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'games-type-content-game-box  div.' . $this->html_class_prefix . 'game-fields:hover {
					border: '.$answ_border_width_mobile.'px solid ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] .' !important;
					border-radius: '. $answ_border_radius_mobile .'px !important;
			}
			';
		}else{
			$answer_border_mobile_styles = '
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'games-type-content-game-box  div.' . $this->html_class_prefix . 'game-fields:hover {
					border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] .' !important;
				}
				';
		}

		$content .= '
			@media screen and (max-width: 768px){

				.ays-pd-icon-main-color-fill {
					fill: ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] . ';
				}

				div#' . $this->html_class_prefix . 'box_id input[type="button"]:not(.' . $this->html_class_prefix . 'secondary-input-fields) , input[type="submit"] {
					background-color: ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] . ';
					color: ' . $this->options[ $this->name_prefix . 'button_text_color_mobile' ] .';
					border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] . ' !important;
				}

				div#' . $this->html_class_prefix . 'box_id input[type="button"].' . $this->html_class_prefix . 'secondary-input-fields {
					color: ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] . ';
					background-color: ' . $this->options[ $this->name_prefix . 'button_text_color_mobile' ] .';
					border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] . ' !important;
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu .' . $this->html_class_prefix . 'nav-menu-item .' . $this->html_class_prefix . 'nav-tab.' . $this->html_class_prefix . 'nav-tab-active {
					background-color: ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'header-wrap div.' . $this->html_class_prefix . 'header-main div.' . $this->html_class_prefix . 'header-btn-box {
					background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color_mobile' ] , 0.2 ) . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'header-wrap div.' . $this->html_class_prefix . 'header-full-screen div.' . $this->html_class_prefix . 'open-full-screen a {
					background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color_mobile' ] , 0.2 ) . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'empty-groups-content div.' . $this->html_class_prefix . 'add_group_btn,
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'empty-groups-content div.' . $this->html_class_prefix . 'add_word_btn,
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'add-group-word-buttons-container div.' . $this->html_class_prefix . 'add_group_btn {
					background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color_mobile' ] , 0.2 ) . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'each_group_item {
					background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color_mobile' ] , 0.2 ) . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab a.' . $this->html_class_prefix . 'group-delete-button-item,
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'word-save-and-delete-button-block span {
					background-color: ' . $this->options[ $this->name_prefix . 'button_text_color_mobile' ] .' !important;
					color: ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] . ' !important;
					border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] . ' !important;
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'words-each-item-block {
					background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color_mobile' ] , 0.2 ) . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'save-groups-block {
					background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color_mobile' ] , 0.2 ) . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-choosing-type label {
					background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color_mobile' ] , 0.2 ) . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-choosing-type label div.' . $this->html_class_prefix . 'game-type-item-title{
					color: ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] .';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'group-tab-words {
					background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color_mobile' ] , 0.2 ) . ';
					color: ' . $this->options[ $this->name_prefix . 'text_color_mobile' ] .';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'each_group_item .ays-pd_each_group_name {
					color: ' . $this->options[ $this->name_prefix . 'text_color_mobile' ] .';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'each_group_item .ays-pd_each_group_title_words_count {
					color: ' . $this->options[ $this->name_prefix . 'text_color_mobile' ] .';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'words-each-item-block span.' . $this->html_class_prefix . 'each_word_span,
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'words-each-item-block span.' . $this->html_class_prefix . 'each_translation,
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'words-each-item-block p.' . $this->html_class_prefix . 'each_word_number {
					color: ' . $this->options[ $this->name_prefix . 'text_color_mobile' ] .';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'groups-modal-main-container div.' . $this->html_class_prefix . 'groups-modal-content div#' . $this->html_class_prefix . 'groups-modal-body div.ays-pd-each_group_item-move p.ays-pd_each_group_name-move{
					color: ' . $this->options[ $this->name_prefix . 'text_color_mobile' ] .';
				}
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'confirm-modal-main-container div.' . $this->html_class_prefix . 'confirm-modal-header p{
					color: ' . $this->options[ $this->name_prefix . 'text_color_mobile' ] .';
				}

				div.' . $this->html_class_prefix . 'group-tab-words  input[type="text"].' . $this->html_class_prefix . 'word_saving_fields {
					border-bottom: 1px solid ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] .';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-type-content .' . $this->html_class_prefix . 'games-type-content-settings {
					background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color_mobile' ] , 0.2 ) . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-check-words-count label.' . $this->html_class_prefix .'form-check-label {
					border: 1px solid ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color_mobile' ] , 0.2 ) .';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-check-words-count label.' . $this->html_class_prefix .'form-check-label-active {
					border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] .';
				}
				
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-check-words-count label.' . $this->html_class_prefix .'form-check-label input[type="radio"] {
					accent-color: ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] .';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-words-learned-percentage label.' . $this->html_class_prefix .'form-input-label input[type="number"]:focus-visible {
					border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] .';
					color: ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] .';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'games-type-content-game-box  div.' . $this->html_class_prefix . 'game-fields	 .checked_answer {
					border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] .';
				}';

				// Answer View
				if( $this->options[ $this->name_prefix . 'answer_view_mobile'] == 'grid' ){
					$content .= '				
					div.' . $this->html_class_prefix . 'box div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'game-fields-container div.' . $this->html_class_prefix . 'game-fields{
						flex-basis: 40% !important;
		            }
					';
				}

				$content .= $answer_border_mobile_styles;

				$content .= '
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'game-fields:not(.correct_div) .no_selected {
					border: 1px solid ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color_mobile' ] , 0.2 ) .' !important;
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'add_word_button_under_words_list>div {
					border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] .';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'add_word_button_under_words_list>div>span {
					color: ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] .' !important;
				}

				div#' . $this->html_class_prefix . 'box_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'close-button-div-word-top {
					border-bottom: 1px solid ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color_mobile' ] , 0.2 ) .';
				}

				.' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'words-each-item-block div.' . $this->html_class_prefix . 'group-tab-edit-layer div.' . $this->html_class_prefix . 'word-translation-fields-parent input {
					border-bottom: 1px solid ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] .';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'each_group_item div.' . $this->html_class_prefix . 'dropdown-buttons button:hover {
					background-color: ' .  Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color_mobile' ], 0.2 ) . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'groups-modal-main-container div.' . $this->html_class_prefix . 'groups-modal-content div.' . $this->html_class_prefix . 'groups-modal-header{
					background-color: ' .  $this->options[ $this->name_prefix . 'main_color_mobile' ] . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'groups-modal-main-container div.' . $this->html_class_prefix . 'groups-modal-content div#' . $this->html_class_prefix . 'groups-modal-body div.ays-pd-each_group_item-move{
					background-color: ' . Personal_Dictionary_Data::hex2rgba( $this->options[ $this->name_prefix . 'main_color_mobile' ] , 0.2 ) . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'confirm-modal-main-container button.' . $this->html_class_prefix . 'confirm-modal-submit{
					color: ' . $this->options[ $this->name_prefix . 'button_text_color_mobile' ] .';
					background-color: ' .  $this->options[ $this->name_prefix . 'main_color_mobile' ] . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id input[type="submit"]:hover {
					background-color: ' . $this->options[ $this->name_prefix . 'main_color_mobile' ] . ';
					color: ' . $this->options[ $this->name_prefix . 'button_text_color_mobile' ] .';
				}

                div#' . $this->html_class_prefix . 'box_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-tab .ays-pd-games-question-para {
					font-size: ' . $this->options[ $this->name_prefix . 'question_font_size_for_mobile' ] . 'px;
					color: ' . $this->options[ $this->name_prefix . 'text_color_mobile' ] .';
				}
				div#' . $this->html_class_prefix . 'box_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-tab .ays-pd-games-find-translation{
					font-size: ' . $this->options[ $this->name_prefix . 'question_font_size_for_mobile' ] . 'px;
					color: ' . $this->options[ $this->name_prefix . 'text_color_mobile' ] .';
				}
				'.

				$menu_item_styles_mobile

				.'
				div#' . $this->html_class_prefix . 'description-id' . ' {
					font-size: ' . $this->options[ $this->name_prefix . 'description_font_size_for_mobile' ] . 'px;
				}

				h2#' . $this->html_class_prefix . 'title-id' . ' {
					font-size: ' . $this->options[ $this->name_prefix . 'title_font_size_for_mobile' ] . 'px;
					color: '. $this->options[ $this->name_prefix . 'title_text_color_mobile' ] .';
				}

				div#' . $this->html_class_prefix . 'box_id input[type="button"] {
					font-size: ' . $this->options[ $this->name_prefix . 'button_font_size_for_mobile' ] . 'px; 
            	}

            	div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu,
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content {
					background-color: ' . $this->options[ $this->name_prefix . 'bg_color_mobile' ] . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'games-type-content-game-box {
					background-color: ' . $this->options[ $this->name_prefix . 'bg_color_mobile'] . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'games-logo-block {
					background-color: ' . $this->options[ $this->name_prefix . 'bg_color_mobile'] . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content div.' . $this->html_class_prefix . 'games-type-content div.' . $this->html_class_prefix . 'games-type-content-game-box  div.' . $this->html_class_prefix . 'game-fields label {
					border: 1px solid ' . $this->options[ $this->name_prefix . 'bg_color_mobile' ] .';
					font-size: ' . $this->options[ $this->name_prefix . 'answer_font_size_for_mobile' ] . 'px;
					text-transform: ' . $this->options[ $this->name_prefix . 'answer_text_transform_mobile' ] . ';
					background-color: ' . $this->options[ $this->name_prefix . 'answer_bg_color_mobile' ] . ';
					color: ' . $this->options[ $this->name_prefix . 'text_color_mobile' ] .';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'groups-modal-main-container div.' . $this->html_class_prefix . 'groups-modal-content div#' . $this->html_class_prefix . 'groups-modal-body{
					background-color: ' . $this->options[ $this->name_prefix . 'bg_color_mobile' ] . ';
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'confirm-modal-main-container div.' . $this->html_class_prefix . 'confirm-modal-content{
					background-color: ' . $this->options[ $this->name_prefix . 'bg_color_mobile' ] . ';
				}
				
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content,
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu {
					border-radius: ' . $this->options[ $this->name_prefix . 'container_border_radius_mobile' ] . 'px !important;
	            
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content,
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'nav-menu {
					border-width: ' . $this->options[ $this->name_prefix . 'container_border_width_mobile' ] . 'px !important;
					border-style: ' . $this->options[ $this->name_prefix . 'container_border_style_mobile' ] . ' !important;
					border-color: ' . $this->options[ $this->name_prefix . 'container_border_color_mobile' ] . ' !important;
	            }

	            div#' . $this->html_class_prefix . 'box_id input[type="button"], div#' . $this->html_class_prefix . 'box_id input[type="submit"] {	                
	                border-radius: ' . $this->options[ $this->name_prefix . 'buttons_border_radius_mobile' ] . 'px;
	                padding: ' . $this->options[ $this->name_prefix . 'buttons_top_bottom_padding_mobile' ] . 'px ' . $this->options[ $this->name_prefix . 'buttons_left_right_padding_mobile' ] . 'px;
	            }

	            div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab a.' . $this->html_class_prefix . 'group-delete-button-item,
				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'word-save-and-delete-button-block span {					
					border-radius: ' . $this->options[ $this->name_prefix . 'buttons_border_radius_mobile' ] . 'px !important;
					padding: ' . $this->options[ $this->name_prefix . 'buttons_top_bottom_padding_mobile' ] . 'px ' . $this->options[ $this->name_prefix . 'buttons_left_right_padding_mobile' ] . 'px !important;
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'container_id div.' . $this->html_class_prefix . 'content .' . $this->html_class_prefix . 'group-tab div.' . $this->html_class_prefix . 'add_word_button_under_words_list>div {
					border: 1px solid ' . $this->options[ $this->name_prefix . 'main_color' ] .';
					border-radius: ' . $this->options[ $this->name_prefix . 'buttons_border_radius_mobile' ] . 'px;
					padding: ' . $this->options[ $this->name_prefix . 'buttons_top_bottom_padding_mobile' ] . 'px ' . $this->options[ $this->name_prefix . 'buttons_left_right_padding_mobile' ] . 'px !important;
				}

				div#' . $this->html_class_prefix . 'box_id div#' . $this->html_class_prefix . 'confirm-modal-main-container button.' . $this->html_class_prefix . 'confirm-modal-submit{					
					border-radius: ' . $this->options[ $this->name_prefix . 'buttons_border_radius_mobile' ] . 'px;
					padding: ' . $this->options[ $this->name_prefix . 'buttons_top_bottom_padding_mobile' ] . 'px ' . $this->options[ $this->name_prefix . 'buttons_left_right_padding_mobile' ] . 'px !important;
				}
            }
		';

        return $content;
	}

	public function ays_pd_move_word_to_group(){
		global $wpdb;
		$words_table 	= esc_sql( $wpdb->prefix . PERSONAL_DICTIONARY_DB_PREFIX . 'words' );
		$pd_group_id = (isset($_REQUEST['group_id']) && $_REQUEST['group_id'] != '') ? sanitize_text_field( $_REQUEST['group_id'] ) : null;
		$pd_word_id  = (isset($_REQUEST['word_id']) && $_REQUEST['word_id'] != '') ? sanitize_text_field( $_REQUEST['word_id'] ) : null;
		$insert_results = 0;
		if(isset($pd_group_id) && isset($pd_word_id)){
			$insert_results = $wpdb->update(
				$words_table,
				array(
					'category_id' => $pd_group_id,
				),
				array( 'id' => $pd_word_id ),
				array(
					'%d', // catgeroy id
				),
				array( '%d' )
			);
		}
		$response = array(
			"status" => true,
			"moved_to_group" => $insert_results,
		);
		ob_end_clean();
		$ob_get_clean = ob_get_clean();
		echo json_encode( $response );
		wp_die();
		
	}

}
