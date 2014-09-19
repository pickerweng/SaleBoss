<?php namespace Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Commander\CommanderTrait;

class BaseController extends Controller
{

	use CommanderTrait;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if (!is_null($this->layout)) {
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * @param $bladable_path
	 * @param array $data
	 */
	protected function view($bladable_path , $data = [])
	{
		return  View::make($bladable_path, $data);
	}

	/**
	 * Redirect back
	 *
	 * @return mixed
	 */
	protected function redirectBack()
	{
		return Redirect::back();
	}

	/**
	 * Redirect intended
	 *
	 * @param null $def
	 * @return mixed
	 */
	protected function redirectIntended( $def = null )
	{
		return Redirect::intended( $def );
	}

	/**
	 * Redirect to page
	 *
	 * @param string $to
	 * @return
	 */
	protected function redirectTo( $to = '/' )
	{
		return Redirect::to( $to );
	}

    /**
     * Share a variable through views
     *
     * @param $var
     * @param $data
     * @return void
     */
	protected function viewShare($var, $data)
	{
		View::share($var,$data);
	}

	/**
	 * Check that view exists or not
	 *
	 * @param $view
	 * @param $fallback
	 * @return string
	 */
	protected function getView($view, $fallback)
	{
		if (View::exists($view)){
			return $view;
		}else {
			return $fallback;
		}
	}

    /**
     * Get title of current page
     *
     * @param $for
     * @return string | boolean
     */
    protected function getTitle($for = null)
    {
        $title = is_null($for) ? $title = 'titles.' . Request::path() : $for;
        if (Lang::has($title))
        {
            return Lang::get($title);
        }
        return false;
    }

    /**
     * Get description of currrent page
     *
     * @param null $for
     * @return bool | string
     */
    protected function getDescription($for = null)
    {
        $description = is_null($for) ? 'descriptions.' . Request::path() : $for;
        if ( Lang::has($description) )
        {
            return Lang::get($description);
        }
        return false;
    }

}
