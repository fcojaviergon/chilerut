<?php
/**
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    Francisco González <fcojaviergonmi@gmail.com>
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class Chilerut extends Module
{
	protected $config_form = false;

	public function __construct()
	{
		$this->name = 'chilerut';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'Francisco Gonzalez';
		$this->need_instance = 1;

		/**
		 * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
		 */
		$this->bootstrap = true;

		parent::__construct();

		$this->displayName = $this->l('Chile Rut');
		$this->description = $this->l('Añade validaciones para el rut de chile');

		$this->confirmUninstall = $this->l('Seguro que desea quitar la validación?');
	}

	/**
	 * Don't forget to create update methods if needed:
	 * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
	 */
	public function install()
	{
          

		return parent::install() &&
			$this->registerHook('header') &&
			$this->registerHook('backOfficeHeader') &&
			$this->registerHook('displayCustomerAccountForm');
	}

	public function uninstall()
	{
		

		return parent::uninstall();
	}

	/**
	 * Load the configuration form
	 */
	public function getContent()
	{
		/**
		 * If values have been submitted in the form, process.
		 */
        if (((bool)Tools::isSubmit('submitChilerutModule')) == true)
        {
            $this->_postProcess();
        }

		$this->context->smarty->assign('module_dir', $this->_path);

		$output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');
                
		return $output;
	}

	/**
	 * Create the form that will be displayed in the configuration of your module.
	 */
	protected function renderForm()
	{
		
	}

	/**
	 * Create the structure of your form.
	 */
	protected function getConfigForm()
	{
		
	}

	/**
	 * Set values for the inputs.
	 */
	protected function getConfigFormValues()
	{
		
	}

	/**
	 * Save form data.
	 */
	protected function _postProcess()
	{
	
	}
        
	/**
	* Add the CSS & JavaScript files you want to be loaded in the BO.
	*/
	public function hookBackOfficeHeader()
	{
        if (Tools::getValue('module_name') == $this->name)
        {
            $this->context->controller->addJS($this->_path.'js/back.js');
            $this->context->controller->addCSS($this->_path.'css/back.css');
        }
	}

	/**
	 * Add the CSS & JavaScript files you want to be added on the FO.
	 */
	public function hookHeader()
	{
		$this->context->controller->addJS($this->_path.'js/jquery.Rut.js');
		$this->context->controller->addJS($this->_path.'js/front.js');
	}

	public function hookDisplayCustomerAccountForm()
	{
		
	}
}
