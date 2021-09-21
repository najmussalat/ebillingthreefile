<?php
namespace App\Helpers;
use App\Models\Area;
use App\Models\User;
use App\Models\Admin;
use App\Models\Payby;
use App\Models\Country;
use App\Models\Package;
use App\Models\Smssent;
use App\Models\Customer;
use App\Models\District;
use App\Models\Division;
use Illuminate\Support\Str;
use App\Models\Complaintext;
use App\Models\Printsetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request; 

class CommonFx{
        public static function make_slug($string) {
        return Str::slug($string, '-');
    }
        public static function bnslug($string, $delimiter = '-') {
      
        $string = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/", "", $string);
            
               
                $string = preg_replace("/[\/_|+ -]+/", $delimiter, trim(strtolower($string)));
            
                return $string;
        
            }


   
public static function Country(){
 return array(
        'BD'=>'BANGLADESH',
      'AF'=>'AFGHANISTAN',
      'AL'=>'ALBANIA',
      'DZ'=>'ALGERIA',
      'AS'=>'AMERICAN SAMOA',
      'AD'=>'ANDORRA',
      'AO'=>'ANGOLA',
      'AI'=>'ANGUILLA',
      'AQ'=>'ANTARCTICA',
      'AG'=>'ANTIGUA AND BARBUDA',
      'AR'=>'ARGENTINA',
      'AM'=>'ARMENIA',
      'AW'=>'ARUBA',
      'AU'=>'AUSTRALIA',
      'AT'=>'AUSTRIA',
      'AZ'=>'AZERBAIJAN',
      'BS'=>'BAHAMAS',
      'BH'=>'BAHRAIN',
      'BB'=>'BARBADOS',
      'BY'=>'BELARUS',
      'BE'=>'BELGIUM',
      'BZ'=>'BELIZE',
      'BJ'=>'BENIN',
      'BM'=>'BERMUDA',
      'BT'=>'BHUTAN',
      'BO'=>'BOLIVIA',
      'BA'=>'BOSNIA AND HERZEGOVINA',
      'BW'=>'BOTSWANA',
      'BV'=>'BOUVET ISLAND',
      'BR'=>'BRAZIL',
      'IO'=>'BRITISH INDIAN OCEAN TERRITORY',
      'BN'=>'BRUNEI DARUSSALAM',
      'BG'=>'BULGARIA',
      'BF'=>'BURKINA FASO',
      'BI'=>'BURUNDI',
      'KH'=>'CAMBODIA',
      'CM'=>'CAMEROON',
      'CA'=>'CANADA',
      'CV'=>'CAPE VERDE',
      'KY'=>'CAYMAN ISLANDS',
      'CF'=>'CENTRAL AFRICAN REPUBLIC',
      'TD'=>'CHAD',
      'CL'=>'CHILE',
      'CN'=>'CHINA',
      'CX'=>'CHRISTMAS ISLAND',
      'CC'=>'COCOS (KEELING) ISLANDS',
      'CO'=>'COLOMBIA',
      'KM'=>'COMOROS',
      'CG'=>'CONGO',
      'CD'=>'CONGO, THE DEMOCRATIC REPUBLIC OF THE',
      'CK'=>'COOK ISLANDS',
      'CR'=>'COSTA RICA',
      'CI'=>'COTE D IVOIRE',
      'HR'=>'CROATIA',
      'CU'=>'CUBA',
      'CY'=>'CYPRUS',
      'CZ'=>'CZECH REPUBLIC',
      'DK'=>'DENMARK',
      'DJ'=>'DJIBOUTI',
      'DM'=>'DOMINICA',
      'DO'=>'DOMINICAN REPUBLIC',
      'TP'=>'EAST TIMOR',
      'EC'=>'ECUADOR',
      'EG'=>'EGYPT',
      'SV'=>'EL SALVADOR',
      'GQ'=>'EQUATORIAL GUINEA',
      'ER'=>'ERITREA',
      'EE'=>'ESTONIA',
      'ET'=>'ETHIOPIA',
      'FK'=>'FALKLAND ISLANDS (MALVINAS)',
      'FO'=>'FAROE ISLANDS',
      'FJ'=>'FIJI',
      'FI'=>'FINLAND',
      'FR'=>'FRANCE',
      'GF'=>'FRENCH GUIANA',
      'PF'=>'FRENCH POLYNESIA',
      'TF'=>'FRENCH SOUTHERN TERRITORIES',
      'GA'=>'GABON',
      'GM'=>'GAMBIA',
      'GE'=>'GEORGIA',
      'DE'=>'GERMANY',
      'GH'=>'GHANA',
      'GI'=>'GIBRALTAR',
      'GR'=>'GREECE',
      'GL'=>'GREENLAND',
      'GD'=>'GRENADA',
      'GP'=>'GUADELOUPE',
      'GU'=>'GUAM',
      'GT'=>'GUATEMALA',
      'GN'=>'GUINEA',
      'GW'=>'GUINEA-BISSAU',
      'GY'=>'GUYANA',
      'HT'=>'HAITI',
      'HM'=>'HEARD ISLAND AND MCDONALD ISLANDS',
      'VA'=>'HOLY SEE (VATICAN CITY STATE)',
      'HN'=>'HONDURAS',
      'HK'=>'HONG KONG',
      'HU'=>'HUNGARY',
      'IS'=>'ICELAND',
      'IN'=>'INDIA',
      'ID'=>'INDONESIA',
      'IR'=>'IRAN, ISLAMIC REPUBLIC OF',
      'IQ'=>'IRAQ',
      'IE'=>'IRELAND',
      'IL'=>'ISRAEL',
      'IT'=>'ITALY',
      'JM'=>'JAMAICA',
      'JP'=>'JAPAN',
      'JO'=>'JORDAN',
      'KZ'=>'KAZAKSTAN',
      'KE'=>'KENYA',
      'KI'=>'KIRIBATI',
      'KP'=>'KOREA DEMOCRATIC PEOPLES REPUBLIC OF',
      'KR'=>'KOREA REPUBLIC OF',
      'KW'=>'KUWAIT',
      'KG'=>'KYRGYZSTAN',
      'LA'=>'LAO PEOPLES DEMOCRATIC REPUBLIC',
      'LV'=>'LATVIA',
      'LB'=>'LEBANON',
      'LS'=>'LESOTHO',
      'LR'=>'LIBERIA',
      'LY'=>'LIBYAN ARAB JAMAHIRIYA',
      'LI'=>'LIECHTENSTEIN',
      'LT'=>'LITHUANIA',
      'LU'=>'LUXEMBOURG',
      'MO'=>'MACAU',
      'MK'=>'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF',
      'MG'=>'MADAGASCAR',
      'MW'=>'MALAWI',
      'MY'=>'MALAYSIA',
      'MV'=>'MALDIVES',
      'ML'=>'MALI',
      'MT'=>'MALTA',
      'MH'=>'MARSHALL ISLANDS',
      'MQ'=>'MARTINIQUE',
      'MR'=>'MAURITANIA',
      'MU'=>'MAURITIUS',
      'YT'=>'MAYOTTE',
      'MX'=>'MEXICO',
      'FM'=>'MICRONESIA, FEDERATED STATES OF',
      'MD'=>'MOLDOVA, REPUBLIC OF',
      'MC'=>'MONACO',
      'MN'=>'MONGOLIA',
      'MS'=>'MONTSERRAT',
      'MA'=>'MOROCCO',
      'MZ'=>'MOZAMBIQUE',
      'MM'=>'MYANMAR',
      'NA'=>'NAMIBIA',
      'NR'=>'NAURU',
      'NP'=>'NEPAL',
      'NL'=>'NETHERLANDS',
      'AN'=>'NETHERLANDS ANTILLES',
      'NC'=>'NEW CALEDONIA',
      'NZ'=>'NEW ZEALAND',
      'NI'=>'NICARAGUA',
      'NE'=>'NIGER',
      'NG'=>'NIGERIA',
      'NU'=>'NIUE',
      'NF'=>'NORFOLK ISLAND',
      'MP'=>'NORTHERN MARIANA ISLANDS',
      'NO'=>'NORWAY',
      'OM'=>'OMAN',
      'PK'=>'PAKISTAN',
      'PW'=>'PALAU',
      'PS'=>'PALESTINIAN TERRITORY, OCCUPIED',
      'PA'=>'PANAMA',
      'PG'=>'PAPUA NEW GUINEA',
      'PY'=>'PARAGUAY',
      'PE'=>'PERU',
      'PH'=>'PHILIPPINES',
      'PN'=>'PITCAIRN',
      'PL'=>'POLAND',
      'PT'=>'PORTUGAL',
      'PR'=>'PUERTO RICO',
      'QA'=>'QATAR',
      'RE'=>'REUNION',
      'RO'=>'ROMANIA',
      'RU'=>'RUSSIAN FEDERATION',
      'RW'=>'RWANDA',
      'SH'=>'SAINT HELENA',
      'KN'=>'SAINT KITTS AND NEVIS',
      'LC'=>'SAINT LUCIA',
      'PM'=>'SAINT PIERRE AND MIQUELON',
      'VC'=>'SAINT VINCENT AND THE GRENADINES',
      'WS'=>'SAMOA',
      'SM'=>'SAN MARINO',
      'ST'=>'SAO TOME AND PRINCIPE',
      'SA'=>'SAUDI ARABIA',
      'SN'=>'SENEGAL',
      'SC'=>'SEYCHELLES',
      'SL'=>'SIERRA LEONE',
      'SG'=>'SINGAPORE',
      'SK'=>'SLOVAKIA',
      'SI'=>'SLOVENIA',
      'SB'=>'SOLOMON ISLANDS',
      'SO'=>'SOMALIA',
      'ZA'=>'SOUTH AFRICA',
      'GS'=>'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS',
      'ES'=>'SPAIN',
      'LK'=>'SRI LANKA',
      'SD'=>'SUDAN',
      'SR'=>'SURINAME',
      'SJ'=>'SVALBARD AND JAN MAYEN',
      'SZ'=>'SWAZILAND',
      'SE'=>'SWEDEN',
      'CH'=>'SWITZERLAND',
      'SY'=>'SYRIAN ARAB REPUBLIC',
      'TW'=>'TAIWAN, PROVINCE OF CHINA',
      'TJ'=>'TAJIKISTAN',
      'TZ'=>'TANZANIA, UNITED REPUBLIC OF',
      'TH'=>'THAILAND',
      'TG'=>'TOGO',
      'TK'=>'TOKELAU',
      'TO'=>'TONGA',
      'TT'=>'TRINIDAD AND TOBAGO',
      'TN'=>'TUNISIA',
      'TR'=>'TURKEY',
      'TM'=>'TURKMENISTAN',
      'TC'=>'TURKS AND CAICOS ISLANDS',
      'TV'=>'TUVALU',
      'UG'=>'UGANDA',
      'UA'=>'UKRAINE',
      'AE'=>'UNITED ARAB EMIRATES',
      'GB'=>'UNITED KINGDOM',
      'US'=>'UNITED STATES',
      'UM'=>'UNITED STATES MINOR OUTLYING ISLANDS',
      'UY'=>'URUGUAY',
      'UZ'=>'UZBEKISTAN',
      'VU'=>'VANUATU',
      'VE'=>'VENEZUELA',
      'VN'=>'VIET NAM',
      'VG'=>'VIRGIN ISLANDS, BRITISH',
      'VI'=>'VIRGIN ISLANDS, U.S.',
      'WF'=>'WALLIS AND FUTUNA',
      'EH'=>'WESTERN SAHARA',
      'YE'=>'YEMEN',
      'YU'=>'YUGOSLAVIA',
      'ZM'=>'ZAMBIA',
      'ZW'=>'ZIMBABWE');
}
public static function Countryname(){
return Country::pluck('countryname','id');

}
public static function Divisionname(){
    return Division::pluck('division','id');
    
    }
    public static function Totalcustomerinfo(){
        return DB::table('customers')
        ->join('bills', 'customers.id', '=', 'bills.customer_id')
       // ->join('collections', 'bills.id', '=', 'collections.bill_id')
         ->where('customers.admin_id','=',Auth::id())
         ->whereMonth('bills.created_at', date('m'))
->whereYear('bills.created_at', date('Y'))
        ->select('customers.id','bills.monthlyrent')
        ->get();
        // return Customer::with('bill.collection')->wherestatus(1)->whereadmin_id(Auth::id())->select('id','admin_id','status','bills')->get()->sum('monthlyrent');
        
        }   public static function Districtname(){
        return District::pluck('district','id');
        
        }
        public static function Connect(){
            $info=User::whereadmin_id(Auth::id())->first();
            if($info){
                return User::pluck('username','id');
            }
            else{
                return Admin::whereid(Auth::id())->pluck('name','id');
            }
     
        
        }
    public static function Areaname(){
    return Area::whereadmin_id(Auth::guard('admin')->user()->id)->pluck('areaname','id');
    
    }
    public static function Packageame(){
        return Package::whereadmin_id(Auth::guard('admin')->user()->id)->select('packageprice','id','packagename')->get();

        }
        public static function Payname(){
            return Payby::whereadmin_id(Auth::guard('admin')->user()->id)->pluck('paybyname','id');
            
            }

            public static function printsetting(){
                return Printsetting::whereadmin_id(Auth::guard('admin')->user()->id)->first();
                
                }
   public static function sentallcustomersms(){
                return Smssent::whereadmin_id(Auth::guard('admin')->user()->id)->first();
                
                } public static function Complaintitle(){
                return Complaintext::whereadmin_id(Auth::guard('admin')->user()->id)->get();
                
                }
  public static function Smscount($text){
               $countlength=strlen($text);
               if(($countlength >= 0) && ($countlength <= 147)){
                   return 1;
               }
                elseif(($countlength >= 148) && ($countlength <=296)){
                   return 2;
               }
               elseif(($countlength >= 297) && ($countlength <=444)){
                return 3;
            }
                  elseif(($countlength >=445) && ($countlength <=591)){
                return 4;
            }
            else{
                return 5;
            }
                
                }

        public static function sentsmscustomer($smsinfo){
            $smssetting=Smssent::whereadmin_id(Auth::id())->firstOrFail();
         
            $text= str_replace(['#CUSTOMER_NAME#', '#CUSTOMER_ID#','#RATE#','#IP#','#PPPOE_USERNAME#','#PPPOE_PASSWORD#','#COMPANY_NAME#'], [$smsinfo['name'], $smsinfo['id'],$smsinfo['monthlypayment'],$smsinfo['ip'],$smsinfo['oppusername'],$smsinfo['opppassword'], Auth::user()->company], $smssetting->newcustomermessage);
            if(($smssetting->newcustomer==1) && ($smssetting->blance>1)){
                // $number=$smsinfo->phone;
                $number=$smsinfo['mobile'];
               $dataall= array(
                 'username'=>$smssetting->username,
                 'password'=>$smssetting->password,
                 'number'=>$number,
                 'message'=>$text
                 );
                 $smssetting->blance -=$smssetting->smsrate *(CommonFx::Smscount($text));
                 $smssetting->save();
   
    
   $url = "http://66.45.237.70/api.php";
       $ch = curl_init(); // Initialize cURL
       curl_setopt($ch, CURLOPT_URL,$url);
       curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataall));
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       $smsresult = curl_exec($ch);
       $p = explode("|",$smsresult);
       $sendstatus = $p[0];

   }
        }
        public static function sentsmscustomerbillpaid($smsinfo){
            $smssetting=Smssent::whereadmin_id(Auth::id())->firstOrFail();
         $text= str_replace(['#CUSTOMER_NAME#', '#AMOUNT#','#IP_OR_USER_NAME_OR_ID#','#DUE#','#COMPANY_NAME#'], [$smsinfo['name'], $smsinfo['id'],$smsinfo['paid'],$smsinfo['due'],Auth::user()->company], $smssetting->paymentmessage);
     
      if(($smssetting->payment==1) && ($smssetting->blance>1)){
      // $number=$smsinfo->phone;
      $number=$smsinfo['mobile'];
     $dataall= array(
       'username'=>$smssetting->username,
       'password'=>$smssetting->password,
       'number'=>$number,
       'message'=>$text
       );
       $smssetting->blance -=$smssetting->smsrate *(CommonFx::Smscount($text));
       $smssetting->save();
   $url = "http://66.45.237.70/api.php";
       $ch = curl_init(); // Initialize cURL
       curl_setopt($ch, CURLOPT_URL,$url);
       curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataall));
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       $smsresult = curl_exec($ch);
       $p = explode("|",$smsresult);
       $sendstatus = $p[0];
   //Log::info($sendstatus);
    
   }
        }

        public static function sentsmsbillcreate($smsinfo){
            $smssetting=Smssent::whereadmin_id($smsinfo['adminid'])->firstOrFail();
            if(($smssetting->billing==1) && ($smssetting->blance>1)){
         $companyinfo=Admin::find($smsinfo['adminid'])->select('id','company');
            $text= str_replace(['#CUSTOMER_NAME#','#MONTH#','#BILL_AMOUNT#', '#CUSTOMER_ID#','#LAST_DAY_OF_PAY_BILL#','#COMPANY_NAME#'], [$smsinfo['name'],date('M-Y'),$smsinfo['billamount'], $smsinfo['id'],$smsinfo['expeirydate'], $companyinfo->company], $smssetting->billingmessage);
          
                // $number=$smsinfo->phone;
                $number=$smsinfo['mobile'];
               $dataall= array(
                 'username'=>$smssetting->username,
                 'password'=>$smssetting->password,
                 'number'=>$number,
                 'message'=>$text
                 );
                 $smssetting->blance -=$smssetting->smsrate *(CommonFx::Smscount($text));
                 $smssetting->save();
   
      
   $url = "http://66.45.237.70/api.php";
       $ch = curl_init(); // Initialize cURL
       curl_setopt($ch, CURLOPT_URL,$url);
       curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataall));
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       $smsresult = curl_exec($ch);
       $p = explode("|",$smsresult);
       $sendstatus = $p[0];

   }
        }
         public static function Sendsmsopencomplain($smsinfo){
            $smssetting=Smssent::whereadmin_id(Auth::id())->firstOrFail();
            if(($smssetting->openticket==1) && ($smssetting->blance>1)){
           $text= str_replace(['#CUSTOMER_NAME#','#COMPLAINS#','#COMMENT#', '#EMPLOYEE_NAME#','#EMPLOYEE_MOBILE#','#COMPANY_NAME#', '#COMPANY_MOBILE#'], [$smsinfo['name'],$smsinfo['complain'], $smsinfo['message'],Auth::user()->name,Auth::user()->phone,Auth::user()->company,Auth::user()->phone], $smssetting->openticketmessage);
          
                // $number=$smsinfo->phone;
                $number=$smsinfo['mobile'];
               $dataall= array(
                 'username'=>$smssetting->username,
                 'password'=>$smssetting->password,
                 'number'=>$number,
                 'message'=>$text
                 );
                 $smssetting->blance -=$smssetting->smsrate *(CommonFx::Smscount($text));
                 $smssetting->save();
   
      
   $url = "http://66.45.237.70/api.php";
       $ch = curl_init(); // Initialize cURL
       curl_setopt($ch, CURLOPT_URL,$url);
       curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataall));
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       $smsresult = curl_exec($ch);
       $p = explode("|",$smsresult);
       $sendstatus = $p[0];

   }
        }
     public static function Sendsmsopencomplainupdate($smsinfo){
            $smssetting=Smssent::whereadmin_id(Auth::id())->firstOrFail();
            if(($smssetting->updateticket==1) && ($smssetting->blance>1)){
           $text= str_replace(['#CUSTOMER_NAME#','#TKTNO#','#TOPIC#','#TKT_MSG#'], [$smsinfo['name'],$smsinfo['tktno'],$smsinfo['complain'][0], $smsinfo['message']], $smssetting->updateticketmessage);
          
                // $number=$smsinfo->phone;
                $number=$smsinfo['mobile'];
               $dataall= array(
                 'username'=>$smssetting->username,
                 'password'=>$smssetting->password,
                 'number'=>$number,
                 'message'=>$text
                 );
                 $smssetting->blance -=$smssetting->smsrate *(CommonFx::Smscount($text));
                 $smssetting->save();
   
      
   $url = "http://66.45.237.70/api.php";
       $ch = curl_init(); // Initialize cURL
       curl_setopt($ch, CURLOPT_URL,$url);
       curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataall));
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       $smsresult = curl_exec($ch);
       $p = explode("|",$smsresult);
       $sendstatus = $p[0];

   }
   }
   public static function Sendsmsopencomplainclose($smsinfo){
    $smssetting=Smssent::whereadmin_id(Auth::id())->firstOrFail();
    if(($smssetting->closeticket==1) && ($smssetting->blance>1)){
   $text= str_replace(['#CUSTOMER_NAME','#COMPANY_MOBILE#','#COMPANY_NAME#'], [$smsinfo['name'],Auth::user()->phone,Auth::user()->company,Auth::user()->phone], $smssetting->closeticketmessage);
  
        // $number=$smsinfo->phone;
        $number=$smsinfo['mobile'];
       $dataall= array(
         'username'=>$smssetting->username,
         'password'=>$smssetting->password,
         'number'=>$number,
         'message'=>$text
         );
         $smssetting->blance -=$smssetting->smsrate *(CommonFx::Smscount($text));
         $smssetting->save();


$url = "http://66.45.237.70/api.php";
$ch = curl_init(); // Initialize cURL
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataall));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$smsresult = curl_exec($ch);
$p = explode("|",$smsresult);
$sendstatus = $p[0];

}
        }
    
}
