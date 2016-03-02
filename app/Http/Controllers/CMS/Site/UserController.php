<?php

namespace App\Http\Controllers\CMS\Site;

use Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use GrizzDev\CMS\Form;
use GrizzDev\CMS\Listing;

class UserController extends Controller {

    public function index() {
        return Listing::render(new User);
    }

    public function create() {
        return Form::render(new User);
    }

    public function store(Request $request) {
    }

    public function show($id) {
		$user = User::find($id);
		return view('cms.users.form', ['user' => $user]);
        //return Form::render(User::find($id));
    }

    public function edit($id) {
    }

    public function update(Request $request, $id) {
    }

    public function destroy($id) {
    }

}
