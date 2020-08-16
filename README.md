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


Örnek gelen json verisi 
```json
{"GetExchangeDataResult":"{\"BIST\":{\"Name\":\"XU100\",\"RateDirection\":-1,\"Rate\":1.4932834057404614,\"Index\":\"1084\"},\"EURxUSD\":{\"Kod\":\"Capraz\",\"Name\":\"EUR\/USD\",\"RateDiretion\":-1,\"Rate\":0.023529805879729526,\"Buy\":\"1,1843\",\"Sell\":\"1,1843\"},\"ServiceDate\":\"17.08.2020 01:32:13\",\"Currencies\":[{\"Kod\":\"039\",\"Name\":\"AED\",\"RateDiretion\":1,\"Rate\":0.086467365938736052,\"Buy\":\"1,96892\",\"Sell\":\"2,03721\"},{\"Kod\":\"006\",\"Name\":\"AUD\",\"RateDiretion\":1,\"Rate\":0.15804544271318388,\"Buy\":\"5,1706\",\"Sell\":\"5,3867\"},{\"Kod\":\"011\",\"Name\":\"CAD\",\"RateDiretion\":1,\"Rate\":0.15391964333104635,\"Buy\":\"5,4339\",\"Sell\":\"5,661\"},{\"Kod\":\"021\",\"Name\":\"CHF\",\"RateDiretion\":1,\"Rate\":0.096970872374213535,\"Buy\":\"7,926\",\"Sell\":\"8,2579\"},{\"Kod\":\"029\",\"Name\":\"CNY\",\"RateDiretion\":0,\"Rate\":0.0,\"Buy\":\"1,03168\",\"Sell\":\"1,08211\"},{\"Kod\":\"013\",\"Name\":\"DKK\",\"RateDiretion\":1,\"Rate\":0.071056569388838753,\"Buy\":\"1,14122\",\"Sell\":\"1,19708\"},{\"Kod\":\"036\",\"Name\":\"EUR\",\"RateDiretion\":1,\"Rate\":0.069806455971277437,\"Buy\":\"8,5326\",\"Sell\":\"8,8879\"},{\"Kod\":\"003\",\"Name\":\"GBP\",\"RateDiretion\":1,\"Rate\":0.17016853818092592,\"Buy\":\"9,4361\",\"Sell\":\"9,8305\"},{\"Kod\":\"020\",\"Name\":\"JPY\",\"RateDiretion\":1,\"Rate\":0.056685325586358637,\"Buy\":\"6,7316\",\"Sell\":\"7,0605\"},{\"Kod\":\"012\",\"Name\":\"KWD\",\"RateDiretion\":0,\"Rate\":0.0,\"Buy\":\"23,4179\",\"Sell\":\"24,6414\"},{\"Kod\":\"015\",\"Name\":\"NOK\",\"RateDiretion\":1,\"Rate\":0.13928727410084107,\"Buy\":\"0,80731\",\"Sell\":\"0,84835\"},{\"Kod\":\"016\",\"Name\":\"PLN\",\"RateDiretion\":1,\"Rate\":0.044505983582232567,\"Buy\":\"1,9375\",\"Sell\":\"2,0231\"},{\"Kod\":\"038\",\"Name\":\"RON\",\"RateDiretion\":1,\"Rate\":0.13057671381937475,\"Buy\":\"1,7637\",\"Sell\":\"1,8404\"},{\"Kod\":\"025\",\"Name\":\"RUB\",\"RateDiretion\":-1,\"Rate\":0.096739866498973814,\"Buy\":\"0,09813\",\"Sell\":\"0,10327\"},{\"Kod\":\"019\",\"Name\":\"SAR\",\"RateDiretion\":0,\"Rate\":0.0,\"Buy\":\"1,93375\",\"Sell\":\"1,98771\"},{\"Kod\":\"007\",\"Name\":\"SEK\",\"RateDiretion\":1,\"Rate\":0.12583408372006666,\"Buy\":\"0,82576\",\"Sell\":\"0,86731\"},{\"Kod\":\"001\",\"Name\":\"USD\",\"RateDiretion\":1,\"Rate\":0.093358228861029069,\"Buy\":\"7,205\",\"Sell\":\"7,505\"},{\"Kod\":\"040\",\"Name\":\"XAU\",\"RateDiretion\":1,\"Rate\":0.26093495264394306,\"Buy\":\"449\",\"Sell\":\"468,001\"},{\"Kod\":\"035\",\"Name\":\"ZAR\",\"RateDiretion\":1,\"Rate\":0.069412309116145821,\"Buy\":\"0,4134\",\"Sell\":\"0,4325\"}]}"}
```
