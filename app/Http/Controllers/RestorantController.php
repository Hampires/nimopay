<?php

namespace App\Http\Controllers;

use App\Restorant;
use App\User;
use App\Hours;
use App\City;
use App\Plans;
use App\Tables;
use App\Enterprises;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Notifications\RestaurantCreated;
use Illuminate\Support\Facades\Validator;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use App\Events\CallWaiter;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Facades\Session;

//use Intervention\Image\Image;
use Image;

use App\Imports\RestoImport;
use Maatwebsite\Excel\Facades\Excel;

class RestorantController extends Controller
{

    protected $imagePath='uploads/restorants/';

    /**
     * Auth checker functin for the crud
     */
    private function authChecker(){
        $this->ownerOnly();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Restorant $restaurants)
    {
        if(auth()->user()->hasRole('admin')){
            //return view('restorants.index', ['restorants' => $restaurants->where(['active'=>1])->paginate(10)]);
            return view('restorants.index', ['restorants' => $restaurants->orderBy('id', 'desc')->paginate(10)]);
        }else return redirect()->route('orders.index')->withStatus(__('No Access'));
    }

    public function loginas(Restorant $restaurant){
        if(auth()->user()->hasRole('admin')){
            //Login as owner
            Auth::login($restaurant->user, true);
            return $this->edit($restaurant);
        }else return redirect()->route('orders.index')->withStatus(__('No Access'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->hasRole('admin')){
            return view('restorants.create');
        }else return redirect()->route('orders.index')->withStatus(__('No Access'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate first
        $request->validate([
            'name' => ['required', 'string', 'unique:restorants,name', 'max:255'],
            'name_owner' => ['required', 'string', 'max:255'],
            'email_owner' => ['required', 'string', 'email', 'unique:users,email', 'max:255'],
            'phone_owner' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:'.env('MIN_PHONE_NUMBER',9).''],
        ]);

        //Create the user
        $generatedPassword = Str::random(10);
        $owner = new User;
        $owner->name = strip_tags($request->name_owner);
        $owner->email = strip_tags($request->email_owner);
        $owner->phone = strip_tags($request->phone_owner)|"";
        $owner->api_token = Str::random(80);

        $owner->password =  Hash::make($generatedPassword);
        $owner->save();

        //Assign role
        $owner->assignRole('owner');

        //Create Restorant
        $restaurant = new Restorant;
        $restaurant->name = strip_tags($request->name);
        $restaurant->user_id = $owner->id;
        $restaurant->description = strip_tags($request->description."");
        $restaurant->minimum = $request->minimum|0;
        $restaurant->lat = 0;
        $restaurant->lng = 0;
        $restaurant->address = "";
        $restaurant->phone = $owner->phone;
        $restaurant->subdomain= $this->makeAlias(strip_tags($request->name));
        //$restaurant->logo = "";
        $restaurant->save();

        //Send email to the user/owner
        $owner->notify(new RestaurantCreated($generatedPassword,$restaurant,$owner));



        return redirect()->route('admin.businesses.index')->withStatus(__('Restaurant successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restorant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restorant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restorant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit($restaurant_id)
    {
        $restaurant = Restorant::where('id',$restaurant_id)->get()->first();
        $enterprises = Enterprises::all();
        $enterprise = Enterprises::where('id', $restaurant->enterprise_id)->get()->first();
        
        //Days of the week
        $timestamp = strtotime('next Monday');
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }


        //Generate days columns
        $hoursRange = [];
        for($i=0; $i<7; $i++){
            $from = $i."_from";
            $to = $i."_to";

            array_push($hoursRange, $from);
            array_push($hoursRange, $to);
        }

        $hours = Hours::where(['restorant_id' => $restaurant->id])->get($hoursRange)->first();

        if(auth()->user()->id==$restaurant->user_id||auth()->user()->hasRole('admin')){
            //return view('restorants.edit', compact('restorant'));
            return view('restorants.edit',[
                'enterprises' => $enterprises,
                'enterprise' => $enterprise,
                'restorant' => $restaurant,
                'days' => $days,
                'cities'=> City::get()->pluck('name','id'),
                'plans'=>Plans::get()->pluck('name','id'),
                'hours' => $hours]);
        }
        return redirect()->route('home')->withStatus(__('No Access'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restorant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $restaurant)
    {
        $phone = env('IS_WHATSAPP_ORDERING_MODE',false) ? "whatsapp_phone" : "phone";
        $restaurant = Restorant::where('id', $restaurant)->get()->first();
        $enterprise = Enterprises::where('id', intval($restaurant->enterprise_id))->get()->first();

        $restaurant->name = strip_tags($request->name);
        $restaurant->address = strip_tags($request->address);
        $restaurant->$phone = strip_tags($request->phone);
        $restaurant->description = strip_tags($request->description);
        $restaurant->placeholder = strip_tags($request->placeholder);
        $restaurant->enterprise_id = intval($request->enterprise);
        $restaurant->minimum = strip_tags($request->minimum);
        $restaurant->fee = $request->fee ? $request->fee : 0;
        $restaurant->static_fee = $request->static_fee ? $request->static_fee : 0;
        $restaurant->subdomain=$this->makeAlias(strip_tags($request->name));
        $restaurant->is_featured = $request->is_featured != null ? 1 : 0;
        $restaurant->can_pickup = $request->can_pickup == "true" ? 1 : 0;
        $restaurant->can_deliver = $request->can_deliver == "true" ? 1 : 0;
        $restaurant->self_deliver = $request->self_deliver == "true" ? 1 : 0;
        $restaurant->free_deliver = $request->free_deliver == "true" ? 1 : 0;


        if(isset($request->city_id)){
            $restaurant->city_id = $request->city_id;
        }

        //dd($request->all());

        if($request->hasFile('resto_logo')){
            $restaurant->logo=$this->saveImageVersions(
                $this->imagePath,
                $request->resto_logo,
                [
                    ['name'=>'large','w'=>590,'h'=>400],
                    ['name'=>'medium','w'=>295,'h'=>200],
                    ['name'=>'thumbnail','w'=>200,'h'=>200]
                ]
            );

        }
        if($request->hasFile('resto_cover')){
            $restaurant->cover=$this->saveImageVersions(
                $this->imagePath,
                $request->resto_cover,
                [
                    ['name'=>'cover','w'=>2000,'h'=>1000],
                    ['name'=>'thumbnail','w'=>400,'h'=>200]
                ]
            );
        }

        $restaurant->update();

        if(auth()->user()->hasRole('admin')){
            return redirect()->route('admin.businesses.edit',['id' => $restaurant->id])->withStatus(ucwords($enterprise->name) . __(' successfully updated.'));
        }else{
            return redirect()->route('admin.businesses.edit',['id' => $restaurant->id])->withStatus(ucwords($enterprise->name) . __(' successfully updated.'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restorant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restorant $restaurant)
    {

        if(!auth()->user()->hasRole('admin')){
            dd("Not allowed");
         }

        $restaurant->active=0;
        $restaurant->save();

        //$restaurant->delete();

        return redirect()->route('admin.businesses.index')->withStatus(__('Restaurant successfully deactivated.'));
    }

    public function remove(Restorant $restaurant)
    {
        if(!auth()->user()->hasRole('admin')){
            dd("Not allowed");
        }

        $user=$restaurant->user;

        //delete restaurant
        $user->restorant->delete();

        if($user->email!="owner@example.com"){
            //delete user
            $user->delete();
        }
        return redirect()->route('admin.businesses.index')->withStatus(__('Restaurant successfully removed from database.'));
    }

    public function updateLocation(Restorant $restaurant, Request $request)
    {

        $restaurant->lat = $request->lat;
        $restaurant->lng = $request->lng;

        $restaurant->update();

        return response()->json([
            'status' => true,
            'errMsg' => ''
        ]);
    }

    public function updateRadius(Restorant $restaurant, Request $request)
    {
        $restaurant->radius = $request->radius;
        $restaurant->update();

        return response()->json([
            'status' => true,
            'msg' => ''
        ]);
    }

    public function updateDeliveryArea(Restorant $restaurant, Request $request)
    {
        $restaurant->radius = json_decode($request->path);
        $restaurant->update();

        return response()->json([
            'status' => true,
            'msg' => ''
        ]);
    }

    public function getLocation(Restorant $restaurant)
    {
        return response()->json([
            'data' => [
                'lat' => $restaurant->lat,
                'lng' => $restaurant->lng,
                'area' => $restaurant->radius,
                'id' => $restaurant->id
            ],
            'status' => true,
            'errMsg' => ''
        ]);
    }

    public function import(Request $request)
    {
        Excel::import(new RestoImport, request()->file('resto_excel'));

        return redirect()->route('admin.businesses.index')->withStatus(__('Restaurant successfully imported.'));
    }

    public function workingHours(Request $request)
    {
        $hours = Hours::where(['restorant_id' => $request->rid])->first();

        if($hours == null){

            $hours = new Hours();
            $hours->restorant_id = $request->rid;
            $hours->{'0_from'} = $request->{'0_from'} ?? null;
            $hours->{'0_to'} = $request->{'0_to'} ?? null;
            $hours->{'1_from'} = $request->{'1_from'} ?? null;
            $hours->{'1_to'} = $request->{'1_to'} ?? null;
            $hours->{'2_from'} = $request->{'2_from'} ?? null;
            $hours->{'2_to'} = $request->{'2_to'} ?? null;
            $hours->{'3_from'} = $request->{'3_from'} ?? null;
            $hours->{'3_to'} = $request->{'3_to'} ?? null;
            $hours->{'4_from'} = $request->{'4_from'} ?? null;
            $hours->{'4_to'} = $request->{'4_to'} ?? null;
            $hours->{'5_from'} = $request->{'5_from'} ?? null;
            $hours->{'5_to'} = $request->{'5_to'} ?? null;
            $hours->{'6_from'} = $request->{'6_from'} ?? null;
            $hours->{'6_to'} = $request->{'6_to'} ?? null;
            $hours->save();
        }

        $hours->{'0_from'} = $request->{'0_from'} ?? null;
        $hours->{'0_to'} = $request->{'0_to'} ?? null;
        $hours->{'1_from'} = $request->{'1_from'} ?? null;
        $hours->{'1_to'} = $request->{'1_to'} ?? null;
        $hours->{'2_from'} = $request->{'2_from'} ?? null;
        $hours->{'2_to'} = $request->{'2_to'} ?? null;
        $hours->{'3_from'} = $request->{'3_from'} ?? null;
        $hours->{'3_to'} = $request->{'3_to'} ?? null;
        $hours->{'4_from'} = $request->{'4_from'} ?? null;
        $hours->{'4_to'} = $request->{'4_to'} ?? null;
        $hours->{'5_from'} = $request->{'5_from'} ?? null;
        $hours->{'5_to'} = $request->{'5_to'} ?? null;
        $hours->{'6_from'} = $request->{'6_from'} ?? null;
        $hours->{'6_to'} = $request->{'6_to'} ?? null;
        $hours->update();

        return redirect()->route('admin.businesses.edit',['id' => $request->rid])->withStatus(__('Working hours successfully updated!'));
    }

    public function showRegisterRestaurant()
    {
        $enterprises = Enterprises::get();
        return view('restorants.register', ['enterprises' => $enterprises]);
    }

    public function storeRegisterRestaurant(Request $request)
    {
        //Validate first
        $theRules=[
            'name' => ['required', 'string', 'unique:restorants,name', 'max:255'],
            'placeholder' => ['required', 'string', 'max:25'],
            'enterprise' => ['required', 'integer', 'exists:enterprises,id'],
            'name_owner' => ['required', 'string', 'max:255'],
            'email_owner' => ['required', 'string', 'email', 'unique:users,email', 'max:255'],
            'phone_owner' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:'.env('MIN_PHONE_NUMBER',9).''],
        ];

        if(strlen(env('RECAPTCHA_SITE_KEY',""))>2){
            $theRules['g-recaptcha-response']='recaptcha';
        }

        $request->validate($theRules);

        //Create the user
        //$generatedPassword = Str::random(10);
        $owner = new User;
        $owner->name = strip_tags($request->name_owner);
        $owner->email = strip_tags($request->email_owner);
        $owner->phone = strip_tags($request->phone_owner)|"";
        $owner->active = 0;
        $owner->api_token = Str::random(80);



        $owner->password = null;
        $owner->save();

        //Assign role
        $owner->assignRole('owner');

        //Send welcome email


        //welcome notification
        /*try {
            $owner->notify(new WelcomeNotification($owner));
        } catch (\Exception $e) {
           return view('restorants.error_location',['message'=>'settings.site_run_into_smtp_error']);
        }*/
        //Create Restorant
        $restaurant = new Restorant;
        $restaurant->name = strip_tags($request->name);
        $restaurant->placeholder = strtolower($request->placeholder);
        $restaurant->user_id = $owner->id;
        $restaurant->enterprise_id = intval($request->enterprise);
        $restaurant->description = strip_tags($request->description."");
        $restaurant->minimum = $request->minimum|0;
        $restaurant->lat = 0;
        $restaurant->lng = 0;
        $restaurant->address = "";
        $restaurant->phone = $owner->phone;
        //$restaurant->subdomain=strtolower(preg_replace('/[^A-Za-z0-9]/', '', strip_tags($request->name)));
        $restaurant->active = 0;
        $restaurant->subdomain = null;
        //$restaurant->logo = "";
        $restaurant->save();

        if(config('app.isqrsaas')||env('DIRECTLY_APPROVE_RESSTAURANT',false)){
            //QR SaaS - or directly approve
            $this->makeRestaurantActive($restaurant);
            return redirect()->route('front')->withStatus(__('notications.thanks_andcheckemail'));
        }else{
            //Foodtiger
            return redirect()->route('newrestaurant.register')->withStatus(__('notications.thanks_and_review'));
        }
    }



    private function makeRestaurantActive(Restorant $restaurant){
        //Activate the restaurant
        $restaurant->active = 1;
        $restaurant->subdomain = $this->makeAlias($restaurant->name);
        $restaurant->update();

        $owner = $restaurant->user;

        //if the restaurant is first time activated
        if($owner->password == null){
            //Activate the owner
            $generatedPassword = Str::random(10);

            $owner->password = Hash::make($generatedPassword);
            $owner->active = 1;
            $owner->update();

            //Send email to the user/owner
            $owner->notify(new RestaurantCreated($generatedPassword, $restaurant, $owner));
        }
    }

    public function activateRestaurant(Restorant $restaurant)
    {
        $this->makeRestaurantActive($restaurant);
        return redirect()->route('admin.businesses.index')->withStatus(__('Restaurant successfully activated.'));
    }

    public function restaurantslocations(){
         //TODO - Method for admin onlt
         if(!auth()->user()->hasRole('admin')){
            dd("Not allowed");
         }

         $toRespond=array(
            'restaurants'=> Restorant::where('active',1)->get()
        );

        return response()->json($toRespond);
    }

    public function removedemo(){
        //Find by phone number (530) 625-9694
        $demoRestaurants=Restorant::where('phone','(530) 625-9694')->get();
        foreach ($demoRestaurants as $key => $restorant) {
            $restorant->delete();
        }
        return redirect()->route('settings.index')->withStatus(__('Demo resturants removed.'));

    }

    public function callWaiter(Request $request)
    {
        $CAN_USE_PUSHER = strlen(env('PUSHER_APP_ID',"")) > 2 && strlen(env('PUSHER_APP_KEY',"")) > 2 && strlen(env('PUSHER_APP_SECRET',"")) > 2;
        if($request->table_id){
            $table = Tables::where('id', $request->table_id)->get()->first();

            if(env('ENABLE_CALL_WAITER', false) && $CAN_USE_PUSHER){
                $msg = __('notications.notification_callwaiter');

                event(new CallWaiter($table, $msg));

                return redirect()->back()->withStatus('The restaurant is notified. The waiter will come shortly!');
            }
        }else{
            return redirect()->back()->withStatus('Please select table');
        }
        
    }

    public function shareMenu()
    {
        $this->authChecker();

        if(env('WILDCARD_DOMAIN_READY',false)){
            $url = (isset($_SERVER['HTTPS'])&&$_SERVER["HTTPS"] ?"https://":"http://").auth()->user()->restorant->subdomain.".".str_replace("www.","",$_SERVER['HTTP_HOST']);
        }else{
            $enterprise = Enterprises::find(auth()->user()->restorant->enterprise_id);
            $url = route('vendor',[$enterprise->name, auth()->user()->restorant->subdomain]);
        }

        return view('restorants.share',['url' => $url,'name'=>auth()->user()->restorant->name]);
    }

    public function downloadQR()
    {
        $this->authChecker();

        if(env('WILDCARD_DOMAIN_READY',false)){
            $url = (isset($_SERVER['HTTPS'])&&$_SERVER["HTTPS"] ?"https://":"http://").auth()->user()->restorant->subdomain.".".str_replace("www.","",$_SERVER['HTTP_HOST']);
        }else{
            $enterprise = Enterprises::find(auth()->user()->restorant->enterprise_id);
            $url = route('vendor',[$enterprise->name, auth()->user()->restorant->subdomain]);
        }
        $url = "https://api.qrserver.com/v1/create-qr-code/?size=512x512&data=".$url;
        $filename = 'qr.jpg';
        $tempImage = tempnam(sys_get_temp_dir(), $filename);
        copy($url, $tempImage);

        return response()->download($tempImage, $filename);
    }
}
