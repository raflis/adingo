<?php

namespace App\Http\Controllers\Web;

use Validator;
use App\Models\Record;
use App\Models\Blog\Tag;
use App\Models\Blog\Post;
use App\Models\Admin\Home;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Models\Admin\Aboutus;
use App\Models\Admin\Partner;
use App\Models\Blog\Category;
use App\Models\Admin\Solution;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class WebController extends Controller
{
    public function index()
    {
        return redirect()->route('admin');
    }
}
