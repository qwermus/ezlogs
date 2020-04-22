<?php

return [

    'firstname' => 'First Name',
    'surname' => 'Surname',
    'age' => 'Age',
    'license' => 'Driver\'s license',
    'photo' => 'Photo',
    'phone_text' => 'Phone number',
    'address' => 'Address',
    'comment' => 'Comment #:counter',

    'firstname_help' => 'required string from 2 to 10 symbols',
    'surname_help' => 'required string from 2 to 10 symbols',
    'age_help' => 'required number from '.config('api.ageMin').' to '.config('api.ageMax'),
    'license_help' => 'required string, mask is AZ123456',
    'photo_help' => 'required, dimensions are from '.config('api.photoDimensionsMin').' to '.config('api.photoDimensionsMax').'px',
    'phone_text_help' => 'required string max 15 symbols, 5-10 numbers',
    'address_help' => 'required string from 5 to 1000 symbols',
    'comment_help' => 'Comment is string from 2 to 10000 symbols',

    'submit' => 'submit',
    'search' => 'search',
    'interval' => 'Interval between posts, ms',
    'num' => 'Number of posts',
    'wrongnum' => 'Wrong number of posts',
    'wronginterval' => 'Wrong interval',

];
