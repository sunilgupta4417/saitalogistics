@extends('frontend.layouts.master')
@section('page_content')
    <section id="where-from-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="where-from-design">
                        <h3 class="shipment-heading">Create New Shipment</h3>
                        <form id="signUpForm" action="{{ url('user/shipment/store') }}" method="POST">
                            {{ csrf_field() }}
                              <!-- start step indicators -->
                              <div class="form-header d-flex">
                                    <span class="stepIndicator">Where From</span>
                                    <span class="stepIndicator">Where Going</span>
                                    <span class="stepIndicator">What</span>
                                    <span class="stepIndicator">How</span>
                                    <span class="stepIndicator">Review</span>
                                    <span class="stepIndicator">Payment</span>
                                    <span class="stepIndicator lasting">Complete</span>
                              </div>
                              <!-- end step indicators -->

                                <!-- Step1 -->
                                <div class="step">
                                    <div class="row">
                                        <div class="inter-form">
                                            <div class="maining-heading">
                                                <h3 class="mb-4">Where Are You Shipment Form?</h3>
                                            </div>
                                            <div class="form-group">
                                                <label>Country</label>
<select id="select-service" required name="S_country"> 
<option label="Select a country ... " selected="selected" >Select a country ... </option>   
<option value="Afghanistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antartica">Antarctica</option>
<option value="Antigua and Barbuda">Antigua and Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
<option value="Botswana">Botswana</option>
<option value="Bouvet Island">Bouvet Island</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
<option value="Brunei Darussalam">Brunei Darussalam</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Islands">Cocos (Keeling) Islands</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Congo">Congo, the Democratic Republic of the</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cota D'Ivoire">Cote d'Ivoire</option>
<option value="Croatia">Croatia (Hrvatska)</option>
<option value="Cuba">Cuba</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands (Malvinas)</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="France Metropolitan">France, Metropolitan</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Territories">French Southern Territories</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guinea-Bissau">Guinea-Bissau</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
<option value="Holy See">Holy See (Vatican City State)</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran (Islamic Republic of)</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
<option value="Korea">Korea, Republic of</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Lao">Lao People's Democratic Republic</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon" selected>Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
<option value="Madagascar">Madagascar</option>
<option value="Malawi">Malawi</option>
<option value="Malaysia">Malaysia</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Micronesia">Micronesia, Federated States of</option>
<option value="Moldova">Moldova, Republic of</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Namibia">Namibia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherlands">Netherlands</option>
<option value="Netherlands Antilles">Netherlands Antilles</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Northern Mariana Islands">Northern Mariana Islands</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau">Palau</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Philippines">Philippines</option>
<option value="Pitcairn">Pitcairn</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russian Federation</option>
<option value="Rwanda">Rwanda</option>
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
<option value="Saint LUCIA">Saint LUCIA</option>
<option value="Saint Vincent">Saint Vincent and the Grenadines</option>
<option value="Samoa">Samoa</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia (Slovak Republic)</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="South Georgia">South Georgia and the South Sandwich Islands</option>
<option value="Span">Spain</option>
<option value="SriLanka">Sri Lanka</option>
<option value="St. Helena">St. Helena</option>
<option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Svalbard">Svalbard and Jan Mayen Islands</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syrian Arab Republic</option>
<option value="Taiwan">Taiwan, Province of China</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania, United Republic of</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad and Tobago">Trinidad and Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks and Caicos">Turks and Caicos Islands</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Emirates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States">United States</option>
<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
<option value="Uruguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Viet Nam</option>
<option value="Virgin Islands (British)">Virgin Islands (British)</option>
<option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
<option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
<option value="Western Sahara">Western Sahara</option>
<option value="Yemen">Yemen</option>
<option value="Serbia">Serbia</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
</select>                                 
                                                
                                            </div>
                                            <div class="form-group">
                                                <label>Company Or Name</label>
                                                <input type="text" name="S_name" id="sname" oninput="this.className = ''" >
                                            </div>
                                            <div class="form-group">
                                                <label>Contact</label>
                                                <input type="number" name="S_contact" id="scontact" oninput="this.className = ''" >
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" name="S_address" id="saddress" oninput="this.className = ''">
                                            </div>
                                            <div class="form-group">
                                                <label>Apartment / Suite / Unit / Building etc</label>
                                                <input type="text" name="S_appartment" id="sappartment" oninput="this.className = ''" >
                                            </div>
                                            <div class="form-group">
                                                <label>Department, C/D etc</label>
                                                <input type="text" name="S_department" oninput="this.className = ''" >
                                            </div>
                                            <div class="form-group">
                                                <label>Postcode</label>
                                                <input type="number" name="S_pincode" id="spincode" oninput="this.className = ''" >
                                            </div>
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" oninput="this.className = ''" name="S_city" id="scity">
                                            </div>
                                            <div class="form-group">
                                                <label>Other Address Information</label>
                                                <input type="text" oninput="this.className = ''" name="S_other">
                                            </div>

                                            <div class="form-group agreed-text not-boarding">
                                                <label class="container">
                                                    <p><b>Use this as my default address</b></p>
                                                    <input type="radio" name="S_address_type" value="Default">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>

                                            <div class="form-group agreed-text not-boarding">
                                                <label class="container">
                                                    <p><b>This Is A Residential Address</b></p>
                                                    <input type="radio" name="S_address_type" value="Residential">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="form-group"></div>

                                            <div class="form-group">
                                                <label>Email Id</label>
                                                <input type="text" oninput="this.className = ''" name="S_email">
                                            </div>

                                            <div class="form-group">
                                                <label>Telephone</label>
                                                <input type="text" oninput="this.className = ''" name="S_phone">
                                            </div>

                                            <div class="form-group">
                                                <label>KYC Document</label>
                                                <select id="select-service" required="" oninput="this.className = ''" name="S_idProof">
                                                    <option></option>
                                                    <option value="aadhar card">Aadhar Card</option>
                                                    <option value="voter id card">Voter Id Card</option>
                                                    <option value="driving licence">Driving Licence</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Upload KYC Id Image Front</label>
                                                <input type="file" oninput="this.className = ''" name="S_kycFront" class="">
                                            </div>

                                            <div class="form-group">
                                                <label>Upload KYC Id Image Back</label>
                                                <input type="file" oninput="this.className = ''" name="S_kycBack">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step2 -->
                                <div class="step">
                                    <div class="row">
                                        <div class="inter-form">
                                            <div class="maining-heading">
                                                <h3 class="mb-4">Where Is Your Shipping Going?</h3>
                                            </div>
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select id="select-service" required="" oninput="this.className = ''" name="R_country" id="rcountry">
                                                    <option></option>
                                                    <option value="indicator">India</option>
                                                    <option value="UK">UK</option>
                                                    <option value="USA">USA</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Company Or Name</label>
                                                <input type="text" oninput="this.className = ''" name="R_name" id="rname">
                                            </div>
                                            <div class="form-group">
                                                <label>Contact</label>
                                                <input type="number" oninput="this.className = ''" name="R_contact" id="rcontact">
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" oninput="this.className = ''" name="R_address" id="raddress">
                                            </div>
                                            <div class="form-group">
                                                <label>Apartment / Suite / Unit / Building etc</label>
                                                <input type="text" oninput="this.className = ''" name="R_appartment">
                                            </div>
                                            <div class="form-group">
                                                <label>Department, C/D etc</label>
                                                <input type="text" oninput="this.className = ''" name="R_department">
                                            </div>
                                            <div class="form-group">
                                                <label>Postcode</label>
                                                <input type="number" oninput="this.className = ''" name="R_pincode">
                                            </div>
                                            <div class="form-group">
                                                <label>City</label>
                                                 <input type="text" oninput="this.className = ''" name="R_city">
                                            </div>
                                            <div class="form-group">
                                                <label>Other Address Information</label>
                                                <input type="text" oninput="this.className = ''" name="R_other">
                                            </div>

                                            <div class="form-group">
                                                <label>Email Id</label>
                                                <input type="text" oninput="this.className = ''" name="R_email">
                                            </div>

                                            <div class="form-group">
                                                <label>Telephone</label>
                                                <input type="text" oninput="this.className = ''" name="R_phone">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!--  Step3 -->
                                <div class="step">
                                    <div class="row">
                                        <div class="inter-form">
                                            <div class="maining-heading">
                                                <h3 class="mb-4">Whats Your Shipment</h3>
                                            </div>
                                            <div class="where-boxing">
                                                <div class="form-group">
                                                    <label>Courier Type</label>
                                                    <select id="select-service" required="" oninput="this.className = ''" name="courier_type">
                                                        <option></option>
                                                        <option value="Fedex">Fedex</option>
                                                        <option value="DHL">DHL</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Weight</label>
                                                    <input type="text" oninput="this.className = ''" name="weight" id="weight">
                                                </div>
                                                <div class="form-group">
                                                    <label>Length</label>
                                                    <input type="text" oninput="this.className = ''" name="length" id="length">
                                                </div>
                                                <div class="form-group">
                                                    <label>Width</label>
                                                    <input type="text" oninput="this.className = ''" name="width" id="width">
                                                </div>
                                                <div class="form-group">
                                                    <label>Height</label>
                                                    <input type="text" oninput="this.className = ''" name="height" id="height">
                                                </div>
                                                <div class="form-group">
                                                    <label>Declared value</label>
                                                    <input type="text" oninput="this.className = ''" name="dvalue" id="dvalue">
                                                </div>
                                                <div class="form-group">
                                                    <label>Item type</label>
                                                    <input type="text" oninput="this.className = ''" name="item_type" id="item_type">
                                                </div>
                                                <div class="form-group">
                                                    <label>Shipping charges</label>
                                                    <input type="text" oninput="this.className = ''" name="shipping_charge">
                                                </div>
                                            </div>
                                            <div class="step-image">
                                                <img src="assets/images/step-img.png" alt="" class="img-responsive">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step4 -->
                                <div class="step">
                                    <div class="row">
                                        <div class="inter-form">
                                            <div class="maining-heading">
                                                <h3 class="mb-4">How Would You Like To Ship?</h3>
                                            </div>

                                            <div class="form-group agreed-text full-widthing">
                                                <label>Would you like to pickup your shipment?</label>
                                                <label class="container">
                                                    <p><b>Would you like to drop your shipment?</b></p>
                 <input type="radio" checked="checked" name="dropPickup" value="cdrop" onclick="show1();">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>

                                            <div class="form-group agreed-text full-widthing">
                                                <label class="container">
                                                    <p><b>Yes pickup my shipment</b></p>
                <input type="radio" name="dropPickup" value="cpickup" onclick="show2();">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label>Drop off date</label>
                                                <input data-provide="datepicker" id="dropDate" type="text" oninput="this.className = ''" name="date">
                                            </div>



                                        </div>
                                    </div>
                                </div>

                                <!-- Step5 -->
                                <div class="step">
                                    <div class="inter-form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="maining-heading">
                                                    <h3 class="mb-4">Where From</h3>
                                                    <a href="#" class="edit-clss" style="display:none">Edit</a>
                                                </div>
                                                <div class="maing-address">
                                                    <h4 class="rsname">Tayla Dhyll</h4>
                                                    <p  class="rsaddress">Unit 222, Rosden House 372 Old St, London, Greater London EC1 9AU, GB</p>
                                                    <b  class="rscontact">+15678987645</b>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="maining-heading">
                                                    <h3 class="mb-4">Where Going</h3>
                                                    <a href="#" class="edit-clss" style="display:none">Edit</a>
                                                </div>
                                                <div class="maing-address">
                                                    <h4 class="rrname">Tayla Dhyll</h4>
                                                    <p class="rraddress">Unit 222, Rosden House 372 Old St, London, Greater London EC1 9AU, GB</p>
                                                    <b class="rrcontact">+15678987645</b>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="what-details">
                                                    <div class="what-detail-iner">
                                                        <h3>What</h3>
                                                        <a href="#" class="edit-clss" style="display:none">Edit</a>
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                  <td>Weight</td>
                                                                  <td class="rweight">8.1 Lbs/3.67 Kgs</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Dimensions</td>
                                                                  <td class="rdim">17X12X4 In.</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Total Pieces</td>
                                                                  <td class="rpiece">1</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Total Shipment Weight</td>
                                                                  <td class="rtweight">8.1 Lbs/3.67 Kgs</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Packaging</td>
                                                                  <td class="rpackaging">Your Packaging</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="what-details">
                                                    <div class="what-detail-iner">
                                                        <h3>How</h3>
                                                        <a href="#" class="edit-clss" style="display:none">Edit</a>
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                  <td>Type selected</td>
                                                                  <td class="rdrop">I will drop it off</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Drop date</td>
                                                                  <td class="rdropdate">22 Feb 2023</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Drop address</td>
                                                                  <td>Unit 222, Rosden House 372 Old St, London, Greater London EC1 9AU, GB</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="what-details">
                                                    <div class="agreed-text not-boarding">
                                                        <label class="container">
                                                            <p style="font-size:14px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>
                                                            <input type="radio" name="radio">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step6 -->
                                <div class="step">
                                    <div class="row">
                                        <div class="inter-form">
                                            <div class="maining-heading">
                                                <h3 class="mb-4">Who Would You Like To Pay?</h3>
                                            </div>
                                            <div class="where-boxing">
                                                Coming soon
                                            </div>
                                            <div class="paymment-right-details">
                                                <h3>Amount Payables Details</h3>
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                          <td><b>Particulars</b></td>
                                                          <td><b>Amount</b></td>
                                                        </tr>
                                                        <tr>
                                                          <td>Total</td>
                                                          <td>$<?php echo $total = rand(20 , 30);?></td>
                                                        </tr>
                                                        <tr>
                                                          <td>Tax & Duties</td>
                                                          <td>$<?php echo $tax = rand(5 , 10)?></td>
                                                        </tr>
                                                        <tr>
                                                          <td><b>Payable Amount</b></td>
                                                          <td><b>$ <?php echo $total + $tax?></b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="payment-details">
                                                <h3>Duties & Taxes</h3>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley .</p>
                                            </div>
                                             <div class="payment-btns">
                                                <input type="submit" class="down-btn" name="submit" value="Proceed to Pay">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                               

                                <!-- Step7 -->
                                <div class="step">
                                    <div class="row">
                                        <div class="inter-form">
                                            <div class="payment-successful">
                                                <img src="assets/images/successful.svg" alt="" class="img-responsive">
                                                <h3>Payment Successful</h3>
                                                <p>Your shipment has been successfully added Track with your Waybill No. <b>3456789098</b></p>
                                            </div>
                                            <div class="payment-btns">
                                                <a href="#" class="down-btn">Download Invoice</a>
                                                <a href="#" class="done-btn">Done</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- start previous / next buttons -->
                                <div class="form-footer">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)"><img src="assets/images/back-btn.svg" alt="" class="img-responsive"> Back</button>
                                    <button type="button" id="cencalBtn">Cancel</button>
                                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Continue</button>
                                </div>
                              <!-- end previous / next buttons -->
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_body_scripts')
<script>
     $('.tab-link').click( function() {
     
     var tabID = $(this).attr('data-tab');
     
     $(this).addClass('active').siblings().removeClass('active');
     
     $('#tab-'+tabID).addClass('active').siblings().removeClass('active');
     });
    </script>


    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
            showTab(currentTab); // Display the current tab
            
            function showTab(n) {
              // This function will display the specified tab of the form...
              var x = document.getElementsByClassName("step");
              x[n].style.display = "block";
              //... and fix the Previous/Next buttons:
              if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
              } else {
                document.getElementById("prevBtn").style.display = "inline";
              }
              if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
              } else {
                document.getElementById("nextBtn").innerHTML = "Continue";
              }
              //... and run a function that will display the correct step indicator:
              fixStepIndicator(n)
            }
            
            function nextPrev(n) {
                console.log(n)
              // This function will figure out which tab to display
              var x = document.getElementsByClassName("step");
              // Exit the function if any field in the current tab is invalid:
              if (n == 1 && !validateForm()) return false;
              // Hide the current tab:
              x[currentTab].style.display = "none";
              // Increase or decrease the current tab by 1:
              currentTab = currentTab + n;
              console.log(currentTab);
              if(currentTab==5)
              {
                $(".form-footer").hide();
              }
              else
              {
                $(".form-footer").show();
              }
              if(currentTab==4)
              {
                $(".rsname").html($("#sname").val())
                $(".rsaddress").html($("#saddress").val())
                $(".rscontact").html($("#scontact").val())
                $(".rrname").html($("#rname").val())
                $(".rraddress").html($("#raddress").val())
                $(".rrcontact").html($("#rcontact").val())

                $(".rweight").html($("#weight").val())
                $(".rdim").html($("#length").val()+' * '+$("#width").val()+' * '+$("#height").val())
                $(".rpiece").html(1)
                $(".rtweight").html($("#weight").val())

                if($('input[name="dropPickup"]:checked').val()=='cdrop')
                {
                    $(".rdrop").html('I will drop it off')
                }
                else if($('input[name="dropPickup"]:checked').val()=='cdrop')
                {
                    $(".rdrop").html('Pickup my shipment')
                }
                else
                {
                    $(".rdrop").html()
                }
                
                $(".rdropdate").html($("#dropDate").val())
              }
              
              // if you have reached the end of the form...
              if (currentTab >= 6) {
                // ... the form gets submitted:
                document.getElementById("signUpForm").submit();
                return false;
              }
              // Otherwise, display the correct tab:
              showTab(currentTab);
            }
            
            function validateForm() {
              // This function deals with validation of the form fields
              var x, y, i, valid = true;
              x = document.getElementsByClassName("step");
              y = x[currentTab].getElementsByTagName("input");
              // A loop that checks every input field in the current tab:
              for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                  // add an "invalid" class to the field:
                  y[i].className += " invalid";
                  // and set the current valid status to false
                  valid = false;
                }
              }
              // If the valid status is true, mark the step as finished and valid:
              if (valid) {
                document.getElementsByClassName("stepIndicator")[currentTab].className += " finish";
              }
              return valid; // return the valid status
            }
            
            function fixStepIndicator(n) {
              // This function removes the "active" class of all steps...
              var i, x = document.getElementsByClassName("stepIndicator");
              for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
              }
              //... and adds the "active" class on the current step:
              x[n].className += " active";
            }
    </script>

    <script type="text/javascript"> 
        function show1(){
  document.getElementById('div1').style.display ='none';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
}
    </script>


@endsection
