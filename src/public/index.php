<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use LearnPhpMvc\APP\Router;

use LearnPhpMvc\controller\api\AuthentikasiController;
use LearnPhpMvc\controller\api\JenisUsahaControllerApi;
use LearnPhpMvc\controller\api\JurusanControllerApi;
use LearnPhpMvc\controller\api\KategoriControllerApi;
use LearnPhpMvc\controller\api\MagangControllerApi;
use LearnPhpMvc\controller\api\PencariMagangControllerApi;
use LearnPhpMvc\controller\api\PenghargaanControllerApi;
use LearnPhpMvc\controller\api\PenyediaMagangControllerApi;
use LearnPhpMvc\controller\api\SekolahControllerApi;
use LearnPhpMvc\controller\api\SkillController;
use LearnPhpMvc\controller\CompanyController;
use LearnPhpMvc\controller\HomeController;
use LearnPhpMvc\controller\ProductController;
use LearnPhpMvc\controller\LamarController;
use LearnPhpMvc\controller\LoginController;
use LearnPhpMvc\controller\MagangController;
use LearnPhpMvc\controller\PenyediaMagangController;
use LearnPhpMvc\controller\RegisterController;
use LearnPhpMvc\Domain\Role;

//api
Router::add('GET', '/api/test', ProductController::class, 'categories');
Router::add('POST', '/api/add', ProductController::class, 'postCategories');
Router::add('GET', '/api/pencarimagang/all', PencariMagangControllerApi::class, 'findAll');
Router::add('POST', '/api/login', AuthentikasiController::class, 'login');
Router::add('POST', '/api/register', AuthentikasiController::class, 'register');
Router::add('GET', '/api/verivication/{id}', AuthentikasiController::class, 'sendEmail');
Router::add('POST', '/api/mobile/register', AuthentikasiController::class, 'registerMobile');
Router::add("GET", "/api/aktifasi/{username}/{token}", AuthentikasiController::class, 'verivikasiAkun');
Router::add("POST", "/api/findby/username", PencariMagangControllerApi::class, "findByUsername");
Router::add("POST", "/api/search/user", PencariMagangControllerApi::class, "findByUsernameLike");
Router::add("GET", "/api/skill/findAll", SkillController::class, "findAll");
Router::add("POST", "/api/pencarimagang/update/", PencariMagangControllerApi::class, "updatePencariMagang");
Router::add("POST", "/api/skill/add", SkillController::class, "addSkill");
Router::add("POST", "/api/skill/update", SkillController::class, "update");
Router::add("GET", "/api/skill/findById/{id}", SkillController::class, "findById");
Router::add("GET", "/api/pencarimagang/aktif/user", PencariMagangControllerApi::class, "findByStatusAktif");
Router::add("DELETE", "/api/skill/delete", SkillController::class, "deleteSkillById");
Router::add("GET", "/api/kategori/all", KategoriControllerApi::class, "findAll");
Router::add("GET", "/api/skill/showskillbypencari/[0-9a-zA-Z]*", SkillController::class, "showSkilsPencariMagang");
Router::add("POST", "/api/pencarimagang/findbyid", PencariMagangControllerApi::class, "findById");
Router::add("GET", "/api/aktifasi/penyedia/{username}/{token}", PenyediaMagangControllerApi::class, 'verivikasiAkun');
Router::add("POST", "/api/penyedia/register/akun", PenyediaMagangControllerApi::class, "regristasiAkun");
Router::add("GET", "/api/penyediamagang/all", PenyediaMagangControllerApi::class, "findAll");
Router::add('GET', '/api/penyedia/verivication/{id}', PenyediaMagangControllerApi::class, 'sendEmail');
Router::add("POST", "/api/penyedia/login", PenyediaMagangControllerApi::class, "login");
Router::add("GET", "/api/jenisusaha/findbyid/([0-9a-zA-Z]*)", JenisUsahaControllerApi::class, "findById");
Router::add("GET", "/api/jenisusaha/findall", JenisUsahaControllerApi::class, "findAll");
Router::add("POST", "/api/sekolah/save", SekolahControllerApi::class, "save");
Router::add("POST", "/api/sekolah/addjurusantosekolah", SekolahControllerApi::class, "addJurusanToSekolah");
Router::add("POST", "/api/jurusan/findbyjurusan", JurusanControllerApi::class, "findByJurusan");
Router::add("POST" , "/api/pencarimagang/uploadpenghargaan" , PencariMagangControllerApi::class , "uploadPenghargaan");
Router::add("POST" , "/api/penghargaan/findById" , PenghargaanControllerApi::class , "findById");
Router::add("POST" , "/api/penghargaan/findbypencarimagang" , PenghargaanControllerApi::class , "findByPencariMagang");
//w=web
Router::add('GET', '/', HomeController::class, 'index');
Router::add('GET', '/hello', HomeController::class, 'hello', [AuthMiddleware::class]);
Router::add('GET', '/world', HomeController::class, 'world', [AuthMiddleware::class]);
Router::add('GET', '/about', HomeController::class, 'about');
Router::add("POST", "/company/home/dashboard/update/data", PenyediaMagangController::class, "updateDataProfile");
Router::add('POST', '/company/search', CompanyController::class, 'search');
Router::add('GET', '/company', CompanyController::class, 'index');
Router::add('GET', '/formlamar', LamarController::class, 'formLamar');
Router::add("POST", "/api/update/tentang-saya", PencariMagangControllerApi::class, "updateTentangSaya");
Router::add("GET", "/company/detail", CompanyController::class, "detailCompany");
Router::add("GET", "/magang", MagangController::class, "search_magang");
Router::add("GET", "/magang/findall", MagangController::class, "findAll");
Router::add("GET", "/magang/cari/nama", MagangController::class, "hasil_cari");
Router::add("GET", "/magang/detail", MagangController::class, "detailMagang");
Router::add("GET", "/login", LoginController::class, "formLogin");
Router::add("POST", "/login/post", LoginController::class, "postLogin");
Router::add("POST", "/api/pencarimagang/upload/image", PencariMagangControllerApi::class, "uploadImage");
Router::add("POST", "/api/sekolah/findbysekolah", SekolahControllerApi::class, "findBySekolah");
Router::add("POST" , "/api/pencarimagang/showdatasekolah" , PencariMagangControllerApi::class , "showDataSekolah");
// register controler 
Router::add("GET", "/register", RegisterController::class, "formRegister");
Router::add("POST", "/register/post", RegisterController::class, "postRegister");
Router::add("POST", "/company/home/dashboard/tambah/magang/update", PenyediaMagangController::class, "updateData");
Router::add("GET", "/api/sekolah/findall", SekolahControllerApi::class, "findAll");
Router::add("POST" , "/api/pencarimagang/addsekolah" , PencariMagangControllerApi::class , "updateDataSekolah");
// penyedia controller
Router::add("GET", "/company/home", PenyediaMagangController::class, "home");
Router::add("GET", "/company/home/dashboard", PenyediaMagangController::class, "dashboardPenyedia");
Router::add("GET", "/company/home/dashboard/tambah/magang", PenyediaMagangController::class, "formTambahData");
Router::add("POST", "/company/home/dashboard/tambah/magang/save", PenyediaMagangController::class, "tambahDataPost");
Router::add("GET", "/company/home/dashboard/tambah/magang/delete/([0-9a-zA-Z]*)", PenyediaMagangController::class, "deleteMagang");
Router::add("GET", "/company/test", PenyediaMagangController::class, "testPhpInfo");
Router::add("GET", "/api/magang/showmagangall", MagangControllerApi::class, "showMagangInMobile");
Router::add('GET', '/api/jurusan/findall', JurusanControllerApi::class, 'findAll');
Router::add("POST", "/api/jurusan/findbyid", JurusanControllerApi::class, "findById");
Router::run();
