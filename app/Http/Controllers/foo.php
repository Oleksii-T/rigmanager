<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ImageUploader;
use App\Http\Controllers\Traits\Subscription;
use Google\Cloud\Translate\TranslateClient;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Traits\Tags;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\App;
use App\Http\Requests\PostRequest;
use App\Jobs\MailersAnalizePost;
use Illuminate\Http\Request;
use App\Imports\PostsImport;
use Illuminate\Support\Str;
use App\Jobs\TranslatePost;
use Carbon\Carbon;
use App\Post;
use App\User;

class PostController extends Controller
{
    use ImageUploader, Tags, Subscription;







}
