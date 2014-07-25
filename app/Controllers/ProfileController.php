<?php namespace Controllers;


class ProfileController extends BaseController{
    protected $userRepo;

    public function __construct(
        UserRepositoryInterface $userRepo
    ){
        $this->userRepo = $userRepo;
    }

    public function edit()
    {
        //return $this->
    }
}