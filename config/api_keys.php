<?php

return
[
    "stripe"  => config('app.env') == 'production' ? env('STRIPE_KEY','production_key') :  env('STRIPE_KEY','test_key')
];
