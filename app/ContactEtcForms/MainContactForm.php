<?php

namespace App\ContactEtcForms;

use WebDevEtc\ContactEtc\ContactPageConfigurator;
use WebDevEtc\ContactEtc\ContactForm;
use WebDevEtc\ContactEtc\FieldTypes\Checkbox;
use WebDevEtc\ContactEtc\FieldTypes\Email;
use WebDevEtc\ContactEtc\FieldTypes\Select;
use WebDevEtc\ContactEtc\FieldTypes\RecaptchaV2Invisible;
use WebDevEtc\ContactEtc\FieldTypes\Text;
use WebDevEtc\ContactEtc\FieldTypes\Textarea;


/* https://webdevetc.com/contactetc configuration

For full docs please go to the URL above. It explains things in a much
easier to digest way!

>> What is this file?
This is a config file for a single contact form.

Most websites will probably only have one contact on their site, so
you should only have this one file in /app/ContactEtcForms/

If you have multiple forms please read the docs on my site to see what
needs to be done to get it working correctly!

If you need to generate another contact form, then please run the following command:
php artisan make:contactetcform MyContactForm

Then you must update the file created from that command (for example, app/ContactEtcForms/MainContactForm.php)
with details about your contact form (who to send to, what fields are required, etc).

Then in /config/contactetc.php, you must make it look something like this:

     [...]
     'contact_forms' => [
            app_path('ContactEtcForms/MainContactForm.php'),
      ],
     [...]

If you don't have a contactetc.php file in /config, then
please see the docs and go to the vendor:publish part!

If you want to have more than one contact form please see the docs on https://webdevetc.com/contactetc

Feel free to delete this comment once you have read it!
*/


    // set a alphanum (with underscore) name for this contact form (it must be unique, if you have 2+ contact forms):
    // the  default form should be 'main_contact_form'.
return ContactForm::newContactForm('main_contact_form')

    // what email address shall we send the contact form response to? (i.e. your email address)
    ->sendTo("UPDATEME@YOURSITE.com")

    // what is the human readable name of this form
    // This will appear on the emails that it sends you.
    ->humanReadableFormName("Main Contact Form")


    // Now add some fields!
    // Please see my docs page for more details
    // It includes some decent defaults below though.
    // If you need a custom field type you can easily make one. See the docs.
    // Some options are commented out.
    ->addFields(

        [
            // first field:
            Text::newNamed("your_name")// field name (<input name=$field_name>)
            ->setLabelName("Your name") // the <label>$label_name</label> value
                ->max(100) // max length for their name
                ->markAsRequiredField() // required in the Request validation + <input required >
//                        ->setAsFromName() // if you want the email to set the 'from name' to this value
                ->setAsReplyToName(), // if you want to email 'reply to name' to this value

            // second field:
            Email::newNamed("email") // the field name <input name='email'>
                ->setLabelName("Your email address") // the <label>Your email address</label>
                ->setPlaceholderValue("you@example.com") // the default placeholder value (<input placeholder=$placeholder>)
                ->markAsRequiredField() // makes it required, in the Request validation and also in the HTML with <input required>
                ->max(200)// max length (via request validation rule)
                ->min(4)// min length (via request validation rule)
//                        ->setAsFromAddress() // send the email to you with this as the 'from' address
                ->setAsReplyToAddress(), // mark the email's "reply to" as this value


            // another field -
//            Text::newNamed("your_location")// field name
//            ->setLabelName("Location")
//                ->markAsOptional() // opposite of ->markAsRequiredField(). This isn't really needed, as all fields are optional unless ->markAsRequired() was set
//                ->max(100), // max length

            // another field:
            Textarea::newNamed("message")
                ->setLabelName("Your message")
//                        ->defaultValue("I wanted to get in touch to ask about...")
                ->setDescription("Please give as much detail as possible") // an optional bit of text that is displayed below the field
                ->markAsRequiredField()
                ->max(5000),

            // Here are some other field types you can use.
            // Just uncomment them and move it where you want

            // select (dropdown) <select><option>...</option><option>...</option></select>
            // Make sure you use ->setOptions()!
//               Select::newNamed("job_position")
//                  ->setLabelName("Your Job Position")
//                  ->setDescription("Tell us a little bit about yourself")
//                  ->setOptions([
//
//                      'other' => "Other",
//                      'ceo' => "CEO",
//                      'manager' => "Manager",
//
//                    ]),

            // checkbox - useful if you want the user to agree to some terms and conditions.
//                    Checkbox::newNamed("agree_to_terms")           //<input type='checkbox'>
//                            ->setLabelName("Agree to our terms?")
//                            ->markAsRequiredField(),


            // Do you want to use the invisible recaptcha from Google?
            // If so, please make sure that you have CAPTCHA_SITEKEY and CAPTCHA_SECRET set up in your .env (or in config/captcha.php)
            // and uncomment the next line
//                    RecaptchaV2Invisible::spam()  // do not use newNamed with RecaptchaV2Invisible()
//                       ->markAsRequiredField()
//                       ->setLabelName("Spam protection"), // probably not needed, as it should be invisible!

        ]


    )


    // the rest of the options are optional :)


    // If you need to send data to the view, set it here.
    // Maybe your main layout blade file has <title>{{$title}}</title> <meta name=desc content={{$meta_desc}}
    // The data from these two arrays are sent in the ContactEtcController methods
    // The first array is for the contact form view
    // and the second array is for the 'thank you' or 'confirmation' page.
    ->setFormViewVars([
        'title' => "Our contact page",
        'meta_desc' => "Get in touch with us!",
//                    'sidebar_section_title'=>"Welcome to our contact page",
    ], [
        'title' => "Our contact page",
        'meta_desc' => "Get in touch with us!",
    ])

    // Do you want to show some custom HTML above and/or below the form?
    // Enter it here :) Be warned: Anything you enter here is echoed directly, it is NOT escaped!!
    // {!! ... !!}
    // This is a good place to put your phone number or other contact details.
    ->setHtmlAboveAndBelowForm(
        '<div style="text-align:center;"><h3>Contact us</h3><p>Please use the contact form below to get in touch! </p></div>', '')

    // And finally, what do you want the contact form button value and css class to be?
    // by default it will look something like <input type='submit' value='Send!' class='btn btn-primary'>
    ->setSubmitButtonTextAndClasses("Send!", "btn btn-primary")
   ;
