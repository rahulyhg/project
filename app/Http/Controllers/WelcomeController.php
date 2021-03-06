<?php

namespace App\Http\Controllers;

use Antares\Model\Role;

class WelcomeController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return mixed
     */
    public function index()
    {
//        vdump(user(), request()->session());
//        exit;
        if (($redirection = $this->redirectWhenAuthenticated()) !== false) {
            return $redirection;
        }
        if (!app('antares.installed')) {
            return redirect(handles('antares::install'));
        }
        return $this->redirect(handles(area() . '/login'));
    }

    /**
     * reidrects when user is authenticated
     * 
     * @return boolean|\Illuminate\Http\RedirectResponse
     */
    protected function redirectWhenAuthenticated()
    {
        if (auth()->guest()) {
            return false;
        }

        if (can('antares.show-dashboard')) {
            return redirect(handles('antares::/'))->send();
        }
    }

}
