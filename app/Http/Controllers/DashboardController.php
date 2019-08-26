<?php 
/** 
 * @author	 : Vishal Kumar Sinha <vishalsinhadev@gmail.com> 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    //
    public function index()
    {
        return view('dashboard.index');
    }
}
