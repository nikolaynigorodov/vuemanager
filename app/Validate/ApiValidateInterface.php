<?php


namespace App\Validate;


use Illuminate\Http\Request;

interface ApiValidateInterface
{
    public function rules(Request $request);
}
