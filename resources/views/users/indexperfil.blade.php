@extends('layouts.panel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Mi cuenta</div>

                <div class="card-body">
                   @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                      <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}
                      </li>
                      @endforeach
                      <ul>
                    </div>
                  @endif

                    <!-- Page content -->

      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="{{ route('user.avatar',['filename'=>Auth::user()->photo]) }}"/>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info mr-4" data-toggle="modal" data-target="#exampleModal"><i class="ni ni-tag"></i> Link</a>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Link para registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        https://dashboard.lifearluxury.com/register?{{ $user->id }}
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        
                      </div>
                    </div>
                  </div>
                </div>


                <a href="#" class="btn btn-sm btn-default float-right"><i class="ni ni-chat-round"></i> Mensaje</a>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                      <span class="heading">x</span>
                      <span class="description">Referidos</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                  {{ $user->name }}<span class="font-weight-light"></span>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>{{ $user->email }}
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>{{ Auth::user()->phone }}
                </div>
                <hr class="my-4" />

                <a href="/home">Noticias</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">{{ Auth::user()->name }}</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="#" class="btn btn-outline-secondary"><i class="ni ni-money-coins"></i> Billetera</a>
                </div>
              </div>
            </div>
            <div class="card-body">
    <form class="row g-3" action="{{ url('user/'.$user->id) }}" enctype="multipart/form-data" method="post">
    @csrf
    @method('PUT')



        <div class="col-md-6" hidden="true">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-single-02"></i></span>
            </div>
            <input class="form-control" placeholder="Nombre" type="text" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
         </div>
        </div>
        <div class="col-md-6" hidden="true">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-single-02"></i></span>
            </div>
            <input class="form-control" placeholder="Apellido" type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}" required autocomplete="lastname" autofocus>
          </div>
        </div>
        <div class="col-md-6" hidden="true">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-badge"></i></span>
            </div>
              <select id="typeDoc" name="typeDoc" class="form-control" required>
                <option value="{{ $user->typeDoc}}">{{ $user->typeDoc}}</option>
                  <option value="Cedula"  >Cedula</option>
                  <option value="Pasaporte"  >Pasaporte</option>
                  <option value="Visa"  >Visa</option>
                  <option value="otro"  >otro</option>
              </select>
          </div>
        </div>
        <div class="col-md-6" hidden="true">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
            </div>
            <input class="form-control" placeholder="Numero documento" type="number" name="numberDoc" value="{{ old('lastname', $user->numberDoc) }}"  autocomplete="numberDoc" autofocus>
          </div>
        </div>
        <div class="col-md-6" hidden="true">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-badge"></i></span>
            </div>
              <select id="role" name="role" class="form-control" required>
                <option value="{{ $user->role }}">Tipo de Rol</option>
                  <option value="admin"  >Administrador</option>
                  <option value="user"  >Usuario</option>
              </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
            </div>
            <input class="form-control" placeholder="Telefono" type="number" name="phone" value="{{ old('phone', $user->phone) }}" required autocomplete="phone" autofocus>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
            </div>
            <input class="form-control" placeholder="Movil" type="number" name="cellphone" value="{{ old('cellphone', $user->cellphone) }}" required autocomplete="cellphone" autofocus>
          </div>
        </div>
        <div class="col-md-6" hidden="true">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-world-2"></i></span>
            </div>
            <select id="country" name="country" class="form-control" required>
              <option value="{{ $user->country}}">País </option>
              <option value="1"  >Afghanistan</option>
              <option value="2"  >Albania</option>
              <option value="3"  >Algeria</option>
              <option value="4"  >American Samoa</option>
              <option value="5"  >Andorra</option>
              <option value="6"  >Angola</option>
              <option value="7"  >Anguilla</option>
              <option value="8"  >Antarctica</option>
              <option value="9"  >Antigua and Barbuda</option>
              <option value="10"  >Argentina</option>
              <option value="11"  >Armenia</option>
              <option value="12"  >Aruba</option>
              <option value="13"  >Australia</option>
              <option value="14"  >Austria</option>
              <option value="15"  >Azerbaijan</option>
              <option value="16"  >Bahamas</option>
              <option value="17"  >Bahrain</option>
              <option value="18"  >Bangladesh</option>
              <option value="19"  >Barbados</option>
              <option value="20"  >Belarus</option>
              <option value="21"  >Belgium</option>
              <option value="22"  >Belize</option>
              <option value="23"  >Benin</option>
              <option value="24"  >Bermuda</option>
              <option value="25"  >Bhutan</option>
              <option value="26"  >Bolivia</option>
              <option value="27"  >Bosnia and Herzegovina</option>
              <option value="28"  >Botswana</option>
              <option value="29"  >Bouvet Island</option>
              <option value="30"  >Brazil</option>
              <option value="31"  >British Indian Ocean Territory</option>
              <option value="32"  >Brunei Darussalam</option>
              <option value="33"  >Bulgaria</option>
              <option value="34"  >Burkina Faso</option>
              <option value="35"  >Burundi</option>
              <option value="36"  >Cambodia</option>
              <option value="37"  >Cameroon</option>
              <option value="38"  >Canada</option>
              <option value="39"  >Cape Verde</option>
              <option value="40"  >Cayman Islands</option>
              <option value="41"  >Central African Republic</option>
              <option value="42"  >Chad</option>
              <option value="43"  >Chile</option>
              <option value="44"  >China</option>
              <option value="45"  >Christmas Island</option>
              <option value="46"  >Cocos (Keeling) Islands</option>
              <option value="57"  >Colombia</option>
              <option value="48"  >Comoros</option>
              <option value="49"  >Congo</option>
              <option value="50"  >Cook Islands</option>
              <option value="51"  >Costa Rica</option>
              <option value="52"  >Cote D'Ivoire</option>
              <option value="53"  >Croatia</option>
              <option value="54"  >Cuba</option>
              <option value="55"  >Cyprus</option>
              <option value="56"  >Czech Republic</option>
              <option value="57"  >Denmark</option>
              <option value="58"  >Djibouti</option>
              <option value="59"  >Dominica</option>
              <option value="60"  >Dominican Republic</option>
              <option value="61"  >East Timor</option>
              <option value="62"  >Ecuador</option>
              <option value="63"  >Egypt</option>
              <option value="64"  >El Salvador</option>
              <option value="65"  >Equatorial Guinea</option>
              <option value="66"  >Eritrea</option>
              <option value="67"  >Estonia</option>
              <option value="68"  >Ethiopia</option>
              <option value="69"  >Falkland Islands (Malvinas)</option>
              <option value="70"  >Faroe Islands</option>
              <option value="71"  >Fiji</option>
              <option value="72"  >Finland</option>
              <option value="74"  >France, Metropolitan</option>
              <option value="75"  >French Guiana</option>
              <option value="76"  >French Polynesia</option>
              <option value="77"  >French Southern Territories</option>
              <option value="78"  >Gabon</option>
              <option value="79"  >Gambia</option>
              <option value="80"  >Georgia</option>
              <option value="81"  >Germany</option>
              <option value="82"  >Ghana</option>
              <option value="83"  >Gibraltar</option>
              <option value="84"  >Greece</option>
              <option value="85"  >Greenland</option>
              <option value="86"  >Grenada</option>
              <option value="87"  >Guadeloupe</option>
              <option value="88"  >Guam</option>
              <option value="89"  >Guatemala</option>
              <option value="90"  >Guinea</option>
              <option value="91"  >Guinea-Bissau</option>
              <option value="92"  >Guyana</option>
              <option value="93"  >Haiti</option>
              <option value="94"  >Heard and Mc Donald Islands</option>
              <option value="95"  >Honduras</option>
              <option value="96"  >Hong Kong</option>
              <option value="97"  >Hungary</option>
              <option value="98"  >Iceland</option>
              <option value="99"  >India</option>
              <option value="100"  >Indonesia</option>
              <option value="101"  >Iran (Islamic Republic of)</option>
              <option value="102"  >Iraq</option>
              <option value="103"  >Ireland</option>
              <option value="104"  >Israel</option>
              <option value="105"  >Italy</option>
              <option value="106"  >Jamaica</option>
              <option value="107"  >Japan</option>
              <option value="108"  >Jordan</option>
              <option value="109"  >Kazakhstan</option>
              <option value="110"  >Kenya</option>
              <option value="111"  >Kiribati</option>
              <option value="112"  >North Korea</option>
              <option value="113"  >Korea, Republic of</option>
              <option value="114"  >Kuwait</option>
              <option value="115"  >Kyrgyzstan</option>
              <option value="116"  >Lao People's Democratic Republic</option>
              <option value="117"  >Latvia</option>
              <option value="118"  >Lebanon</option>
              <option value="119"  >Lesotho</option>
              <option value="120"  >Liberia</option>
              <option value="121"  >Libyan Arab Jamahiriya</option>
              <option value="122"  >Liechtenstein</option>
              <option value="123"  >Lithuania</option>
              <option value="124"  >Luxembourg</option>
              <option value="125"  >Macau</option>
              <option value="126"  >FYROM</option>
              <option value="127"  >Madagascar</option>
              <option value="128"  >Malawi</option>
              <option value="129"  >Malaysia</option>
              <option value="130"  >Maldives</option>
              <option value="131"  >Mali</option>
              <option value="132"  >Malta</option>
              <option value="133"  >Marshall Islands</option>
              <option value="134"  >Martinique</option>
              <option value="135"  >Mauritania</option>
              <option value="136"  >Mauritius</option>
              <option value="137"  >Mayotte</option>
              <option value="138"  >Mexico</option>
              <option value="139"  >Micronesia, Federated States of</option>
              <option value="140"  >Moldova, Republic of</option>
              <option value="141"  >Monaco</option>
              <option value="142"  >Mongolia</option>
              <option value="143"  >Montserrat</option>
              <option value="144"  >Morocco</option>
              <option value="145"  >Mozambique</option>
              <option value="146"  >Myanmar</option>
              <option value="147"  >Namibia</option>
              <option value="148"  >Nauru</option>
              <option value="149"  >Nepal</option>
              <option value="150"  >Netherlands</option>
              <option value="151"  >Netherlands Antilles</option>
              <option value="152"  >New Caledonia</option>
              <option value="153"  >New Zealand</option>
              <option value="154"  >Nicaragua</option>
              <option value="155"  >Niger</option>
              <option value="156"  >Nigeria</option>
              <option value="157"  >Niue</option>
              <option value="158"  >Norfolk Island</option>
              <option value="159"  >Northern Mariana Islands</option>
              <option value="160"  >Norway</option>
              <option value="161"  >Oman</option>
              <option value="162"  >Pakistan</option>
              <option value="163"  >Palau</option>
              <option value="164"  >Panama</option>
              <option value="165"  >Papua New Guinea</option>
              <option value="166"  >Paraguay</option>
              <option value="167"  >Peru</option>
              <option value="168"  >Philippines</option>
              <option value="169"  >Pitcairn</option>
              <option value="170"  >Poland</option>
              <option value="171"  >Portugal</option>
              <option value="172"  >Puerto Rico</option>
              <option value="173"  >Qatar</option>
              <option value="174"  >Reunion</option>
              <option value="175"  >Romania</option>
              <option value="176"  >Russian Federation</option>
              <option value="177"  >Rwanda</option>
              <option value="178"  >Saint Kitts and Nevis</option>
              <option value="179"  >Saint Lucia</option>
              <option value="180"  >Saint Vincent and the Grenadines</option>
              <option value="181"  >Samoa</option>
              <option value="182"  >San Marino</option>
              <option value="183"  >Sao Tome and Principe</option>
              <option value="184"  >Saudi Arabia</option>
              <option value="185"  >Senegal</option>
              <option value="186"  >Seychelles</option>
              <option value="187"  >Sierra Leone</option>
              <option value="188"  >Singapore</option>
              <option value="189"  >Slovak Republic</option>
              <option value="190"  >Slovenia</option>
              <option value="191"  >Solomon Islands</option>
              <option value="192"  >Somalia</option>
              <option value="193"  >South Africa</option>
              <option value="194"  >South Georgia &amp; South Sandwich Islands</option>
              <option value="195"  >Spain</option>
              <option value="196"  >Sri Lanka</option>
              <option value="197"  >St. Helena</option>
              <option value="198"  >St. Pierre and Miquelon</option>
              <option value="199"  >Sudan</option>
              <option value="200"  >Suriname</option>
              <option value="201"  >Svalbard and Jan Mayen Islands</option>
              <option value="202"  >Swaziland</option>
              <option value="203"  >Sweden</option>
              <option value="204"  >Switzerland</option>
              <option value="205"  >Syrian Arab Republic</option>
              <option value="206"  >Taiwan</option>
              <option value="207"  >Tajikistan</option>
              <option value="208"  >Tanzania, United Republic of</option>
              <option value="209"  >Thailand</option>
              <option value="210"  >Togo</option>
              <option value="211"  >Tokelau</option>
              <option value="212"  >Tonga</option>
              <option value="213"  >Trinidad and Tobago</option>
              <option value="214"  >Tunisia</option>
              <option value="215"  >Turkey</option>
              <option value="216"  >Turkmenistan</option>
              <option value="217"  >Turks and Caicos Islands</option>
              <option value="218"  >Tuvalu</option>
              <option value="219"  >Uganda</option>
              <option value="220"  >Ukraine</option>
              <option value="221"  >United Arab Emirates</option>
              <option value="222"  >United Kingdom</option>
              <option value="223"  >United States</option>
              <option value="224"  >United States Minor Outlying Islands</option>
              <option value="225"  >Uruguay</option>
              <option value="226"  >Uzbekistan</option>
              <option value="227"  >Vanuatu</option>
              <option value="228"  >Vatican City State (Holy See)</option>
              <option value="229"  >Venezuela</option>
              <option value="230"  >Viet Nam</option>
              <option value="231"  >Virgin Islands (British)</option>
              <option value="232"  >Virgin Islands (U.S.)</option>
              <option value="233"  >Wallis and Futuna Islands</option>
              <option value="234"  >Western Sahara</option>
              <option value="235"  >Yemen</option>
              <option value="237"  >Democratic Republic of Congo</option>
              <option value="238"  >Zambia</option>
              <option value="239"  >Zimbabwe</option>
              <option value="240"  >Jersey</option>
              <option value="241"  >Guernsey</option>
              <option value="242"  >Montenegro</option>
              <option value="243"  >Serbia</option>
              <option value="244"  >Aaland Islands</option>
              <option value="245"  >Bonaire, Sint Eustatius and Saba</option>
              <option value="246"  >Curacao</option>
              <option value="247"  >Palestinian Territory, Occupied</option>
              <option value="248"  >South Sudan</option>
              <option value="249"  >St. Barthelemy</option>
              <option value="250"  >St. Martin (French part)</option>
              <option value="251"  >Canary Islands</option>

              </select>
          </div>
        </div>
        <div class="col-md-12">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">

              <span class="input-group-text"><i class="ni ni-camera-compact"></i>&nbsp; Avatar</span>
            </div>
            <input class="form-control" placeholder="photo"  type="file" name="photo"  autocomplete="photo" autofocus>
          </div>
        </div>
        <div class="col-md-12" hidden="true">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-camera-compact"></i>&nbsp; Documento</span>
            </div>
            <input class="form-control" placeholder="photoDoc"  type="file" name="photoDoc"  autocomplete="photoDoc" autofocus>
          </div>
        </div>
        <div class="col-md-6" hidden="true">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-button-power"></i>&nbsp;  Desactivar</span>
            </div>
              <label class="custom-toggle" >
                  <input type="checkbox" name="isActive"  checked>
                  <span class="custom-toggle-slider rounded-circle " data-label-off="No" data-label-on="Yes"></span>
              </label><span class="input-group-text"> Activar</span>
          </div>
        </div>

        <div class="col-md-6" hidden="true">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
              <select id="level" name="level" class="form-control" required>
                <option value="{{ $user->level }}">Tipo de nivel</option>
                  <option value="1"  >USUARIO</option>
                  <option value="2"  >DIRECTOR</option>
                  <option value="3"  >DIRECTOR JUNIOR</option>
                  <option value="4"  >DIRECTOR SENIOR</option>
                  <option value="5"  >VICE PRESIDENTE</option>
              </select>
          </div>
        </div>

        <div class="col-md-12" hidden="true">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-email-83"></i></span>
            </div>
              <input class="form-control" placeholder="Email" type="email" name="email" autocomplete="email" value="{{ $user->email }}" autofocus >
          </div>
        </div>


        <div class="col-md-12" hidden="true">
          <p>Ingrese un valor sólo si desea cambiar el código de referido.</p>
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
            </div>
            <input class="form-control" placeholder="Código de referido" type="text" name="ownerId" value="{{ $user->ownerId }}"  autocomplete="ownerId" autofocus>
          </div>
        </div>

        <div class="col-md-4">
          <button type="submit" class="btn btn-outline-default" ><i class="ni ni-satisfied"></i> Editar Usuario</button>
        </div>
        </div>

        <div class="col-md-4">
            <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                  <div class="modal-header">
                      <h6 class="modal-title" id="modal-title-notification">Se requiere tu atención</h6>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x"></i>
                          <h4 class="heading mt-4">¡Deberías leer esto!</h4>
                          <p>Precaución esta acción cambiara los datos del usuario.</p>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-outline-default">
                        <i class="ni ni-check-bold"></i> Guardar Cambios
                      </button>
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
        </div>

  </form>
            </div>
          </div>
        </div>


    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
