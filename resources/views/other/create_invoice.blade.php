@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">CREATE INVOICE</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Accounts</a></li>
                <li class="breadcrumb-item"><span> CREATE INVOICE</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="content-page">
       <div class="card">
          <div class="card-body">
             <div class="row">
                <div class="col-sm-12">
                   <form>
                      <div class="row">
                         <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                               <label>Role <span class="text-danger">*</span></label>
                               <select class="form-control select">
                                    <option>Select</option>
                                    <option selected>Management</option>
                                    <option>staff</option>
                                 </select>
                            </div>
                         </div>
                         <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                               <label>Email</label>
                               <input type="text" class="form-control">
                            </div>
                         </div>
                         <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                               <label>Tax</label>
                               <select class="form-control select">
                                    <option>Select Tax</option>
                                    <option>VAT</option>
                                    <option>Gst</option>
                                    <option>No Tax</option>
                                 </select>
                            </div>
                         </div>
                         <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                               <label>Client Address</label>
                               <textarea class="form-control" placeholder="Client Address" rows="4"></textarea>
                            </div>
                         </div>
                         <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                               <label>Billing Address</label>
                               <textarea class="form-control" placeholder="Billing Address" rows="4"></textarea>
                            </div>
                         </div>
                         <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                               <label>Invoice date <span class="text-danger">*</span></label>
                               <input class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker">
                            </div>
                         </div>
                         <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                               <label>Due Date <span class="text-danger">*</span></label>
                               <input class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker">
                            </div>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-12 col-sm-12">
                            <div class="table-responsive">
                               <table class="table custom-table">
                                  <thead class="thead-light">
                                     <tr>
                                        <th style="width: 20px">#</th>
                                        <th class="col-sm-2">Item</th>
                                        <th class="col-md-6">Description</th>
                                        <th style="width:100px;">Unit COST</th>
                                        <th style="width:80px;">Qty</th>
                                        <th>Amount</th>
                                        <th> </th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                     <tr>
                                        <td>1</td>
                                        <td>
                                           <input class="form-control" type="text" style="min-width:150px">
                                        </td>
                                        <td>
                                           <input class="form-control" type="text" style="min-width:150px">
                                        </td>
                                        <td>
                                           <input class="form-control" style="width:100px" type="text">
                                        </td>
                                        <td>
                                           <input class="form-control" style="width:80px" type="text">
                                        </td>
                                        <td>
                                           <input class="form-control" readonly="" style="width:120px" type="text">
                                        </td>
                                        <td><a href="javascript:void(0)" class="text-success font-18" title="Add"><i class="fas fa-plus"></i></a></td>
                                     </tr>
                                     <tr>
                                        <td>2</td>
                                        <td>
                                           <input class="form-control" type="text" style="min-width:150px">
                                        </td>
                                        <td>
                                           <input class="form-control" type="text" style="min-width:150px">
                                        </td>
                                        <td>
                                           <input class="form-control" style="width:100px" type="text">
                                        </td>
                                        <td>
                                           <input class="form-control" style="width:80px" type="text">
                                        </td>
                                        <td>
                                           <input class="form-control" readonly="" style="width:120px" type="text">
                                        </td>
                                        <td><a href="javascript:void(0)" class="text-danger font-18" title="Remove"><i class="fas fa-trash-alt" aria-hidden="true"></i></a></td>
                                     </tr>
                                  </tbody>
                               </table>
                            </div>
                            <div class="table-responsive">
                               <table class="table custom-table">
                                  <tbody>
                                     <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-right">Total</td>
                                        <td style="text-align: right; padding-right: 30px;width: 230px">0</td>
                                     </tr>
                                     <tr>
                                        <td colspan="5" class="text-right">Tax</td>
                                        <td style="text-align: right; padding-right: 30px;width: 230px">
                                           <input class="form-control text-right" value="0" readonly="" type="text">
                                        </td>
                                     </tr>
                                     <tr>
                                        <td colspan="5" class="text-right">
                                           Discount %
                                        </td>
                                        <td style="text-align: right; padding-right: 30px;width: 230px">
                                           <input class="form-control text-right" type="text">
                                        </td>
                                     </tr>
                                     <tr>
                                        <td colspan="5" style="text-align: right; font-weight: bold">
                                           Grand Total
                                        </td>
                                        <td style="text-align: right; padding-right: 30px; font-weight: bold; font-size: 16px;width: 230px">
                                           $ 0.00
                                        </td>
                                     </tr>
                                  </tbody>
                               </table>
                            </div>
                            <div class="row">
                               <div class="col-md-12">
                                  <div class="form-group">
                                     <label>Other Information</label>
                                     <input type="text" class="form-control">
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                              @if(checkAccess('create-invoice','add_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>@endif
                                 <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
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
@endsection