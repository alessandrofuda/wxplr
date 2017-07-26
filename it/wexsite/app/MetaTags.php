<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetaTags extends Model {
	use SoftDeletes;
	const PAGE_TYPE_HOME = 0;
	const PAGE_TYPE_HOW_IT_WORKS = 1;
	const PAGE_TYPE_PRICING = 2;
	const PAGE_TYPE_PARTNERS = 3;
  	const PAGE_TYPE_BLOG = 4;
	const PAGE_TYPE_ABOUT = 5;
	const PAGE_TYPE_LOGIN = 6;
	const PAGE_TYPE_SERVICE = 7;
	const PAGE_TYPE_CONTACT_US = 8;
	const PAGE_TYPE_PRIVACY_POLICY = 9;
	const PAGE_TYPE_TERMS_SERVICE = 10;
	const PAGE_TYPE_COOKIES_POLICY = 11;
	const PAGE_TYPE_CODE_ETHICS = 12;
	const PAGE_TYPE_HOME_IT = 13;
	const PAGE_TYPE_CHI_SIAMO = 14;
	const PAGE_TYPE_SERVIZI = 15;
	const PAGE_TYPE_CONTATTI = 16;
	const PAGE_TYPE_INFORMATIVA_PRIVACY = 17;
	const PAGE_TYPE_CONDIZIONI_VENDITA = 18;
	const PAGE_TYPE_COOKIE_POLICY = 19;
	const PAGE_TYPE_CODICE_ETICO = 20;
	const PAGE_TYPE_SERVICESB = 21;
	const PAGE_TYPE_GLOBAL_ORIENTATION = 22;
	const PAGE_TYPE_PROFESSIONAL_KIT = 23;
	const PAGE_TYPE_GLOBAL_TOOLBOX = 24;
	const PAGE_TYPE_SKILLS_DEVELOPMENT = 25;

	const PAGE_TYPE_GLOBAL_ORIENTATION_IT = 26;
	const PAGE_TYPE_PROFESSIONAL_KIT_IT = 27;
	const PAGE_TYPE_GLOBAL_TOOLBOX_IT = 28;
	const PAGE_TYPE_SKILLS_DEVELOPMENT_IT = 29;
	const PAGE_TYPE_PARTNERS_IT = 30;

	const PAGE_TYPE_AIESEC = 31;
	const PAGE_TYPE_AIESEC_IT = 32;

	const PAGE_TYPE_FAQ = 33;
	const PAGE_TYPE_FAQ_IT = 34;

   public static function getPageTypeOptions($id = null) {
		$list = [
			MetaTags::PAGE_TYPE_HOME => 'Home Page',
			MetaTags::PAGE_TYPE_HOW_IT_WORKS => 'How it works',
			MetaTags::PAGE_TYPE_PRICING => 'Pricing',
			MetaTags::PAGE_TYPE_PARTNERS => 'Partners',
			MetaTags::PAGE_TYPE_BLOG => 'Blog',
			MetaTags::PAGE_TYPE_ABOUT => 'About',
			MetaTags::PAGE_TYPE_PRIVACY_POLICY => 'Privacy Policy',
			MetaTags::PAGE_TYPE_TERMS_SERVICE => 'Terms of service',
			MetaTags::PAGE_TYPE_COOKIES_POLICY => 'Cookies Policy',
			MetaTags::PAGE_TYPE_CODE_ETHICS => 'Code of ethics',
			MetaTags::PAGE_TYPE_LOGIN => 'Login Pages',
        	MetaTags::PAGE_TYPE_SERVICE => 'service',
        	MetaTags::PAGE_TYPE_CONTACT_US => 'contact_us',
        	MetaTags::PAGE_TYPE_HOME_IT => 'Home IT',
        	MetaTags::PAGE_TYPE_CHI_SIAMO => 'Chi siamo',
			MetaTags::PAGE_TYPE_INFORMATIVA_PRIVACY => 'Informativa Privacy',
			MetaTags::PAGE_TYPE_CONDIZIONI_VENDITA => 'Condizioni di vendita',
			MetaTags::PAGE_TYPE_COOKIE_POLICY => 'Cookie Policy',
			MetaTags::PAGE_TYPE_CODICE_ETICO => 'Codice etico',
			MetaTags::PAGE_TYPE_SERVIZI => 'servizi',
			MetaTags::PAGE_TYPE_CONTATTI => 'contatti',
			MetaTags::PAGE_TYPE_SERVICESB => 'Services b',
			MetaTags::PAGE_TYPE_GLOBAL_ORIENTATION => 'global orientation test',
			MetaTags::PAGE_TYPE_PROFESSIONAL_KIT => 'professional kit',
			MetaTags::PAGE_TYPE_GLOBAL_TOOLBOX => 'global toolbox	',
			MetaTags::PAGE_TYPE_SKILLS_DEVELOPMENT => 'skills development',

			MetaTags::PAGE_TYPE_GLOBAL_ORIENTATION_IT => 'global orientation test IT',
			MetaTags::PAGE_TYPE_PROFESSIONAL_KIT_IT => 'professional kit IT',
			MetaTags::PAGE_TYPE_GLOBAL_TOOLBOX_IT => 'global toolbox	IT',
			MetaTags::PAGE_TYPE_SKILLS_DEVELOPMENT_IT => 'skills development IT',
			MetaTags::PAGE_TYPE_PARTNERS_IT => 'Partners IT',

			MetaTags::PAGE_TYPE_AIESEC => 'AIESEC',
			MetaTags::PAGE_TYPE_AIESEC_IT => 'AIESEC IT',

			MetaTags::PAGE_TYPE_FAQ => 'FAQ',
			MetaTags::PAGE_TYPE_FAQ_IT => 'FAQ IT',
		];
		if($id === null)
      	return $list;
		if(is_numeric($id))
      	return $list[$id];
		return $id;
	}

    protected $fillable = [
        'deleted_at','name','content', 'page_type', 'title', 'meta_title', 'meta_description'
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'meta_tags';
}
