<?php

namespace App\Http\Controllers;

use App\Jobs\ZipApploadJob;
use App\Notice;
use App\Jobs\CarbonNow;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    //
    public function sample(Request $request)
    {
        $this->dispatch(new CarbonNow());
        $this->dispatch(new ZipApploadJob($_FILES));
        return redirect('/');
    }
}
