<?php

declare(strict_types=1);

namespace Conichonhaa\Webtrees\Module\ExtendedEmailService;

use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\Services\EmailService;


	// extend EmailService class

class ExtendedEmailService extends EmailService implements ModuleCustomInterface {
	
	use ModuleCustomTrait;
    protected function transport(): Swift_Transport
    {
        $transport = parent::transport();
        $transport->setStreamOptions(array('ssl' => array('allow_self_signed' => true, 'verify_peer' => false)));

        return $transport;
    }
    
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
	
	public function boot(): void
	{
		app()->bind(EmailService::class, ExtendedEmailService::class);
	}	
	
};




