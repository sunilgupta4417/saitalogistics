<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Common;
use App\Models\{
    User,
    PacketBooking,
    Country
    };
use Illuminate\Support\Facades\{Artisan,
    Validator,
    Session,
    Hash,
    Auth,
    DB
};    

class DashboardController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper       = new Common();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $data['user'] = User::where(['id' => auth()->user()->id])->first();
        return view('frontend.dashboard.index', $data);
    }

    public function update_profile(Request $request)
    {
        $rules = array(
                    'name'            => 'required',
                    'mobile'                 => 'required',
                    'file' => 'mimes:jpeg,jpg,png,gif,gif | max:5120',
                );

                $fieldNames = array(
                    'name'            => 'First Name',
                    'mobile'                 => 'Mobile',
                    'file'   =>"Profile Pic",
                ); 
        $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);
            if ($validator->fails())
            {
                return back()->withErrors($validator)->withInput();
            }
            else
            {        
                $user = User::where(['id' => Auth::user()->id])->first();
                $user->name = $request->name;
                $user->mobile_no = $request->mobile;
                $user->phn_code = $request->phn_code;
                $picture = $request->file;
            if (isset($picture))
            {
                 $imageName = time().'.'.$request->file->extension();  
     
                $ext      = strtolower($request->file->extension());

                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp')
                {
                    $request->file->move(public_path('/assets/images/profile/'), $imageName);
                    $user->profile_pic = $imageName;

                }
                else
                {
                       $this->helper->one_time_message('error', 'Invalid Image Format!');
                        return back();
                }
            }
            $user->save();

            }  

            $this->helper->one_time_message('success', __('Profile Updated successfully!'));
            return redirect('user/dashboard');  

    }


    public function update_password(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password'     => 'required',
        ]);

        $user = User::where(['id' => Auth::user()->id])->first();

        if (Hash::check($request->old_password, $user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();

            $this->helper->one_time_message('success', __('Password Updated successfully!'));
            return redirect('user/dashboard'); 
        }
        else
        {
            $this->helper->one_time_message('error', __('Old Password is Wrong!'));
            return redirect('user/dashboard'); 
        }
    }

    public function get_shipment()
    {
        $data['shipments'] = PacketBooking::where(['client_id' => auth()->user()->id])->get();
        return view('frontend.dashboard.shipment_history', $data);
    }

    public function create_shipment()
    {
        $data['country'] = Country::where(['isActive' => 1])->get();
        $data['user'] = User::where(['id' => auth()->user()->id])->first();
        return view('frontend.dashboard.shipment_create', $data);

    }

    public function shipping_success()
    {
        $data['user'] = User::where(['id' => auth()->user()->id])->first();
        return view('frontend.dashboard.shipment_success', $data);

    }

    public function store_shipment(Request $request)
    {
        if($request->S_address_type=='Default')
        {
            $S_default = 1;
            $S_residential = 0;
        }
        else if($request->S_address_type=='Residential')
        {
            $S_default = 0;
            $S_residential = 1;
        }
        else
        {
            $S_default = 0;
            $S_residential = 0;
        }
        if($request->dropPickup=='cdrop')
        {
            $cpickup = 0;
            $cdrop = 1;
        }
        else if($request->dropPickup=='cpickup')
        {
            $cpickup = 1;
            $cdrop = 0;
        }
        else
        {
            $cpickup = 0;
            $cdrop = 0;
        }
        $backImg = $frontImg = '';
        if (isset($request->S_idFront))
            {
                $picture = $request->S_idFront;
                $ext      = strtolower($picture->getClientOriginalExtension());
                $filename = time() . '.' . $ext;

                $dir1 = public_path('/assets/images/profile/' . $filename);

                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp')
                {
                    $img = Image::make($picture->getRealPath());

                    $img->resize(100, 100)->save($dir1);

                  $frontImg = $filename;
                }
                else
                {
                       $frontImg = '';
                }
            }
            if (isset($request->S_idBack))
            {
                $picture = $request->S_idBack;
                $ext      = strtolower($picture->getClientOriginalExtension());
                $filename = time() . '.' . $ext;

                $dir1 = public_path('/assets/images/profile/' . $filename);

                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp')
                {
                    $img = Image::make($picture->getRealPath());

                    $img->resize(100, 100)->save($dir1);

                   $backImg = $filename;
                }
                else
                {
                       $backImg = '';
                }
            }
        $shipment = new PacketBooking();
        $shipment->client_id = auth()->user()->id;
        $shipment->csr_country_id = $request->S_country;
        $shipment->csr_consignor= $request->S_name;
        $shipment->csr_contact_person = $request->S_contact;
        $shipment->csr_address1 = $request->S_address;
        $shipment->csr_address2 = $request->S_appartment;
        $shipment->csr_address3 = $request->S_department;
        $shipment->csr_pincode = $request->S_pincode;
        $shipment->csr_city_id = $request->S_city;
        //$shipment->S_other = $request->S_other;
        //$shipment->S_default = $S_default;
        //$shipment->S_residential = $S_residential;
        $shipment->csr_email_id = $request->S_email;
        $shipment->csr_mobile_no = $request->S_phone;
        //$shipment->S_idProof = $request->S_idProof;
        //$shipment->S_idFront = $frontImg;
        //$shipment->S_idBack = $backImg;
        $shipment->csn_country_id = $request->R_country;
        $shipment->csn_consignor = $request->R_name;
        $shipment->csn_contact_person = $request->R_contact;
        $shipment->csn_address1 = $request->R_address;
        $shipment->csn_address2 = $request->R_appartment;
        $shipment->csn_address3 = $request->R_department;
        $shipment->csn_pincode = $request->R_pincode;
        $shipment->csn_city_id = $request->R_city;
        //$shipment->R_other = $request->R_other;
        $shipment->csn_email_id = $request->R_email;
        $shipment->csn_mobile_no = $request->R_phone;
        //$shipment->courier_type = $request->courier_type;
        $shipment->pcs_weight = $request->weight;
        //$shipment->length = $request->length;
        //$shipment->width = $request->width;
        //$shipment->height = $request->height;
        //$shipment->dvalue = $request->dvalue;
        $shipment->packet_type = $request->item_type;
        //$shipment->shipping_charge = $request->shipping_charge;
        //$shipment->cpickup = $cpickup;
        //$shipment->cdrop = $cdrop;
        //$shipment->dpDate = $request->date;
        //$shipment->payment_gateway = 'no';
        //$shipment->payment_status = 'pending';
        $shipment->save();

        return redirect('user/shipping/success'); 



    }
}
