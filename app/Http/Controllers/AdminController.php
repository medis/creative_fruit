<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Create work form.
    public function create() {
        return 'create work';
    }

    // Save work.
    public function store() {
        return 'save work';
    }

    // Edit work.
    public function edit() {
        return 'edit work';
    }

    // Update work.
    public function update() {
        return 'update work';
    }

    // Delete work.
    public function destroy() {
        return 'delete work.';
    }
}
