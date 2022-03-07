<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Form Input Language Lines
    |--------------------------------------------------------------------------
    |
    | The values here are used to inject text displayed to the user.
    |
    | The values are specified in this file which is a PHP array.
    | A Language Line follows the following format:
    |	'key.name' => 'The translated value',
    | In the frontend, the key is then referenced using
	|	{{ __(file-name.key.name) }}
	| which then gets replaced with the translated value.
    |
    | I reccomended you use a smart text editor like VSCode (free)
    | to verify the syntax is correct. (i.e. you haven't forgotten
	| a comma somewhere, because that will make PHP sad.)
    |
    */

	// Request Create Values
	'request.create.subject' => 'Enter a descriptive subject',
	'request.create.subject.placeholder' => 'e.g. I need help with fighting Russia',
	'request.create.location' => 'Enter a your location',
	'request.create.location.placeholder' => 'e.g. Kyiv, Ukraine',
	'request.create.resource.water.description' => 'Please specify quantity in the Request Details',
	'request.create.resource.food.description' => 'Please specify any dietary restrictions in the Request Details',
	'request.create.resource.money.description' => 'Please specify in the Request Details',
	'request.create.resource.shelter.description' => 'Please specify in the Request Details',
	'request.create.resource.other.description' => 'Please specify in the Request Details',
	'request.create.body' => 'Request Details - Remember to specify your contact information here',
	'request.create.body.placeholder' => 'e.g. We need food and shelter. Please contact us on 123-123-123 or hello@example.com.',
	'request.create.expires_at' => 'Request Expiration - Do you need aid before a certain date?',
	'request.create.resources' => 'Resources in Request',

	// Offer Create Values
	'offer.create.subject' => 'PleaseReplaceMe',
	'offer.create.subject.placeholder' => 'PleaseReplaceMe',
	'offer.create.location' => 'PleaseReplaceMe',
	'offer.create.location.placeholder' => 'PleaseReplaceMe',
	'offer.create.resource.water.description' => 'PleaseReplaceMe',
	'offer.create.resource.food.description' => 'PleaseReplaceMe',
	'offer.create.resource.money.description' => 'PleaseReplaceMe',
	'offer.create.resource.shelter.description' => 'PleaseReplaceMe',
	'offer.create.resource.other.description' => 'PleaseReplaceMe',
	'offer.create.body' => 'PleaseReplaceMe',
	'offer.create.body.placeholder' => 'PleaseReplaceMe',
	'offer.create.expires_at' => 'PleaseReplaceMe',
	'offer.create.resources' => 'Resources in Offer',
];