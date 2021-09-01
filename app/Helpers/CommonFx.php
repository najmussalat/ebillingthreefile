<?php
namespace App\Helpers;
use App\Models\Area;
use App\Models\Country;
use App\Models\Package;
use App\Models\Smssent;
use App\Models\District;
use App\Models\Division;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Payby;
use App\Models\Printsetting;
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
    public static function Districtname(){
        return District::pluck('district','id');
        
        }
    public static function Areaname(){
    return Area::whereadmin_id(Auth::guard('admin')->user()->id)->pluck('areaname','id');
    
    }
    public static function Packageame(){
        return Package::whereadmin_id(Auth::guard('admin')->user()->id)->pluck('packagename','id');
        
        }
        public static function Payname(){
            return Payby::whereadmin_id(Auth::guard('admin')->user()->id)->pluck('paybyname','id');
            
            }

            public static function printsetting(){
                return Printsetting::whereadmin_id(Auth::guard('admin')->user()->id)->first();
                
                }

        public static function sentsmscustomer($smsinfo){
            $smssetting=Smssent::whereadmin_id(Auth::id())->firstOrFail();
         
            $text= str_replace(['#CUSTOMER_NAME#', '#CUSTOMER_ID#','#RATE#'], [$smsinfo['name'], $smsinfo['id'],$smsinfo['monthlypayment']], $smssetting->newcustomermessage);
     
   
      if($smssetting->newcustomer==1){
      // $number=$smsinfo->phone;
      $number=$smsinfo['mobile'];
     $dataall= array(
       'username'=>"mtshoes",
       'password'=>"76PCMA9D",
       'number'=>$number,
       'message'=>$text
       );
 
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
         
            $text= str_replace(['#CUSTOMER_NAME#', '#CUSTOMER_ID#','#AMOUNT#','#DUE#'], [$smsinfo['name'], $smsinfo['id'],$smsinfo['paid'],$smsinfo['due']], $smssetting->paymentmessage);
     
   
      if($smssetting->payment==1){
      // $number=$smsinfo->phone;
      $number=$smsinfo['mobile'];
     $dataall= array(
       'username'=>"mtshoes",
       'password'=>"76PCMA9D",
       'number'=>$number,
       'message'=>$text
       );
 
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

        public static function sentsmsbillcreate($smsinfo){
            $smssetting=Smssent::whereadmin_id($smsinfo['adminid'])->firstOrFail();
         
            $text= str_replace(['#CUSTOMER_NAME#', '#CUSTOMER_ID#','#EXPIRY_DATE#'], [$smsinfo['name'], $smsinfo['id'],$smsinfo['expeirydate']], $smssetting->billingmessage);
     //dd($text);
   
      if($smssetting->billing==1){
      // $number=$smsinfo->phone;
      $number=$smsinfo['mobile'];
     $dataall= array(
       'username'=>"mtshoes",
       'password'=>"76PCMA9D",
       'number'=>$number,
       'message'=>$text
       );
 
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
