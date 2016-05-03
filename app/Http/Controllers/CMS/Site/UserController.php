<?php

namespace App\Http\Controllers\CMS\Site;

use Hash;
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
	$user = User::create([
		'name' => $request->input('name'),
		'email' => $request->input('email'),
		'password' => Hash::make($request->input('password'))
	]);

	return $user->id;
    }

    public function show($id) {
	$user = User::find($id);
	return view('cms.users.form', ['user' => $user]);
    }

    public function edit($id) {
    }

    public function update(Request $request, $id) {
	$user = User::find($id);

	$user->name = $request->input('name');
	$user->email = $request->input('email');
	$user->password = Hash::make($request->input('password'));
	$user->save();
    }

    public function destroy($id) {
	User::destroy($id);
    }

}
