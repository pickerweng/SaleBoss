<?php namespace Controllers;

use Illuminate\Support\Facades\Lang;
use SaleBoss\Repositories\Exceptions\NotFoundException;
use SaleBoss\Repositories\OrderLogRepositoryInterface;
use SaleBoss\Services\Authenticator\AuthenticatorInterface;

class OrderLogController extends BaseController {

    protected $auth;
    protected $orderLog;

    public function __construct(
        AuthenticatorInterface $auth,
        OrderLogRepositoryInterface $orderLog
    ){
        $this->auth = $auth;
        $this->orderLogRepo = $orderLog;
    }

    public function show($id)
    {
        try {
            $orderLog = $this->orderLogRepo->findById($id);
            $currentUser = $this->auth->user();
            if ($currentUser->id != $orderLog->changer_id && ! $currentUser->hasAnyAccess(['orderlogs.view']))
            {
                return $this->redirectTo('dash')->with('error_message',Lang::get("messages.permission_denied"));
            }
            $orderLogData = json_decode($this->orderLog->data);
            return $this->view(
                'admin.pages.order_log.show',
                compact('orderLog','orderLogData','currentUser')
            );
        }catch (NotFoundException $e){
            App::abort(404);
        }
    }
} 