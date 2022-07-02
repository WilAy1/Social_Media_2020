<?php
require_once "/Users/wilay/students_connect/connect.php";
require_once "/Users/wilay/students_connect/header2.php";
$row = $mbs = mysqli_fetch_array(queryMysql("SELECT * FROM members WHERE user='$user'"));
$cnt = queryMysql("SELECT * FROM messages WHERE receiver='".$row['user']."' AND hasread=0");
$cntnm = mysqli_num_rows($cnt);
$mecc = queryMysql("SELECT * FROM notifications WHERE usertobenotified='".$row['user']."' AND readalready='0'");
$eeex = mysqli_num_rows($mecc);
echo <<<_END
<div class="navbar2">
<ul id="navbar_list">
<li id="hmic" style='width: 14%;'><a href="/students_connect/h"><i class="fas fa-home">
<span class='h_shn12w'><i class='fas fa-circle'></i></span>
</i>
</a>
</li>
<li id="hmic" style=''><a href="/students_connect/trend"><i class="fas fa-bolt"></i></a></li>
<li id="hmic" style='width: 14%;'><a href="/students_connect/messages"><i class="far fa-envelope">
_END;
if($cntnm>0){
echo "<span class='h_shn12w s_thmiw'><span>".$cntnm."</span></span>";
}
echo <<<_END
</i></a></li>
  <li id="hmic" style='width: 14%;'><a href="/students_connect/notification"><i class="far fa-bell">
_END;
if($eeex>0){
  echo "<span class='h_shn12w s_thmiw'><span>".$eeex."</span></span>";
  }
echo <<<_END
  </i></a></li>  <li id="hmic" class="tbstr" style='width: 14%;'><a href="/atlantisstore/"><i class="fas fa-book-open"></i></a></li>
  <li id="hmic" style='width: 14%;'><a href="/students_connect/search"><i class="fas fa-search"></i></a></li>
_END;
if(!file_exists("../../../students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png")){
echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"/students_connect/user.png'\")'; class='mypimg'></div></a></li>";
}
else{
echo "<li id='hmip'><a id='stbl' href='/students_connect/profile.php'><div class='mypimg' style='background-image: url(\"/students_connect_hidden/users_profile_upload/".$row['user'].'/'.$row['user'].".png\")' class='mypimg'></div></a></li>";
}
echo <<<_END
  </ul>   
  </div>
    <div class='pycl'>
    <div onload="checkDark()" class="dark-mode" id='darkmd' style="min-height:650px;">
    <div class='co_ttds'>
    <div class='sc_Aacm ss_oqast'>Settings/Account Management/Country or Region</div>
  _END;
    $countries = [
        'Afghanistan', 'Aland Islands', 'Albania', 'Algeria', 'American Samoa',
        'Andorra', 'Angola', 'Anguilla', 'Antigua & Barbuda', 'Argentina', 'Armenia', 'Aruba', 'Australia', 'Austria',
        'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bermuda', 
        'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Bouvet Island', 'Brazil', 'British Indian Ocean Territory',
        'Brunei', 'Bulgaria', 'Burkina Faso', 'Burundi', 'Cambodia', 'Cameroon', 'Canada', 'Cape Verde', 'Carribean Netherlands',
        'Cayman Islands', 'Central African Republic', 'Chad', 'Chile', 'Christmas Island', 'Cocos (Keeling) Islands', 'Colombia',
        'Comoros', 'Congo -Brazzaville', 'Congo - Kinshasa', 'Cook Islands', 'Costa Rica', 'Cote dIvoire', 'Croatia', 'Cuba',
        'Curacao', 'Cyprus', 'Czechia', 'Denmark', 'Djibouti', 'Dominica', 'Dominic Republic', 'Ecuador', ' Egypt', 'El Savador'
    ];
    $og = "Afghanistan
    Albania
    Algeria
    Andorra
    Angola
    Antigua and Barbuda
    Argentina
    Armenia
    Australia
    Austria
    Azerbaijan
    The Bahamas
    Bahrain
    Bangladesh
    Barbados
    Belarus
    Belgium
    Belize
    Benin
    Bhutan
    Bolivia
    Bosnia and Herzegovina
    Botswana
    Brazil
    Brunei
    Bulgaria
    Burkina Faso
    Burundi
    Cambodia
    Cameroon
    Canada
    Cape Verde
    Central African Republic
    Chad
    Chile
    China
    Colombia
    Comoros
    Congo, Republic of the
    Congo, Democratic Republic of the
    Costa Rica
    Cote d'Ivoire
    Croatia
    Cuba
    Cyprus
    Czech Republic
    Denmark
    Djibouti
    Dominica
    Dominican Republic
    East Timor (Timor-Leste)
    Ecuador
    Egypt
    El Salvador
    Equatorial Guinea
    Eritrea
    Estonia
    Ethiopia
    Fiji
    Finland
    France
    Gabon
    The Gambia
    Georgia
    Germany
    Ghana
    Greece
    Grenada
    Guatemala
    Guinea
    Guinea-Bissau
    Guyana
    Haiti
    Honduras
    Hungary
    Iceland
    India
    Indonesia
    Iran
    Iraq
    Ireland
    Israel
    Italy
    Jamaica
    Japan
    Jordan
    Kazakhstan
    Kenya
    Kiribati
    Korea, North
    Korea, South
    Kosovo
    Kuwait
    Kyrgyzstan
    Laos
    Latvia
    Lebanon
    Lesotho
    Liberia
    Libya
    Liechtenstein
    Lithuania
    Luxembourg
    Macedonia
    Madagascar
    Malawi
    Malaysia
    Maldives
    Mali
    Malta
    Marshall Islands
    Mauritania
    Mauritius
    Mexico
    Micronesia, Federated States of
    Moldova
    Monaco
    Mongolia
    Montenegro
    Morocco
    Mozambique
    Myanmar (Burma)
    Namibia
    Nauru
    Nepal
    Netherlands
    New Zealand
    Nicaragua
    Niger
    Nigeria
    Norway
    Oman
    Pakistan
    Palau
    Panama
    Papua New Guinea
    Paraguay
    Peru
    Philippines
    Poland
    Portugal
    Qatar
    Romania
    Russia
    Rwanda
    Saint Kitts and Nevis
    Saint Lucia
    Saint Vincent and the Grenadines
    Samoa
    San Marino
    Sao Tome and Principe
    Saudi Arabia
    Senegal
    Serbia
    Seychelles
    Sierra Leone
    Singapore
    Slovakia
    Slovenia
    Solomon Islands
    Somalia
    South Africa
    South Sudan
    Spain
    Sri Lanka
    Sudan
    Suriname
    Swaziland
    Sweden
    Switzerland
    Syria
    Taiwan
    Tajikistan
    Tanzania
    Thailand
    Togo
    Tonga
    Trinidad and Tobago
    Tunisia
    Turkey
    Turkmenistan
    Tuvalu
    Uganda
    Ukraine
    United Arab Emirates
    United Kingdom
    United States of America
    Uruguay
    Uzbekistan
    Vanuatu
    Vatican City (Holy See)
    Venezuela
    Vietnam
    Yemen
    Zambia
    Zimbabwe";
    $og = str_replace("    ", '', $og);
    $countries = explode("\r\n", $og);
    echo "<div class='ss_conl'>";
    for($i = 0; $i < count($countries); $i++){
        if(strtolower($row['country']) == strtolower($countries[$i])){
            $moa = "<i class='fas fa-check'></i>";
        }
        else {
            $moa = '';
        }
        echo "<div class='ss_fcll'>".$countries[$i]."<span class='ss_moa'>".$moa."</span></div>";
    }
  echo "</div></div></div></div>
  <script>
    var gh = document.getElementsByClassName('ss_fcll');
    for(var i = 0; i < gh.length; i++){
        gh[i].onclick = function(){
            if(this.children[0] == false){
                var b = this;
            $.ajax({
                url: '/students_connect/settings/country/u.php?t='+b.innerHTML,
                type:'GET',
                processData: false,
                contentType: false,
                success: function(){
                    b.innerHTML = b.innerHTML+'<span class=\"ss_moa\"><i class=\"fas fa-check\"></i></span>';
                }
                })
            }
        }
        }
  </script>
  ";
?>