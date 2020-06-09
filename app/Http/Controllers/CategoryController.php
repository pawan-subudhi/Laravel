<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;

/**
 * This class is for getting all jobs of each category by category id
 * Date: 08/06/2020
 * Author: Pawan
 */

class CategoryController extends Controller
{
    /**
     * getting all jobs of each category by category id
     *
     * @param  int $id
     * @return view
     */
    public function index($id)
    {
        $jobs = Job::where('category_id', $id)->paginate(20);
        $categoryName = Category::where('id', $id)->first();

        return view('jobs.jobs-category', compact('jobs', 'categoryName'));
    }
}
