<?php
use Illuminate\Support\Facades\Schema;

echo "Columns in users table: " . implode(', ', Schema::getColumnListing('users')) . "\n";
