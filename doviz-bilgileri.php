<?php

/*

Plugin Name: Döviz Bilgileri

Plugin URI: http://www.erdemarslan.com/wordpress/05-03-2014/581-wordpress-doviz-bilgileri-eklentisi.html

Description: Bu eklenti Döviz ve Borsa Bilgilerini (USD, EUR, ALTIN, DÖVİZ ve BIST) widget ve shortcode olarak yayımlar.

Version: 2.3

Author: Erdem ARSLAN

Author URI: http://www.erdemarslan.com

Update Author: Oğuzhan Filiz
Update Author URI:http://oguzhanfiliz.com.tr

*/



/*  Copyright 2013  Erdem ARSLAN  (email : erdemsaid [at] gmail [dot] com )



    This program is free software; you can redistribute it and/or modify

    it under the terms of the GNU General Public License, version 2, as 

    published by the Free Software Foundation.



    This program is distributed in the hope that it will be useful,

    but WITHOUT ANY WARRANTY; without even the implied warranty of

    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the

    GNU General Public License for more details.



    You should have received a copy of the GNU General Public License

    along with this program; if not, write to the Free Software

    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/



$plugin		= plugin_basename(__FILE__);

$plugindir	= dirname(__FILE__) . DIRECTORY_SEPARATOR;



// Tanımlamaları yap

# Eklenti tanımlamaları

define( 'DOVIZ_PLUGIN_NAME', $plugin );

define( 'DOVIZ_PLUGIN_VERSION', '2.3' );

define( 'DOVIZ_PLUGIN_DIR', $plugindir );

define( 'DOVIZ_PLUGIN_CACHE_DIR', 'cache' );

define( 'DOVIZ_PLUGIN_CACHE_FILE', 'doviz_verileri.dat');

define( 'DOVIZ_PLUGIN_CACHE_TIME', 900 ); // 15 dakika - 900 sn



require_once 'class-doviz.php';

require_once 'doviz-bilgileri-widget.php';





class Doviz_Borsa_Bilgileri {

	

	private $doviz;

	/*

		Yapılandırıcı Fonksiyon

	*/

	public function __construct() {

		

		$this->doviz = new Doviz;

		

		add_action( 'init', array( $this, 'doviz_plugin_init' ) );

		

		add_action( 'widgets_init', array( $this, 'doviz_plugin_widget_init' ) );

		

		add_shortcode( 'doviz', array( $this, 'doviz_plugin_shortcode' ) );

	}

	

	

	

	

	public function doviz_plugin_shortcode()

	{

		$veriler = json_decode( $this->doviz->veriler(), TRUE );

		

		?>

        <div class="doviz_shortcode">

        	<div class="bist_shortcode">

            	<div class="isim">BİST 100</div>

                <div class="degeri"><?php echo $veriler['bist']['degeri']; ?></div>

                <?php echo $this->degisim( $veriler['bist']['degisim'] ); ?>

            </div>

            

            <div class="repo_shortcode">

            	<div class="isim">USD/EUR</div>

                <div class="degeri"><?php echo $veriler['capraz']['degeri']; ?></div>

                <?php echo $this->degisim( $veriler['capraz']['degisim'] ); ?>

            </div>

            

            <div class="usd_shortcode">

            	<div class="isim">USD</div>

                <div class="degeri"><?php echo $veriler['usd']['degeri']; ?></div>

                <?php echo $this->degisim( $veriler['usd']['degisim'] ); ?>

            </div>

            

            <div class="euro_shortcode">

            	<div class="isim">EURO</div>

                <div class="degeri"><?php echo $veriler['eur']['degeri']; ?></div>

                <?php echo $this->degisim( $veriler['eur']['degisim'] ); ?>

            </div>

            

            <div class="altin_shortcode">

            	<div class="isim">ALTIN</div>

                <div class="degeri"><?php echo $veriler['xau']['degeri']; ?></div>

                <?php echo $this->degisim( $veriler['xau']['degisim'] ); ?>

            </div>            

        </div>

		

		

		<?php

	}

	

	

	

	

	public function doviz_plugin_init()

	{

		if( ! is_admin() ) {

			wp_enqueue_style( 'doviz_main_style', plugins_url( "/doviz-style.css", __FILE__ ), array(), DOVIZ_PLUGIN_VERSION ); // ana still dosyası

		}

	}

	

	

	public function doviz_plugin_widget_init()

	{

		register_widget('Doviz_Widget');

	}

	

	private function degisim( $degisim = 'sabit' ) {

		

		$div = '';

		switch( $degisim )

		{

			case 'asagi' :

				$div = '<div class="degisim kirmizi"><i class="doviz-asagi2"></i></div>';

			break;

			

			case 'yukari' :

				$div = '<div class="degisim yesil"><i class="doviz-yukari2"></i></div>';

			break;

			

			default:

				$div = '<div class="degisim mavi"><i class="doviz-sabit2"></i></div>';

			break;

		}

		

		return $div;

	}

} // End Class



if( ! function_exists('piyasa_verileri') ) {

	function piyasa_verileri() {

		$doviz = new Doviz;

		return $doviz->veriler();

	}

}



$doviz = new Doviz_Borsa_Bilgileri();