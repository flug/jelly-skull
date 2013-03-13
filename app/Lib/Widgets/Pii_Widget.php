<?php  
#require_once ABSPATH."wp-includes/widgets.php"; 

class Pii_Widget extends WP_Widget{

	public function __construct()
	{
//		echo "ok"; 
		parent::__construct(false, 'Pii Widget', array("description" => 'Affiche vos coordonnées'));
	}
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance ; 
		$instance['phone'] = $new_instance['phone'];
		$instance['fax'] = $new_instance['fax'];
		$instance['email'] = $new_instance['email'];
		$instance['address'] = $new_instance['address'];
		$instance['complement'] = $new_instance['complement'];
		return $instance;

	}

	function form($instance)
	{
		$phone = esc_attr($instance['phone']);
		$fax = esc_attr($instance['fax']);
		$email = esc_attr($instance['email']);
		$address = esc_attr($instance['address']);
		$complement = esc_attr($instance['complement']);
		?>
		Partie gauche
<hr>
			<p>
				<label for="<?php echo $this->get_field_id('phone'); ?>">
					<?php _e('Téléphone :'); ?>
					<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" />
				</label>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('fax'); ?>">
					<?php _e('Fax :'); ?>
					<input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo $fax; ?>" />
				</label>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('email'); ?>">
					<?php _e('Email :'); ?>
					<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('address'); ?>">
					<?php _e('Adresse :'); ?>
					<textarea class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" ><?php echo $address; ?></textarea>
				</label>
			</p>
		
		
			Partie droite
			<hr>
			<p>
				<label for="<?php echo $this->get_field_id('complement'); ?>">
					<?php _e('Complement :'); ?>
					<textarea class="widefat" id="<?php echo $this->get_field_id('complement'); ?>" name="<?php echo $this->get_field_name('complement'); ?>" ><?php echo $complement; ?></textarea>
				</label>
			</p>

			
		<?php 
	}

	function widget($args, $instance)
	{

		extract( $args );


		$phone =  $instance['phone'];
		$fax = $instance['fax'];
		$email = $instance['email'];
		$address = $instance['address'];
		$complement = $instance['complement'];



		echo $before_widget;

		echo '<div class="row">'; 
		echo '<div class="six columns">'; 
echo '<adress class="pull-left"><i class="icon-home" ></i>'.nl2br($address).'</adress>';
		?>
		<ul class="pull-right">
			<?php 

			echo '<li><i class="icon-phone"></i>'.$phone.'</li>';
			echo '<li ><i class="icon-print"></i>'.$fax.'</li>';
			echo '<li><i class="icon-mail"></i>'.$email.'</li>';

			?>
		</ul>
	</div>
	<div class="six columns">
		<?php echo '<p>'.$complement.'</p>';?>
	</div>
</div>
<?php 
echo $after_widget;
}
}

?>