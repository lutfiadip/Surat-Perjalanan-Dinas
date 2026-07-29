<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$user = \App\Models\User::first();
auth()->login($user);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::create('/spd/create', 'GET')
);
file_put_contents('rendered.html', $response->getContent());
echo "Done\n";
