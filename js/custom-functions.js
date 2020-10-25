/**
 * Custom JS functions
 *
 */

( function() {
    jQuery(document).ready(function() {
        const nextBtn           = jQuery('#gp-form .next-btn');
        const prevBtn           = jQuery('#gp-form .back-btn');
        const submitBtn         = jQuery('#gp-form .custom-submit');
        const error_message     = jQuery('.gp-error');
        const success_message   = jQuery('.gp-success');
		const steps_container   = jQuery('#gp-form .gp-steps');
        const step1_div         = jQuery('#gp-form .gp-step.step-1');
        const step2_div         = jQuery('#gp-form .gp-step.step-2');
        const step1_fields      = jQuery('#gp-form .gp-step.step-1 input.gp-validate');
        const step2_fields      = jQuery('#gp-form .gp-step.step-2 input.gp-validate');
        const empty_error       = 'Please fill the required fields';
        const empty_checkboxes  = 'Please select at least one ice cream taste';
        const email_error       = 'Please enter a valid email address';
        const successMessage    = "<p>Thank you for submiting the form</p>";

        const isEmail = function (email) {
            let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        const atLeastOneIsChecked = function (checkboxClass) {
            return jQuery(`.${checkboxClass}:checked`).length > 0;
        }

        const showErrors = function(errors, errorInputs) {
            let errorsOutput = "<strong>Please fix the following errors:</strong><br><ul>";
            for (i in errors) {
                errorsOutput += "<li>" + errors[i] + "</li>";
            }

            for (i in errorInputs) {
                jQuery(errorInputs[i]).addClass('gp-invalid')
            }

            errorsOutput += "</ul>";
            error_message.append(errorsOutput);

            error_message.show();
        }

        const clearErrorAndSuccessMsg = function() {
            error_message.empty().hide();
            success_message.empty().hide();
            step1_fields.removeClass('gp-invalid');
            step2_fields.removeClass('gp-invalid');
            jQuery('.gp-step.step-2 .checkboxes-box').removeClass('gp-invalid');
        }

        const showFirstStep = function() {
            // prevBtn.hide();
            // submitBtn.hide();
            step2_div.css('margin-left', '100%');

            // nextBtn.show();
            step1_div.css('margin-left', '0');
			steps_container.css('max-height', '400px');
        }

        const showSecondStep = function() {
            // nextBtn.hide();
            step1_div.css('margin-left', '-100%');

            // prevBtn.show();
            // submitBtn.show();
            step2_div.css('margin-left', '0');
			steps_container.css('max-height', 'inherit');
        }

        const showSuccessMsg = function() {
            success_message.append(successMessage);
            success_message.show();

            jQuery("#gp-form .gp-step input:not([type='checkbox']):not([type='submit']").val("");
            jQuery("#gp-form .gp-step input.custom-checkbox").prop("checked", "");
        }
        
        nextBtn.click(function(e) {
            e.preventDefault();

            clearErrorAndSuccessMsg();
            let errors = [];
            let errorInputs = [];

            step1_fields.each(function(i, input) {
                if ( jQuery(input).val().trim().length == 0 ) {
                    // empty fields error
                    errors['empty_error'] = empty_error;
                    errorInputs.push(input);
                }

                if ( jQuery(input).attr('type') === 'email' && !isEmail(jQuery(input).val()) ) {
                    // validate email field error
                    errors['email_error'] = email_error;
                    errorInputs.push(input);
                }
            })

            if (Object.keys(errors).length > 0) {

                showErrors(errors, errorInputs);
				steps_container.css('max-height', 'inherit');

            }
             else {
                // Next step

                showSecondStep();
            }
        });

        prevBtn.click(function (e) {
            e.preventDefault();

            clearErrorAndSuccessMsg();
            showFirstStep();
        })

        submitBtn.click(function (e) {
            e.preventDefault();

            clearErrorAndSuccessMsg();

            let errors = [];
            let errorInputs = [];
            let savingDataCount = 0;

            step2_fields.each(function(i, input) {
                if ( jQuery(input).val().trim().length == 0 ) {
                    // empty fields error
                    errors['empty_error'] = empty_error;
                    errorInputs.push(input);
                }
            })

            if ( !atLeastOneIsChecked('gp-validate-checkbox') ) {
                errors['empty_checkboxes'] = empty_checkboxes;
                errorInputs.push(jQuery('.gp-step.step-2 .checkboxes-box'));
            }

            if (Object.keys(errors).length > 0) {

                showErrors(errors, errorInputs);
            }
            else {
                // Submit form

                let email = jQuery('#gp-form #email').val();
                let firstname = jQuery('#gp-form #firstname').val();
                let lastname = jQuery('#gp-form #lastname').val();
                let servings = jQuery('#gp-form #servings').val();
                let month_supply = jQuery('#gp-form #month-supply').val();
                let ice_cream = jQuery('#gp-form input.custom-checkbox:checked').map(function() {
                        return jQuery(this).val()
                    })
                    .get();

                /*console.log({
                    email : email,
                    firstname: firstname,
                    lastname: lastname,
                    ice_cream: ice_cream.join(','),
                    servings: servings,
                    month_supply: month_supply,
                })*/

                jQuery.ajax({
                    type : "post",
                    dataType : "json",
                    url : gpAjax.ajaxURL,
                    data : {
                        action: "saveFormDataToDB",
                        email : email,
                        firstname: firstname,
                        lastname: lastname,
                        ice_cream: ice_cream.join(','),
                        servings: servings,
                        month_supply: month_supply,
                    },
                    success: function(response) {
                        console.log(response)
                        if(response.success == true) {
                            // Successfully added
                            savingDataCount++;

                            if ( savingDataCount == 2 ) {
                                showSuccessMsg();
                            }
                        }
                        else {
                            // Not added
                        }
                    }
                })

                let hubspotJSON = {
                    "fields": [
                        {
                            "name": "email",
                            "value": email
                        },
                        {
                            "name": "firstname",
                            "value": firstname
                        },
                        {
                            "name": "lastname",
                            "value": lastname
                        },
                        {
                            "name": "servings",
                            "value": servings
                        },
                        {
                            "name": "month_supply",
                            "value": month_supply
                        }
                    ],
                    "skipValidation" : true,
                    "context": {
                        "pageUri": gpAjax.homeURL,
                    },
                }

                for ( i in ice_cream ) {
                    hubspotJSON['fields'].push({
                        "name": "ice_cream",
                        "value": ice_cream[i]
                    })
                }

                /* console.log(hubspotJSON);
                console.log( JSON.stringify( hubspotJSON ) ); */

                (async () => {
                    const rawResponse = await fetch(gpAjax.hubspotFormURL, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify( hubspotJSON )
                    })
                        .then(response => response.json())
                        .then(content => {
                            console.log(content);
                            if ( content.status !== "error" ) {
                                savingDataCount++;

                                if ( savingDataCount == 2 ) {
                                    showSuccessMsg();
                                }
                            }
                        });
                })();
            }
        })
    });
}() );
