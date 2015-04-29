<?php
error_reporting ( E_ALL ^ E_NOTICE );
$my_email = "enquiyrwalkretail@gmail.com, bcmhatre@gmail.com";
$bcc = "enquiry@walkretail.com";
$subject = "Request A Quote";
$from_email = "enquiry@walkretail.com";
$continue = "http://www.walkretail.com";
$auto_redirect = 1;
$redirect_url = "thank_you_request-quote.php";
$thank_you_message_template = 0;
$thank_you_message_template_filename = "thank_you_message_template.php";
$pre_populate_form = 0;
$show_errors_on_form_page = 0;
$form_page_url = "";
$confirm_email_address = 0;
$required_fields_check = 0;
$required_fields = array (
		'Name',
		'Email',
		'Contact',
		'Current Location',
		'Preferred Location',
		'Skill',
		'Current Designation',
		'Current Designation' 
);
$show_ip = 1;
$banned_ips_check = 0;
$banned_ips = array ();
$banned_ip_message = "Your IP address is banned.  The form was not sent.";
$require_cookie = 0;
$check_referrer = 1;
$word_block = 1;
$blocked_words = array (
		'http://',
		'https://',
		'viagra' 
);
$gibberish_check = 1;
$gibberish_threshold = 6;
$gibberish_exclude_fields = 1;
$gibberish_fields_to_exclude = array (
		'email',
		'email2' 
);
$gobbledegook_check = 0;
$Securimage_CAPTCHA = 0;
$reCAPTCHA = 0;
$privatekey = "";
$textCAPTCHA = 0;
$identiPIC_photo_CAPTCHA = 0;
$identiPIC [1] = "Apple";
$identiPIC [2] = "Flower";
$identiPIC [3] = "Fork";
$email_template = 0;
$email_template_filename = "email_template.php";
$html_format = 0;
$table_cellpadding = "5";
$table_cellspacing = "1";
$table_background_color = "#000000";
$table_left_column_color = "#ececec";
$table_left_column_font = "arial";
$table_left_column_font_size = "2";
$table_left_column_font_color = "#000000";
$table_right_column_color = "#ffffff";
$table_right_column_font = "arial";
$table_right_column_font_size = "2";
$table_right_column_font_color = "#000000";
$autoresponder_font = "arial";
$autoresponder_font_size = "2";
$autoresponder_font_color = "#000000";
$character_set = "iso-8859-1";
$encode_name_subject = 0;
$csv_attachment = 0;
$csv_file_on_server = 0;
$path_to_csv_file = dirname ( __FILE__ ) . "/";
$csv_filename = "form_data.csv";
$show_date_and_time = 0;
$message_id = 0;
$autoresponder = 0;
$autoresponder_from = "";
$autoresponder_subject = "Your enquiry";
$autoresponder_header_message = "Thank you for your enquiry.  We will get back to you shortly.  The data you submitted is shown below.";
$autoresponder_footer_message = "";
$autoresponder_attachment = 0;
$autoresponder_attachment_file = "";
$autoresponder_attachment_path = "";
$autoresponder_attachment_content_type = "";
$autoresponse_email_template = 0;
$autoresponse_email_template_filename = "email_template_autoresponse.php";
$ignore_fields = 1;
$fields_to_ignore = array (
		'Submit',
		'submit' 
);
$sort_fields = 0;
$field_order_keys = array (
		'email',
		'comments',
		'name' 
);
$line_spacing = 1;
$show_blank_fields = 0;
$block_file_types = 0;
$file_types_to_block = array (
		'.com',
		'.bat',
		'.exe' 
);
$allow_file_types = 0;
$file_types_to_allow = array (
		'.doc',
		'.docs',
		'.pdf',
		'.jpg',
		'.mp3' 
);
$max_file_size = "";
$upload_files_to_server = 0;
$path_to_uploaded_file = dirname ( __FILE__ ) . "/";
$uploaded_file_prefix = "";
$replace_spaces_in_filenames = 0;
$show_attachments_in_email_body = 1;
$errors = array ();
$attachment_array = array ();
if (count ( $_COOKIE )) {
	foreach ( array_keys ( $_COOKIE ) as $value ) {
		unset ( $_REQUEST [$value] );
	}
}
if ($pre_populate_form) {
	session_start ();
	$_SESSION ['submitted_form_values'] = $_REQUEST;
}
if (isset ( $_REQUEST ['email'] ) && ! empty ( $_REQUEST ['email'] )) {
	$_REQUEST ['email'] = trim ( $_REQUEST ['email'] );
	if (substr_count ( $_REQUEST ['email'], "@" ) != 1 || stristr ( $_REQUEST ['email'], " " ) || stristr ( $_REQUEST ['email'], "\\" ) || stristr ( $_REQUEST ['email'], ":" )) {
		$errors [] = "Email address is invalid";
	} else {
		$exploded_email = explode ( "@", $_REQUEST ['email'] );
		if (empty ( $exploded_email [0] ) || strlen ( $exploded_email [0] ) > 64 || empty ( $exploded_email [1] )) {
			$errors [] = "Email address is invalid";
		} else {
			if (substr_count ( $exploded_email [1], "." ) == 0) {
				$errors [] = "Email address is invalid";
			} else {
				$exploded_domain = explode ( ".", $exploded_email [1] );
				if (in_array ( "", $exploded_domain )) {
					$errors [] = "Email address is invalid";
				} else {
					foreach ( $exploded_domain as $value ) {
						if (strlen ( $value ) > 63 || ! preg_match ( '/^[a-z0-9-]+$/i', $value )) {
							$errors [] = "Email address is invalid";
							break;
						}
					}
				}
			}
		}
	}
}
if ($require_cookie) {
	if (! isset ( $_COOKIE ['formtoemailpro'] )) {
		$errors [] = "You must enable cookies to use the form";
	}
}
if ($check_referrer) {
	if (! (isset ( $_SERVER ['HTTP_REFERER'] ) && ! empty ( $_SERVER ['HTTP_REFERER'] ) && stristr ( $_SERVER ['HTTP_REFERER'], $_SERVER ['HTTP_HOST'] ))) {
		$errors [] = "You must enable referrer logging to use the form";
	}
}
if ($required_fields_check) {
	foreach ( $required_fields as $value ) {
		if ((! isset ( $_REQUEST [$value] ) || (empty ( $_REQUEST [$value] ) && $_REQUEST [$value] != "0")) && (! isset ( $_FILES [$value] ['name'] ) || empty ( $_FILES [$value] ['name'] ))) {
			$errors [] = "Please complete the $value field";
		}
	}
} else {
	function recursive_array_check_blank($element_value) {
		global $set;
		if (! is_array ( $element_value )) {
			if (! empty ( $element_value )) {
				$set = 1;
			}
		} else {
			foreach ( $element_value as $value ) {
				if ($set) {
					break;
				}
				recursive_array_check_blank ( $value );
			}
		}
	}
	recursive_array_check_blank ( $_REQUEST );
	if (count ( $_FILES )) {
		foreach ( array_keys ( $_FILES ) as $value ) {
			if (! empty ( $_FILES [$value] ['name'] )) {
				$set = 1;
			}
		}
	}
	if (! $set) {
		$errors [] = "You cannot send a blank form";
	}
	unset ( $set );
}
if ($confirm_email_address) {
	if (isset ( $_REQUEST ['email'] ) || isset ( $_REQUEST ['email2'] )) {
		if ($_REQUEST ['email'] != $_REQUEST ['email2']) {
			$errors [] = "Please correctly confirm your email address";
		} else {
			unset ( $_REQUEST ['email2'] );
		}
	}
}
if ($banned_ips_check) {
	foreach ( $banned_ips as $value ) {
		if ($value == substr ( $_SERVER ["REMOTE_ADDR"], 0, strlen ( $value ) )) {
			$errors [] = $banned_ip_message;
			break;
		}
	}
}
if ($gibberish_check) {
	$vowels = array (
			'a',
			'e',
			'i',
			'o',
			'u' 
	);
	$consonants = array (
			'b',
			'c',
			'd',
			'f',
			'g',
			'h',
			'j',
			'k',
			'l',
			'm',
			'n',
			'p',
			'q',
			'r',
			's',
			't',
			'v',
			'w',
			'x',
			'y',
			'z' 
	);
	function recursive_array_gibberish_check($element_value) {
		global $set;
		global $vowels;
		global $consonants;
		global $return_value;
		global $gibberish_threshold;
		if (! is_array ( $element_value )) {
			$exploded_value = explode ( " ", $element_value );
			foreach ( $exploded_value as $word_to_check ) {
				$consecutive_consonant_count = 0;
				$consecutive_vowel_count = 0;
				if ((strlen ( $word_to_check ) >= $gibberish_threshold) && (! is_numeric ( $word_to_check ))) {
					$word_to_check = strtolower ( $word_to_check );
					for($i = 0; $i < strlen ( $word_to_check ); $i ++) {
						if (in_array ( $word_to_check [$i], $vowels )) {
							$consecutive_consonant_count = 0;
							$consecutive_vowel_count ++;
							if ($consecutive_vowel_count == $gibberish_threshold) {
								$set = 1;
								$return_value = $word_to_check;
								break;
							}
						} elseif (in_array ( $word_to_check [$i], $consonants )) {
							$consecutive_vowel_count = 0;
							$consecutive_consonant_count ++;
							if ($consecutive_consonant_count == $gibberish_threshold) {
								$set = 1;
								$return_value = $word_to_check;
								break;
							}
						} else {
							if ($word_to_check [$i] == "@" || $word_to_check [$i] == "-" || $word_to_check [$i] == "." || $word_to_check [$i] == ":") {
								$consecutive_consonant_count = 0;
								$consecutive_vowel_count = 0;
							}
						}
					}
				}
				if ($set) {
					break;
				}
			}
		} else {
			foreach ( $element_value as $value ) {
				if ($set) {
					break;
				}
				recursive_array_gibberish_check ( $value );
			}
		}
	}
	$array_to_check = $_REQUEST;
	if ($gibberish_exclude_fields && count ( $gibberish_fields_to_exclude )) {
		foreach ( $gibberish_fields_to_exclude as $value ) {
			if (isset ( $array_to_check [$value] )) {
				unset ( $array_to_check [$value] );
			}
		}
	}
	recursive_array_gibberish_check ( $array_to_check );
	if ($set) {
		$errors [] = "You have submitted a gibberish word: \"{$return_value}\"";
	}
	unset ( $set );
	unset ( $return_value );
}
if ($gobbledegook_check) {
	$gobbledegook_alphabet = array (
			'¡',
			'¢',
			'¤',
			'¦',
			'§',
			'¨',
			'ª',
			'«',
			'¬',
			'®',
			'¯',
			'°',
			'±',
			'²',
			'³',
			'µ',
			'¶',
			'·',
			'¸',
			'¹',
			'º',
			'»',
			'¼',
			'½',
			'¾',
			'¿',
			'À',
			'Á',
			'Â',
			'Ã',
			'Ä',
			'Å',
			'Æ',
			'Ç',
			'È',
			'É',
			'Ê',
			'Ë',
			'Ì',
			'Í',
			'Î',
			'Ï',
			'Ð',
			'Ñ',
			'Ò',
			'Ó',
			'Ô',
			'Õ',
			'Ö',
			'×',
			'Ø',
			'Ù',
			'Ú',
			'Û',
			'Ü',
			'Ý',
			'Þ',
			'ß',
			'à',
			'á',
			'â',
			'ã',
			'ä',
			'å',
			'æ',
			'ç',
			'è',
			'é',
			'ê',
			'ë',
			'ì',
			'í',
			'î',
			'ï',
			'ð',
			'ñ',
			'ó',
			'õ',
			'ö',
			'÷',
			'ø',
			'ú',
			'û',
			'ü',
			'ý',
			'þ' 
	);
	function recursive_array_check_gobbledegook($element_value, $inkey = "") {
		global $set;
		global $gobbledegook_alphabet;
		global $return_value;
		global $return_key;
		if (! is_array ( $element_value )) {
			foreach ( $gobbledegook_alphabet as $value ) {
				if (stristr ( $element_value, $value )) {
					$set = 1;
					$return_value = $value;
					$return_key = $inkey;
					break;
				}
			}
		} else {
			foreach ( $element_value as $key => $value ) {
				if ($set) {
					break;
				}
				recursive_array_check_gobbledegook ( $value, $key );
			}
		}
	}
	recursive_array_check_gobbledegook ( $_REQUEST );
	if ($set) {
		if (is_numeric ( $return_key )) {
			$errors [] = "You have entered an invalid character ($return_value)";
		} else {
			$errors [] = "You have entered an invalid character ($return_value) in the \"$return_key\" field";
		}
	}
	unset ( $set );
	unset ( $return_value );
	unset ( $return_key );
}
if ($word_block) {
	function recursive_array_check_word_block($element_value, $inkey = "") {
		global $set;
		global $blocked_words;
		global $return_value;
		global $return_key;
		if (! is_array ( $element_value )) {
			foreach ( $blocked_words as $value ) {
				if (stristr ( $element_value, $value )) {
					$set = 1;
					$return_value = $value;
					$return_key = $inkey;
					break;
				}
			}
		} else {
			foreach ( $element_value as $key => $value ) {
				if ($set) {
					break;
				}
				recursive_array_check_word_block ( $value, $key );
			}
		}
	}
	recursive_array_check_word_block ( $_REQUEST );
	if ($set) {
		if (is_numeric ( $return_key )) {
			$errors [] = "You have entered an invalid string ($return_value)";
		} else {
			$errors [] = "You have entered an invalid string ($return_value) in the \"$return_key\" field";
		}
	}
	unset ( $set );
	unset ( $return_value );
	unset ( $return_key );
}
if (count ( $_FILES )) {
	if ($block_file_types) {
		foreach ( array_keys ( $_FILES ) as $value ) {
			if (! empty ( $_FILES [$value] ['name'] )) {
				if (in_array ( strtolower ( strrchr ( $_FILES [$value] ['name'], "." ) ), $file_types_to_block )) {
					$disallowed_filetype = strrchr ( $_FILES [$value] ['name'], "." );
					$errors [] = "{$disallowed_filetype} file types are not permitted.  The file \"{$_FILES[$value]['name']}\" cannot be uploaded.";
				}
			}
		}
	}
	if ($allow_file_types) {
		foreach ( array_keys ( $_FILES ) as $value ) {
			if (! empty ( $_FILES [$value] ['name'] )) {
				if (! in_array ( strtolower ( strrchr ( $_FILES [$value] ['name'], "." ) ), $file_types_to_allow )) {
					$disallowed_filetype = strrchr ( $_FILES [$value] ['name'], "." );
					$errors [] = "{$disallowed_filetype} file types are not permitted.  The file \"{$_FILES[$value]['name']}\" cannot be uploaded.";
				}
			}
		}
	}
	if ($max_file_size) {
		foreach ( array_keys ( $_FILES ) as $value ) {
			if (! empty ( $_FILES [$value] ['size'] )) {
				if ($_FILES [$value] ['size'] > $max_file_size) {
					$errors [] = "File \"{$_FILES[$value]['name']}\" exceeds the maximum file size of {$max_file_size} bytes.";
				}
			}
		}
	}
}
if ($ignore_fields) {
	foreach ( $fields_to_ignore as $value ) {
		if (isset ( $_REQUEST [$value] )) {
			unset ( $_REQUEST [$value] );
		}
	}
}
if (count ( $errors ) && $show_errors_on_form_page == 0) {
	foreach ( $errors as $value ) {
		print stripslashes ( htmlspecialchars ( $value ) ) . "<br>";
	}
	exit ();
}
if (count ( $errors ) && $show_errors_on_form_page) {
	session_start ();
	$_SESSION ['formtoemail_form_errors'] = $errors;
	header ( "location: $form_page_url" );
	exit ();
}
if (! defined ( "PHP_EOL" )) {
	define ( "PHP_EOL", strtoupper ( substr ( PHP_OS, 0, 3 ) == "WIN" ) ? "\r\n" : "\n" );
}
if ($line_spacing) {
	$line_space = PHP_EOL . PHP_EOL;
} else {
	$line_space = PHP_EOL;
}
if ($html_format) {
	function recursive_array_check_HTML(&$element_value) {
		if (! is_array ( $element_value )) {
			$element_value = nl2br ( htmlspecialchars ( $element_value ) );
		} else {
			foreach ( $element_value as $key => $value ) {
				$element_value [$key] = recursive_array_check_HTML ( $value );
			}
		}
		return $element_value;
	}
	recursive_array_check_HTML ( $_REQUEST );
	$html_open = "<html><head><title>$subject</title></head><body><table cellpadding=\"" . $table_cellpadding . "\" cellspacing=\"" . $table_cellspacing . "\" bgcolor=\"" . $table_background_color . "\">";
	$html_close = "</table></body></html>";
	$content_type = "html";
} else {
	$html_open = "";
	$colon_sep = ": ";
	$html_close = "";
	$content_type = "plain";
}
function build_message($request_input) {
	global $colon_sep;
	global $html_format;
	global $table_left_column_color;
	global $table_left_column_font;
	global $table_left_column_font_size;
	global $table_left_column_font_color;
	global $table_right_column_color;
	global $table_right_column_font;
	global $table_right_column_font_size;
	global $table_right_column_font_color;
	global $line_space;
	global $show_blank_fields;
	if (! isset ( $message_output )) {
		$message_output = "";
	}
	if (! is_array ( $request_input )) {
		$message_output = $request_input;
	} else {
		foreach ( $request_input as $key => $value ) {
			if (! empty ( $value ) || $show_blank_fields) {
				if ($html_format) {
					
					if (! is_numeric ( $key )) {
						$message_output .= "<tr><td valign=\"top\" bgcolor=\"" . $table_left_column_color . "\" nowrap><font face=\"" . $table_left_column_font . "\" size=\"" . $table_left_column_font_size . "\" color=\"" . $table_left_column_font_color . "\"><b>" . str_replace ( "_", " ", ucfirst ( $key ) ) . "</b></font></td><td bgcolor=\"" . $table_right_column_color . "\"><font face=\"" . $table_right_column_font . "\" size=\"" . $table_right_column_font_size . "\" color=\"" . $table_right_column_font_color . "\">" . build_message ( $value ) . "</font></td></tr>" . PHP_EOL;
					} else {
						$message_output .= "<table><tr><td><font face=\"" . $table_right_column_font . "\" size=\"" . $table_right_column_font_size . "\" color=\"" . $table_right_column_font_color . "\">" . build_message ( $value ) . "</font></td></tr></table>";
					}
				} else {
					if (! is_numeric ( $key )) {
						$message_output .= str_replace ( "_", " ", ucfirst ( $key ) ) . $colon_sep . build_message ( $value ) . $line_space;
					} else {
						$message_output .= build_message ( $value ) . ", ";
					}
				}
			}
		}
	}
	return rtrim ( $message_output, ", " );
}
if ($sort_fields) {
	$ordered_request = array ();
	foreach ( $field_order_keys as $value ) {
		$ordered_request [$value] = $_REQUEST [$value];
	}
	$_REQUEST = $ordered_request;
}
if ($show_attachments_in_email_body && count ( $_FILES ) && ! $upload_files_to_server) {
	foreach ( array_keys ( $_FILES ) as $value ) {
		if (! empty ( $_FILES [$value] ['tmp_name'] )) {
			$_REQUEST [$value] = $_FILES [$value] ['name'];
		}
	}
}
if (count ( $_FILES ) && $upload_files_to_server) {
	if ($replace_spaces_in_filenames) {
		foreach ( array_keys ( $_FILES ) as $value ) {
			if (! empty ( $_FILES [$value] ['tmp_name'] )) {
				$_FILES [$value] ['name'] = str_replace ( " ", "-", $_FILES [$value] ['name'] );
			}
		}
		$uploaded_file_prefix = str_replace ( " ", "-", $uploaded_file_prefix );
	}
	if (substr_count ( $path_to_uploaded_file, $_SERVER ['DOCUMENT_ROOT'] )) {
		$web_location = str_replace ( $_SERVER ['DOCUMENT_ROOT'], "", $path_to_uploaded_file );
		if ($html_format) {
			foreach ( array_keys ( $_FILES ) as $value ) {
				if (! empty ( $_FILES [$value] ['tmp_name'] )) {
					$_REQUEST [$value] = "<a href=\"http://" . $_SERVER ['HTTP_HOST'] . $web_location . $uploaded_file_prefix . $_FILES [$value] ['name'] . "\">{$uploaded_file_prefix}{$_FILES[$value]['name']}</a>";
				}
			}
		} else {
			foreach ( array_keys ( $_FILES ) as $value ) {
				if (! empty ( $_FILES [$value] ['tmp_name'] )) {
					$_REQUEST [$value] = "http://" . $_SERVER ['HTTP_HOST'] . $web_location . $uploaded_file_prefix . $_FILES [$value] ['name'];
				}
			}
		}
	} else {
		foreach ( array_keys ( $_FILES ) as $value ) {
			if (! empty ( $_FILES [$value] ['tmp_name'] )) {
				$_REQUEST [$value] = $uploaded_file_prefix . $_FILES [$value] ['name'];
			}
		}
	}
}
if ($show_ip) {
	$_REQUEST ["Sender's IP address"] = $_SERVER ["REMOTE_ADDR"];
}
if ($show_date_and_time) {
	$_REQUEST ["Date submitted"] = date ( "F jS, Y.  h:i a" );
}
if ($message_id) {
	$_REQUEST ["Message ID"] = mt_rand ( 10000000, 99999999 );
}
if ($email_template) {
	$message = file_get_contents ( $email_template_filename );
	preg_match_all ( "/ff<[^>]*>/", $message, $matches );
	$unique_matches = array_unique ( $matches [0] );
	foreach ( $unique_matches as $value ) {
		$key = rtrim ( str_replace ( "ff<", "", $value ), ">" );
		if (is_array ( $_REQUEST [$key] )) {
			$array_content = "";
			foreach ( $_REQUEST [$key] as $value2 ) {
				$array_content .= $value2 . ", ";
			}
			$array_content = rtrim ( $array_content, ", " );
			$message = str_replace ( $value, $array_content, $message );
		} else {
			$message = str_replace ( $value, $_REQUEST [$key], $message );
		}
	}
} else {
	$message = $html_open;
	$message .= build_message ( $_REQUEST );
	$message .= $html_close;
}
$message = stripslashes ( $message );
if ($from_email) {
	$headers = "From: " . $from_email;
	$headers .= PHP_EOL;
	$headers .= "Reply-To: " . $_REQUEST ['email'];
	$headers .= PHP_EOL;
	$headers .= "MIME-Version: 1.0";
} else {
	$from_name = "";
	if (isset ( $_REQUEST ['name'] ) && ! empty ( $_REQUEST ['name'] )) {
		$from_name = stripslashes ( $_REQUEST ['name'] );
		if ($encode_name_subject) {
			$from_name = "=?{$character_set}?B?" . base64_encode ( $_REQUEST ['name'] ) . "?=";
		}
	}
	$headers = "From: {$from_name} <{$_REQUEST['email']}>";
	$headers .= PHP_EOL;
	$headers .= "MIME-Version: 1.0";
}
if ($csv_attachment || $csv_file_on_server) {
	function build_file_data($data_input) {
		if (! isset ( $file_data )) {
			$file_data = "";
		}
		if (! is_array ( $data_input )) {
			if (stristr ( $data_input, '"' )) {
				$data_input = str_replace ( '"', '""', $data_input );
			}
			if (stristr ( $data_input, '"' ) || stristr ( $data_input, "," ) || stristr ( $data_input, "\n" ) || stristr ( $data_input, "\r\n" )) {
				$file_data = "\"$data_input\"";
			} else {
				$file_data = $data_input;
			}
		} else {
			foreach ( $data_input as $key => $value ) {
				if (! is_numeric ( $key )) {
					$file_data .= build_file_data ( $value ) . ",";
				} else {
					$file_data .= build_file_data ( $value ) . " :: ";
				}
			}
		}
		return rtrim ( rtrim ( $file_data, "," ), " :: " );
	}
}
if (count ( $_FILES ) || $csv_attachment) {
	if (count ( $_FILES )) {
		if ($upload_files_to_server) {
			foreach ( array_keys ( $_FILES ) as $value ) {
				if (! empty ( $_FILES [$value] ['tmp_name'] )) {
					move_uploaded_file ( $_FILES [$value] ['tmp_name'], $path_to_uploaded_file . $uploaded_file_prefix . $_FILES [$value] ['name'] );
				}
			}
		} else {
			foreach ( array_keys ( $_FILES ) as $value ) {
				if (is_uploaded_file ( $_FILES [$value] ['tmp_name'] )) {
					$file = fopen ( $_FILES [$value] ['tmp_name'], 'rb' );
					$data = fread ( $file, filesize ( $_FILES [$value] ['tmp_name'] ) );
					fclose ( $file );
					$data = chunk_split ( base64_encode ( $data ) );
					$attachment_array [] = "--boundary_sdfsfsdfs345345sfsgs" . PHP_EOL . "Content-Type: " . $_FILES [$value] ['type'] . ";" . PHP_EOL . " name=\"" . $_FILES [$value] ['name'] . "\"" . PHP_EOL . "Content-Disposition: attachment;" . PHP_EOL . " filename=\"" . $_FILES [$value] ['name'] . "\"" . PHP_EOL . "Content-Transfer-Encoding: base64" . PHP_EOL . PHP_EOL . $data . PHP_EOL . PHP_EOL;
				}
			}
		}
	}
	if (count ( $attachment_array ) || $csv_attachment) {
		$headers .= PHP_EOL;
		$headers .= "Content-Type: multipart/mixed;" . PHP_EOL;
		$headers .= " boundary=\"boundary_sdfsfsdfs345345sfsgs\"";
		$body = "";
		$body .= "--boundary_sdfsfsdfs345345sfsgs" . PHP_EOL;
		$body .= "Content-Type: text/" . $content_type . "; charset=\"{$character_set}\"" . PHP_EOL . PHP_EOL;
		$body .= $message . PHP_EOL . PHP_EOL;
		if (count ( $attachment_array )) {
			foreach ( $attachment_array as $value ) {
				$body .= $value;
			}
		}
		if ($csv_attachment) {
			$data = "";
			foreach ( array_keys ( $_REQUEST ) as $value ) {
				$data .= "$value,";
			}
			$data = rtrim ( $data, "," );
			$data .= PHP_EOL;
			$data .= stripslashes ( build_file_data ( $_REQUEST ) );
			$body .= "--boundary_sdfsfsdfs345345sfsgs" . PHP_EOL . "Content-Type: text/plain; charset=\"{$character_set}\"" . PHP_EOL . " name=\"$csv_filename\"" . PHP_EOL . "Content-Disposition: attachment;" . PHP_EOL . " filename=\"$csv_filename\"" . PHP_EOL . PHP_EOL . $data . PHP_EOL . PHP_EOL;
		}
		$body .= "--boundary_sdfsfsdfs345345sfsgs--";
		$message = $body;
	}
}
if (! count ( $attachment_array ) && ! $csv_attachment) {
	$headers .= PHP_EOL;
	$headers .= "Content-Type: text/{$content_type}; charset=\"{$character_set}\"";
}
if ($bcc) {
	$headers .= PHP_EOL;
	$headers .= "Bcc: " . $bcc;
}
$subject = stripslashes ( $subject );
if ($encode_name_subject) {
	$subject = "=?{$character_set}?B?" . base64_encode ( $subject ) . "?=";
}
mail ( $my_email, $subject, $message, $headers );
if ($csv_file_on_server) {
	if (! file_exists ( $path_to_csv_file . $csv_filename )) {
		$data = "";
		foreach ( array_keys ( $_REQUEST ) as $value ) {
			$data .= "$value,";
		}
		$data = rtrim ( $data, "," );
		$data .= "\r\n";
		$handle = fopen ( $path_to_csv_file . $csv_filename, "a" );
		fwrite ( $handle, $data );
		fclose ( $handle );
	}
	$data = "";
	$data .= stripslashes ( build_file_data ( $_REQUEST ) );
	$data .= "\r\n";
	$handle = fopen ( $path_to_csv_file . $csv_filename, "a" );
	fwrite ( $handle, $data );
	fclose ( $handle );
}
if ($autoresponder && isset ( $_REQUEST ['email'] ) && ! empty ( $_REQUEST ['email'] )) {
	if (isset ( $_REQUEST ["Sender's IP address"] )) {
		unset ( $_REQUEST ["Sender's IP address"] );
	}
	if ($autoresponder_from) {
		$my_email = $autoresponder_from;
	}
	$headers = "From: " . $my_email;
	$headers .= PHP_EOL;
	$headers .= "MIME-Version: 1.0" . PHP_EOL;
	$headers .= "Content-Type: text/{$content_type}; charset=\"{$character_set}\"";
	if ($autoresponse_email_template) {
		$message = file_get_contents ( $autoresponse_email_template_filename );
		preg_match_all ( "/ff<[^>]*>/", $message, $matches );
		$unique_matches = array_unique ( $matches [0] );
		foreach ( $unique_matches as $value ) {
			$key = rtrim ( str_replace ( "ff<", "", $value ), ">" );
			if (is_array ( $_REQUEST [$key] )) {
				$array_content = "";
				foreach ( $_REQUEST [$key] as $value2 ) {
					$array_content .= $value2 . ", ";
				}
				$array_content = rtrim ( $array_content, ", " );
				$message = str_replace ( $value, $array_content, $message );
			} else {
				$message = str_replace ( $value, $_REQUEST [$key], $message );
			}
		}
	} else {
		if ($html_format) {
			$html_open = "<html><head><title>$autoresponder_subject</title></head><body><p><font face=\"" . $autoresponder_font . "\" size=\"" . $autoresponder_font_size . "\" color=\"" . $autoresponder_font_color . "\">$autoresponder_header_message</font></p><table cellpadding=\"" . $table_cellpadding . "\" cellspacing=\"" . $table_cellspacing . "\" bgcolor=\"" . $table_background_color . "\">";
			$html_close = "</table><p><font face=\"" . $autoresponder_font . "\" size=\"" . $autoresponder_font_size . "\" color=\"" . $autoresponder_font_color . "\">$autoresponder_footer_message</font></p></body></html>";
			$message = $html_open;
			$message .= build_message ( $_REQUEST );
			$message .= $html_close;
		} else {
			$message = $autoresponder_header_message . PHP_EOL . PHP_EOL . build_message ( $_REQUEST ) . $autoresponder_footer_message;
		}
	}
	$message = stripslashes ( $message );
	if ($autoresponder_attachment) {
		$data = "";
		$file = fopen ( $autoresponder_attachment_path . $autoresponder_attachment_file, 'rb' );
		$data = fread ( $file, filesize ( $autoresponder_attachment_path . $autoresponder_attachment_file ) );
		fclose ( $file );
		$data = chunk_split ( base64_encode ( $data ) );
		$headers = "From: " . $my_email;
		$headers .= PHP_EOL;
		$headers .= "MIME-Version: 1.0" . PHP_EOL;
		$headers .= "Content-Type: multipart/mixed;" . PHP_EOL;
		$headers .= " boundary=\"boundary_sdfsfsdfs345345sfsgs\"";
		$body = "";
		$body .= "--boundary_sdfsfsdfs345345sfsgs" . PHP_EOL;
		$body .= "Content-Type: text/" . $content_type . "; charset=\"{$character_set}\"" . PHP_EOL . PHP_EOL;
		$body .= $message . PHP_EOL . PHP_EOL;
		$body .= "--boundary_sdfsfsdfs345345sfsgs" . PHP_EOL . "Content-Type: " . $autoresponder_attachment_content_type . ";" . PHP_EOL . " name=\"" . $autoresponder_attachment_file . "\"" . PHP_EOL . "Content-Disposition: attachment;" . PHP_EOL . " filename=\"" . $autoresponder_attachment_file . "\"" . PHP_EOL . "Content-Transfer-Encoding: base64" . PHP_EOL . PHP_EOL . $data . PHP_EOL . PHP_EOL;
		$body .= "--boundary_sdfsfsdfs345345sfsgs--";
		$message = $body;
	}
	$autoresponder_subject = stripslashes ( $autoresponder_subject );
	if ($encode_name_subject) {
		$autoresponder_subject = "=?{$character_set}?B?" . base64_encode ( $autoresponder_subject ) . "?=";
	}
	mail ( $_REQUEST ['email'], $autoresponder_subject, $message, $headers );
}
if ($auto_redirect) {
	header ( "location: $redirect_url" );
	exit ();
}
if ($thank_you_message_template) {
	$matches = "";
	$html_output = file_get_contents ( $thank_you_message_template_filename );
	preg_match_all ( "/ff<[^>]*>/", $html_output, $matches );
	$unique_matches = array_unique ( $matches [0] );
	foreach ( $unique_matches as $value ) {
		$key = rtrim ( str_replace ( "ff<", "", $value ), ">" );
		if (is_array ( $_REQUEST [$key] )) {
			$array_content = "";
			foreach ( $_REQUEST [$key] as $value2 ) {
				$array_content .= $value2 . ", ";
			}
			$array_content = rtrim ( $array_content, ", " );
			$html_output = str_replace ( $value, $array_content, $html_output );
		} else {
			$html_output = str_replace ( $value, $_REQUEST [$key], $html_output );
		}
	}
	print $html_output;
	exit ();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Thank You</title>
<meta http-equiv="Content-Type"
	content="text/html; charset=<?php print $character_set; ?>">
</head>
<body bgcolor="#ffffff" text="#000000">
	<div>
		<center>
			<b>Thank you <?php if(isset($_REQUEST['name'])){print stripslashes(htmlspecialchars($_REQUEST['name']));} ?></b>
			<br>Your message has been sent
			<p>
				<a href="<?php print $continue; ?>">Click here to continue</a>
			</p>
		</center>
	</div>
</body>
</html>