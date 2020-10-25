<?php
/**
 * Template Name: Landing Page
 *
 * @package sellics-challenge
 */

get_header();
?>

<?php 
	// content fields 

	//banner row 
	$sign_up_title 		= get_field('sign-up-title');
	$banner_row_image 	= get_field('banner_row_image'); 

	//form row 
	$form_row_content	= get_field('form_row_content');
	$custom_form 		= get_field('custom_form'); 

	// ice-cream cones 
	$cones 				= get_field('ice_cream_cones');
	$cone1 				= $cones['cone_1'];
	$cone2 				= $cones['cone_2'];
	$cone3 				= $cones['cone_3'];
	$cone4 				= $cones['cone_4'];
	$cone5 				= $cones['cone_5'];
	$cone6 				= $cones['cone_6'];

?>

<div class="main-content">
	<section class="wave-bg">
		<div class="gp-container banner-container ">
			<div class="banner-row row">
				<div class="col-gp-6 col-gp-mob-12">
					<div class="signup-wrapper">
						<h1><?php echo $sign_up_title; // __('Sign up for unlimited Ice-cream delivery', 'sellics')?></h1>
						<div class="sign-up-form">
							<input type="email" title="sign-up" class="enter-email" id="signup-email" placeholder="E-mail"/>
							<button type="submit" class="get-ice-cream"><?php echo __('Get your Ice Cream', 'sellics');?></button>
						</div>
					</div>
				</div>
				<div class="col-gp-6 col-gp-mob-12">
					<img src="<?php echo $banner_row_image['url'] ;?>" class="pc-img" alt="<?php echo $banner_row_image['alt']; ?>">
				</div>
			</div>
		</div>
	</section>
	<section class="no-bg">
		<div class="gp-container choices-container">
			<div class="choices-row row">

			<?php if ( have_rows('ice_cream_choices') ): 
				while ( have_rows('ice_cream_choices') ): the_row();

				//ice cream choices
				$choice_image			= get_sub_field('choice_image');
				$choice_content			= get_sub_field('choice_content');
				?>
				<div class="col-gp-4 col-gp-mob-12">
					<div class="choice-image">
						<img src="<?php echo $choice_image['url']; ?>" alt="<?php echo $choice_image['alt']; ?>">
					</div>
					<div class="choice-content">
						<?php echo $choice_content; ?>
					</div>
				</div>

				<?php endwhile;
						endif; ?>
			</div>
		</div>
	</section>
	<section class="color-bg">
		<div class="gp-container form-container ">
			<div class="form-row row">
				<div class="col-gp-6 col-gp-tab-12 col-gp-mob-12">
					<div class="form-content">
						<?php echo $form_row_content; ?>
					</div>
				</div>
				<div class="col-gp-6 col-gp-tab-12 col-gp-mob-12">
					<div class="custom-form">
						<?php get_template_part('/custom-form/form'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="ice-creams">
		<div class="gp-container form-container ">
			<div class="ice-cream-row row">
				<div class="col-gp-2">
					<div class="ice-cream-cone">
						<img src="<?php echo $cone1['url']; ?>" alt="<?php echo $cone1['alt']; ?>" id="cone-1">
					</div>
				</div>
				<div class="col-gp-2">
					<div class="ice-cream-cone">
						<img src="<?php echo $cone2['url']; ?>" alt="<?php echo $cone2['alt']; ?>" id="cone-2">
					</div>
				</div>
				<div class="col-gp-2">
					<div class="ice-cream-cone">
						<img src="<?php echo $cone3['url']; ?>" alt="<?php echo $cone3['alt']; ?>" id="cone-3">
					</div>
				</div>
				<div class="col-gp-2">
					<div class="ice-cream-cone">
						<img src="<?php echo $cone4['url']; ?>" alt="<?php echo $cone4['alt']; ?>" id="cone-4">
					</div>
				</div>
				<div class="col-gp-2">
					<div class="ice-cream-cone">
						<img src="<?php echo $cone5['url']; ?>" alt="<?php echo $cone5['alt']; ?>" id="cone-5">
					</div>
				</div>
				<div class="col-gp-2">
					<div class="ice-cream-cone">
						<img src="<?php echo $cone6['url']; ?>" alt="<?php echo $cone6['alt']; ?>" id="cone-6">
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php

get_footer();
