<?php

use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('refresh_captcha', 'HomeController@refreshCaptcha')->name('refresh_captcha');

Route::post('checklogin', 'Auth\LoginController@checklogin')->name('checklogin');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['middleware' => ['auth','App\Http\Middleware\Admin']], function()
{
	Route::get('/admin', 'AdminController@adminhome')->name('adminhome')->middleware('auth');

	/*User type*/
	Route::get('/admin/usertypelist', 'AdminController@usertypelist')->name('admin.usertypelist')->middleware('auth');
	Route::post('/admin/usertypestore','AdminController@usertypestore')->name('admin.usertypestore')->middleware('auth');
	Route::get('/admin/usertypeedit/{id}', 'AdminController@usertypeedit')->middleware('auth');
	Route::post('/admin/usertypeupdate', 'AdminController@usertypeupdate')->name('admin.usertypeupdate')->middleware('auth');
	Route::get('/admin/usertypedestroy/{id}', 'AdminController@usertypedestroy')->middleware('auth');
	Route::get('/admin/usertypestatus/{id}', 'AdminController@usertypestatus')->middleware('auth');

	/*component*/

	Route::get('/admin/componentlist', 'AdminController@componentlist')->name('admin.componentlist')->middleware('auth');
	Route::post('/admin/componentstore','AdminController@componentstore')->name('admin.componentstore')->middleware('auth');
	Route::get('/admin/componentedit/{id}', 'AdminController@componentedit')->name('admin.componentedit')->middleware('auth');
	Route::post('/admin/componentupdate', 'AdminController@componentupdate')->name('admin.componentupdate')->middleware('auth');
	Route::get('/admin/componentdestroy/{id}', 'AdminController@componentdestroy')->middleware('auth');
	Route::get('/admin/componentstatus/{id}', 'AdminController@componentstatus')->middleware('auth');

	/*component permission*/

	Route::get('/admin/componentpermissionlist', 'AdminController@componentpermissionlist')->name('admin.componentpermissionlist')->middleware('auth');
	Route::get('admin/permissioncreate','AdminController@permissioncreate')->name('admin.permissioncreate')->middleware('auth');
	Route::post('/admin/componentpermissionstore','AdminController@componentpermissionstore')->name('admin.componentpermissionstore')->middleware('auth');
	Route::get('/admin/componentpermissionedit/{id}', 'AdminController@componentpermissionedit')->name('admin.componentpermissionedit')->middleware('auth');
	Route::post('/admin/componentpermissionupdate', 'AdminController@componentpermissionupdate')->name('admin.componentpermissionupdate')->middleware('auth');
	Route::get('/admin/componentpermissiondestroy/{id}', 'AdminController@componentpermissiondestroy')->middleware('auth');
	Route::get('/admin/componentpermissionstatus/{id}', 'AdminController@componentpermissionstatus')->middleware('auth');

	/*  Menulinktype  */

	Route::get('/admin/menulinktypelist', 'AdminController@menulinktypelist')->name('admin.menulinktypelist')->middleware('auth');
	Route::post('/admin/menulinktypestore','AdminController@menulinktypestore')->name('admin.menulinktypestore')->middleware('auth');
	Route::get('/admin/menulinktypeedit/{id}', 'AdminController@menulinktypeedit')->middleware('auth');
	Route::post('/admin/menulinktypeupdate', 'AdminController@menulinktypeupdate')->name('admin.menulinktypeupdate')->middleware('auth');
	Route::get('/admin/menulinktypedestroy/{id}', 'AdminController@menulinktypedestroy')->middleware('auth');
	Route::get('/admin/menulinktypestatus/{id}', 'AdminController@menulinktypestatus')->middleware('auth');

	/*Contenttypes*/
	Route::get('/admin/contenttypelist', 'AdminController@contenttypelist')->name('admin.contenttypelist')->middleware('auth');
	Route::post('/admin/contenttypestore','AdminController@contenttypestore')->name('admin.contenttypestore')->middleware('auth');
	Route::get('/admin/contenttypeedit/{id}', 'AdminController@contenttypeedit')->middleware('auth');
	Route::post('/admin/contenttypeupdate', 'AdminController@contenttypeupdate')->name('admin.contenttypeupdate')->middleware('auth');
	Route::get('/admin/contenttypedestroy/{id}', 'AdminController@contenttypedestroy')->middleware('auth');
	Route::get('/admin/contenttypestatus/{id}', 'AdminController@contenttypestatus')->middleware('auth');

	/*Filetypes*/
	Route::get('/admin/filetypelist', 'AdminController@filetypelist')->name('admin.filetypelist')->middleware('auth');
	Route::get('admin/filetypecreate','AdminController@filetypecreate')->name('admin.filetypecreate')->middleware('auth');
	Route::post('/admin/filetypestore','AdminController@filetypestore')->name('admin.filetypestore')->middleware('auth');
	Route::get('/admin/filetypeedit/{id}', 'AdminController@filetypeedit')->middleware('auth');
	Route::post('/admin/filetypeupdate', 'AdminController@filetypeupdate')->name('admin.filetypeupdate')->middleware('auth');
	Route::get('/admin/filetypedestroy/{id}', 'AdminController@filetypedestroy')->middleware('auth');
	Route::get('/admin/filetypestatus/{id}', 'AdminController@filetypestatus')->middleware('auth');

	/*Communication type*/

	Route::get('/admin/communicationtypelist', 'AdminController@communicationtypelist')->name('admin.communicationtypelist')->middleware('auth');
	Route::post('/admin/communicationtypestore','AdminController@communicationtypestore')->name('admin.communicationtypestore')->middleware('auth');
	Route::get('/admin/communicationtypeedit/{id}', 'AdminController@communicationtypeedit')->middleware('auth');
	Route::post('/admin/communicationtypeupdate', 'AdminController@communicationtypeupdate')->name('admin.communicationtypeupdate')->middleware('auth');
	Route::get('/admin/communicationtypedestroy/{id}', 'AdminController@communicationtypedestroy')->middleware('auth');
	Route::get('/admin/communicationtypestatus/{id}', 'AdminController@communicationtypestatus')->middleware('auth');

	/*User */
	Route::get('/admin/userlist', 'AdminController@userlist')->name('admin.userlist')->middleware('auth');
	Route::get('admin/usercreate','AdminController@usercreate')->name('admin.usercreate')->middleware('auth');
	Route::post('/admin/userstore','AdminController@userstore')->name('admin.userstore')->middleware('auth');
	Route::get('/admin/useredit/{id}', 'AdminController@useredit')->middleware('auth');
	Route::post('/admin/userupdate', 'AdminController@userupdate')->name('admin.userupdate')->middleware('auth');
	Route::get('/admin/userdestroy/{id}', 'AdminController@userdestroy')->middleware('auth');
	Route::get('/admin/userstatus/{id}', 'AdminController@userstatus')->middleware('auth');


	/*Site Settings*/
	Route::get('/admin/sitesettinglist', 'AdminController@sitesettinglist')->name('admin.sitesettinglist')->middleware('auth');
	Route::post('/admin/sitesettingstore','AdminController@sitesettingstore')->name('admin.sitesettingstore')->middleware('auth');
	Route::get('/admin/sitesettingedit/{id}', 'AdminController@sitesettingedit')->middleware('auth');
	Route::post('/admin/sitesettingupdate', 'AdminController@sitesettingupdate')->name('admin.sitesettingupdate')->middleware('auth');
	Route::get('/admin/sitesettingdestroy/{id}', 'AdminController@sitesettingdestroy')->middleware('auth');
	Route::get('/admin/sitesettingstatus/{id}', 'AdminController@sitesettingstatus')->middleware('auth');

	/*  Language */
	Route::get('/admin/languagelist', 'AdminController@languagelist')->name('admin.languagelist')->middleware('auth');
	Route::post('/admin/languagestore','AdminController@languagestore')->name('admin.languagestore')->middleware('auth');
	Route::get('/admin/languageedit/{id}', 'AdminController@languageedit')->middleware('auth');
	Route::post('/admin/languageupdate', 'AdminController@languageupdate')->name('admin.languageupdate')->middleware('auth');
	Route::get('/admin/languagedestroy/{id}', 'AdminController@languagedestroy')->middleware('auth');
	Route::get('/admin/languagestatus/{id}', 'AdminController@languagestatus')->middleware('auth');


	/*Site Control Label */
	Route::get('/admin/sitecontrollabellist', 'AdminController@sitecontrollabellist')->name('admin.sitecontrollabellist')->middleware('auth');
	Route::post('/admin/sitecontrollabelstore','AdminController@sitecontrollabelstore')->name('admin.sitecontrollabelstore')->middleware('auth');
	Route::get('/admin/sitecontrollabeledit/{id}', 'AdminController@sitecontrollabeledit')->middleware('auth');
	Route::post('/admin/sitecontrollabelupdate', 'AdminController@sitecontrollabelupdate')->name('admin.sitecontrollabelupdate')->middleware('auth');
	Route::get('/admin/sitecontrollabeldestroy/{id}', 'AdminController@sitecontrollabeldestroy')->middleware('auth');
	Route::get('/admin/sitecontrollabelstatus/{id}', 'AdminController@sitecontrollabelstatus')->middleware('auth');


	/*Dept Category*/
	Route::get('/admin/deptcategorylist', 'AdminController@deptcategorylist')->name('admin.deptcategorylist')->middleware('auth');
	Route::post('/admin/deptcategorystore','AdminController@deptcategorystore')->name('admin.deptcategorystore')->middleware('auth');
	Route::get('/admin/deptcategoryedit/{id}', 'AdminController@deptcategoryedit')->middleware('auth');
	Route::post('/admin/deptcategoryupdate', 'AdminController@deptcategoryupdate')->name('admin.deptcategoryupdate')->middleware('auth');
	Route::get('/admin/deptcategorydestroy/{id}', 'AdminController@deptcategorydestroy')->middleware('auth');
	Route::get('/admin/deptcategorystatus/{id}', 'AdminController@deptcategorystatus')->middleware('auth');

	/*Change password*/
	Route::get('/admin/changepasswordview', 'AdminController@changepasswordview')->name('admin.changepasswordview')->middleware('auth');
	Route::post('/admin/checkoldpassword', 'AdminController@checkoldpassword')->name('admin.checkoldpassword')->middleware('auth');
	Route::post('/admin/changepasswordaction', 'AdminController@changepasswordaction')->name('admin.changepasswordaction')->middleware('auth');

	/*Reset Password*/
Route::get('/admin/resetpasswordview', 'AdminController@resetpasswordview')->name('admin.resetpasswordview')->middleware('auth');
Route::post('/admin/resetpasswordaction', 'AdminController@resetpasswordaction')->name('admin.resetpasswordaction')->middleware('auth');

});

/*  Site Admin  */

Route::group(['middleware' => ['auth','App\Http\Middleware\SiteAdmin']], function()
{

	Route::get('/siteadmin', 'SiteadminController@siteadminhome')->name('siteadminhome')->middleware('auth');

	/*  Language */
	Route::get('/siteadmin/articlecategorylist', 'SiteadminController@articlecategorylist')->name('siteadmin.articlecategorylist')->middleware('auth');
	Route::post('/siteadmin/articlecategorystore','SiteadminController@articlecategorystore')->name('siteadmin.articlecategorystore')->middleware('auth');
	Route::get('/siteadmin/articlecategoryedit/{id}', 'SiteadminController@articlecategoryedit')->middleware('auth');
	Route::post('/siteadmin/articlecategoryupdate', 'SiteadminController@articlecategoryupdate')->name('siteadmin.articlecategoryupdate')->middleware('auth');
	Route::get('/siteadmin/articlecategorydestroy/{id}', 'SiteadminController@articlecategorydestroy')->middleware('auth');
	Route::get('/siteadmin/articlecategorystatus/{id}', 'SiteadminController@articlecategorystatus')->middleware('auth');

/*  Activity Type */
	Route::get('/siteadmin/activitytypelist', 'SiteadminController@activitytypelist')->name('siteadmin.activitytypelist')->middleware('auth');
	Route::post('/siteadmin/activitytypestore','SiteadminController@activitytypestore')->name('siteadmin.activitytypestore')->middleware('auth');
	Route::get('/siteadmin/activitytypeedit/{id}', 'SiteadminController@activitytypeedit')->middleware('auth');
	Route::post('/siteadmin/activitytypeupdate', 'SiteadminController@activitytypeupdate')->name('siteadmin.activitytypeupdate')->middleware('auth');
	Route::get('/siteadmin/activitytypedestroy/{id}', 'SiteadminController@activitytypedestroy')->middleware('auth');
	Route::get('/siteadmin/activitytypestatus/{id}', 'SiteadminController@activitytypestatus')->middleware('auth');

	/*  Header Button */
	Route::get('/siteadmin/headerbuttonlist', 'SiteadminController@headerbuttonlist')->name('siteadmin.headerbuttonlist')->middleware('auth');
	Route::get('siteadmin/buttoncreate','SiteadminController@buttoncreate')->name('siteadmin.buttoncreate')->middleware('auth');
	Route::post('/siteadmin/headerbuttonstore','SiteadminController@headerbuttonstore')->name('siteadmin.headerbuttonstore')->middleware('auth');
	Route::get('/siteadmin/headerbuttonedit/{id}', 'SiteadminController@headerbuttonedit')->middleware('auth');
	Route::post('/siteadmin/headerbuttonupdate', 'SiteadminController@headerbuttonupdate')->name('siteadmin.headerbuttonupdate')->middleware('auth');
	Route::get('/siteadmin/headerbuttondestroy/{id}', 'SiteadminController@headerbuttondestroy')->middleware('auth');
	Route::get('/siteadmin/headerbuttonstatus/{id}', 'SiteadminController@headerbuttonstatus')->middleware('auth');


	/*   Button */
	Route::get('/siteadmin/buttonlist', 'SiteadminController@buttonlist')->name('siteadmin.buttonlist')->middleware('auth');
	Route::get('siteadmin/btncreate','SiteadminController@btncreate')->name('siteadmin.btncreate')->middleware('auth');
	Route::post('/siteadmin/buttonstore','SiteadminController@buttonstore')->name('siteadmin.buttonstore')->middleware('auth');
	Route::get('/siteadmin/buttonedit/{id}', 'SiteadminController@buttonedit')->middleware('auth');
	Route::post('/siteadmin/buttonupdate', 'SiteadminController@buttonupdate')->name('siteadmin.buttonupdate')->middleware('auth');
	Route::get('/siteadmin/buttondestroy/{id}', 'SiteadminController@buttondestroy')->middleware('auth');
	Route::get('/siteadmin/buttonstatus/{id}', 'SiteadminController@buttonstatus')->middleware('auth');


	/* Logo */
	Route::get('/siteadmin/logolist', 'SiteadminController@logolist')->name('siteadmin.logolist')->middleware('auth');
	Route::post('/siteadmin/logostore','SiteadminController@logostore')->name('siteadmin.logostore')->middleware('auth');
	Route::get('/siteadmin/logoedit/{id}', 'SiteadminController@logoedit')->middleware('auth');
	Route::post('/siteadmin/logoupdate', 'SiteadminController@logoupdate')->name('siteadmin.logoupdate')->middleware('auth');
	Route::get('/siteadmin/logodestroy/{id}', 'SiteadminController@logodestroy')->middleware('auth');
	Route::get('/siteadmin/logostatus/{id}', 'SiteadminController@logostatus')->middleware('auth');

	/* Title */
	Route::get('/siteadmin/titlelist', 'SiteadminController@titlelist')->name('siteadmin.titlelist')->middleware('auth');
	Route::post('/siteadmin/titlestore','SiteadminController@titlestore')->name('siteadmin.titlestore')->middleware('auth');
	Route::get('/siteadmin/titleedit/{id}', 'SiteadminController@titleedit')->middleware('auth');
	Route::post('/siteadmin/titleupdate', 'SiteadminController@titleupdate')->name('siteadmin.titleupdate')->middleware('auth');
	Route::get('/siteadmin/titledestroy/{id}', 'SiteadminController@titledestroy')->middleware('auth');
	Route::get('/siteadmin/titlestatus/{id}', 'SiteadminController@titlestatus')->middleware('auth');


	/* Footer */
	Route::get('/siteadmin/footerlist', 'SiteadminController@footerlist')->name('siteadmin.footerlist')->middleware('auth');
	Route::post('/siteadmin/footerstore','SiteadminController@footerstore')->name('siteadmin.footerstore')->middleware('auth');
	Route::get('/siteadmin/footeredit/{id}', 'SiteadminController@footeredit')->middleware('auth');
	Route::post('/siteadmin/footerupdate', 'SiteadminController@footerupdate')->name('siteadmin.footerupdate')->middleware('auth');
	Route::get('/siteadmin/footerdestroy/{id}', 'SiteadminController@footerdestroy')->middleware('auth');
	Route::get('/siteadmin/footerstatus/{id}', 'SiteadminController@footerstatus')->middleware('auth');



	/* Footer Menu */
	Route::get('/siteadmin/footermenulist', 'SiteadminController@footermenulist')->name('siteadmin.footermenulist')->middleware('auth');
	Route::post('/siteadmin/footermenustore','SiteadminController@footermenustore')->name('siteadmin.footermenustore')->middleware('auth');
	Route::get('/siteadmin/footermenuedit/{id}', 'SiteadminController@footermenuedit')->middleware('auth');
	Route::post('/siteadmin/footermenuupdate', 'SiteadminController@footermenuupdate')->name('siteadmin.footermenuupdate')->middleware('auth');
	Route::get('/siteadmin/footermenudestroy/{id}', 'SiteadminController@footermenudestroy')->middleware('auth');
	Route::get('/siteadmin/footermenustatus/{id}', 'SiteadminController@footermenustatus')->middleware('auth');

	/* Footer Link */
	Route::get('/siteadmin/footerlinklist', 'SiteadminController@footerlinklist')->name('siteadmin.footerlinklist')->middleware('auth');
	Route::post('/siteadmin/footerlinkstore','SiteadminController@footerlinkstore')->name('siteadmin.footerlinkstore')->middleware('auth');
	Route::get('/siteadmin/footerlinkedit/{id}', 'SiteadminController@footerlinkedit')->middleware('auth');
	Route::post('/siteadmin/footerlinkupdate', 'SiteadminController@footerlinkupdate')->name('siteadmin.footerlinkupdate')->middleware('auth');
	Route::get('/siteadmin/footerlinkdestroy/{id}', 'SiteadminController@footerlinkdestroy')->middleware('auth');
	Route::get('/siteadmin/footerlinkstatus/{id}', 'SiteadminController@footerlinkstatus')->middleware('auth');

	/* Social Media */
	Route::get('/siteadmin/socialmedialist', 'SiteadminController@socialmedialist')->name('siteadmin.socialmedialist')->middleware('auth');
	Route::post('/siteadmin/socialmediastore','SiteadminController@socialmediastore')->name('siteadmin.socialmediastore')->middleware('auth');
	Route::get('/siteadmin/socialmediaedit/{id}', 'SiteadminController@socialmediaedit')->middleware('auth');
	Route::post('/siteadmin/socialmediaupdate', 'SiteadminController@socialmediaupdate')->name('siteadmin.socialmediaupdate')->middleware('auth');
	Route::get('/siteadmin/socialmediadestroy/{id}', 'SiteadminController@socialmediadestroy')->middleware('auth');
	Route::get('/siteadmin/socialmediastatus/{id}', 'SiteadminController@socialmediastatus')->middleware('auth');

	
	/* Main Menu */
	Route::get('/siteadmin/mainmenulist', 'SiteadminController@mainmenulist')->name('siteadmin.mainmenulist')->middleware('auth');
	Route::get('siteadmin/mainmenucreate','SiteadminController@mainmenucreate')->name('siteadmin.mainmenucreate')->middleware('auth');
	Route::post('/siteadmin/mainmenustore','SiteadminController@mainmenustore')->name('siteadmin.mainmenustore')->middleware('auth');
	Route::get('/siteadmin/mainmenuedit/{id}', 'SiteadminController@mainmenuedit')->middleware('auth');
	Route::post('/siteadmin/mainmenuupdate', 'SiteadminController@mainmenuupdate')->name('siteadmin.mainmenuupdate')->middleware('auth');
	Route::get('/siteadmin/mainmenudestroy/{id}', 'SiteadminController@mainmenudestroy')->middleware('auth');
	Route::get('/siteadmin/mainmenustatus/{id}', 'SiteadminController@mainmenustatus')->middleware('auth');


	/* Sub Menu */
	Route::get('/siteadmin/submenulist', 'SiteadminController@submenulist')->name('siteadmin.submenulist')->middleware('auth');
	Route::get('siteadmin/submenucreate','SiteadminController@submenucreate')->name('siteadmin.submenucreate')->middleware('auth');
	Route::post('/siteadmin/submenustore','SiteadminController@submenustore')->name('siteadmin.submenustore')->middleware('auth');
	Route::get('/siteadmin/submenuedit/{id}', 'SiteadminController@submenuedit')->middleware('auth');
	Route::post('/siteadmin/submenuupdate', 'SiteadminController@submenuupdate')->name('siteadmin.submenuupdate')->middleware('auth');
	Route::get('/siteadmin/submenudestroy/{id}', 'SiteadminController@submenudestroy')->middleware('auth');
	Route::get('/siteadmin/submenustatus/{id}', 'SiteadminController@submenustatus')->middleware('auth');


	/* What's News */
	Route::get('/siteadmin/whatisnewlist', 'SiteadminController@whatisnewlist')->name('siteadmin.whatisnewlist')->middleware('auth');
	
	Route::post('/siteadmin/whatisnewstore','SiteadminController@whatisnewstore')->name('siteadmin.whatisnewstore')->middleware('auth');
	Route::get('/siteadmin/whatisnewedit/{id}', 'SiteadminController@whatisnewedit')->middleware('auth');
	Route::post('/siteadmin/whatisnewupdate', 'SiteadminController@whatisnewupdate')->name('siteadmin.whatisnewupdate')->middleware('auth');
	Route::get('/siteadmin/whatisnewdestroy/{id}', 'SiteadminController@whatisnewdestroy')->middleware('auth');
	Route::get('/siteadmin/whatisnewstatus/{id}', 'SiteadminController@whatisnewstatus')->middleware('auth');

	/* About Department */
	Route::get('/siteadmin/aboutdepartmentlist', 'SiteadminController@aboutdepartmentlist')->name('siteadmin.aboutdepartmentlist')->middleware('auth');
	Route::post('/siteadmin/aboutdepartmentstore','SiteadminController@aboutdepartmentstore')->name('siteadmin.aboutdepartmentstore')->middleware('auth');
	Route::get('/siteadmin/aboutdepartmentedit/{id}', 'SiteadminController@aboutdepartmentedit')->middleware('auth');
	Route::post('/siteadmin/aboutdepartmentupdate', 'SiteadminController@aboutdepartmentupdate')->name('siteadmin.aboutdepartmentupdate')->middleware('auth');
	Route::get('/siteadmin/aboutdepartmentdestroy/{id}', 'SiteadminController@aboutdepartmentdestroy')->middleware('auth');
	Route::get('/siteadmin/aboutdepartmentstatus/{id}', 'SiteadminController@aboutdepartmentstatus')->middleware('auth');


	/* About Portal */
	Route::get('/siteadmin/aboutportallist', 'SiteadminController@aboutportallist')->name('siteadmin.aboutportallist')->middleware('auth');
	Route::post('/siteadmin/aboutportalstore','SiteadminController@aboutportalstore')->name('siteadmin.aboutportalstore')->middleware('auth');
	Route::get('/siteadmin/aboutportaledit/{id}', 'SiteadminController@aboutportaledit')->middleware('auth');
	Route::post('/siteadmin/aboutportalupdate', 'SiteadminController@aboutportalupdate')->name('siteadmin.aboutportalupdate')->middleware('auth');
	Route::get('/siteadmin/aboutportaldestroy/{id}', 'SiteadminController@aboutportaldestroy')->middleware('auth');
	Route::get('/siteadmin/aboutportalstatus/{id}', 'SiteadminController@aboutportalstatus')->middleware('auth');


	/* Contact us */
	Route::get('/siteadmin/contactuslist', 'SiteadminController@contactuslist')->name('siteadmin.contactuslist')->middleware('auth');
	Route::post('/siteadmin/contactusstore','SiteadminController@contactusstore')->name('siteadmin.contactusstore')->middleware('auth');
	Route::get('/siteadmin/contactusedit/{id}', 'SiteadminController@contactusedit')->middleware('auth');
	Route::post('/siteadmin/contactusupdate', 'SiteadminController@contactusupdate')->name('siteadmin.contactusupdate')->middleware('auth');
	Route::get('/siteadmin/contactusdestroy/{id}', 'SiteadminController@contactusdestroy')->middleware('auth');
	Route::get('/siteadmin/contactusstatus/{id}', 'SiteadminController@contactusstatus')->middleware('auth');


	/* Archive policy */
	Route::get('/siteadmin/archivepolicylist', 'SiteadminController@archivepolicylist')->name('siteadmin.archivepolicylist')->middleware('auth');
	Route::post('/siteadmin/archivepolicystore','SiteadminController@archivepolicystore')->name('siteadmin.archivepolicystore')->middleware('auth');
	Route::get('/siteadmin/archivepolicyedit/{id}', 'SiteadminController@archivepolicyedit')->middleware('auth');
	Route::post('/siteadmin/archivepolicyupdate', 'SiteadminController@archivepolicyupdate')->name('siteadmin.archivepolicyupdate')->middleware('auth');
	Route::get('/siteadmin/archivepolicydestroy/{id}', 'SiteadminController@archivepolicydestroy')->middleware('auth');
	Route::get('/siteadmin/archivepolicystatus/{id}', 'SiteadminController@archivepolicystatus')->middleware('auth');

	/* Support centers */
	Route::get('/siteadmin/supportcenterlist', 'SiteadminController@supportcenterlist')->name('siteadmin.supportcenterlist')->middleware('auth');
	Route::post('/siteadmin/supportcenterstore','SiteadminController@supportcenterstore')->name('siteadmin.supportcenterstore')->middleware('auth');
	Route::get('/siteadmin/supportcenteredit/{id}', 'SiteadminController@supportcenteredit')->middleware('auth');
	Route::post('/siteadmin/supportcenterupdate', 'SiteadminController@supportcenterupdate')->name('siteadmin.supportcenterupdate')->middleware('auth');
	Route::get('/siteadmin/supportcenterdestroy/{id}', 'SiteadminController@supportcenterdestroy')->middleware('auth');
	Route::get('/siteadmin/supportcenterstatus/{id}', 'SiteadminController@supportcenterstatus')->middleware('auth');

	/*Help*/

	Route::get('/siteadmin/helplist', 'SiteadminController@helplist')->name('siteadmin.helplist')->middleware('auth');
	Route::post('/siteadmin/helpstore','SiteadminController@helpstore')->name('siteadmin.helpstore')->middleware('auth');
	Route::get('/siteadmin/helpedit/{id}', 'SiteadminController@helpedit')->middleware('auth');
	Route::post('/siteadmin/helpupdate', 'SiteadminController@helpupdate')->name('siteadmin.helpupdate')->middleware('auth');
	Route::get('/siteadmin/helpdestroy/{id}', 'SiteadminController@helpdestroy')->middleware('auth');
	Route::get('/siteadmin/helpstatus/{id}', 'SiteadminController@helpstatus')->middleware('auth');
	
	/*  Guidelines  */

	Route::get('/siteadmin/guidelinelist', 'SiteadminController@guidelinelist')->name('siteadmin.guidelinelist')->middleware('auth');
	Route::post('/siteadmin/guidelinestore','SiteadminController@guidelinestore')->name('siteadmin.guidelinestore')->middleware('auth');
	Route::get('/siteadmin/guidelineedit/{id}', 'SiteadminController@guidelineedit')->middleware('auth');
	Route::post('/siteadmin/guidelineupdate', 'SiteadminController@guidelineupdate')->name('siteadmin.guidelineupdate')->middleware('auth');
	Route::get('/siteadmin/guidelinedestroy/{id}', 'SiteadminController@guidelinedestroy')->middleware('auth');
	Route::get('/siteadmin/guidelinestatus/{id}', 'SiteadminController@guidelinestatus')->middleware('auth');
	
	/*   Service Info  */

	Route::get('/siteadmin/serviceinfolist', 'SiteadminController@serviceinfolist')->name('siteadmin.serviceinfolist')->middleware('auth');
	Route::post('/siteadmin/serviceinfostore','SiteadminController@serviceinfostore')->name('siteadmin.serviceinfostore')->middleware('auth');
	Route::get('/siteadmin/serviceinfoedit/{id}', 'SiteadminController@serviceinfoedit')->middleware('auth');
	Route::post('/siteadmin/serviceinfoupdate', 'SiteadminController@serviceinfoupdate')->name('siteadmin.serviceinfoupdate')->middleware('auth');
	Route::get('/siteadmin/serviceinfodestroy/{id}', 'SiteadminController@serviceinfodestroy')->middleware('auth');
	Route::get('/siteadmin/serviceinfostatus/{id}', 'SiteadminController@serviceinfostatus')->middleware('auth');


	/*   Address with Map  */

	Route::get('/siteadmin/addresswithmaplist', 'SiteadminController@addresswithmaplist')->name('siteadmin.addresswithmaplist')->middleware('auth');
	Route::post('/siteadmin/addresswithmapstore','SiteadminController@addresswithmapstore')->name('siteadmin.addresswithmapstore')->middleware('auth');
	Route::get('/siteadmin/addresswithmapedit/{id}', 'SiteadminController@addresswithmapedit')->middleware('auth');
	Route::post('/siteadmin/addresswithmapupdate', 'SiteadminController@addresswithmapupdate')->name('siteadmin.addresswithmapupdate')->middleware('auth');
	Route::get('/siteadmin/addresswithmapdestroy/{id}', 'SiteadminController@addresswithmapdestroy')->middleware('auth');
	Route::get('/siteadmin/addresswithmapstatus/{id}', 'SiteadminController@addresswithmapstatus')->middleware('auth');

	

	/*   Site compatibility info  */

	Route::get('/siteadmin/sitecompinfolist', 'SiteadminController@sitecompinfolist')->name('siteadmin.sitecompinfolist')->middleware('auth');
	Route::post('/siteadmin/sitecompinfostore','SiteadminController@sitecompinfostore')->name('siteadmin.sitecompinfostore')->middleware('auth');
	Route::get('/siteadmin/sitecompinfoedit/{id}', 'SiteadminController@sitecompinfoedit')->middleware('auth');
	Route::post('/siteadmin/sitecompinfoupdate', 'SiteadminController@sitecompinfoupdate')->name('siteadmin.sitecompinfoupdate')->middleware('auth');
	Route::get('/siteadmin/sitecompinfodestroy/{id}', 'SiteadminController@sitecompinfodestroy')->middleware('auth');
	Route::get('/siteadmin/sitecompinfostatus/{id}', 'SiteadminController@sitecompinfostatus')->middleware('auth');

	/*   Digital info  */

	Route::get('/siteadmin/digitalinfolist', 'SiteadminController@digitalinfolist')->name('siteadmin.digitalinfolist')->middleware('auth');
	Route::post('/siteadmin/digitalinfostore','SiteadminController@digitalinfostore')->name('siteadmin.digitalinfostore')->middleware('auth');
	Route::get('/siteadmin/digitalinfoedit/{id}', 'SiteadminController@digitalinfoedit')->middleware('auth');
	Route::post('/siteadmin/digitalinfoupdate', 'SiteadminController@digitalinfoupdate')->name('siteadmin.digitalinfoupdate')->middleware('auth');
	Route::get('/siteadmin/digitalinfodestroy/{id}', 'SiteadminController@digitalinfodestroy')->middleware('auth');
	Route::get('/siteadmin/digitalinfostatus/{id}', 'SiteadminController@digitalinfostatus')->middleware('auth');


	

	/*   Copyright policy */

	Route::get('/siteadmin/copyrightpolicylist', 'SiteadminController@copyrightpolicylist')->name('siteadmin.copyrightpolicylist')->middleware('auth');
	Route::post('/siteadmin/copyrightpolicystore','SiteadminController@copyrightpolicystore')->name('siteadmin.copyrightpolicystore')->middleware('auth');
	Route::get('/siteadmin/copyrightpolicyedit/{id}', 'SiteadminController@copyrightpolicyedit')->middleware('auth');
	Route::post('/siteadmin/copyrightpolicyupdate', 'SiteadminController@copyrightpolicyupdate')->name('siteadmin.copyrightpolicyupdate')->middleware('auth');
	Route::get('/siteadmin/copyrightpolicydestroy/{id}', 'SiteadminController@copyrightpolicydestroy')->middleware('auth');
	Route::get('/siteadmin/copyrightpolicystatus/{id}', 'SiteadminController@copyrightpolicystatus')->middleware('auth');


	/*   Hyperlink  policy */

	Route::get('/siteadmin/hyperlinkpolicylist', 'SiteadminController@hyperlinkpolicylist')->name('siteadmin.hyperlinkpolicylist')->middleware('auth');
	Route::post('/siteadmin/hyperlinkpolicystore','SiteadminController@hyperlinkpolicystore')->name('siteadmin.hyperlinkpolicystore')->middleware('auth');
	Route::get('/siteadmin/hyperlinkpolicyedit/{id}', 'SiteadminController@hyperlinkpolicyedit')->middleware('auth');
	Route::post('/siteadmin/hyperlinkpolicyupdate', 'SiteadminController@hyperlinkpolicyupdate')->name('siteadmin.hyperlinkpolicyupdate')->middleware('auth');
	Route::get('/siteadmin/hyperlinkpolicydestroy/{id}', 'SiteadminController@hyperlinkpolicydestroy')->middleware('auth');
	Route::get('/siteadmin/hyperlinkpolicystatus/{id}', 'SiteadminController@hyperlinkpolicystatus')->middleware('auth');


/*   Privacy Policy  */

	Route::get('/siteadmin/privacypolicylist', 'SiteadminController@privacypolicylist')->name('siteadmin.privacypolicylist')->middleware('auth');
	Route::post('/siteadmin/privacypolicystore','SiteadminController@privacypolicystore')->name('siteadmin.privacypolicystore')->middleware('auth');
	Route::get('/siteadmin/privacypolicyedit/{id}', 'SiteadminController@privacypolicyedit')->middleware('auth');
	Route::post('/siteadmin/privacypolicyupdate', 'SiteadminController@privacypolicyupdate')->name('siteadmin.privacypolicyupdate')->middleware('auth');
	Route::get('/siteadmin/privacypolicydestroy/{id}', 'SiteadminController@privacypolicydestroy')->middleware('auth');
	Route::get('/siteadmin/privacypolicystatus/{id}', 'SiteadminController@privacypolicystatus')->middleware('auth');

	/*   Terms and Conditions  */

	Route::get('/siteadmin/termsandconditionlist', 'SiteadminController@termsandconditionlist')->name('siteadmin.termsandconditionlist')->middleware('auth');
	Route::post('/siteadmin/termsandconditionstore','SiteadminController@termsandconditionstore')->name('siteadmin.termsandconditionstore')->middleware('auth');
	Route::get('/siteadmin/termsandconditionedit/{id}', 'SiteadminController@termsandconditionedit')->middleware('auth');
	Route::post('/siteadmin/termsandconditionupdate', 'SiteadminController@termsandconditionupdate')->name('siteadmin.termsandconditionupdate')->middleware('auth');
	Route::get('/siteadmin/termsandconditiondestroy/{id}', 'SiteadminController@termsandconditiondestroy')->middleware('auth');
	Route::get('/siteadmin/termsandconditionstatus/{id}', 'SiteadminController@termsandconditionstatus')->middleware('auth');


/*   Department Introduction  */

	Route::get('/siteadmin/deptintrolist', 'SiteadminController@deptintrolist')->name('siteadmin.deptintrolist')->middleware('auth');
	Route::get('siteadmin/deptintrocreate','SiteadminController@deptintrocreate')->name('siteadmin.deptintrocreate')->middleware('auth');
	Route::post('/siteadmin/deptintrostore','SiteadminController@deptintrostore')->name('siteadmin.deptintrostore')->middleware('auth');
	Route::get('/siteadmin/deptintroedit/{id}', 'SiteadminController@deptintroedit')->middleware('auth');
	Route::post('/siteadmin/deptintroupdate', 'SiteadminController@deptintroupdate')->name('siteadmin.deptintroupdate')->middleware('auth');
	Route::get('/siteadmin/deptintrodestroy/{id}', 'SiteadminController@deptintrodestroy')->middleware('auth');
	Route::get('/siteadmin/deptintrostatus/{id}', 'SiteadminController@deptintrostatus')->middleware('auth');



/*   FAQ  */

	Route::get('/siteadmin/faqlist', 'SiteadminController@faqlist')->name('siteadmin.faqlist')->middleware('auth');
	Route::post('/siteadmin/faqstore','SiteadminController@faqstore')->name('siteadmin.faqstore')->middleware('auth');
	Route::get('/siteadmin/faqedit/{id}', 'SiteadminController@faqedit')->middleware('auth');
	Route::post('/siteadmin/faqupdate', 'SiteadminController@faqupdate')->name('siteadmin.faqupdate')->middleware('auth');
	Route::get('/siteadmin/faqdestroy/{id}', 'SiteadminController@faqdestroy')->middleware('auth');
	Route::get('/siteadmin/faqstatus/{id}', 'SiteadminController@faqstatus')->middleware('auth');

	/*   Service Link  */

	Route::get('/siteadmin/servicelinklist', 'SiteadminController@servicelinklist')->name('siteadmin.servicelinklist')->middleware('auth');
	Route::post('/siteadmin/servicelinkstore','SiteadminController@servicelinkstore')->name('siteadmin.servicelinkstore')->middleware('auth');
	Route::get('/siteadmin/servicelinkedit/{id}', 'SiteadminController@servicelinkedit')->middleware('auth');
	Route::post('/siteadmin/servicelinkupdate', 'SiteadminController@servicelinkupdate')->name('siteadmin.servicelinkupdate')->middleware('auth');
	Route::get('/siteadmin/servicelinkdestroy/{id}', 'SiteadminController@servicelinkdestroy')->middleware('auth');
	Route::get('/siteadmin/servicelinkstatus/{id}', 'SiteadminController@servicelinkstatus')->middleware('auth');

/*   Widget Link  */

	Route::get('/siteadmin/widgetlinklist', 'WebadminController@widgetlinklist')->name('siteadmin.widgetlinklist')->middleware('auth');
	Route::post('/siteadmin/widgetlinkstore','WebadminController@widgetlinkstore')->name('siteadmin.widgetlinkstore')->middleware('auth');
	Route::get('/siteadmin/widgetlinkedit/{id}', 'WebadminController@widgetlinkedit')->middleware('auth');
	Route::post('/siteadmin/widgetlinkupdate', 'WebadminController@widgetlinkupdate')->name('siteadmin.widgetlinkupdate')->middleware('auth');
	Route::get('/siteadmin/widgetlinkdestroy/{id}', 'WebadminController@widgetlinkdestroy')->middleware('auth');
	Route::get('/siteadmin/widgetlinkstatus/{id}', 'WebadminController@widgetlinkstatus')->middleware('auth');

	/*   Short Alert */

	Route::get('/siteadmin/shortalertlist', 'SiteadminController@shortalertlist')->name('siteadmin.shortalertlist')->middleware('auth');
	Route::post('/siteadmin/shortalertstore','SiteadminController@shortalertstore')->name('siteadmin.shortalertstore')->middleware('auth');
	Route::get('/siteadmin/shortalertedit/{id}', 'SiteadminController@shortalertedit')->middleware('auth');
	Route::post('/siteadmin/shortalertupdate', 'SiteadminController@shortalertupdate')->name('siteadmin.shortalertupdate')->middleware('auth');
	Route::get('/siteadmin/shortalertdestroy/{id}', 'SiteadminController@shortalertdestroy')->middleware('auth');
	Route::get('/siteadmin/shortalertstatus/{id}', 'SiteadminController@shortalertstatus')->middleware('auth');


/*   Long Alert */

	Route::get('/siteadmin/longalertlist', 'SiteadminController@longalertlist')->name('siteadmin.longalertlist')->middleware('auth');
	Route::post('/siteadmin/longalertstore','SiteadminController@longalertstore')->name('siteadmin.longalertstore')->middleware('auth');
	Route::get('/siteadmin/longalertedit/{id}', 'SiteadminController@longalertedit')->middleware('auth');
	Route::post('/siteadmin/longalertupdate', 'SiteadminController@longalertupdate')->name('siteadmin.longalertupdate')->middleware('auth');
	Route::get('/siteadmin/longalertdestroy/{id}', 'SiteadminController@longalertdestroy')->middleware('auth');
	Route::get('/siteadmin/longalertstatus/{id}', 'SiteadminController@longalertstatus')->middleware('auth');

	/*   Media Alert */

	Route::get('/siteadmin/mediaalertlist', 'SiteadminController@mediaalertlist')->name('siteadmin.mediaalertlist')->middleware('auth');
	Route::get('siteadmin/mediaalertcreate','SiteadminController@mediaalertcreate')->name('siteadmin.mediaalertcreate')->middleware('auth');
	Route::post('/siteadmin/mediaalertstore','SiteadminController@mediaalertstore')->name('siteadmin.mediaalertstore')->middleware('auth');
	Route::get('/siteadmin/mediaalertedit/{id}', 'SiteadminController@mediaalertedit')->middleware('auth');
	Route::post('/siteadmin/mediaalertupdate', 'SiteadminController@mediaalertupdate')->name('siteadmin.mediaalertupdate')->middleware('auth');
	Route::get('/siteadmin/mediaalertdestroy/{id}', 'SiteadminController@mediaalertdestroy')->middleware('auth');
	Route::get('/siteadmin/mediaalertstatus/{id}', 'SiteadminController@mediaalertstatus')->middleware('auth');
	Route::get('/siteadmin/filetypelist/{id}', 'SiteadminController@filetypelist')->middleware('auth');

/*Activity*/

	Route::get('/siteadmin/activitylist', 'WebadminController@activitylist')->name('siteadmin.activitylist')->middleware('auth');
	Route::get('siteadmin/activitycreate','WebadminController@activitycreate')->name('siteadmin.activitycreate')->middleware('auth');
	Route::post('/siteadmin/activitystore','WebadminController@activitystore')->name('siteadmin.activitystore')->middleware('auth');
	Route::get('/siteadmin/activityedit/{id}', 'WebadminController@activityedit')->middleware('auth');
	Route::post('/siteadmin/activityupdate', 'WebadminController@activityupdate')->name('siteadmin.activityupdate')->middleware('auth');
	Route::get('/siteadmin/activitydestroy/{id}', 'WebadminController@activitydestroy')->middleware('auth');
	Route::get('/siteadmin/activitystatus/{id}', 'WebadminController@activitystatus')->middleware('auth');

/*Article*/

	Route::get('/siteadmin/articlelist', 'WebadminController@articlelist')->name('siteadmin.articlelist')->middleware('auth');
	Route::get('siteadmin/articlecreate','WebadminController@articlecreate')->name('siteadmin.articlecreate')->middleware('auth');
	Route::post('/siteadmin/articlestore','WebadminController@articlestore')->name('siteadmin.articlestore')->middleware('auth');
	Route::get('/siteadmin/articleedit/{id}', 'WebadminController@articleedit')->middleware('auth');
	Route::get('/siteadmin/articleuplddet/{id}', 'WebadminController@articleuplddet')->middleware('auth');
	Route::post('/siteadmin/articleupdate', 'WebadminController@articleupdate')->name('siteadmin.articleupdate')->middleware('auth');
	Route::get('/siteadmin/articledestroy/{id}', 'WebadminController@articledestroy')->middleware('auth');
	Route::get('/siteadmin/articlestatus/{id}', 'WebadminController@articlestatus')->middleware('auth');

/*Gallery*/
	Route::get('/siteadmin/gallerylist', 'WebadminController@gallerylist')->name('siteadmin.gallerylist')->middleware('auth');
	Route::get('siteadmin/gallerycreate','WebadminController@gallerycreate')->name('siteadmin.gallerycreate')->middleware('auth');
	Route::post('/siteadmin/gallerystore','WebadminController@gallerystore')->name('siteadmin.gallerystore')->middleware('auth');
	Route::get('/siteadmin/galleryedit/{id}', 'WebadminController@galleryedit')->middleware('auth');
	Route::post('/siteadmin/galleryupdate', 'WebadminController@galleryupdate')->name('siteadmin.galleryupdate')->middleware('auth');
	Route::get('/siteadmin/gallerydestroy/{id}', 'WebadminController@gallerydestroy')->middleware('auth');
	Route::get('/siteadmin/gallerystatus/{id}', 'WebadminController@gallerystatus')->middleware('auth');

/*Newletter*/

	Route::get('/siteadmin/newsletterlist', 'WebadminController@newsletterlist')->name('siteadmin.newsletterlist')->middleware('auth');
	Route::get('siteadmin/newslettercreate','WebadminController@newslettercreate')->name('siteadmin.newslettercreate')->middleware('auth');
	Route::post('/siteadmin/newsletterstore','WebadminController@newsletterstore')->name('siteadmin.newsletterstore')->middleware('auth');
	Route::get('/siteadmin/newsletteredit/{id}', 'WebadminController@newsletteredit')->middleware('auth');
	Route::post('/siteadmin/newsletterupdate', 'WebadminController@newsletterupdate')->name('siteadmin.newsletterupdate')->middleware('auth');
	Route::get('/siteadmin/newsletterdestroy/{id}', 'WebadminController@newsletterdestroy')->middleware('auth');
	Route::get('/siteadmin/newsletterstatus/{id}', 'WebadminController@newsletterstatus')->middleware('auth');
	
	
	Route::get('/siteadmin/promocampaignlist', 'WebadminController@promocampaignlist')->name('siteadmin.promocampaignlist')->middleware('auth');
	Route::get('siteadmin/promocampaigncreate','WebadminController@promocampaigncreate')->name('siteadmin.promocampaigncreate')->middleware('auth');
	Route::post('/siteadmin/promocampaignstore','WebadminController@promocampaignstore')->name('siteadmin.promocampaignstore')->middleware('auth');
	Route::get('/siteadmin/promocampaignedit/{id}', 'WebadminController@promocampaignedit')->middleware('auth');
	Route::post('/siteadmin/promocampaignupdate', 'WebadminController@promocampaignupdate')->name('siteadmin.promocampaignupdate')->middleware('auth');
	Route::get('/siteadmin/promocampaigndestroy/{id}', 'WebadminController@promocampaigndestroy')->middleware('auth');
	Route::get('/siteadmin/promocampaignstatus/{id}', 'WebadminController@promocampaignstatus')->middleware('auth');
	Route::get('/siteadmin/promofiletypelist/{id}', 'WebadminController@promofiletypelist')->middleware('auth');



	/*Change password*/
	Route::get('/siteadmin/changepasswordview', 'AdminController@changepasswordview')->name('siteadmin.changepasswordview')->middleware('auth');
	Route::post('/siteadmin/checkoldpassword', 'AdminController@checkoldpassword')->name('siteadmin.checkoldpassword')->middleware('auth');
	Route::post('/siteadmin/changepasswordaction', 'AdminController@changepasswordaction')->name('siteadmin.changepasswordaction')->middleware('auth');

});





/*App Admin*/

Route::group(['middleware' => ['auth','App\Http\Middleware\AppAdmin']], function()
{
	Route::get('/appadmin', 'AppadminController@appadminhome')->name('appadminhome')->middleware('auth');

	Route::get('/appadmin/designationlist', 'AppadminController@designationlist')->name('appadmin.designationlist')->middleware('auth');
	Route::post('/appadmin/designationstore','AppadminController@designationstore')->name('appadmin.designationstore')->middleware('auth');
	Route::get('/appadmin/designationedit/{id}', 'AppadminController@designationedit')->middleware('auth');
	Route::post('/appadmin/designationupdate', 'AppadminController@designationupdate')->name('appadmin.designationupdate')->middleware('auth');
	Route::get('/appadmin/designationdestroy/{id}', 'AppadminController@designationdestroy')->middleware('auth');
	Route::get('/appadmin/designationstatus/{id}', 'AppadminController@designationstatus')->middleware('auth');


	Route::get('/appadmin/departmentlist', 'AppadminController@departmentlist')->name('appadmin.departmentlist')->middleware('auth');
	Route::get('appadmin/departmentcreate','AppadminController@departmentcreate')->name('appadmin.departmentcreate')->middleware('auth');
	Route::post('/appadmin/departmentstore','AppadminController@departmentstore')->name('appadmin.departmentstore')->middleware('auth');
	Route::get('/appadmin/departmentedit/{id}', 'AppadminController@departmentedit')->middleware('auth');
	Route::post('/appadmin/departmentupdate', 'AppadminController@departmentupdate')->name('appadmin.departmentupdate')->middleware('auth');
	Route::get('/appadmin/departmentdestroy/{id}', 'AppadminController@departmentdestroy')->middleware('auth');
	Route::get('/appadmin/departmentstatus/{id}', 'AppadminController@departmentstatus')->middleware('auth');


	Route::get('/appadmin/hierarchylist', 'AppadminController@hierarchylist')->name('appadmin.hierarchylist')->middleware('auth');
	Route::post('/appadmin/hierarchystore','AppadminController@hierarchystore')->name('appadmin.hierarchystore')->middleware('auth');
	Route::get('/appadmin/hierarchyedit/{id}', 'AppadminController@hierarchyedit')->middleware('auth');
	Route::post('/appadmin/hierarchyupdate', 'AppadminController@hierarchyupdate')->name('appadmin.hierarchyupdate')->middleware('auth');
	Route::get('/appadmin/hierarchydestroy/{id}', 'AppadminController@hierarchydestroy')->middleware('auth');
	Route::get('/appadmin/hierarchystatus/{id}', 'AppadminController@hierarchystatus')->middleware('auth');


	Route::get('/appadmin/staffcategorylist', 'AppadminController@staffcategorylist')->name('appadmin.staffcategorylist')->middleware('auth');
	Route::post('/appadmin/staffcategorystore','AppadminController@staffcategorystore')->name('appadmin.staffcategorystore')->middleware('auth');
	Route::get('/appadmin/staffcategoryedit/{id}', 'AppadminController@staffcategoryedit')->middleware('auth');
	Route::post('/appadmin/staffcategoryupdate', 'AppadminController@staffcategoryupdate')->name('appadmin.staffcategoryupdate')->middleware('auth');
	Route::get('/appadmin/staffcategorydestroy/{id}', 'AppadminController@staffcategorydestroy')->middleware('auth');
	Route::get('/appadmin/staffcategorystatus/{id}', 'AppadminController@staffcategorystatus')->middleware('auth');


	Route::get('/appadmin/officelist', 'AppadminController@officelist')->name('appadmin.officelist')->middleware('auth');
	Route::post('/appadmin/officestore','AppadminController@officestore')->name('appadmin.officestore')->middleware('auth');
	Route::get('/appadmin/officeedit/{id}', 'AppadminController@officeedit')->middleware('auth');
	Route::post('/appadmin/officeupdate', 'AppadminController@officeupdate')->name('appadmin.officeupdate')->middleware('auth');
	Route::get('/appadmin/officedestroy/{id}', 'AppadminController@officedestroy')->middleware('auth');
	Route::get('/appadmin/officestatus/{id}', 'AppadminController@officestatus')->middleware('auth');


	Route::get('/appadmin/membershiprequestlist', 'AppadminController@membershiprequestlist')->name('appadmin.membershiprequestlist')->middleware('auth');
	Route::get('appadmin/membershiprequestcreate','AppadminController@membershiprequestcreate')->name('appadmin.membershiprequestcreate')->middleware('auth');
	Route::post('/appadmin/membershiprequeststore','AppadminController@membershiprequeststore')->name('appadmin.membershiprequeststore')->middleware('auth');
	Route::get('/appadmin/membershiprequestedit/{id}', 'AppadminController@membershiprequestedit')->middleware('auth');
	Route::post('/appadmin/membershiprequestupdate', 'AppadminController@membershiprequestupdate')->name('appadmin.membershiprequestupdate')->middleware('auth');
	Route::get('/appadmin/membershiprequestdestroy/{id}', 'AppadminController@membershiprequestdestroy')->middleware('auth');
	Route::get('/appadmin/membershiprequeststatus/{id}', 'AppadminController@membershiprequeststatus')->middleware('auth');


	Route::get('/appadmin/stafflist', 'AppadminController@stafflist')->name('appadmin.stafflist')->middleware('auth');
	Route::get('appadmin/staffcreate','AppadminController@staffcreate')->name('appadmin.staffcreate')->middleware('auth');
	Route::post('/appadmin/staffstore','AppadminController@staffstore')->name('appadmin.staffstore')->middleware('auth');
	Route::get('/appadmin/staffedit/{id}', 'AppadminController@staffedit')->middleware('auth');
	Route::post('/appadmin/staffupdate', 'AppadminController@staffupdate')->name('appadmin.staffupdate')->middleware('auth');
	Route::get('/appadmin/staffdestroy/{id}', 'AppadminController@staffdestroy')->middleware('auth');
	Route::get('/appadmin/staffstatus/{id}', 'AppadminController@staffstatus')->middleware('auth');


	Route::get('/appadmin/committeelist', 'AppadminController@committeelist')->name('appadmin.committeelist')->middleware('auth');
	Route::post('/appadmin/committeestore','AppadminController@committeestore')->name('appadmin.committeestore')->middleware('auth');
	Route::get('/appadmin/committeeedit/{id}', 'AppadminController@committeeedit')->middleware('auth');
	Route::post('/appadmin/committeeupdate', 'AppadminController@committeeupdate')->name('appadmin.committeeupdate')->middleware('auth');
	Route::get('/appadmin/committeedestroy/{id}', 'AppadminController@committeedestroy')->middleware('auth');
	Route::get('/appadmin/committeestatus/{id}', 'AppadminController@committeestatus')->middleware('auth');
	

	Route::get('/appadmin/staffcommitteelist', 'AppadminController@staffcommitteelist')->name('appadmin.staffcommitteelist')->middleware('auth');
	Route::get('appadmin/staffcommitteecreate','AppadminController@staffcommitteecreate')->name('appadmin.staffcommitteecreate')->middleware('auth');
	Route::post('/appadmin/staffcommitteestore','AppadminController@staffcommitteestore')->name('appadmin.staffcommitteestore')->middleware('auth');
	Route::get('/appadmin/staffcommitteedestroy/{id}', 'AppadminController@staffcommitteedestroy')->middleware('auth');
	Route::get('/appadmin/staffcommitteestatus/{id}', 'AppadminController@staffcommitteestatus')->middleware('auth');

	
	Route::get('/appadmin/communicationlist', 'AppadminController@communicationlist')->name('appadmin.communicationlist')->middleware('auth');
	Route::get('appadmin/communicationcreate','AppadminController@communicationcreate')->name('appadmin.communicationcreate')->middleware('auth');
	Route::post('/appadmin/communicationstore','AppadminController@communicationstore')->name('appadmin.communicationstore')->middleware('auth');
	Route::get('/appadmin/communicationdestroy/{id}', 'AppadminController@communicationdestroy')->middleware('auth');
	Route::get('/appadmin/communicationstatus/{id}', 'AppadminController@communicationstatus')->middleware('auth');
	Route::post('appadmin/storecommunicationimg', 'AppadminController@storecommunicationimg')->name('appadmin.storecommunicationimg')->middleware('auth');

	/*Route::get('SentMail','AppadminController@SentMail');*/

	/*Change password*/
	Route::get('/appadmin/changepasswordview', 'AdminController@changepasswordview')->name('appadmin.changepasswordview')->middleware('auth');
	Route::post('/appadmin/checkoldpassword', 'AdminController@checkoldpassword')->name('appadmin.checkoldpassword')->middleware('auth');
	Route::post('/appadmin/changepasswordaction', 'AdminController@changepasswordaction')->name('appadmin.changepasswordaction')->middleware('auth');

});

/*Web Admin*/

Route::group(['middleware' => ['auth','App\Http\Middleware\WebAdmin']], function()
{
	
	Route::get('/webadmin', 'WebadminController@webadminhome')->name('webadminhome')->middleware('auth');
	Route::get('/webadmin/bannerlist', 'WebadminController@bannerlist')->name('webadmin.bannerlist')->middleware('auth');
	Route::post('/webadmin/bannerstore','WebadminController@bannerstore')->name('webadmin.bannerstore')->middleware('auth');
	Route::get('/webadmin/banneredit/{id}', 'WebadminController@banneredit')->middleware('auth');
	Route::post('/webadmin/bannerupdate', 'WebadminController@bannerupdate')->name('webadmin.bannerupdate')->middleware('auth');
	Route::get('/webadmin/bannerdestroy/{id}', 'WebadminController@bannerdestroy')->middleware('auth');
	Route::get('/webadmin/bannerstatus/{id}', 'WebadminController@bannerstatus')->middleware('auth');


	Route::get('/webadmin/promocampaignlist', 'WebadminController@promocampaignlist')->name('webadmin.promocampaignlist')->middleware('auth');
	Route::get('webadmin/promocampaigncreate','WebadminController@promocampaigncreate')->name('webadmin.promocampaigncreate')->middleware('auth');
	Route::post('/webadmin/promocampaignstore','WebadminController@promocampaignstore')->name('webadmin.promocampaignstore')->middleware('auth');
	Route::get('/webadmin/promocampaignedit/{id}', 'WebadminController@promocampaignedit')->middleware('auth');
	Route::post('/webadmin/promocampaignupdate', 'WebadminController@promocampaignupdate')->name('webadmin.promocampaignupdate')->middleware('auth');
	Route::get('/webadmin/promocampaigndestroy/{id}', 'WebadminController@promocampaigndestroy')->middleware('auth');
	Route::get('/webadmin/promocampaignstatus/{id}', 'WebadminController@promocampaignstatus')->middleware('auth');
	Route::get('/webadmin/promofiletypelist/{id}', 'WebadminController@promofiletypelist')->middleware('auth');


	Route::get('/webadmin/downloadlist', 'WebadminController@downloadlist')->name('webadmin.downloadlist')->middleware('auth');
	Route::get('webadmin/downloadcreate','WebadminController@downloadcreate')->name('webadmin.downloadcreate')->middleware('auth');
	Route::post('/webadmin/downloadstore','WebadminController@downloadstore')->name('webadmin.downloadstore')->middleware('auth');
	Route::get('/webadmin/downloadedit/{id}', 'WebadminController@downloadedit')->middleware('auth');
	Route::post('/webadmin/downloadupdate', 'WebadminController@downloadupdate')->name('webadmin.downloadupdate')->middleware('auth');
	Route::get('/webadmin/downloaddestroy/{id}', 'WebadminController@downloaddestroy')->middleware('auth');
	Route::get('/webadmin/downloadstatus/{id}', 'WebadminController@downloadstatus')->middleware('auth');
	Route::get('/webadmin/downloadfiletypelist/{id}', 'WebadminController@downloadfiletypelist')->middleware('auth');


	Route::get('/webadmin/gallerylist', 'WebadminController@gallerylist')->name('webadmin.gallerylist')->middleware('auth');
	Route::get('webadmin/gallerycreate','WebadminController@gallerycreate')->name('webadmin.gallerycreate')->middleware('auth');
	Route::post('/webadmin/gallerystore','WebadminController@gallerystore')->name('webadmin.gallerystore')->middleware('auth');
	Route::get('/webadmin/galleryedit/{id}', 'WebadminController@galleryedit')->middleware('auth');
	Route::post('/webadmin/galleryupdate', 'WebadminController@galleryupdate')->name('webadmin.galleryupdate')->middleware('auth');
	Route::get('/webadmin/gallerydestroy/{id}', 'WebadminController@gallerydestroy')->middleware('auth');
	Route::get('/webadmin/gallerystatus/{id}', 'WebadminController@gallerystatus')->middleware('auth');


	Route::get('/webadmin/galleryalbumlist', 'WebadminController@galleryalbumlist')->name('webadmin.galleryalbumlist')->middleware('auth');
	Route::post('/webadmin/galleryalbumstore','WebadminController@galleryalbumstore')->name('webadmin.galleryalbumstore')->middleware('auth');
	Route::get('webadmin/galleryalbumcreate','WebadminController@galleryalbumcreate')->name('webadmin.galleryalbumcreate')->middleware('auth');
	Route::get('/webadmin/galleryalbumedit/{id}', 'WebadminController@galleryalbumedit')->middleware('auth');
	Route::post('/webadmin/galleryalbumupdate', 'WebadminController@galleryalbumupdate')->name('webadmin.galleryalbumupdate')->middleware('auth');
	Route::get('/webadmin/galleryalbumdestroy/{id}', 'WebadminController@galleryalbumdestroy')->middleware('auth');
	Route::get('/webadmin/galleryalbumstatus/{id}', 'WebadminController@galleryalbumstatus')->middleware('auth');


	
	Route::get('/webadmin/newsletterlist', 'WebadminController@newsletterlist')->name('webadmin.newsletterlist')->middleware('auth');
	Route::get('webadmin/newslettercreate','WebadminController@newslettercreate')->name('webadmin.newslettercreate')->middleware('auth');
	Route::post('/webadmin/newsletterstore','WebadminController@newsletterstore')->name('webadmin.newsletterstore')->middleware('auth');
	Route::get('/webadmin/newsletteredit/{id}', 'WebadminController@newsletteredit')->middleware('auth');
	Route::post('/webadmin/newsletterupdate', 'WebadminController@newsletterupdate')->name('webadmin.newsletterupdate')->middleware('auth');
	Route::get('/webadmin/newsletterdestroy/{id}', 'WebadminController@newsletterdestroy')->middleware('auth');
	Route::get('/webadmin/newsletterstatus/{id}', 'WebadminController@newsletterstatus')->middleware('auth');



	Route::get('/webadmin/newslettervolumelist', 'WebadminController@newslettervolumelist')->name('webadmin.newslettervolumelist')->middleware('auth');
	Route::get('webadmin/newslettervolumecreate','WebadminController@newslettervolumecreate')->name('webadmin.newslettervolumecreate')->middleware('auth');
	Route::post('/webadmin/newslettervolumestore','WebadminController@newslettervolumestore')->name('webadmin.newslettervolumestore')->middleware('auth');
	Route::get('/webadmin/newslettervolumeedit/{id}', 'WebadminController@newslettervolumeedit')->middleware('auth');
	Route::post('/webadmin/newslettervolumeupdate', 'WebadminController@newslettervolumeupdate')->name('webadmin.newslettervolumeupdate')->middleware('auth');
	Route::get('/webadmin/newslettervolumedestroy/{id}', 'WebadminController@newslettervolumedestroy')->middleware('auth');
	Route::get('/webadmin/newslettervolumestatus/{id}', 'WebadminController@newslettervolumestatus')->middleware('auth');
	Route::get('/webadmin/newslettervolumefiletypelist/{id}', 'WebadminController@newslettervolumefiletypelist')->middleware('auth');


	Route::get('/webadmin/articlelist', 'WebadminController@articlelist')->name('webadmin.articlelist')->middleware('auth');
	Route::get('webadmin/articlecreate','WebadminController@articlecreate')->name('webadmin.articlecreate')->middleware('auth');
	Route::post('/webadmin/articlestore','WebadminController@articlestore')->name('webadmin.articlestore')->middleware('auth');
	Route::get('/webadmin/articleedit/{id}', 'WebadminController@articleedit')->middleware('auth');
	Route::get('/webadmin/articleuplddet/{id}', 'WebadminController@articleuplddet')->middleware('auth');
	Route::post('/webadmin/articleupdate', 'WebadminController@articleupdate')->name('webadmin.articleupdate')->middleware('auth');
	Route::get('/webadmin/articledestroy/{id}', 'WebadminController@articledestroy')->middleware('auth');
	Route::get('/webadmin/articlestatus/{id}', 'WebadminController@articlestatus')->middleware('auth');



	Route::get('/webadmin/articleuploadlist', 'WebadminController@articleuploadlist')->name('webadmin.articleuploadlist')->middleware('auth');
	Route::get('webadmin/articleuploadcreate','WebadminController@articleuploadcreate')->name('webadmin.articleuploadcreate')->middleware('auth');
	Route::post('/webadmin/articleuploadstore','WebadminController@articleuploadstore')->name('webadmin.articleuploadstore')->middleware('auth');
	Route::get('/webadmin/articleuploadedit/{id}', 'WebadminController@articleuploadedit')->middleware('auth');
	Route::post('/webadmin/articleuploadupdate', 'WebadminController@articleuploadupdate')->name('webadmin.articleuploadupdate')->middleware('auth');
	Route::get('/webadmin/articleuploaddestroy/{id}', 'WebadminController@articleuploaddestroy')->middleware('auth');
	Route::get('/webadmin/articleuploadstatus/{id}', 'WebadminController@articleuploadstatus')->middleware('auth');
	Route::get('/webadmin/articleuploadfiletypelist/{id}', 'WebadminController@articleuploadfiletypelist')->middleware('auth');



	Route::get('/webadmin/activitylist', 'WebadminController@activitylist')->name('webadmin.activitylist')->middleware('auth');
	Route::get('webadmin/activitycreate','WebadminController@activitycreate')->name('webadmin.activitycreate')->middleware('auth');
	Route::post('/webadmin/activitystore','WebadminController@activitystore')->name('webadmin.activitystore')->middleware('auth');
	Route::get('/webadmin/activityedit/{id}', 'WebadminController@activityedit')->middleware('auth');
	Route::post('/webadmin/activityupdate', 'WebadminController@activityupdate')->name('webadmin.activityupdate')->middleware('auth');
	Route::get('/webadmin/activitydestroy/{id}', 'WebadminController@activitydestroy')->middleware('auth');
	Route::get('/webadmin/activitystatus/{id}', 'WebadminController@activitystatus')->middleware('auth');



	Route::get('/webadmin/activityuploadlist', 'WebadminController@activityuploadlist')->name('webadmin.activityuploadlist')->middleware('auth');
	Route::get('webadmin/activityuploadcreate','WebadminController@activityuploadcreate')->name('webadmin.activityuploadcreate')->middleware('auth');
	Route::post('/webadmin/activityuploadstore','WebadminController@activityuploadstore')->name('webadmin.activityuploadstore')->middleware('auth');
	Route::get('/webadmin/activityuploadedit/{id}', 'WebadminController@activityuploadedit')->middleware('auth');
	Route::post('/webadmin/activityuploadupdate', 'WebadminController@activityuploadupdate')->name('webadmin.activityuploadupdate')->middleware('auth');
	Route::get('/webadmin/activityuploaddestroy/{id}', 'WebadminController@activityuploaddestroy')->middleware('auth');
	Route::get('/webadmin/activityuploadstatus/{id}', 'WebadminController@activityuploadstatus')->middleware('auth');
	Route::get('/webadmin/activityuploadfiletypelist/{id}', 'WebadminController@activityuploadfiletypelist')->middleware('auth');




	Route::get('/webadmin/livestreaminglist', 'WebadminController@livestreaminglist')->name('webadmin.livestreaminglist')->middleware('auth');
	Route::post('/webadmin/livestreamingstore','WebadminController@livestreamingstore')->name('webadmin.livestreamingstore')->middleware('auth');
	Route::get('/webadmin/livestreamingedit/{id}', 'WebadminController@livestreamingedit')->middleware('auth');
	Route::post('/webadmin/livestreamingupdate', 'WebadminController@livestreamingupdate')->name('webadmin.livestreamingupdate')->middleware('auth');
	Route::get('/webadmin/livestreamingdestroy/{id}', 'WebadminController@livestreamingdestroy')->middleware('auth');
	Route::get('/webadmin/livestreamingstatus/{id}', 'WebadminController@livestreamingstatus')->middleware('auth');



	Route::get('/webadmin/appdepartmentlist', 'WebadminController@appdepartmentlist')->name('webadmin.appdepartmentlist')->middleware('auth');
	Route::post('/webadmin/appdepartmentstore','WebadminController@appdepartmentstore')->name('webadmin.appdepartmentstore')->middleware('auth');
	Route::get('/webadmin/appdepartmentedit/{id}', 'WebadminController@appdepartmentedit')->middleware('auth');
	Route::post('/webadmin/appdepartmentupdate', 'WebadminController@appdepartmentupdate')->name('webadmin.appdepartmentupdate')->middleware('auth');
	Route::get('/webadmin/appdepartmentdestroy/{id}', 'WebadminController@appdepartmentdestroy')->middleware('auth');
	Route::get('/webadmin/appdepartmentstatus/{id}', 'WebadminController@appdepartmentstatus')->middleware('auth');



	Route::get('/webadmin/appsectionlist', 'WebadminController@appsectionlist')->name('webadmin.appsectionlist')->middleware('auth');
	Route::get('webadmin/appsectioncreate','WebadminController@appsectioncreate')->name('webadmin.appsectioncreate')->middleware('auth');
	Route::post('/webadmin/appsectionstore','WebadminController@appsectionstore')->name('webadmin.appsectionstore')->middleware('auth');
	Route::get('/webadmin/appsectionedit/{id}', 'WebadminController@appsectionedit')->middleware('auth');
	Route::post('/webadmin/appsectionupdate', 'WebadminController@appsectionupdate')->name('webadmin.appsectionupdate')->middleware('auth');
	Route::get('/webadmin/appsectiondestroy/{id}', 'WebadminController@appsectiondestroy')->middleware('auth');
	Route::get('/webadmin/appsectionstatus/{id}', 'WebadminController@appsectionstatus')->middleware('auth');



	Route::get('/webadmin/widgetlinklist', 'WebadminController@widgetlinklist')->name('webadmin.widgetlinklist')->middleware('auth');
	Route::post('/webadmin/widgetlinkstore','WebadminController@widgetlinkstore')->name('webadmin.widgetlinkstore')->middleware('auth');
	Route::get('/webadmin/widgetlinkedit/{id}', 'WebadminController@widgetlinkedit')->middleware('auth');
	Route::post('/webadmin/widgetlinkupdate', 'WebadminController@widgetlinkupdate')->name('webadmin.widgetlinkupdate')->middleware('auth');
	Route::get('/webadmin/widgetlinkdestroy/{id}', 'WebadminController@widgetlinkdestroy')->middleware('auth');
	Route::get('/webadmin/widgetlinkstatus/{id}', 'WebadminController@widgetlinkstatus')->middleware('auth');


	/* Logo */
	Route::get('/webadmin/logolist', 'SiteadminController@logolist')->name('webadmin.logolist')->middleware('auth');
	Route::post('/webadmin/logostore','SiteadminController@logostore')->name('webadmin.logostore')->middleware('auth');
	Route::get('/webadmin/logoedit/{id}', 'SiteadminController@logoedit')->middleware('auth');
	Route::post('/webadmin/logoupdate', 'SiteadminController@logoupdate')->name('webadmin.logoupdate')->middleware('auth');
	Route::get('/webadmin/logodestroy/{id}', 'SiteadminController@logodestroy')->middleware('auth');
	Route::get('/webadmin/logostatus/{id}', 'SiteadminController@logostatus')->middleware('auth');

	/* Title */
	Route::get('/webadmin/titlelist', 'SiteadminController@titlelist')->name('webadmin.titlelist')->middleware('auth');
	Route::post('/webadmin/titlestore','SiteadminController@titlestore')->name('webadmin.titlestore')->middleware('auth');
	Route::get('/webadmin/titleedit/{id}', 'SiteadminController@titleedit')->middleware('auth');
	Route::post('/webadmin/titleupdate', 'SiteadminController@titleupdate')->name('webadmin.titleupdate')->middleware('auth');
	Route::get('/webadmin/titledestroy/{id}', 'SiteadminController@titledestroy')->middleware('auth');
	Route::get('/webadmin/titlestatus/{id}', 'SiteadminController@titlestatus')->middleware('auth');


	/* Footer */
	Route::get('/webadmin/footerlist', 'SiteadminController@footerlist')->name('webadmin.footerlist')->middleware('auth');
	Route::post('/webadmin/footerstore','SiteadminController@footerstore')->name('webadmin.footerstore')->middleware('auth');
	Route::get('/webadmin/footeredit/{id}', 'SiteadminController@footeredit')->middleware('auth');
	Route::post('/webadmin/footerupdate', 'SiteadminController@footerupdate')->name('webadmin.footerupdate')->middleware('auth');
	Route::get('/webadmin/footerdestroy/{id}', 'SiteadminController@footerdestroy')->middleware('auth');
	Route::get('/webadmin/footerstatus/{id}', 'SiteadminController@footerstatus')->middleware('auth');


	/* About Portal */
	Route::get('/webadmin/aboutportallist', 'SiteadminController@aboutportallist')->name('webadmin.aboutportallist')->middleware('auth');
	Route::post('/webadmin/aboutportalstore','SiteadminController@aboutportalstore')->name('webadmin.aboutportalstore')->middleware('auth');
	Route::get('/webadmin/aboutportaledit/{id}', 'SiteadminController@aboutportaledit')->middleware('auth');
	Route::post('/webadmin/aboutportalupdate', 'SiteadminController@aboutportalupdate')->name('webadmin.aboutportalupdate')->middleware('auth');
	Route::get('/webadmin/aboutportaldestroy/{id}', 'SiteadminController@aboutportaldestroy')->middleware('auth');
	Route::get('/webadmin/aboutportalstatus/{id}', 'SiteadminController@aboutportalstatus')->middleware('auth');


	/*   Short Alert */

	Route::get('/webadmin/shortalertlist', 'SiteadminController@shortalertlist')->name('webadmin.shortalertlist')->middleware('auth');
	Route::post('/webadmin/shortalertstore','SiteadminController@shortalertstore')->name('webadmin.shortalertstore')->middleware('auth');
	Route::get('/webadmin/shortalertedit/{id}', 'SiteadminController@shortalertedit')->middleware('auth');
	Route::post('/webadmin/shortalertupdate', 'SiteadminController@shortalertupdate')->name('webadmin.shortalertupdate')->middleware('auth');
	Route::get('/webadmin/shortalertdestroy/{id}', 'SiteadminController@shortalertdestroy')->middleware('auth');
	Route::get('/webadmin/shortalertstatus/{id}', 'SiteadminController@shortalertstatus')->middleware('auth');


	/* Footer Menu */
	Route::get('/webadmin/footermenulist', 'SiteadminController@footermenulist')->name('webadmin.footermenulist')->middleware('auth');
	Route::post('/webadmin/footermenustore','SiteadminController@footermenustore')->name('webadmin.footermenustore')->middleware('auth');
	Route::get('/webadmin/footermenuedit/{id}', 'SiteadminController@footermenuedit')->middleware('auth');
	Route::post('/webadmin/footermenuupdate', 'SiteadminController@footermenuupdate')->name('webadmin.footermenuupdate')->middleware('auth');
	Route::get('/webadmin/footermenudestroy/{id}', 'SiteadminController@footermenudestroy')->middleware('auth');
	Route::get('/webadmin/footermenustatus/{id}', 'SiteadminController@footermenustatus')->middleware('auth');

	/* Footer Link */
	Route::get('/webadmin/footerlinklist', 'SiteadminController@footerlinklist')->name('webadmin.footerlinklist')->middleware('auth');
	Route::post('/webadmin/footerlinkstore','SiteadminController@footerlinkstore')->name('webadmin.footerlinkstore')->middleware('auth');
	Route::get('/webadmin/footerlinkedit/{id}', 'SiteadminController@footerlinkedit')->middleware('auth');
	Route::post('/webadmin/footerlinkupdate', 'SiteadminController@footerlinkupdate')->name('webadmin.footerlinkupdate')->middleware('auth');
	Route::get('/webadmin/footerlinkdestroy/{id}', 'SiteadminController@footerlinkdestroy')->middleware('auth');
	Route::get('/webadmin/footerlinkstatus/{id}', 'SiteadminController@footerlinkstatus')->middleware('auth');

	/* Social Media */
	Route::get('/webadmin/socialmedialist', 'SiteadminController@socialmedialist')->name('webadmin.socialmedialist')->middleware('auth');
	Route::post('/webadmin/socialmediastore','SiteadminController@socialmediastore')->name('webadmin.socialmediastore')->middleware('auth');
	Route::get('/webadmin/socialmediaedit/{id}', 'SiteadminController@socialmediaedit')->middleware('auth');
	Route::post('/webadmin/socialmediaupdate', 'SiteadminController@socialmediaupdate')->name('webadmin.socialmediaupdate')->middleware('auth');
	Route::get('/webadmin/socialmediadestroy/{id}', 'SiteadminController@socialmediadestroy')->middleware('auth');
	Route::get('/webadmin/socialmediastatus/{id}', 'SiteadminController@socialmediastatus')->middleware('auth');


	/*   Long Alert */

	Route::get('/webadmin/longalertlist', 'SiteadminController@longalertlist')->name('webadmin.longalertlist')->middleware('auth');
	Route::post('/webadmin/longalertstore','SiteadminController@longalertstore')->name('webadmin.longalertstore')->middleware('auth');
	Route::get('/webadmin/longalertedit/{id}', 'SiteadminController@longalertedit')->middleware('auth');
	Route::post('/webadmin/longalertupdate', 'SiteadminController@longalertupdate')->name('webadmin.longalertupdate')->middleware('auth');
	Route::get('/webadmin/longalertdestroy/{id}', 'SiteadminController@longalertdestroy')->middleware('auth');
	Route::get('/webadmin/longalertstatus/{id}', 'SiteadminController@longalertstatus')->middleware('auth');


	/*   Media Alert */

	Route::get('/webadmin/mediaalertlist', 'SiteadminController@mediaalertlist')->name('webadmin.mediaalertlist')->middleware('auth');
	Route::get('webadmin/mediaalertcreate','SiteadminController@mediaalertcreate')->name('webadmin.mediaalertcreate')->middleware('auth');
	Route::post('/webadmin/mediaalertstore','SiteadminController@mediaalertstore')->name('webadmin.mediaalertstore')->middleware('auth');
	Route::get('/webadmin/mediaalertedit/{id}', 'SiteadminController@mediaalertedit')->middleware('auth');
	Route::post('/webadmin/mediaalertupdate', 'SiteadminController@mediaalertupdate')->name('webadmin.mediaalertupdate')->middleware('auth');
	Route::get('/webadmin/mediaalertdestroy/{id}', 'SiteadminController@mediaalertdestroy')->middleware('auth');
	Route::get('/webadmin/mediaalertstatus/{id}', 'SiteadminController@mediaalertstatus')->middleware('auth');
	Route::get('/webadmin/filetypelist/{id}', 'SiteadminController@filetypelist')->middleware('auth');


	/* About Department */
	Route::get('/webadmin/aboutdepartmentlist', 'SiteadminController@aboutdepartmentlist')->name('webadmin.aboutdepartmentlist')->middleware('auth');
	Route::post('/webadmin/aboutdepartmentstore','SiteadminController@aboutdepartmentstore')->name('webadmin.aboutdepartmentstore')->middleware('auth');
	Route::get('/webadmin/aboutdepartmentedit/{id}', 'SiteadminController@aboutdepartmentedit')->middleware('auth');
	Route::post('/webadmin/aboutdepartmentupdate', 'SiteadminController@aboutdepartmentupdate')->name('webadmin.aboutdepartmentupdate')->middleware('auth');
	Route::get('/webadmin/aboutdepartmentdestroy/{id}', 'SiteadminController@aboutdepartmentdestroy')->middleware('auth');
	Route::get('/webadmin/aboutdepartmentstatus/{id}', 'SiteadminController@aboutdepartmentstatus')->middleware('auth');



	/*   Department Introduction  */

	Route::get('/webadmin/deptintrolist', 'SiteadminController@deptintrolist')->name('webadmin.deptintrolist')->middleware('auth');
	Route::get('webadmin/deptintrocreate','SiteadminController@deptintrocreate')->name('webadmin.deptintrocreate')->middleware('auth');
	Route::post('/webadmin/deptintrostore','SiteadminController@deptintrostore')->name('webadmin.deptintrostore')->middleware('auth');
	Route::get('/webadmin/deptintroedit/{id}', 'SiteadminController@deptintroedit')->middleware('auth');
	Route::post('/webadmin/deptintroupdate', 'SiteadminController@deptintroupdate')->name('webadmin.deptintroupdate')->middleware('auth');
	Route::get('/webadmin/deptintrodestroy/{id}', 'SiteadminController@deptintrodestroy')->middleware('auth');
	Route::get('/webadmin/deptintrostatus/{id}', 'SiteadminController@deptintrostatus')->middleware('auth');



	/* What's News */
	Route::get('/webadmin/whatisnewlist', 'SiteadminController@whatisnewlist')->name('webadmin.whatisnewlist')->middleware('auth');
	
	Route::post('/webadmin/whatisnewstore','SiteadminController@whatisnewstore')->name('webadmin.whatisnewstore')->middleware('auth');
	Route::get('/webadmin/whatisnewedit/{id}', 'SiteadminController@whatisnewedit')->middleware('auth');
	Route::post('/webadmin/whatisnewupdate', 'SiteadminController@whatisnewupdate')->name('webadmin.whatisnewupdate')->middleware('auth');
	Route::get('/webadmin/whatisnewdestroy/{id}', 'SiteadminController@whatisnewdestroy')->middleware('auth');
	Route::get('/webadmin/whatisnewstatus/{id}', 'SiteadminController@whatisnewstatus')->middleware('auth');


   /* Main Menu */
	Route::get('/webadmin/mainmenulist', 'SiteadminController@mainmenulist')->name('webadmin.mainmenulist')->middleware('auth');
	Route::get('webadmin/mainmenucreate','SiteadminController@mainmenucreate')->name('webadmin.mainmenucreate')->middleware('auth');
	Route::post('/webadmin/mainmenustore','SiteadminController@mainmenustore')->name('webadmin.mainmenustore')->middleware('auth');
	Route::get('/webadmin/mainmenuedit/{id}', 'SiteadminController@mainmenuedit')->middleware('auth');
	Route::post('/webadmin/mainmenuupdate', 'SiteadminController@mainmenuupdate')->name('webadmin.mainmenuupdate')->middleware('auth');
	Route::get('/webadmin/mainmenudestroy/{id}', 'SiteadminController@mainmenudestroy')->middleware('auth');
	Route::get('/webadmin/mainmenustatus/{id}', 'SiteadminController@mainmenustatus')->middleware('auth');


	/* Sub Menu */
	Route::get('/webadmin/submenulist', 'SiteadminController@submenulist')->name('webadmin.submenulist')->middleware('auth');
	Route::get('webadmin/submenucreate','SiteadminController@submenucreate')->name('webadmin.submenucreate')->middleware('auth');
	Route::post('/webadmin/submenustore','SiteadminController@submenustore')->name('webadmin.submenustore')->middleware('auth');
	Route::get('/webadmin/submenuedit/{id}', 'SiteadminController@submenuedit')->middleware('auth');
	Route::post('/webadmin/submenuupdate', 'SiteadminController@submenuupdate')->name('webadmin.submenuupdate')->middleware('auth');
	Route::get('/webadmin/submenudestroy/{id}', 'SiteadminController@submenudestroy')->middleware('auth');
	Route::get('/webadmin/submenustatus/{id}', 'SiteadminController@submenustatus')->middleware('auth');
	
	
	/* Contact us */
	Route::get('/webadmin/contactuslist', 'SiteadminController@contactuslist')->name('webadmin.contactuslist')->middleware('auth');
	Route::post('/webadmin/contactusstore','SiteadminController@contactusstore')->name('webadmin.contactusstore')->middleware('auth');
	Route::get('/webadmin/contactusedit/{id}', 'SiteadminController@contactusedit')->middleware('auth');
	Route::post('/webadmin/contactusupdate', 'SiteadminController@contactusupdate')->name('webadmin.contactusupdate')->middleware('auth');
	Route::get('/webadmin/contactusdestroy/{id}', 'SiteadminController@contactusdestroy')->middleware('auth');
	Route::get('/webadmin/contactusstatus/{id}', 'SiteadminController@contactusstatus')->middleware('auth');
	
	/* Archive policy */
	Route::get('/webadmin/archivepolicylist', 'SiteadminController@archivepolicylist')->name('webadmin.archivepolicylist')->middleware('auth');
	Route::post('/webadmin/archivepolicystore','SiteadminController@archivepolicystore')->name('webadmin.archivepolicystore')->middleware('auth');
	Route::get('/webadmin/archivepolicyedit/{id}', 'SiteadminController@archivepolicyedit')->middleware('auth');
	Route::post('/webadmin/archivepolicyupdate', 'SiteadminController@archivepolicyupdate')->name('webadmin.archivepolicyupdate')->middleware('auth');
	Route::get('/webadmin/archivepolicydestroy/{id}', 'SiteadminController@archivepolicydestroy')->middleware('auth');
	Route::get('/webadmin/archivepolicystatus/{id}', 'SiteadminController@archivepolicystatus')->middleware('auth');

	/* Support centers */
	Route::get('/webadmin/supportcenterlist', 'SiteadminController@supportcenterlist')->name('webadmin.supportcenterlist')->middleware('auth');
	Route::post('/webadmin/supportcenterstore','SiteadminController@supportcenterstore')->name('webadmin.supportcenterstore')->middleware('auth');
	Route::get('/webadmin/supportcenteredit/{id}', 'SiteadminController@supportcenteredit')->middleware('auth');
	Route::post('/webadmin/supportcenterupdate', 'SiteadminController@supportcenterupdate')->name('webadmin.supportcenterupdate')->middleware('auth');
	Route::get('/webadmin/supportcenterdestroy/{id}', 'SiteadminController@supportcenterdestroy')->middleware('auth');
	Route::get('/webadmin/supportcenterstatus/{id}', 'SiteadminController@supportcenterstatus')->middleware('auth');

	/*Help*/

	Route::get('/webadmin/helplist', 'SiteadminController@helplist')->name('webadmin.helplist')->middleware('auth');
	Route::post('/webadmin/helpstore','SiteadminController@helpstore')->name('webadmin.helpstore')->middleware('auth');
	Route::get('/webadmin/helpedit/{id}', 'SiteadminController@helpedit')->middleware('auth');
	Route::post('/webadmin/helpupdate', 'SiteadminController@helpupdate')->name('webadmin.helpupdate')->middleware('auth');
	Route::get('/webadmin/helpdestroy/{id}', 'SiteadminController@helpdestroy')->middleware('auth');
	Route::get('/webadmin/helpstatus/{id}', 'SiteadminController@helpstatus')->middleware('auth');
	
	/*  Guidelines  */

	Route::get('/webadmin/guidelinelist', 'SiteadminController@guidelinelist')->name('webadmin.guidelinelist')->middleware('auth');
	Route::post('/webadmin/guidelinestore','SiteadminController@guidelinestore')->name('webadmin.guidelinestore')->middleware('auth');
	Route::get('/webadmin/guidelineedit/{id}', 'SiteadminController@guidelineedit')->middleware('auth');
	Route::post('/webadmin/guidelineupdate', 'SiteadminController@guidelineupdate')->name('webadmin.guidelineupdate')->middleware('auth');
	Route::get('/webadmin/guidelinedestroy/{id}', 'SiteadminController@guidelinedestroy')->middleware('auth');
	Route::get('/siteadmin/guidelinestatus/{id}', 'SiteadminController@guidelinestatus')->middleware('auth');
	
	/*   Service Info  */

	Route::get('/webadmin/serviceinfolist', 'SiteadminController@serviceinfolist')->name('webadmin.serviceinfolist')->middleware('auth');
	Route::post('/webadmin/serviceinfostore','SiteadminController@serviceinfostore')->name('webadmin.serviceinfostore')->middleware('auth');
	Route::get('/webadmin/serviceinfoedit/{id}', 'SiteadminController@serviceinfoedit')->middleware('auth');
	Route::post('/webadmin/serviceinfoupdate', 'SiteadminController@serviceinfoupdate')->name('webadmin.serviceinfoupdate')->middleware('auth');
	Route::get('/webadmin/serviceinfodestroy/{id}', 'SiteadminController@serviceinfodestroy')->middleware('auth');
	Route::get('/webadmin/serviceinfostatus/{id}', 'SiteadminController@serviceinfostatus')->middleware('auth');


	/*   Address with Map  */

	Route::get('/webadmin/addresswithmaplist', 'SiteadminController@addresswithmaplist')->name('webadmin.addresswithmaplist')->middleware('auth');
	Route::post('/webadmin/addresswithmapstore','SiteadminController@addresswithmapstore')->name('webadmin.addresswithmapstore')->middleware('auth');
	Route::get('/webadmin/addresswithmapedit/{id}', 'SiteadminController@addresswithmapedit')->middleware('auth');
	Route::post('/webadmin/addresswithmapupdate', 'SiteadminController@addresswithmapupdate')->name('webadmin.addresswithmapupdate')->middleware('auth');
	Route::get('/webadmin/addresswithmapdestroy/{id}', 'SiteadminController@addresswithmapdestroy')->middleware('auth');
	Route::get('/webadmin/addresswithmapstatus/{id}', 'SiteadminController@addresswithmapstatus')->middleware('auth');

	

	/*   Site compatibility info  */

	Route::get('/webadmin/sitecompinfolist', 'SiteadminController@sitecompinfolist')->name('webadmin.sitecompinfolist')->middleware('auth');
	Route::post('/webadmin/sitecompinfostore','SiteadminController@sitecompinfostore')->name('webadmin.sitecompinfostore')->middleware('auth');
	Route::get('/webadmin/sitecompinfoedit/{id}', 'SiteadminController@sitecompinfoedit')->middleware('auth');
	Route::post('/webadmin/sitecompinfoupdate', 'SiteadminController@sitecompinfoupdate')->name('webadmin.sitecompinfoupdate')->middleware('auth');
	Route::get('/webadmin/sitecompinfodestroy/{id}', 'SiteadminController@sitecompinfodestroy')->middleware('auth');
	Route::get('/webadmin/sitecompinfostatus/{id}', 'SiteadminController@sitecompinfostatus')->middleware('auth');

	/*   Digital info  */

	Route::get('/webadmin/digitalinfolist', 'SiteadminController@digitalinfolist')->name('webadmin.digitalinfolist')->middleware('auth');
	Route::post('/webadmin/digitalinfostore','SiteadminController@digitalinfostore')->name('webadmin.digitalinfostore')->middleware('auth');
	Route::get('/webadmin/digitalinfoedit/{id}', 'SiteadminController@digitalinfoedit')->middleware('auth');
	Route::post('/webadmin/digitalinfoupdate', 'SiteadminController@digitalinfoupdate')->name('webadmin.digitalinfoupdate')->middleware('auth');
	Route::get('/webadmin/digitalinfodestroy/{id}', 'SiteadminController@digitalinfodestroy')->middleware('auth');
	Route::get('/webadmin/digitalinfostatus/{id}', 'SiteadminController@digitalinfostatus')->middleware('auth');


	

	/*   Copyright policy */

	Route::get('/webadmin/copyrightpolicylist', 'SiteadminController@copyrightpolicylist')->name('webadmin.copyrightpolicylist')->middleware('auth');
	Route::post('/webadmin/copyrightpolicystore','SiteadminController@copyrightpolicystore')->name('webadmin.copyrightpolicystore')->middleware('auth');
	Route::get('/webadmin/copyrightpolicyedit/{id}', 'SiteadminController@copyrightpolicyedit')->middleware('auth');
	Route::post('/webadmin/copyrightpolicyupdate', 'SiteadminController@copyrightpolicyupdate')->name('webadmin.copyrightpolicyupdate')->middleware('auth');
	Route::get('/webadmin/copyrightpolicydestroy/{id}', 'SiteadminController@copyrightpolicydestroy')->middleware('auth');
	Route::get('/webadmin/copyrightpolicystatus/{id}', 'SiteadminController@copyrightpolicystatus')->middleware('auth');


	/*   Hyperlink  policy */

	Route::get('/webadmin/hyperlinkpolicylist', 'SiteadminController@hyperlinkpolicylist')->name('webadmin.hyperlinkpolicylist')->middleware('auth');
	Route::post('/webadmin/hyperlinkpolicystore','SiteadminController@hyperlinkpolicystore')->name('webadmin.hyperlinkpolicystore')->middleware('auth');
	Route::get('/webadmin/hyperlinkpolicyedit/{id}', 'SiteadminController@hyperlinkpolicyedit')->middleware('auth');
	Route::post('/webadmin/hyperlinkpolicyupdate', 'SiteadminController@hyperlinkpolicyupdate')->name('webadmin.hyperlinkpolicyupdate')->middleware('auth');
	Route::get('/webadmin/hyperlinkpolicydestroy/{id}', 'SiteadminController@hyperlinkpolicydestroy')->middleware('auth');
	Route::get('/webadmin/hyperlinkpolicystatus/{id}', 'SiteadminController@hyperlinkpolicystatus')->middleware('auth');


/*   Privacy Policy  */

	Route::get('/webadmin/privacypolicylist', 'SiteadminController@privacypolicylist')->name('webadmin.privacypolicylist')->middleware('auth');
	Route::post('/webadmin/privacypolicystore','SiteadminController@privacypolicystore')->name('webadmin.privacypolicystore')->middleware('auth');
	Route::get('/webadmin/privacypolicyedit/{id}', 'SiteadminController@privacypolicyedit')->middleware('auth');
	Route::post('/webadmin/privacypolicyupdate', 'SiteadminController@privacypolicyupdate')->name('webadmin.privacypolicyupdate')->middleware('auth');
	Route::get('/webadmin/privacypolicydestroy/{id}', 'SiteadminController@privacypolicydestroy')->middleware('auth');
	Route::get('/webadmin/privacypolicystatus/{id}', 'SiteadminController@privacypolicystatus')->middleware('auth');

	/*   Terms and Conditions  */

	Route::get('/webadmin/termsandconditionlist', 'SiteadminController@termsandconditionlist')->name('webadmin.termsandconditionlist')->middleware('auth');
	Route::post('/webadmin/termsandconditionstore','SiteadminController@termsandconditionstore')->name('webadmin.termsandconditionstore')->middleware('auth');
	Route::get('/webadmin/termsandconditionedit/{id}', 'SiteadminController@termsandconditionedit')->middleware('auth');
	Route::post('/webadmin/termsandconditionupdate', 'SiteadminController@termsandconditionupdate')->name('webadmin.termsandconditionupdate')->middleware('auth');
	Route::get('/webadmin/termsandconditiondestroy/{id}', 'SiteadminController@termsandconditiondestroy')->middleware('auth');
	Route::get('/webadmin/termsandconditionstatus/{id}', 'SiteadminController@termsandconditionstatus')->middleware('auth');
	
	/*   FAQ  */

	Route::get('/webadmin/faqlist', 'SiteadminController@faqlist')->name('webadmin.faqlist')->middleware('auth');
	Route::post('/webadmin/faqstore','SiteadminController@faqstore')->name('webadmin.faqstore')->middleware('auth');
	Route::get('/webadmin/faqedit/{id}', 'SiteadminController@faqedit')->middleware('auth');
	Route::post('/webadmin/faqupdate', 'SiteadminController@faqupdate')->name('webadmin.faqupdate')->middleware('auth');
	Route::get('/webadmin/faqdestroy/{id}', 'SiteadminController@faqdestroy')->middleware('auth');
	Route::get('/webadmin/faqstatus/{id}', 'SiteadminController@faqstatus')->middleware('auth');

	/*   Service Link  */

	Route::get('/webadmin/servicelinklist', 'SiteadminController@servicelinklist')->name('webadmin.servicelinklist')->middleware('auth');
	Route::post('/webadmin/servicelinkstore','SiteadminController@servicelinkstore')->name('webadmin.servicelinkstore')->middleware('auth');
	Route::get('/webadmin/servicelinkedit/{id}', 'SiteadminController@servicelinkedit')->middleware('auth');
	Route::post('/webadmin/servicelinkupdate', 'SiteadminController@servicelinkupdate')->name('webadmin.servicelinkupdate')->middleware('auth');
	Route::get('/webadmin/servicelinkdestroy/{id}', 'SiteadminController@servicelinkdestroy')->middleware('auth');
	Route::get('/webadmin/servicelinkstatus/{id}', 'SiteadminController@servicelinkstatus')->middleware('auth');

/*Change password*/
Route::get('/webadmin/changepasswordview', 'AdminController@changepasswordview')->name('webadmin.changepasswordview')->middleware('auth');
	Route::post('/webadmin/checkoldpassword', 'AdminController@checkoldpassword')->name('webadmin.checkoldpassword')->middleware('auth');
	Route::post('/webadmin/changepasswordaction', 'AdminController@changepasswordaction')->name('webadmin.changepasswordaction')->middleware('auth');

	
});


/*Editor*/

Route::group(['middleware' => ['auth','App\Http\Middleware\Editor']], function()
{
	Route::get('/editor', 'EditorController@editorhome')->name('editorhome')->middleware('auth');
	
	
	Route::get('/editor/downloadlist', 'WebadminController@downloadlist')->name('editor.downloadlist')->middleware('auth');
	Route::get('editor/downloadcreate','WebadminController@downloadcreate')->name('editor.downloadcreate')->middleware('auth');
	Route::post('/editor/downloadstore','WebadminController@downloadstore')->name('editor.downloadstore')->middleware('auth');
	Route::get('/editor/downloadedit/{id}', 'WebadminController@downloadedit')->middleware('auth');
	Route::post('/editor/downloadupdate', 'WebadminController@downloadupdate')->name('editor.downloadupdate')->middleware('auth');
	Route::get('/editor/downloaddestroy/{id}', 'WebadminController@downloaddestroy')->middleware('auth');
	Route::get('/editor/downloadstatus/{id}', 'WebadminController@downloadstatus')->middleware('auth');
	Route::get('/editor/downloadfiletypelist/{id}', 'WebadminController@downloadfiletypelist')->middleware('auth');
	
	
	
	Route::get('/editor/gallerylist', 'WebadminController@gallerylist')->name('editor.gallerylist')->middleware('auth');
	Route::get('editor/gallerycreate','WebadminController@gallerycreate')->name('editor.gallerycreate')->middleware('auth');
	Route::post('/editor/gallerystore','WebadminController@gallerystore')->name('editor.gallerystore')->middleware('auth');
	Route::get('/editor/galleryedit/{id}', 'WebadminController@galleryedit')->middleware('auth');
	Route::post('/editor/galleryupdate', 'WebadminController@galleryupdate')->name('editor.galleryupdate')->middleware('auth');
	Route::get('/editor/gallerydestroy/{id}', 'WebadminController@gallerydestroy')->middleware('auth');
	Route::get('/editor/gallerystatus/{id}', 'WebadminController@gallerystatus')->middleware('auth');



	Route::get('/editor/galleryalbumlist', 'WebadminController@galleryalbumlist')->name('editor.galleryalbumlist')->middleware('auth');
	Route::post('/editor/galleryalbumstore','WebadminController@galleryalbumstore')->name('editor.galleryalbumstore')->middleware('auth');
	Route::get('editor/galleryalbumcreate','WebadminController@galleryalbumcreate')->name('editor.galleryalbumcreate')->middleware('auth');
	Route::get('/editor/galleryalbumedit/{id}', 'WebadminController@galleryalbumedit')->middleware('auth');
	Route::post('/editor/galleryalbumupdate', 'WebadminController@galleryalbumupdate')->name('editor.galleryalbumupdate')->middleware('auth');
	Route::get('/editor/galleryalbumdestroy/{id}', 'WebadminController@galleryalbumdestroy')->middleware('auth');
	Route::get('/editor/galleryalbumstatus/{id}', 'WebadminController@galleryalbumstatus')->middleware('auth');
	
	Route::get('/editor/newsletterlist', 'WebadminController@newsletterlist')->name('editor.newsletterlist')->middleware('auth');
	Route::get('editor/newslettercreate','WebadminController@newslettercreate')->name('editor.newslettercreate')->middleware('auth');
	Route::post('/editor/newsletterstore','WebadminController@newsletterstore')->name('editor.newsletterstore')->middleware('auth');
	Route::get('/editor/newsletteredit/{id}', 'WebadminController@newsletteredit')->middleware('auth');
	Route::post('/editor/newsletterupdate', 'WebadminController@newsletterupdate')->name('editor.newsletterupdate')->middleware('auth');
	Route::get('/editor/newsletterdestroy/{id}', 'WebadminController@newsletterdestroy')->middleware('auth');
	Route::get('/editor/newsletterstatus/{id}', 'WebadminController@newsletterstatus')->middleware('auth');



	Route::get('/editor/newslettervolumelist', 'WebadminController@newslettervolumelist')->name('editor.newslettervolumelist')->middleware('auth');
	Route::get('editor/newslettervolumecreate','WebadminController@newslettervolumecreate')->name('editor.newslettervolumecreate')->middleware('auth');
	Route::post('/editor/newslettervolumestore','WebadminController@newslettervolumestore')->name('editor.newslettervolumestore')->middleware('auth');
	Route::get('/editor/newslettervolumeedit/{id}', 'WebadminController@newslettervolumeedit')->middleware('auth');
	Route::post('/editor/newslettervolumeupdate', 'WebadminController@newslettervolumeupdate')->name('editor.newslettervolumeupdate')->middleware('auth');
	Route::get('/editor/newslettervolumedestroy/{id}', 'WebadminController@newslettervolumedestroy')->middleware('auth');
	Route::get('/editor/newslettervolumestatus/{id}', 'WebadminController@newslettervolumestatus')->middleware('auth');
	Route::get('/editor/newslettervolumefiletypelist/{id}', 'WebadminController@newslettervolumefiletypelist')->middleware('auth');


	Route::get('/editor/articlelist', 'WebadminController@articlelist')->name('editor.articlelist')->middleware('auth');
	Route::get('editor/articlecreate','WebadminController@articlecreate')->name('editor.articlecreate')->middleware('auth');
	Route::post('/editor/articlestore','WebadminController@articlestore')->name('editor.articlestore')->middleware('auth');
	Route::get('/editor/articleedit/{id}', 'WebadminController@articleedit')->middleware('auth');
	Route::get('/editor/articleuplddet/{id}', 'WebadminController@articleuplddet')->middleware('auth');
	Route::post('/editor/articleupdate', 'WebadminController@articleupdate')->name('editor.articleupdate')->middleware('auth');
	Route::get('/editor/articledestroy/{id}', 'WebadminController@articledestroy')->middleware('auth');
	Route::get('/editor/articlestatus/{id}', 'WebadminController@articlestatus')->middleware('auth');



	Route::get('/editor/articleuploadlist', 'WebadminController@articleuploadlist')->name('editor.articleuploadlist')->middleware('auth');
	Route::get('editor/articleuploadcreate','WebadminController@articleuploadcreate')->name('editor.articleuploadcreate')->middleware('auth');
	Route::post('/editor/articleuploadstore','WebadminController@articleuploadstore')->name('editor.articleuploadstore')->middleware('auth');
	Route::get('/editor/articleuploadedit/{id}', 'WebadminController@articleuploadedit')->middleware('auth');
	Route::post('/editor/articleuploadupdate', 'WebadminController@articleuploadupdate')->name('editor.articleuploadupdate')->middleware('auth');
	Route::get('/editor/articleuploaddestroy/{id}', 'WebadminController@articleuploaddestroy')->middleware('auth');
	Route::get('/editor/articleuploadstatus/{id}', 'WebadminController@articleuploadstatus')->middleware('auth');
	Route::get('/editor/articleuploadfiletypelist/{id}', 'WebadminController@articleuploadfiletypelist')->middleware('auth');


	Route::get('/editor/activitylist', 'WebadminController@activitylist')->name('editor.activitylist')->middleware('auth');
	Route::get('editor/activitycreate','WebadminController@activitycreate')->name('editor.activitycreate')->middleware('auth');
	Route::post('/editor/activitystore','WebadminController@activitystore')->name('editor.activitystore')->middleware('auth');
	Route::get('/editor/activityedit/{id}', 'WebadminController@activityedit')->middleware('auth');
	Route::post('/editor/activityupdate', 'WebadminController@activityupdate')->name('editor.activityupdate')->middleware('auth');
	Route::get('/editor/activitydestroy/{id}', 'WebadminController@activitydestroy')->middleware('auth');
	Route::get('/editor/activitystatus/{id}', 'WebadminController@activitystatus')->middleware('auth');

	Route::get('/editor/activityuploadlist', 'WebadminController@activityuploadlist')->name('editor.activityuploadlist')->middleware('auth');
	Route::get('editor/activityuploadcreate','WebadminController@activityuploadcreate')->name('editor.activityuploadcreate')->middleware('auth');
	Route::post('/editor/activityuploadstore','WebadminController@activityuploadstore')->name('editor.activityuploadstore')->middleware('auth');
	Route::get('/editor/activityuploadedit/{id}', 'WebadminController@activityuploadedit')->middleware('auth');
	Route::post('/editor/activityuploadupdate', 'WebadminController@activityuploadupdate')->name('editor.activityuploadupdate')->middleware('auth');
	Route::get('/editor/activityuploaddestroy/{id}', 'WebadminController@activityuploaddestroy')->middleware('auth');
	Route::get('/editor/activityuploadstatus/{id}', 'WebadminController@activityuploadstatus')->middleware('auth');
	Route::get('/editor/activityuploadfiletypelist/{id}', 'WebadminController@activityuploadfiletypelist')->middleware('auth');

	Route::get('/editor/livestreaminglist', 'WebadminController@livestreaminglist')->name('editor.livestreaminglist')->middleware('auth');
	Route::post('/editor/livestreamingstore','WebadminController@livestreamingstore')->name('editor.livestreamingstore')->middleware('auth');
	Route::get('/editor/livestreamingedit/{id}', 'WebadminController@livestreamingedit')->middleware('auth');
	Route::post('/editor/livestreamingupdate', 'WebadminController@livestreamingupdate')->name('editor.livestreamingupdate')->middleware('auth');
	Route::get('/editor/livestreamingdestroy/{id}', 'WebadminController@livestreamingdestroy')->middleware('auth');
	Route::get('/editor/livestreamingstatus/{id}', 'WebadminController@livestreamingstatus')->middleware('auth');



	/*   Short Alert */

	Route::get('/editor/shortalertlist', 'SiteadminController@shortalertlist')->name('editor.shortalertlist')->middleware('auth');
	Route::post('/editor/shortalertstore','SiteadminController@shortalertstore')->name('editor.shortalertstore')->middleware('auth');
	Route::get('/editor/shortalertedit/{id}', 'SiteadminController@shortalertedit')->middleware('auth');
	Route::post('/editor/shortalertupdate', 'SiteadminController@shortalertupdate')->name('editor.shortalertupdate')->middleware('auth');
	Route::get('/editor/shortalertdestroy/{id}', 'SiteadminController@shortalertdestroy')->middleware('auth');
	Route::get('/editor/shortalertstatus/{id}', 'SiteadminController@shortalertstatus')->middleware('auth');


	/*   Long Alert */

	Route::get('/editor/longalertlist', 'SiteadminController@longalertlist')->name('editor.longalertlist')->middleware('auth');
	Route::post('/editor/longalertstore','SiteadminController@longalertstore')->name('editor.longalertstore')->middleware('auth');
	Route::get('/editor/longalertedit/{id}', 'SiteadminController@longalertedit')->middleware('auth');
	Route::post('/editor/longalertupdate', 'SiteadminController@longalertupdate')->name('editor.longalertupdate')->middleware('auth');
	Route::get('/editor/longalertdestroy/{id}', 'SiteadminController@longalertdestroy')->middleware('auth');
	Route::get('/editor/longalertstatus/{id}', 'SiteadminController@longalertstatus')->middleware('auth');


	/*   Media Alert */

	Route::get('/editor/mediaalertlist', 'SiteadminController@mediaalertlist')->name('editor.mediaalertlist')->middleware('auth');
	Route::get('editor/mediaalertcreate','SiteadminController@mediaalertcreate')->name('editor.mediaalertcreate')->middleware('auth');
	Route::post('/editor/mediaalertstore','SiteadminController@mediaalertstore')->name('editor.mediaalertstore')->middleware('auth');
	Route::get('/editor/mediaalertedit/{id}', 'SiteadminController@mediaalertedit')->middleware('auth');
	Route::post('/editor/mediaalertupdate', 'SiteadminController@mediaalertupdate')->name('editor.mediaalertupdate')->middleware('auth');
	Route::get('/editor/mediaalertdestroy/{id}', 'SiteadminController@mediaalertdestroy')->middleware('auth');
	Route::get('/editor/mediaalertstatus/{id}', 'SiteadminController@mediaalertstatus')->middleware('auth');
	Route::get('/editor/filetypelist/{id}', 'SiteadminController@filetypelist')->middleware('auth');



	/* About Portal */
	Route::get('/editor/aboutportallist', 'SiteadminController@aboutportallist')->name('editor.aboutportallist')->middleware('auth');
	Route::post('/editor/aboutportalstore','SiteadminController@aboutportalstore')->name('editor.aboutportalstore')->middleware('auth');
	Route::get('/editor/aboutportaledit/{id}', 'SiteadminController@aboutportaledit')->middleware('auth');
	Route::post('/editor/aboutportalupdate', 'SiteadminController@aboutportalupdate')->name('editor.aboutportalupdate')->middleware('auth');
	Route::get('/editor/aboutportaldestroy/{id}', 'SiteadminController@aboutportaldestroy')->middleware('auth');
	Route::get('/editor/aboutportalstatus/{id}', 'SiteadminController@aboutportalstatus')->middleware('auth');



	/* About Department */
	Route::get('/editor/aboutdepartmentlist', 'SiteadminController@aboutdepartmentlist')->name('editor.aboutdepartmentlist')->middleware('auth');
	Route::post('/editor/aboutdepartmentstore','SiteadminController@aboutdepartmentstore')->name('editor.aboutdepartmentstore')->middleware('auth');
	Route::get('/editor/aboutdepartmentedit/{id}', 'SiteadminController@aboutdepartmentedit')->middleware('auth');
	Route::post('/editor/aboutdepartmentupdate', 'SiteadminController@aboutdepartmentupdate')->name('editor.aboutdepartmentupdate')->middleware('auth');
	Route::get('/editor/aboutdepartmentdestroy/{id}', 'SiteadminController@aboutdepartmentdestroy')->middleware('auth');
	Route::get('/editor/aboutdepartmentstatus/{id}', 'SiteadminController@aboutdepartmentstatus')->middleware('auth');



	/*   Department Introduction  */

	Route::get('/editor/deptintrolist', 'SiteadminController@deptintrolist')->name('editor.deptintrolist')->middleware('auth');
	Route::get('editor/deptintrocreate','SiteadminController@deptintrocreate')->name('editor.deptintrocreate')->middleware('auth');
	Route::post('/editor/deptintrostore','SiteadminController@deptintrostore')->name('editor.deptintrostore')->middleware('auth');
	Route::get('/editor/deptintroedit/{id}', 'SiteadminController@deptintroedit')->middleware('auth');
	Route::post('/editor/deptintroupdate', 'SiteadminController@deptintroupdate')->name('editor.deptintroupdate')->middleware('auth');
	Route::get('/editor/deptintrodestroy/{id}', 'SiteadminController@deptintrodestroy')->middleware('auth');
	Route::get('/editor/deptintrostatus/{id}', 'SiteadminController@deptintrostatus')->middleware('auth');


	/* What's News */
	Route::get('/editor/whatisnewlist', 'SiteadminController@whatisnewlist')->name('editor.whatisnewlist')->middleware('auth');
	
	Route::post('/editor/whatisnewstore','SiteadminController@whatisnewstore')->name('editor.whatisnewstore')->middleware('auth');
	Route::get('/editor/whatisnewedit/{id}', 'SiteadminController@whatisnewedit')->middleware('auth');
	Route::post('/editor/whatisnewupdate', 'SiteadminController@whatisnewupdate')->name('editor.whatisnewupdate')->middleware('auth');
	Route::get('/editor/whatisnewdestroy/{id}', 'SiteadminController@whatisnewdestroy')->middleware('auth');
	Route::get('/editor/whatisnewstatus/{id}', 'SiteadminController@whatisnewstatus')->middleware('auth');
    
    /*Change password*/
    Route::get('/editor/changepasswordview', 'AdminController@changepasswordview')->name('editor.changepasswordview')->middleware('auth');
	Route::post('/editor/checkoldpassword', 'AdminController@checkoldpassword')->name('editor.checkoldpassword')->middleware('auth');
	Route::post('/editor/changepasswordaction', 'AdminController@changepasswordaction')->name('editor.changepasswordaction')->middleware('auth');


});

Route::group(['middleware' => ['auth','App\Http\Middleware\Deptasst']], function()
{
	Route::get('/deptasst', 'DeptasstController@deptassthome')->name('deptassthome')->middleware('auth');


	Route::get('/deptasst/appdepartmentlist', 'DeptasstController@appdepartmentlist')->name('deptasst.appdepartmentlist')->middleware('auth');
	Route::post('/deptasst/appdepartmentstore','DeptasstController@appdepartmentstore')->name('deptasst.appdepartmentstore')->middleware('auth');
	Route::post('/deptasst/appdepartmentupdate', 'DeptasstController@appdepartmentupdate')->name('deptasst.appdepartmentupdate')->middleware('auth');
	Route::get('/deptasst/appsectionrevertedlist', 'DeptasstController@appsectionrevertedlist')->name('deptasst.appsectionrevertedlist')->middleware('auth');
	
	
	
	
	Route::get('/deptasst/appsectionlist', 'WebadminController@appsectionlist')->name('deptasst.appsectionlist')->middleware('auth');
	Route::get('deptasst/appsectioncreate','WebadminController@appsectioncreate')->name('deptasst.appsectioncreate')->middleware('auth');
	Route::post('/deptasst/appsectionstore','WebadminController@appsectionstore')->name('deptasst.appsectionstore')->middleware('auth');
	Route::get('/deptasst/appsectionedit/{id}', 'WebadminController@appsectionedit')->middleware('auth');
	Route::post('/deptasst/appsectionupdate', 'WebadminController@appsectionupdate')->name('deptasst.appsectionupdate')->middleware('auth');
	Route::get('/deptasst/appsectiondestroy/{id}', 'WebadminController@appsectiondestroy')->middleware('auth');
	Route::get('/deptasst/appsectionstatus/{id}', 'WebadminController@appsectionstatus')->middleware('auth');
	

	 /*Change password*/
	 Route::get('/deptasst/changepasswordview', 'AdminController@changepasswordview')->name('deptasst.changepasswordview')->middleware('auth');
	Route::post('/deptasst/checkoldpassword', 'AdminController@checkoldpassword')->name('deptasst.checkoldpassword')->middleware('auth');
	Route::post('/deptasst/changepasswordaction', 'AdminController@changepasswordaction')->name('deptasst.changepasswordaction')->middleware('auth');
});


Route::group(['middleware' => ['auth','App\Http\Middleware\Photoeditor']], function()
{

	Route::get('/photoeditor', 'PhotoeditorController@photoeditorhome')->name('photoeditorhome')->middleware('auth');


	Route::get('/photoeditor/downloadlist', 'WebadminController@downloadlist')->name('photoeditor.downloadlist')->middleware('auth');
	Route::get('photoeditor/downloadcreate','WebadminController@downloadcreate')->name('photoeditor.downloadcreate')->middleware('auth');
	Route::post('/photoeditor/downloadstore','WebadminController@downloadstore')->name('photoeditor.downloadstore')->middleware('auth');
	Route::get('/photoeditor/downloadedit/{id}', 'WebadminController@downloadedit')->middleware('auth');
	Route::post('/photoeditor/downloadupdate', 'WebadminController@downloadupdate')->name('photoeditor.downloadupdate')->middleware('auth');
	Route::get('/photoeditor/downloaddestroy/{id}', 'WebadminController@downloaddestroy')->middleware('auth');
	Route::get('/photoeditor/downloadstatus/{id}', 'WebadminController@downloadstatus')->middleware('auth');
	Route::get('/photoeditor/downloadfiletypelist/{id}', 'WebadminController@downloadfiletypelist')->middleware('auth');


	Route::get('/photoeditor/gallerylist', 'WebadminController@gallerylist')->name('photoeditor.gallerylist')->middleware('auth');
	Route::get('photoeditor/gallerycreate','WebadminController@gallerycreate')->name('photoeditor.gallerycreate')->middleware('auth');
	Route::post('/photoeditor/gallerystore','WebadminController@gallerystore')->name('photoeditor.gallerystore')->middleware('auth');
	Route::get('/photoeditor/galleryedit/{id}', 'WebadminController@galleryedit')->middleware('auth');
	Route::post('/photoeditor/galleryupdate', 'WebadminController@galleryupdate')->name('photoeditor.galleryupdate')->middleware('auth');
	Route::get('/photoeditor/gallerydestroy/{id}', 'WebadminController@gallerydestroy')->middleware('auth');
	Route::get('/photoeditor/gallerystatus/{id}', 'WebadminController@gallerystatus')->middleware('auth');

	Route::get('/photoeditor/galleryalbumlist', 'WebadminController@galleryalbumlist')->name('photoeditor.galleryalbumlist')->middleware('auth');
	Route::post('/photoeditor/galleryalbumstore','WebadminController@galleryalbumstore')->name('photoeditor.galleryalbumstore')->middleware('auth');
	Route::get('photoeditor/galleryalbumcreate','WebadminController@galleryalbumcreate')->name('photoeditor.galleryalbumcreate')->middleware('auth');
	Route::get('/photoeditor/galleryalbumedit/{id}', 'WebadminController@galleryalbumedit')->middleware('auth');
	Route::post('/photoeditor/galleryalbumupdate', 'WebadminController@galleryalbumupdate')->name('photoeditor.galleryalbumupdate')->middleware('auth');
	Route::get('/photoeditor/galleryalbumdestroy/{id}', 'WebadminController@galleryalbumdestroy')->middleware('auth');
	Route::get('/photoeditor/galleryalbumstatus/{id}', 'WebadminController@galleryalbumstatus')->middleware('auth');


	Route::get('/photoeditor/newsletterlist', 'WebadminController@newsletterlist')->name('photoeditor.newsletterlist')->middleware('auth');
	Route::get('photoeditor/newslettercreate','WebadminController@newslettercreate')->name('photoeditor.newslettercreate')->middleware('auth');
	Route::post('/photoeditor/newsletterstore','WebadminController@newsletterstore')->name('photoeditor.newsletterstore')->middleware('auth');
	Route::get('/photoeditor/newsletteredit/{id}', 'WebadminController@newsletteredit')->middleware('auth');
	Route::post('/photoeditor/newsletterupdate', 'WebadminController@newsletterupdate')->name('photoeditor.newsletterupdate')->middleware('auth');
	Route::get('/photoeditor/newsletterdestroy/{id}', 'WebadminController@newsletterdestroy')->middleware('auth');
	Route::get('/photoeditor/newsletterstatus/{id}', 'WebadminController@newsletterstatus')->middleware('auth');



	Route::get('/photoeditor/newslettervolumelist', 'WebadminController@newslettervolumelist')->name('photoeditor.newslettervolumelist')->middleware('auth');
	Route::get('photoeditor/newslettervolumecreate','WebadminController@newslettervolumecreate')->name('photoeditor.newslettervolumecreate')->middleware('auth');
	Route::post('/photoeditor/newslettervolumestore','WebadminController@newslettervolumestore')->name('photoeditor.newslettervolumestore')->middleware('auth');
	Route::get('/photoeditor/newslettervolumeedit/{id}', 'WebadminController@newslettervolumeedit')->middleware('auth');
	Route::post('/photoeditor/newslettervolumeupdate', 'WebadminController@newslettervolumeupdate')->name('photoeditor.newslettervolumeupdate')->middleware('auth');
	Route::get('/photoeditor/newslettervolumedestroy/{id}', 'WebadminController@newslettervolumedestroy')->middleware('auth');
	Route::get('/photoeditor/newslettervolumestatus/{id}', 'WebadminController@newslettervolumestatus')->middleware('auth');
	Route::get('/photoeditor/newslettervolumefiletypelist/{id}', 'WebadminController@newslettervolumefiletypelist')->middleware('auth');



	Route::get('/photoeditor/articleuploadlist', 'WebadminController@articleuploadlist')->name('photoeditor.articleuploadlist')->middleware('auth');
	Route::get('photoeditor/articleuploadcreate','WebadminController@articleuploadcreate')->name('photoeditor.articleuploadcreate')->middleware('auth');
	Route::post('/photoeditor/articleuploadstore','WebadminController@articleuploadstore')->name('photoeditor.articleuploadstore')->middleware('auth');
	Route::get('/photoeditor/articleuploadedit/{id}', 'WebadminController@articleuploadedit')->middleware('auth');
	Route::post('/photoeditor/articleuploadupdate', 'WebadminController@articleuploadupdate')->name('photoeditor.articleuploadupdate')->middleware('auth');
	Route::get('/photoeditor/articleuploaddestroy/{id}', 'WebadminController@articleuploaddestroy')->middleware('auth');
	Route::get('/photoeditor/articleuploadstatus/{id}', 'WebadminController@articleuploadstatus')->middleware('auth');
	Route::get('/photoeditor/articleuploadfiletypelist/{id}', 'WebadminController@articleuploadfiletypelist')->middleware('auth');


	Route::get('/photoeditor/activityuploadlist', 'WebadminController@activityuploadlist')->name('photoeditor.activityuploadlist')->middleware('auth');
	Route::get('photoeditor/activityuploadcreate','WebadminController@activityuploadcreate')->name('photoeditor.activityuploadcreate')->middleware('auth');
	Route::post('/photoeditor/activityuploadstore','WebadminController@activityuploadstore')->name('photoeditor.activityuploadstore')->middleware('auth');
	Route::get('/photoeditor/activityuploadedit/{id}', 'WebadminController@activityuploadedit')->middleware('auth');
	Route::post('/photoeditor/activityuploadupdate', 'WebadminController@activityuploadupdate')->name('photoeditor.activityuploadupdate')->middleware('auth');
	Route::get('/photoeditor/activityuploaddestroy/{id}', 'WebadminController@activityuploaddestroy')->middleware('auth');
	Route::get('/photoeditor/activityuploadstatus/{id}', 'WebadminController@activityuploadstatus')->middleware('auth');
	Route::get('/photoeditor/activityuploadfiletypelist/{id}', 'WebadminController@activityuploadfiletypelist')->middleware('auth');

	 /*Change password*/
	 Route::get('/photoeditor/changepasswordview', 'AdminController@changepasswordview')->name('photoeditor.changepasswordview')->middleware('auth');
	Route::post('/photoeditor/checkoldpassword', 'AdminController@checkoldpassword')->name('photoeditor.checkoldpassword')->middleware('auth');
	Route::post('/photoeditor/changepasswordaction', 'AdminController@changepasswordaction')->name('photoeditor.changepasswordaction')->middleware('auth');


});

/*App Manager*/

Route::group(['middleware' => ['auth','App\Http\Middleware\Appmanager']], function()
{
	Route::get('/appmanager', 'AppmanagerController@appmanagerhome')->name('appmanagerhome')->middleware('auth');


	Route::get('/appmanager/stafflist', 'AppadminController@stafflist')->name('appmanager.stafflist')->middleware('auth');
	Route::get('appmanager/staffcreate','AppadminController@staffcreate')->name('appmanager.staffcreate')->middleware('auth');
	Route::post('/appmanager/staffstore','AppadminController@staffstore')->name('appmanager.staffstore')->middleware('auth');
	Route::get('/appmanager/staffedit/{id}', 'AppadminController@staffedit')->middleware('auth');
	Route::post('/appmanager/staffupdate', 'AppadminController@staffupdate')->name('appmanager.staffupdate')->middleware('auth');
	Route::get('/appmanager/staffdestroy/{id}', 'AppadminController@staffdestroy')->middleware('auth');
	Route::get('/appmanager/staffstatus/{id}', 'AppadminController@staffstatus')->middleware('auth');

	Route::get('/appmanager/committeelist', 'AppadminController@committeelist')->name('appmanager.committeelist')->middleware('auth');
	Route::post('/appmanager/committeestore','AppadminController@committeestore')->name('appmanager.committeestore')->middleware('auth');
	Route::get('/appmanager/committeeedit/{id}', 'AppadminController@committeeedit')->middleware('auth');
	Route::post('/appmanager/committeeupdate', 'AppadminController@committeeupdate')->name('appmanager.committeeupdate')->middleware('auth');
	Route::get('/appmanager/committeedestroy/{id}', 'AppadminController@committeedestroy')->middleware('auth');
	Route::get('/appmanager/committeestatus/{id}', 'AppadminController@committeestatus')->middleware('auth');
	

	Route::get('/appmanager/staffcommitteelist', 'AppadminController@staffcommitteelist')->name('appmanager.staffcommitteelist')->middleware('auth');
	Route::get('appmanager/staffcommitteecreate','AppadminController@staffcommitteecreate')->name('appmanager.staffcommitteecreate')->middleware('auth');
	Route::post('/appmanager/staffcommitteestore','AppadminController@staffcommitteestore')->name('appmanager.staffcommitteestore')->middleware('auth');
	Route::get('/appmanager/staffcommitteedestroy/{id}', 'AppadminController@staffcommitteedestroy')->middleware('auth');
	Route::get('/appmanager/staffcommitteestatus/{id}', 'AppadminController@staffcommitteestatus')->middleware('auth');

	
	Route::get('/appmanager/communicationlist', 'AppadminController@communicationlist')->name('appmanager.communicationlist')->middleware('auth');
	Route::get('appmanager/communicationcreate','AppadminController@communicationcreate')->name('appmanager.communicationcreate')->middleware('auth');
	Route::post('/appmanager/communicationstore','AppadminController@communicationstore')->name('appmanager.communicationstore')->middleware('auth');
	Route::get('/appmanager/communicationdestroy/{id}', 'AppadminController@communicationdestroy')->middleware('auth');
	Route::get('/appmanager/communicationstatus/{id}', 'AppadminController@communicationstatus')->middleware('auth');
	Route::post('appmanager/storecommunicationimg', 'AppadminController@storecommunicationimg')->name('appmanager.storecommunicationimg')->middleware('auth');


	/*Route::get('SentMail','AppadminController@SentMail');*/

	 /*Change password*/
	 Route::get('/appmanager/changepasswordview', 'AdminController@changepasswordview')->name('appmanager.changepasswordview')->middleware('auth');
	Route::post('/appmanager/checkoldpassword', 'AdminController@checkoldpassword')->name('appmanager.checkoldpassword')->middleware('auth');
	Route::post('/appmanager/changepasswordaction', 'AdminController@changepasswordaction')->name('appmanager.changepasswordaction')->middleware('auth');

});

/*App Client*/

Route::group(['middleware' => ['auth','App\Http\Middleware\Appclient']], function()
{
	Route::get('/appclient', 'AppclientController@appclienthome')->name('appclienthome')->middleware('auth');

	
	Route::get('/appclient/communicationlist', 'AppadminController@communicationlist')->name('appclient.communicationlist')->middleware('auth');
	Route::get('appclient/communicationcreate','AppadminController@communicationcreate')->name('appclient.communicationcreate')->middleware('auth');
	Route::post('/appclient/communicationstore','AppadminController@communicationstore')->name('appclient.communicationstore')->middleware('auth');
	Route::get('/appclient/communicationdestroy/{id}', 'AppadminController@communicationdestroy')->middleware('auth');
	Route::get('/appclient/communicationstatus/{id}', 'AppadminController@communicationstatus')->middleware('auth');
	Route::post('appclient/storecommunicationimg', 'AppadminController@storecommunicationimg')->name('appclient.storecommunicationimg')->middleware('auth');


	/*Route::get('SentMail','AppadminController@SentMail');*/

	 /*Change password*/
	 Route::get('/appclient/changepasswordview', 'AdminController@changepasswordview')->name('appclient.changepasswordview')->middleware('auth');
	Route::post('/appclient/checkoldpassword', 'AdminController@checkoldpassword')->name('appclient.checkoldpassword')->middleware('auth');
	Route::post('/appclient/changepasswordaction', 'AdminController@changepasswordaction')->name('appclient.changepasswordaction')->middleware('auth');

});


/*Moderator*/

Route::group(['middleware' => ['auth','App\Http\Middleware\Moderator']], function()
{

	Route::get('/moderator', 'ModeratorController@moderatorhome')->name('moderatorhome')->middleware('auth');

	Route::get('/moderator/contributeditems/{val}', 'ModeratorController@contributeditems')->name('moderator.contributeditems')->middleware('auth');



	Route::get('/moderator/contributedactivitieslist/{val}', 'ModeratorController@contributedactivitieslist')->name('moderator.contributedactivitieslist')->middleware('auth');
	Route::get('/moderator/contributedactverify/{id}', 'ModeratorController@contributedactverify')->middleware('auth');
	Route::post('/moderator/contributedactupdate', 'ModeratorController@contributedactupdate')->name('moderator.contributedactupdate')->middleware('auth');


	Route::get('/moderator/contributedarticleslist/{val}', 'ModeratorController@contributedarticleslist')->name('moderator.contributedarticleslist')->middleware('auth');
	Route::get('/moderator/contributedartverify/{id}', 'ModeratorController@contributedartverify')->middleware('auth');
	Route::post('/moderator/contributedartupdate', 'ModeratorController@contributedartupdate')->name('moderator.contributedartupdate')->middleware('auth');


	Route::get('/moderator/contributedgallerieslist/{val}', 'ModeratorController@contributedgallerieslist')->name('moderator.contributedgallerieslist')->middleware('auth');
	Route::get('/moderator/contributedgallverify/{id}', 'ModeratorController@contributedgallverify')->middleware('auth');
	Route::post('/moderator/contributedgallupdate', 'ModeratorController@contributedgallupdate')->name('moderator.contributedgallupdate')->middleware('auth');


	Route::get('/moderator/contributednewsletterlist/{val}', 'ModeratorController@contributednewsletterlist')->name('moderator.contributednewsletterlist')->middleware('auth');
	Route::get('/moderator/contributednewsverify/{id}', 'ModeratorController@contributednewsverify')->middleware('auth');
	Route::post('/moderator/contributednewsupdate', 'ModeratorController@contributednewsupdate')->name('moderator.contributednewsupdate')->middleware('auth');


	Route::get('/moderator/contributedshortalertlist/{val}', 'ModeratorController@contributedshortalertlist')->name('moderator.contributedshortalertlist')->middleware('auth');
	Route::get('/moderator/contributedshortverify/{id}', 'ModeratorController@contributedshortverify')->middleware('auth');
	Route::post('/moderator/contributedshortupdate', 'ModeratorController@contributedshortupdate')->name('moderator.contributedshortupdate')->middleware('auth');



	Route::get('/moderator/contributedlongalertlist/{val}', 'ModeratorController@contributedlongalertlist')->name('moderator.contributedlongalertlist')->middleware('auth');
	Route::get('/moderator/contributedlongverify/{id}', 'ModeratorController@contributedlongverify')->middleware('auth');
	Route::post('/moderator/contributedlongupdate', 'ModeratorController@contributedlongupdate')->name('moderator.contributedlongupdate')->middleware('auth');


	Route::get('/moderator/contributedmediaalertlist/{val}', 'ModeratorController@contributedmediaalertlist')->name('moderator.contributedmediaalertlist')->middleware('auth');
	Route::get('/moderator/contributedmediaverify/{id}', 'ModeratorController@contributedmediaverify')->middleware('auth');
	Route::post('/moderator/contributedmediaupdate', 'ModeratorController@contributedmediaupdate')->name('moderator.contributedmediaupdate')->middleware('auth');


	Route::get('/moderator/contributedabtportallist/{val}', 'ModeratorController@contributedabtportallist')->name('moderator.contributedabtportallist')->middleware('auth');
	Route::get('/moderator/contributedabtportalverify/{id}', 'ModeratorController@contributedabtportalverify')->middleware('auth');
	Route::post('/moderator/contributedabtportalupdate', 'ModeratorController@contributedabtportalupdate')->name('moderator.contributedabtportalupdate')->middleware('auth');


	Route::get('/moderator/contributedabtdeptlist/{val}', 'ModeratorController@contributedabtdeptlist')->name('moderator.contributedabtdeptlist')->middleware('auth');
	Route::get('/moderator/contributedabtdeptverify/{id}', 'ModeratorController@contributedabtdeptverify')->middleware('auth');
	Route::post('/moderator/contributedabtdeptupdate', 'ModeratorController@contributedabtdeptupdate')->name('moderator.contributedabtdeptupdate')->middleware('auth');


	Route::get('/moderator/contributeddeptintrolist/{val}', 'ModeratorController@contributeddeptintrolist')->name('moderator.contributeddeptintrolist')->middleware('auth');
	Route::get('/moderator/contributeddeptintroverify/{id}', 'ModeratorController@contributeddeptintroverify')->middleware('auth');
	Route::post('/moderator/contributeddeptintroupdate', 'ModeratorController@contributeddeptintroupdate')->name('moderator.contributeddeptintroupdate')->middleware('auth');


	Route::get('/moderator/contributedwhatsnewlist/{val}', 'ModeratorController@contributedwhatsnewlist')->name('moderator.contributedwhatsnewlist')->middleware('auth');
	Route::get('/moderator/contributedwhatsnewverify/{id}', 'ModeratorController@contributedwhatsnewverify')->middleware('auth');
	Route::post('/moderator/contributedwhatsnewupdate', 'ModeratorController@contributedwhatsnewupdate')->name('moderator.contributedwhatsnewupdate')->middleware('auth');


	/*Change password*/
	Route::get('/moderator/changepasswordview', 'AdminController@changepasswordview')->name('moderator.changepasswordview')->middleware('auth');
	Route::post('/moderator/checkoldpassword', 'AdminController@checkoldpassword')->name('moderator.checkoldpassword')->middleware('auth');
	Route::post('/moderator/changepasswordaction', 'AdminController@changepasswordaction')->name('moderator.changepasswordaction')->middleware('auth');



});

/*Publisher*/

Route::group(['middleware' => ['auth','App\Http\Middleware\Publisher']], function()
{

	Route::get('/publisher', 'PublisherController@publisherhome')->name('publisherhome')->middleware('auth');

	Route::get('/publisher/moderateditems/{val}', 'PublisherController@moderateditems')->name('publisher.moderateditems')->middleware('auth');


	Route::get('/publisher/moderatedactivitieslist/{val}', 'PublisherController@moderatedactivitieslist')->name('publisher.moderatedactivitieslist')->middleware('auth');
	Route::get('/publisher/moderatedactapprove/{id}', 'PublisherController@moderatedactapprove')->middleware('auth');
	Route::post('/publisher/moderatedactupdate', 'PublisherController@moderatedactupdate')->name('publisher.moderatedactupdate')->middleware('auth');

	Route::get('/publisher/moderatedarticleslist/{val}', 'PublisherController@moderatedarticleslist')->name('publisher.moderatedarticleslist')->middleware('auth');
	Route::get('/publisher/moderatedartapprove/{id}', 'PublisherController@moderatedartapprove')->middleware('auth');
	Route::post('/publisher/moderatedartupdate', 'PublisherController@moderatedartupdate')->name('publisher.moderatedartupdate')->middleware('auth');

	Route::get('/publisher/moderatedgallerylist/{val}', 'PublisherController@moderatedgallerylist')->name('publisher.moderatedgallerylist')->middleware('auth');
	Route::get('/publisher/moderatedgallapprove/{id}', 'PublisherController@moderatedgallapprove')->middleware('auth');
	Route::post('/publisher/moderatedgallupdate', 'PublisherController@moderatedgallupdate')->name('publisher.moderatedgallupdate')->middleware('auth');


	Route::get('/publisher/moderatednewsletterlist/{val}', 'PublisherController@moderatednewsletterlist')->name('publisher.moderatednewsletterlist')->middleware('auth');
	Route::get('/publisher/moderatednewsapprove/{id}', 'PublisherController@moderatednewsapprove')->middleware('auth');
	Route::post('/publisher/moderatednewsupdate', 'PublisherController@moderatednewsupdate')->name('publisher.moderatednewsupdate')->middleware('auth');


	Route::get('/publisher/moderatedshortalertlist/{val}', 'PublisherController@moderatedshortalertlist')->name('publisher.moderatedshortalertlist')->middleware('auth');
	Route::get('/publisher/moderatedshortapprove/{id}', 'PublisherController@moderatedshortapprove')->middleware('auth');
	Route::post('/publisher/moderatedshortupdate', 'PublisherController@moderatedshortupdate')->name('publisher.moderatedshortupdate')->middleware('auth');


	Route::get('/publisher/moderatedlongalertlist/{val}', 'PublisherController@moderatedlongalertlist')->name('publisher.moderatedlongalertlist')->middleware('auth');
	Route::get('/publisher/moderatedlongapprove/{id}', 'PublisherController@moderatedlongapprove')->middleware('auth');
	Route::post('/publisher/moderatedlongupdate', 'PublisherController@moderatedlongupdate')->name('publisher.moderatedlongupdate')->middleware('auth');


	Route::get('/publisher/moderatedmediaalertlist/{val}', 'PublisherController@moderatedmediaalertlist')->name('publisher.moderatedmediaalertlist')->middleware('auth');
	Route::get('/publisher/moderatedmediaapprove/{id}', 'PublisherController@moderatedmediaapprove')->middleware('auth');
	Route::post('/publisher/moderatedmediaupdate', 'PublisherController@moderatedmediaupdate')->name('publisher.moderatedmediaupdate')->middleware('auth');



	Route::get('/publisher/moderatedabtportallist/{val}', 'PublisherController@moderatedabtportallist')->name('publisher.moderatedabtportallist')->middleware('auth');
	Route::get('/publisher/moderatedabtportalapprove/{id}', 'PublisherController@moderatedabtportalapprove')->middleware('auth');
	Route::post('/publisher/moderatedabtportalupdate', 'PublisherController@moderatedabtportalupdate')->name('publisher.moderatedabtportalupdate')->middleware('auth');


	Route::get('/publisher/moderatedabtdeptlist/{val}', 'PublisherController@moderatedabtdeptlist')->name('publisher.moderatedabtdeptlist')->middleware('auth');
	Route::get('/publisher/moderatedabtdeptapprove/{id}', 'PublisherController@moderatedabtdeptapprove')->middleware('auth');
	Route::post('/publisher/moderatedabtdeptupdate', 'PublisherController@moderatedabtdeptupdate')->name('publisher.moderatedabtdeptupdate')->middleware('auth');


	Route::get('/publisher/moderateddeptintrolist/{val}', 'PublisherController@moderateddeptintrolist')->name('publisher.moderateddeptintrolist')->middleware('auth');
	Route::get('/publisher/moderateddeptintroapprove/{id}', 'PublisherController@moderateddeptintroapprove')->middleware('auth');
	Route::post('/publisher/moderateddeptintroupdate', 'PublisherController@moderateddeptintroupdate')->name('publisher.moderateddeptintroupdate')->middleware('auth');


	Route::get('/publisher/moderatedwhatsnewlist/{val}', 'PublisherController@moderatedwhatsnewlist')->name('publisher.moderatedwhatsnewlist')->middleware('auth');
	Route::get('/publisher/moderatedwhatsnewapprove/{id}', 'PublisherController@moderatedwhatsnewapprove')->middleware('auth');
	Route::post('/publisher/moderatedwhatsnewupdate', 'PublisherController@moderatedwhatsnewupdate')->name('publisher.moderatedwhatsnewupdate')->middleware('auth');


	/*Change password*/
	Route::get('/publisher/changepasswordview', 'AdminController@changepasswordview')->name('publisher.changepasswordview')->middleware('auth');
	Route::post('/publisher/checkoldpassword', 'AdminController@checkoldpassword')->name('publisher.checkoldpassword')->middleware('auth');
	Route::post('/publisher/changepasswordaction', 'AdminController@changepasswordaction')->name('publisher.changepasswordaction')->middleware('auth');

});


/*Live  Streaming*/

Route::group(['middleware' => ['auth','App\Http\Middleware\Livestreaming']], function()
{

	Route::get('/livestreaming', 'LivestreamingController@livestreaminghome')->name('livestreaminghome')->middleware('auth');

	Route::get('/livestreaming/livestreaminglist', 'WebadminController@livestreaminglist')->name('livestreaming.livestreaminglist')->middleware('auth');
	Route::post('/livestreaming/livestreamingstore','WebadminController@livestreamingstore')->name('livestreaming.livestreamingstore')->middleware('auth');
	Route::get('/livestreaming/livestreamingedit/{id}', 'WebadminController@livestreamingedit')->middleware('auth');
	Route::post('/livestreaming/livestreamingupdate', 'WebadminController@livestreamingupdate')->name('livestreaming.livestreamingupdate')->middleware('auth');
	Route::get('/livestreaming/livestreamingdestroy/{id}', 'WebadminController@livestreamingdestroy')->middleware('auth');
	Route::get('/livestreaming/livestreamingstatus/{id}', 'WebadminController@livestreamingstatus')->middleware('auth');


	/*Change password*/
	Route::get('/livestreaming/changepasswordview', 'AdminController@changepasswordview')->name('livestreaming.changepasswordview')->middleware('auth');
	Route::post('/livestreaming/checkoldpassword', 'AdminController@checkoldpassword')->name('livestreaming.checkoldpassword')->middleware('auth');
	Route::post('/livestreaming/changepasswordaction', 'AdminController@changepasswordaction')->name('livestreaming.changepasswordaction')->middleware('auth');

});


/*Department SO*/

Route::group(['middleware' => ['auth','App\Http\Middleware\Deptso']], function()
{
	Route::get('/deptso', 'DeptsoController@deptsohome')->name('deptsohome')->middleware('auth');

	Route::get('/deptso/appdepartment', 'DeptsoController@appdepartment')->name('deptso.appdepartment')->middleware('auth');
	Route::get('/deptso/varifieditems', 'DeptsoController@varifieditems')->name('deptso.varifieditems')->middleware('auth');
	Route::get('/deptso/appdepartmentlist', 'DeptsoController@appdepartmentlist')->name('deptso.appdepartmentlist')->middleware('auth');
	Route::get('/deptso/appdepartmentview/{id}', 'DeptsoController@appdepartmentview')->name('deptso.appdepartmentview')->middleware('auth');
	Route::get('/deptso/appsectionrevert/{id}', 'DeptsoController@appsectionrevert')->name('deptso.appsectionrevert')->middleware('auth');
	Route::get('/deptso/appdepartmentlistaprove', 'DeptsoController@appdepartmentlistaprove')->name('deptso.appdepartmentlistaprove')->middleware('auth');
	Route::post('/deptso/contributedactupdate', 'DeptsoController@contributedactupdate')->name('deptso.contributedactupdate')->middleware('auth');
	
	Route::get('/deptso/appsection', 'DeptsoController@appsection')->name('deptso.appsection')->middleware('auth');
	Route::get('/deptso/appsectionlist', 'DeptsoController@appsectionlist')->name('deptso.appsectionlist')->middleware('auth');
	Route::get('/deptso/appsectionview/{id}', 'DeptsoController@appsectionview')->name('deptso.appsectionview')->middleware('auth');
	Route::get('/deptso/appsectionlistaproved', 'DeptsoController@appsectionlistaproved')->name('deptso.appsectionlistaproved')->middleware('auth');
	Route::post('/deptso/appsectionlistupdate', 'DeptsoController@appsectionlistupdate')->name('deptso.appsectionlistupdate')->middleware('auth');


	/*Change password*/
	Route::get('/deptso/changepasswordview', 'AdminController@changepasswordview')->name('deptso.changepasswordview')->middleware('auth');
	Route::post('/deptso/checkoldpassword', 'AdminController@checkoldpassword')->name('deptso.checkoldpassword')->middleware('auth');
	Route::post('/deptso/changepasswordaction', 'AdminController@changepasswordaction')->name('deptso.changepasswordaction')->middleware('auth');
	
	
});

/*Department Head*/

Route::group(['middleware' => ['auth','App\Http\Middleware\Depthead']], function()
{

	Route::get('/depthead', 'DeptheadController@deptheadhome')->name('deptheadhome')->middleware('auth');

	Route::get('/depthead/appdepartment', 'DeptsoController@appdepartment')->name('depthead.appdepartment')->middleware('auth');
	Route::get('/depthead/varifieditems', 'DeptsoController@varifieditems')->name('depthead.varifieditems')->middleware('auth');
	Route::get('/depthead/appdepartmentlist', 'DeptsoController@appdepartmentlist')->name('depthead.appdepartmentlist')->middleware('auth');
	Route::get('/depthead/appsectionrevert/{id}', 'DeptsoController@appsectionrevert')->name('depthead.appsectionrevert')->middleware('auth');
	Route::get('/depthead/appdepartmentview/{id}', 'DeptsoController@appdepartmentview')->name('depthead.appdepartmentview')->middleware('auth');
	Route::get('/depthead/appdepartmentlistaprove', 'DeptsoController@appdepartmentlistaprove')->name('depthead.appdepartmentlistaprove')->middleware('auth');
	Route::post('/depthead/contributedactupdate', 'DeptsoController@contributedactupdate')->name('depthead.contributedactupdate')->middleware('auth');
	
	Route::get('/depthead/appsection', 'DeptsoController@appsection')->name('depthead.appsection')->middleware('auth');
	Route::get('/depthead/appsectionlist', 'DeptsoController@appsectionlist')->name('depthead.appsectionlist')->middleware('auth');
	Route::get('/depthead/appsectionview/{id}', 'DeptsoController@appsectionview')->name('depthead.appsectionview')->middleware('auth');
	Route::get('/depthead/appsectionlistaproved', 'DeptsoController@appsectionlistaproved')->name('depthead.appsectionlistaproved')->middleware('auth');
	Route::post('/depthead/appsectionlistupdate', 'DeptsoController@appsectionlistupdate')->name('depthead.appsectionlistupdate')->middleware('auth');


	/*Change password*/
	Route::get('/depthead/changepasswordview', 'AdminController@changepasswordview')->name('depthead.changepasswordview')->middleware('auth');
	Route::post('/depthead/checkoldpassword', 'AdminController@checkoldpassword')->name('depthead.checkoldpassword')->middleware('auth');
	Route::post('/depthead/changepasswordaction', 'AdminController@changepasswordaction')->name('depthead.changepasswordaction')->middleware('auth');

});
 