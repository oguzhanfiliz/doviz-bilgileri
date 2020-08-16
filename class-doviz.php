<?php



Class Doviz {

	

	private $cache_dosyasi;

	

	public function __construct() {

		// Cache Dosyası

		$this->cache_dosyasi = DOVIZ_PLUGIN_DIR . DOVIZ_PLUGIN_CACHE_DIR . DIRECTORY_SEPARATOR . DOVIZ_PLUGIN_CACHE_FILE;

		// Döviz verilerini çek! veri JSON Formatında olacak! Ona göre kullan

	}

	

	

	/*

		döviz verilerini alır!

	*/

	public function veriler()

	{

		if( file_exists( $this->cache_dosyasi ) && ( current_time('timestamp') - filemtime( $this->cache_dosyasi ) ) < DOVIZ_PLUGIN_CACHE_TIME ) {

			// Dosya var ve zamanı geçmemiş !

			return file_get_contents( $this->cache_dosyasi );

		} else {

			// dosya yok veya zamanı geçmiş!

			return $this->doviz_bilgilerini_cek();

		}

	}

	

	

	/*

		Döviz Verilerini sunucudan al !

	*/

	private function doviz_bilgilerini_cek()

	{

		$HTTP_args = array(

			'timeout'     => 5,

			'user-agent'  => 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:27.0) Gecko/20100101 Firefox/51.0'

		);

		$yanit = wp_remote_get( 'https://www.akbank.com/_vti_bin/AkbankServicesSecure/FrontEndServiceSecure.svc/GetExchangeData?_=' . time(), $HTTP_args );

		

		if( wp_remote_retrieve_response_code( $yanit ) == 200 ) {

			// yanıt sağlam ise, oku

			$json = json_decode( wp_remote_retrieve_body( $yanit ), TRUE );

			

			// Gelen veriyi anlamlı bilgiye döndür ve yaz!

			$json_veri = json_decode($json["GetExchangeDataResult"], TRUE);

			

			// bunları düzenle

			$bilgiler = json_encode(

				array(

					'bist'	=> array(

            'isim'    => "BIST",

						'degeri'	=> $json_veri["BIST"]["Index"],

						'degisim'	=> $this->degisim_cevir( $json_veri["BIST"]["RateDirection"] )

					),

					'capraz'	=> array(

            'isim'    => "USD/EUR",

						'degeri'	=> $json_veri["EURxUSD"]["Sell"],

						'degisim'	=> $this->degisim_cevir( $json_veri["EURxUSD"]["RateDiretion"] )

					),

					'usd'	=> array(

            'isim'    => "Amerikan Doları",

						'degeri'	=> $json_veri["Currencies"][16]["Sell"],

						'degisim'	=> $this->degisim_cevir( $json_veri["Currencies"][16]["RateDiretion"] )

					),

					

					'eur'	=> array(

            'isim'    => "Euro",

						'degeri'	=> $json_veri["Currencies"][6]["Sell"],

						'degisim'	=> $this->degisim_cevir( $json_veri["Currencies"][6]["RateDiretion"] )

					),

					

					'gbp'	=> array(

            'isim'    => "İngiliz Sterlini",

						'degeri'	=> $json_veri["Currencies"][7]["Sell"],

						'degisim'	=> $this->degisim_cevir( $json_veri["Currencies"][7]["RateDiretion"] )

					),

					

					'jpy'	=> array(

            'isim'    => "Japon Yeni",

						'degeri'	=> $json_veri["Currencies"][8]["Sell"],

						'degisim'	=> $this->degisim_cevir( $json_veri["Currencies"][8]["RateDiretion"] )

					),

					

					'rub'	=> array(

            'isim'    => "Rus Rublesi",

						'degeri'	=> $json_veri["Currencies"][11]["Sell"],

						'degisim'	=> $this->degisim_cevir( $json_veri["Currencies"][11]["RateDiretion"] )

					),

					

					

					'sar'	=> array(

            'isim'    => "SA Riyali",

						'degeri'	=> $json_veri["Currencies"][12]["Sell"],

						'degisim'	=> $this->degisim_cevir( $json_veri["Currencies"][12]["RateDiretion"] )

					),

					
					'xau'	=> array(

						'isim'    => "Altın(Gr)",
			
									'degeri'	=> $json_veri["Currencies"][17]["Sell"],
			
									'degisim'	=> $this->degisim_cevir( $json_veri["Currencies"][17]["RateDiretion"] )
			
								),

					'zaman'	=> current_time('timestamp')

				)

			);


			

			// cache dosyasına yaz!

			$fp = fopen( $this->cache_dosyasi, "w");

			fwrite( $fp, $bilgiler );

			fclose( $fp );

			

		} else {

			// veri alınamadı! Sahte veri hazırla! Varsa dosyayı oku ve al! yoksa, 0 doldur ver!

			if ( file_exists( $this->cache_dosyasi ) )

			{

				$bilgiler = file_get_contents( $this->cache_dosyasi );

			} else {

				$bilgiler = json_encode(

				array(

					'bist'	=> array(

            'isim'    => "BIST",

						'degeri'	=> "00000",

						'degisim'	=> 'asagi'

					),

					'capraz'	=> array(

            'isim'    => "USD/EUR",

						'degeri'	=> "0.0000",

						'degisim'	=> 'asagi'

					),

					'usd'	=> array(

            'isim'    => "USD",

						'degeri'	=> "0.0000",

						'degisim'	=> 'asagi'

					),

					

					'eur'	=> array(

            'isim'    => "Euro",

						'degeri'	=> "0.0000",

						'degisim'	=> 'asagi'

					),

					

					'gbp'	=> array(

            'isim'    => "İngiliz Sterlini",

						'degeri'	=> "0.0000",

						'degisim'	=> 'asagi'

					),

					

					'jpy'	=> array(

            'isim'    => "Japon Yeni",

						'degeri'	=> "0.0000",

						'degisim'	=> 'asagi'

					),

					

					'rub'	=> array(

            'isim'    => "Rus Rublesi",

						'degeri'	=> "0.0000",

						'degisim'	=> 'asagi'

					),

					

					

					'sar'	=> array(

            'isim'    => "SA Riyali",

						'degeri'	=> "0.0000",

						'degisim'	=> 'asagi'

					),

					

					'xau'	=> array(

            'isim'    => "Altın",

						'degeri'	=> "0.0000",

						'degisim'	=> 'asagi'

					),

					'zaman'	=> current_time('timestamp')

				)

			);

			}

		}



		return $bilgiler;

	}

	

	private function degisim_cevir( $deger )

	{

		if( $deger == "1" || $deger == 1 || $deger == '1' )

		{

			return 'yukari';

		}

		elseif ( $deger == "-1" || $deger == -1 || $deger == '-1')

		{

			return 'asagi';

		} else {

			return 'sabit';

		}

		

	}

	

	private function TL_sil( $veri )

	{

		$bol = explode( ' ', $veri );

		return $bol[0];

	}

	

	

	

}