@extends('frontend.layouts.master')
@section('page_content')
    <section id="tracking-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-box" id="tracking-wdh">
                        <h2>Track Your Parcel</h2>
                        <form>
                            <div class="form-group">
                                <input type="text" id="otp" value="621691143376" required>
                            </div>
                            <div class="sub-btns text-center">
                                <button type="submit" class="btn">Track</button>
                            </div>
                        </form>
                       <!--  <div class="tracking-table">
                            <h3><a href="#">Multiple Tracking Numbers | Need Help?</a></h3>
                        </div> -->
                        <!-- <div class="table-formet">
                            <table class="table-responsive">
                                <thead>
                                    <tr>
                                        <th>Scheduled delivery date</th>
                                        <th>Delivery status</th>
                                        <th>Way bill number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-blk">08/12/2022</td>
                                        <td class="text-orng">In Transit</td>
                                        <td class="text-blk">621691143376</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->
                    </div>


                </div>
            </div>
        </div>
    </section>

   <!--  <section id="tracking-body">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-8">
                    <div class="shipment-details">
                        <h3>Shipment Facts</h3>
                        <div class="shipment-table-formet">
                            <table class="table-responsive">
                                <tbody>
                                    <tr>
                                        <td class="texts-light">Tracking Number </td>
                                        <td class="text-dark">621691143376</td>
                                    </tr>
                                    <tr>
                                        <td class="texts-light">Ship Date</td>
                                        <td class="text-dark">08/12/2022</td>
                                    </tr>
                                    <tr>
                                        <td class="texts-light">Standard Transit</td>
                                        <td class="text-dark">13/12/2022 Before 20:00</td>
                                    </tr>
                                    <tr>
                                        <td class="texts-light">Scheduled Delivery</td>
                                        <td class="text-dark">Pending</td>
                                    </tr>
                                    <tr>
                                        <td class="texts-light">Service</td>
                                        <td class="text-dark">Fedex International Priority</td>
                                    </tr>
                                    <tr>
                                        <td class="texts-light">Shipper</td>
                                        <td class="text-dark">Shipper</td>
                                    </tr>
                                    <tr>
                                        <td class="texts-light">Special Handling Section</td>
                                        <td class="text-dark">Deliver Weekday</td>
                                    </tr>
                                    <tr>
                                        <td class="texts-light">Weight</td>
                                        <td class="text-dark">8.1 Lbs/3.67 Kgs</td>
                                    </tr>
                                    <tr>
                                        <td class="texts-light">Dimensions</td>
                                        <td class="text-dark">17X12X4 In.</td>
                                    </tr>
                                    <tr>
                                        <td class="texts-light">Total Pieces</td>
                                        <td class="text-dark">1</td>
                                    </tr>
                                    <tr>
                                        <td class="texts-light">Total Shipment Weight</td>
                                        <td class="text-dark">8.1 Lbs/3.67 Kgs</td>
                                    </tr>
                                    <tr>
                                        <td class="texts-light">Packaging</td>
                                        <td class="text-dark">Your Packaging</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="progress">
                        <div class="progress-bar"></div>
                        <div class="pro-arrow"><img src="assets/images/right-arrow.svg" alt="" class="img-responsive"></div>
                    </div>
                                <p>Grapevine, Tx Us Label Created 8/12/2022 2:46 Pm</p>
                            </li>
                            <li> 
                                <h3>Package Received By Fedex</h3>
                                <p>Irving, Tx 8/12/2022 3:17 Pm</p>
                            </li>
                            <li> 
                                <h3>In Transit</h3>
                                <p>Mumbai In 27/12/2022 12:51 Pm</p>
                            </li>
                            <li> 
                                <h3>Out For Delivery</h3>
                                <p></p>
                            </li>
                            <li> 
                                <h3>To</h3>
                                <p>Madhya Pradesh, In Scheduled Delivery Date Pending</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

@endsection
