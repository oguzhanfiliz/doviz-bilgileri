# doviz-bilgileri
 Wordpress döviz bilgileri uygulamasının düzenltilmiş halidir kodlama tamamen Erdem ARSLAN'a aittir. 

 ```html 
 public_html/wp-content/plugins
 ```

Klasörüne kopyalayın 

Bilgi ekleyip çıkarmak isterseniz

```php 
class.doviz.php 
``` 

```php

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

```
Kısmını düzenleyin

[Plugin url](https://tr.wordpress.org/plugins/doviz-bilgileri/)