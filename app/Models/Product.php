<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
}
 // The "Product" model represents the products in the database.
    // It uses the Eloquent ORM to interact with the database.

    // The "HasFactory" trait allows you to use factory to generate fake data for testing.

    // Since you're extending the Eloquent Model class, you'll inherit various methods and properties
    // that allow you to interact with the database table associated with this model.

    // You can define relationships, attributes, and other methods here to work with your product data.