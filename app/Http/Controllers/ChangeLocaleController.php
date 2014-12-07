<?php namespace nonstop3d\Http\Controllers;

use nonstop3d\Http\Requests;
use nonstop3d\Http\Controllers\Controller;
use Config;
use Validator;
use Session;
use App;

class ChangeLocaleController extends Controller {


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($language)
	{
	
	        //list of supported languages of your application.
        $rules = [
            'language' => 'in:'.implode(',', Config::get('app.support_locales')),
        ];


        $validator = Validator::make(['language' => $language],$rules);

        if($validator->passes())
        {
            Session::put('language',$language);
            App::setLocale($language);
        }
        else
        {/**/
            return ;
        }

                if( $language !=  Config::get('app.fallback_locale')){
                    return redirect('/'.$language);
                }else{
                    return redirect('/');
                }

		//
	}


}
