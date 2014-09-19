<?php namespace SaleBoss\Services\Leads\Presenter;

interface PickerListenerInterface {

    public function onPickSuccess ($message);

    public function onPickFail ($messages);
}