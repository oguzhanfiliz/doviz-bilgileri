<?php

/* Düzenlenme sağlandı */

class Doviz_Widget extends WP_Widget {

	

	private $doviz;



	public function __construct() {

		

		$this->doviz = new Doviz;

		

		

		$params = array(

			'name'			=> 'Döviz ve Borsa Bilgileri',

			'description'	=> 'Bu bileşen Döviz ve Borsa bilgilerini (BIST 100, USD, EURO, O/N REPO, ALTIN) gösterir.'

		);

		parent::__construct('Doviz_Widget','',$params);

	}

	

	public function form( $instance ) {

		$baslik		= isset($instance['baslik'])	? esc_attr( $instance['baslik'] )	: '';

		?>

        <p>

        	<label for ="<?php echo $this->get_field_id( 'baslik' ); ?>"><strong>Widget Başlığı</strong>  

            <input class="widefat" id="<?php echo $this->get_field_id( 'baslik' ); ?>" name="<?php echo $this->get_field_name( 'baslik' ); ?>" type="text" value="<?php echo $baslik; ?>" />

            </label>

        </p>

        <?php

	}

	

	public function widget( $args, $instance ) {

		

		extract($args, EXTR_SKIP);

		$title = $instance['baslik'];

		

		echo $before_widget;

		

		if ( $title )

		{

			echo $before_title . $title . $after_title; 

		}

		

		$veriler = json_decode( $this->doviz->veriler(), TRUE );

		

		

		?>

        <div class="doviz_widget">

        

          <?php

          foreach($veriler as $key => $value)

          {

            if($key != "zaman") {

            

            ?>

            

            <div class="<?php echo $key; ?>">

            	<div class="isim"><?php echo $value["isim"]; ?></div>

                <div class="degeri"><?php echo $value["degeri"]; ?></div>

                <?php echo $this->degisim( $value['degisim'] ); ?>

            </div>

            

            <?php

            }

          }

          ?>

            

            <div class="zaman_widget"><strong>Son Güncelleme:</strong> <?php echo date('d.m.Y H:i', $veriler['zaman']); ?></div>

            

        </div>

        

        

		

		<?php

		echo $after_widget;

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

	

}