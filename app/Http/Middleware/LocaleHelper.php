<?php namespace nonstop3d\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Config;
use Session;
use Validator;




class LocaleHelper implements Middleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
    public function __construct()
    {

//Session::set('language', 'ru');

        // get app locale now
        $this->locale = Config::get('app.locale');


        //Fall back locale
        $this->fallback_locale = Config::get('app.fallback_locale');


        // bool value - find any locale settins in cookies?
        $this->has_locale_cookies = Session::has('language');


        //locale in cookies
        if ($this->has_locale_cookies){
            $this->language = Session::get('language') ? : false;
        }else{
            $this->language = false;
        }


        //list of supported languages of your application.
        $rules = [
            'language' => 'in:'.implode(',', Config::get('app.support_locales')),
        ];

        // bool -> if locale in cookies in valid locales list
        $this->validator_passes = Validator::make(array('language' => $this->language),$rules)->passes();


    }




	public function handle($request, Closure $next)
	{

        // if already have lang cookies, do locale check. If not - do nothing
        if ($this->has_locale_cookies)
        {


            // if in cookies a valid lang, then confirm that we show page with correct lang
            if ($this->validator_passes) {


                // if cookie lang and locale lang different - redirect to lang in cookies
                if ($this->language != $this->locale){

                    return redirect('/'.$this->locale_prefix_helper());

                }

            } else {

                // if in session incorrect lang, redirect to fall_back lang
                // and set fail cookies
                $this->set_session_locale($this->fallback_locale);

                return redirect('/');

            }

        }



        return $next($request);

    }








    /*
     * set locale for User
    */
    protected function set_session_locale ($locale){
        Session::set('language', $locale);
    }



    /*
     * set URL locale_prefix for User to locale in cookies
     * if locale in cookies not in valid locale list, than
     * set locale_prefix to fallback_locale or default_locale - empty
    */
    protected function locale_prefix_helper(){

    if ($this->validator_passes and ($this->language != $this->fallback_locale)){
        Config::set('app.locale_prefix', $this->language);
    } else {
        Config::set('app.locale_prefix', '');
    }
        return Config::get('app.locale_prefix');

    }



}
