<?php

use App\Models\Tkrk;

function newKrk()
{
    return Tkrk::where('status', 0)->count();
}
