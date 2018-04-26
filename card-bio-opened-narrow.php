<?php
/**
 * @package    Connections
 * @subpackage Template : Bio Card Opened Narrow
 * @author     Steven A. Zahm
 * @since      0.7.9
 * @license    GPL-2.0+
 * @link       http://connections-pro.com
 * @copyright  2013 Steven A. Zahm
 *
 * @wordpress-plugin
 * Plugin Name:       Connections Bio Card Opened Narrow - Template
 * Plugin URI:        http://connections-pro.com
 * Description:       This is a variation of the default template which shows the bio field for an entry.
 * Version:           2.0.1
 * Author:            Steven A. Zahm
 * Author URI:        http://connections-pro.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'CN_Bio_Card_Opened_Narrow_Template' ) ) {

	class CN_Bio_Card_Opened_Narrow_Template {

		public static function register() {

			$atts = array(
				'class'       => 'CN_Bio_Card_Opened_Narrow_Template',
				'name'        => 'Bio Entry Card Opened Narrow',
				'slug'        => 'card-bio-opened-narrow',
				'type'        => 'all',
				'version'     => '2.0.1',
				'author'      => 'Steven A. Zahm',
				'authorURL'   => 'connections-pro.com',
				'description' => 'This is a variation of the default template which shows the bio field for an entry.',
				'custom'      => TRUE,
				'path'        => plugin_dir_path( __FILE__ ),
				'url'         => plugin_dir_url( __FILE__ ),
				'thumbnail'   => 'thumbnail.png',
				'parts'       => array(),
				);

			cnTemplateFactory::register( $atts );
		}

		public function __construct( $template ) {
			$this->template = $template;

			$template->part( array( 'tag' => 'card', 'type' => 'action', 'callback' => array( __CLASS__, 'card' ) ) );
			$template->part( array( 'tag' => 'card-single', 'type' => 'action', 'callback' => array( __CLASS__, 'card' ) ) );
		}


		public static function card( $entry, $template, $atts ) {

/*

global $noResultMessage, $defaults;
$noResultMessage = 'test';
$defaults['message'] = 'test2';
print("*TEST!");
*/
			?>

<?php
global $thisCatFound;
$thisCat = strip_tags($entry->getCategoryBlock( array( 'label' => '', 'separator' => ', ', 'before' => '', 'after' => '', 'return' => TRUE ) ));
?>
<?php
$paddingBottom = '0px';
if (!$thisCatFound[$thisCat]) {
	##print('<h2 style="padding-left:20px; padding-top:20px" id="squelch-taas-title-0" class="squelch-taas-group-title">');
	##print($thisCat);
	##print("</h2>\n");
	$paddingBottom = '0px';
	$thisCatFound[$thisCat] = TRUE;
}
?>


<!--<p class="clearfloat"></p>-->

			<div class="cn-entry" style="-moz-border-radius:4px; background-color:#FFFFFF; border:0px solid #E3E3E3; color: #000000; margin:8px 0px; padding:6px; padding-left:20px; position: relative; width:150px; float:left;">
				<div style="width:100px; float:left">
					<?php 
$image = '';
$photo = '';
$photo2 = '';
$photo3 = '';
$photoTagArray = '';
$srcse = '';
$photoUrl = '';
$mag = '';
$photowidth = '';
$photoheight = '';
$photoalt = '';

##$entry->getImage();
$image = $entry->getImage( array( 'image' => 'photo' , 'preset' => 'thumbnail', 'return' => TRUE, 'action' => 'none' ) );
$photo = $entry->getImage( array( 'image' => 'photo' , 'preset' => 'profile', 'return' => TRUE, 'action' => 'none', 'style' => FALSE ) );
if ($photo) {
	list($span1, $span2, $photo2, $endspan1, $endspan2) = explode("><", $photo);
	$photoTagArray = getHtmlTagArray2($photo);
	if (is_array($photoTagArray)) {
		$srcset = $photoTagArray['srcset'];
		list($photoUrl, $mag) = explode(" ", $srcset);
		$photowidth = $photoTagArray['width'];
		$photoheight = $photoTagArray['height'];
		$photoalt = $photoTagArray['alt'];
	}
}
if ($photo2) {
	$photo3 = '<' . $photo2 . '>';
	$photo3 = str_replace(' 1x', '', $photo3);
	$photo3 = str_replace('srcset=', 'src=', $photo3);
}
if ((!$photo) AND ($photo3)) {
	echo '<span class="cn-image-style"><span style="display: block; max-width: 100%; width: 180px">' . $photo3 . '</span></span>';
}
##echo '*<img src="' . $photoUrl . '" width="' . $photowidth . '" height="' . $photoheight . '" alt="name" style="width:250px !important; height:300px !important">*';

##echo '<pre>'; print_r($photoTagArray); echo '</pre>';



?>
					<div style="clear:both;"></div>
					<div style="margin-bottom: 10px;">
						<!--<span style="font-size:larger;font-variant: small-caps"><strong><?php echo $entry->getNameBlock(array('link' => '')); ?></strong></span>-->
<h3><?php echo $entry->getNameBlock(array('link' => '')); ?></a></h3>

						<?php $entry->getTitleBlock(); ?>
						<?php $entry->getOrgUnitBlock(); ?>
						<?php $entry->getContactNameBlock(); ?>

					</div>


				<!--</div>

				<div align="left">-->

					<?php $entry->getFamilyMemberBlock(); ?>
					<?php
$phones = $entry->getPhoneNumberBlock(array('type' => 'workphone', 'format' => '%number%', 'before' => '<strong>Phone:</strong>&nbsp;', 'return' => TRUE));

$phones = str_replace('<span class="phone-number-block">', '', $phones);
$phones = str_replace('</span></span>', '</span>', $phones);
$phones = str_replace('<span class="tel">', '', $phones);
$phones = str_replace('</span><span class="type" style="display: none;">work</span>', '', $phones);
print("$phones");
?>
					<?php
$email = $entry->getEmailAddressBlock(array('type' => 'work', 'format' => '%address%', 'before' => '<br /><strong>Email:</strong>&nbsp;', 'return' => TRUE));

$email = str_replace('</span><span class="type" style="display: none;">INTERNET</span>', '', $email);
$email = str_replace('<span class="email-address-block">', '', $email);
$email = str_replace('<span class="email">', '', $email);
$email = str_replace('</span>', '', $email);
$email = str_replace('<span class="email-address">', '', $email);
$email = str_replace('<a class="value"', '<a', $email);
$email = str_replace('<span class="email cn-email-address">', '', $email);
$email = str_replace("\n", '', $email);


print("$email");

$address = $entry->getAddressBlock(array('return' => TRUE));

$address = str_replace('<span class="address-name">Work</span>', '<span class="address-name">Address</span>', $address);
$address = str_replace('<span class="address-name">Other</span>', '', $address);
echo '<p></p>';
echo $address;

?>
					<?php $entry->getSocialMediaBlock(); ?>
					<?php $entry->getImBlock(); ?>
					<?php ##$entry->getLinkBlock();
					?>

 		<?php

		$thisLink = '';
		$echoLink = '';
		##if ( $atts['show_links'] ) {
			echo '<!--';
			$thisLink = $entry->getLinkBlock( array( 'format' => '%url%', 'type' => $atts['link_types'], 'return' => TRUE ) );
			echo '-->';
			$thisLink = strip_tags($thisLink);
			if ($thisLink) {
				$echoLink = '<span class="link website"><span class="link-name">Research Website</span>:<br /> <a target="_blank" class="url" href="' . $thisLink . '">' . $thisLink . '</a></span><br />';
				echo $echoLink;
			}
		##}
		?>

					<?php $entry->getDateBlock(); ?>


				</div>

				<div style="clear:both"></div>

				<?php echo $entry->getBioBlock(); ?>
<?php
	echo '<!--';
	##$thisentry = $entry->getMetaBlock(array('separator' => '-'),'','');

	$thisentry = $entry->getMetaBlock( array('key' => 'Education', 'single' => FALSE, 'display_custom' => TRUE, 'return' => TRUE),'','');



	$thisentry = str_replace('<h3 style="padding-bottom:0px; margin-bottom:0px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">0: </h3><span class="cn-entry-meta-value">0, ', '<h3 style="padding-bottom:0px; margin-bottom:0px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">Education: </h3><span class="cn-entry-meta-value">', $thisentry);

	$thisentry = str_replace('<h3 style="padding-bottom:0px; margin-bottom:0px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">1: </h3><span class="cn-entry-meta-value">1, ', '<h3 style="padding-bottom:0px; margin-bottom:0px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">Education: </h3><span class="cn-entry-meta-value">', $thisentry);

$thisentry = str_replace('<li style="margin-top:20px"><h3 style="padding-bottom:0px; margin-bottom:0px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">Education: </h3><span class="cn-entry-meta-value"></span></li>', '', $thisentry);
	echo '-->';

	echo $thisentry;

	##echo '<b>Education:</b> ';
	##$thisentry2 = $entry->getContentBlock( array('include' => array('Education'), 'return' => TRUE), $atts['content'], $atts, $template );
	##$thisentry2 = $entry->getContentBlock(array('id' => 'Education', 'include' => array('Education'), 'return' => TRUE), $atts, $template);
	##echo $thisentry2;
?>

				<div style="clear:both"></div>

				<div class="cn-meta" align="left" style="margin-top: 6px">

					<?php
## remove this to get rid of duplicate "custom" field listings 2/24/2015 by SMK
 ##$entry->getContentBlock( $atts['content'], $atts, $template );

 ?>


					<!--<div style="display: block; margin-bottom: 8px;"><?php $entry->getCategoryBlock( array( 'separator' => ', ', 'before' => '<span>', 'after' => '</span>' ) ); ?></div>-->

					<?php
	##if ( cnSettingsAPI::get( 'connections', 'connections_display_entry_actions', 'vcard' ) ) $entry->vcard( array( 'before' => '<span>', 'after' => '</span>' ) );
?>

					<?php
					/*

					cnTemplatePart::updated(
						array(
							'timestamp' => $entry->getUnixTimeStamp(),
							'style' => array(
								'font-size'    => 'x-small',
								'font-variant' => 'small-caps',
								'position'     => 'absolute',
								'right'        => '36px',
								'bottom'       => '8px'
							)
						)
					);

					cnTemplatePart::returnToTop( array( 'style' => array( 'position' => 'absolute', 'right' => '8px', 'bottom' => '5px' ) ) );
					*/

					?>

				</div>

			</div>



			<?php
		}

	}

	// Register the template.
	add_action( 'cn_register_template', array( 'CN_Bio_Card_Opened_Narrow_Template', 'register' ) );
}
