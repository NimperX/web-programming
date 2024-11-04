<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function list() {
        $tags = Tag::all();

        return view('tags.list', ['tag_list' => $tags]);
    }
}
