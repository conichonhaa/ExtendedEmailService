<?php

declare(strict_types=1);


use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\Services\EmailService;

// Create a modified version of EmailService
class MyEmailService extends EmailService {
    protected function transport(): Swift_Transport {
        $transport = parent::transport();
        $transport->setStreamOptions(array('ssl' => array('allow_self_signed' => true, 'verify_peer' => false)));

        return $transport;    }
}

// Create a custom module
class MyClass extends AbstractModule implements ModuleCustomInterface {
    use ModuleCustomTrait;

    public function boot(): void {
        app()->bind(EmailService::class, MyEmailService::class);
    }

    // The other module functions go here (name, title, description, author, version, etc.).
/**
     * How should this module be labelled on tabs, menus, etc.?
     *
     * @return string
     */
    public function title(): string
    {
        return 'EmailService disable';
    }
    
    /**
     * A sentence describing what this module does.
     *
     * @return string
     */
    public function description(): string
    {
        return 'This module disable EmailService SSL check';
    }
	
	public function customModuleAuthorName(): string
    {
        return 'Conichonhaa';
    }
}

// Create and return a module object.
return new MyClass();