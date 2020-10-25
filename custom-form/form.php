<?php
/**
* Landing page form template
 */

$pageID = get_the_id();
?>

	<form action="" method="post" id="gp-form">
		<div class="gp-steps">
			<div class="gp-step step-1">
                <div class="gp-error"></div>
				<span class="cf-label"><?php echo __('Email *', 'sellics'); ?></span>
				<input type="email" name="email" id="email" class="custom-inputs gp-validate">
				<span class="cf-label"><?php echo __('First name *', 'sellics'); ?></span>
				<input type="text" name="firstname" id="firstname" class="custom-inputs gp-validate">
				<span class="cf-label"><?php echo __('Last name *', 'sellics'); ?></span>
				<input type="text" name="lastname" id="lastname" class="custom-inputs gp-validate">

                <button class="next-btn"><?php echo __('Next', 'sellics');?></button>
			</div>
			<div class="gp-step step-2">
                <div class="gp-error"></div>
				<div class="checkboxes-container">
					<span class="cf-label"><?php echo __('Which ice cream taste you like? *', 'sellics'); ?></span>
					<div class="checkboxes-box">
						<p>
							<input type="checkbox" name="ice_cream[]" id="vanilla" value="Vanilla" class="custom-checkbox gp-validate-checkbox">
							<label for="vanilla">Vanilla</label>
						</p>
						<p>
							<input type="checkbox" name="ice_cream[]" id="strawberry" value="Strawberry" class="custom-checkbox gp-validate-checkbox">
							<label for="strawberry">Strawberry</label>
						</p>
						<p>
							<input type="checkbox" name="ice_cream[]" id="coconut" value="Coconut" class="custom-checkbox gp-validate-checkbox">
							<label for="coconut">Coconut</label>
						</p>
						<p>
							<input type="checkbox" name="ice_cream[]" id="sellics" value="Sellics Special" class="custom-checkbox gp-validate-checkbox">
							<label for="sellics">Sellics Special</label>
						</p>
						<p>
							<input type="checkbox" name="ice_cream[]" id="chocolat" value="Chocolat" class="custom-checkbox gp-validate-checkbox">
							<label for="chocolat">Chocolat</label>
						</p>
						<p>
							<input type="checkbox" name="ice_cream[]" id="caramel" value="Caramel Macchiato" class="custom-checkbox gp-validate-checkbox">
							<label for="caramel">Caramel Macchiato</label>
						</p>
					</div>
				</div>
				<span class="cf-label"><?php echo __('How many servings of ice cream do you consume per month? *', 'sellics'); ?></span>
				<input type="text" name="servings" id="servings" class="custom-inputs gp-validate">
				<span class="cf-label"><?php echo __('How many months should your ice cream supply last for? *', 'sellics'); ?></span>
				<input type="text" name="month-supply" id="month-supply" class="custom-inputs gp-validate">

                <button class="back-btn"><?php echo __('Back', 'sellics');?></button>
				<input type="submit" name="submit" value="<?php _e('Submit', 'sellics'); ?>" class="custom-submit">

                <div class="gp-success"></div>
            </div>
		</div>
	</form>

<?php


