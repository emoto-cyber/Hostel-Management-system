<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HostelManagementController extends Controller
{
    //dashboard


public function dashboard()
{
    // Users per month
    $data = DB::table('users')
        ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    $months = $data->pluck('month')->map(fn($m) => date("F", mktime(0,0,0,$m,1)));
    $totals = $data->pluck('total');

    // Rooms info (example)
    $bookedRooms = DB::table('rooms')->where('status','booked')->count();
    $vacantRooms = DB::table('rooms')->where('status','vacant')->count();
    $totalPaid = DB::table('payments')->sum('amount');

    return view('dashboard', compact('months','totals','bookedRooms','vacantRooms','totalPaid'));
}

    public function hostel_index(Request $request)
    {

    $query = Hostel::query();

    if($request->filled('search')){
        $search = $request->input('search');
        $query->where('name', 'like', "%$search%")
              ->orWhere('location', 'like', "%$search%");
    }

    if($request->filled('month')){
        $month = date('m', strtotime($request->input('month')));
        $query->whereMonth('created_at', $month);
    }


    $hostels = $query->with('user')->where('owner_id', Auth::id())->latest()->get();



        // $hostels = Hostel::with('user')->
        // where('owner_id', Auth::id())->get();

        $data = [
            'totalhostels' => $hostels->count(),
            'totalRooms' => Hostel::where('owner_id', Auth::id())->withCount('rooms')->get()->sum('rooms_count'),
            'totalcapacity' => Hostel::where('owner_id', Auth::id())->with('rooms')->get()->sum(function($hostel){
                return $hostel->rooms->sum('capacity');
            }),
            'occupiedRooms' => Room::where('status', 'occupied')->count(),
            'vacantRooms' => Room::where('status', 'vacant')->count(),
        ];

        return view('hostel.index', compact('hostels', 'data'));
    }

    public function hostel_all()
    {

    $user = Auth::user();

    $startmonth = Carbon::now()->startOfMonth();
    $endmonth = Carbon::now()->endOfMonth();

        $hostels = Hostel::with('user')->get();


    $hostelIds = Hostel::where('owner_id', $user->id)->pluck('id');

$data = [
    'totalhostels' => $hostelIds->count(),

    // 'totalRooms' => Room::whereIn($hostelIds)
    //     ->whereBetween('created_at', [$startmonth, $endmonth])
    //     ->sum('capacity'),

    'occupiedRooms' => Room::whereIn('hostel_id', $hostelIds)
        ->where('status', 'occupied')
        ->count(),

    'vacantRooms' => Room::whereIn('hostel_id', $hostelIds)
        ->where('status', 'vacant')
        ->count(),
];

        return view('hostel.index', compact('hostels', 'data'));
    }


    public function hostel_create(){
        return view('hostel.create');
    }

    public function hostel_store(Request $request){
        $request->validate([
            'name'=> 'required|string|max:255',
            'location'=> 'required|string|max:255',
            'capacity'=> 'required|integer',
            'manager_name'=> 'required|string|max:255',
            'contact_number'=> 'required|string|max:20',
            'description'=> 'nullable|string',
        ]) ;

        $user= Auth::user();

 Hostel::create([
    'owner_id'=> $user->id,
    'name'=> $request->name,
    'location'=> $request->location,
    'capacity'=> $request->capacity,
    'manager_name'=> $request->manager_name,
    'contact_number'=> $request->contact_number,
    'description'=> $request->description,
 ]);

 return redirect()->route('hostel.index')->with('success','Hostel created successfully.');

    }

    public function hostel_destroy($id){
        $hostel = Hostel::findOrFail($id);
        $hostel->delete();

        return redirect()->route('hostel.index')->with('success','Hostel deleted successfully.');
    }

    public function room_index(Request $request)
    {

    $query = Room ::query();

    if($request->filled('search')){
        $search = $request->input('search');
        $query->where('room_type', 'like', "%$search%")
              ->where('status','Available')
              ->orWhereHas('hostel', function($q) use ($search){
                  $q->where('name', 'like', "%$search%");

              });
    }

    if($request->filled('month')){
        $month = date('m', strtotime($request->input('month')));
        $query->whereMonth('created_at', $month);
    }

    $rooms = $query->with('user','hostel')
       ->whereHas('hostel', function($q){
           $q->where('owner_id', Auth::id());
       })
       ->get();






    //    $rooms=Room::with('user','hostel')
    // //    ->where('user_id', Auth::id())
    //    ->get();


    //    $user = Auth::user();

    //    $startmonth = Carbon::now()->startOfMonth();
    //    $endmonth = Carbon::now()->endOfMonth();

       $data =[
        'totalrooms' => Room::count(),

        'totalvacant' => Room::where('status','Vacant')
        ->count(),
        'totalsingles' => Room::where('room_type','Single')
        ->count(),
        'totalOccupied' => Room::where('status','occupied')
        ->count(),
        'totalcapacity' => Room::sum('capacity'),
       ];

        return view('room.index', compact('rooms', 'data'));
    }

    public function room_create(){
        $hostels=Hostel::all();

        return view('room.create', compact('hostels'));
    }

    public function room_store(Request $request){
        $request->validate([
            'room_number'=> 'required|string|max:255',
            'capacity'=>'required|integer',
            'price'=>'required|decimal:0,2|max:999999.99',
            'room_type'=>'required|string|max:255',

        ]);

        // $user=Auth::user();

        // $hostel = Hostel::findOrFail($request->hostel_id);

        Room::create([
            'hostel_id'   => $request->hostel_id,
            'room_number'=> $request->room_number,
            'capacity'=>$request->capacity,
            'price'=>$request->price,
            'room_type'=>$request->room_type,
            'status'=>'Available'
            ]);

            return redirect()->route('room.index')->with('success','');



}

public function room_edit($id){
    $room = Room::findOrFail($id);
    $hostels = Hostel::all();

     if($room->status !== 'available'){
       return redirect()->route('room.index')->with('error','sorry!!,this room has already been booked.');
     }

    return view('room.edit', compact('room', 'hostels'));
}

public function room_update(Request $request, $id){
    $request->validate([
        'room_number'=> 'required|string|max:255',
        'capacity'=>'required|integer',
        'price'=>'required|decimal:0,2|max:999999.99',
        'room_type'=>'required|string|max:255',
        'status'=>'required|string|max:255',
    ]);

    DB::transaction(function () use ($request,$id) {
    $user = Auth::user();

    $room = Room::findOrFail($id);
//  $room = Room::findOrFail($request->room_id);
$hostelid = $request->hostel_id;

 $room->update([
    'status'=>'Occupied',
    ]);

   $payment= Payment::updateOrCreate(
    [
        'user_id' => $user->id,
        'room_id' => $room->id,
    ],
    [
        'hostel_id' => $hostelid, // ✅ safest
        'amount'    => $room->price,
        'status'    => 'Paid',
    ]
);

   // 2️⃣ Get Owner Wallet
        $hostel = Hostel::findOrFail($request->hostel_id);
        $wallet = Wallet::firstOrCreate(
            ['owner_id' => $hostel->owner_id],
            ['balance' => 0]
        );

         // 3️⃣ Update Wallet Balance
        $wallet->increment('balance', $payment->amount);

              // 4️⃣ Record Wallet Transaction
        WalletTransaction::create([
            'wallet_id'  => $wallet->id,
            'payment_id' => $payment->id,
            'type'       => 'credit',
            'amount'     => $payment->amount,
            'description'=> 'Hostel rent payment'
        ]);
});


    return redirect()->route('room.index')->with('success','Room updated successfully.');
}

public function room_destroy($id){
    $room = Room::findOrFail($id);
    $room->delete();

    return redirect()->route('room.index')->with('success','Room deleted successfully.');
}

public function payment_index(Request $request)
{
     $query = Payment::query();

    // filter by search
    if ($request->filled('search')) {
        $query->search($request->search);  // uses your scopeSearch
    }



       // filter by month
    if ($request->filled('month')) {
        $query->monthly($request->month);  // uses your scopeMonthly
    }
    $payments = $query->with(['user', 'room.hostel'])
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

    return view('payment.index', compact('payments'));
}

public function room_toggle($id)
{
    $room = Room::findOrFail($id);

    $room->status = ($room->status === 'Available') ? 'Occupied' : 'Available';
    $room->save();

    return redirect()->route('room.index')->with('success', 'Room status updated successfully.');
}

public function room_available(){

    // $startmonth = Carbon::now()->startOfMonth();
    // $endmonth = Carbon::now()->endOfMonth();



    $rooms = Room::where('status','Available')
    ->get();

    return view('room.index',compact('rooms'));
}

public function room_occupied(){
    $rooms = Room::where('status','occupied')
    ->get();

    return view(view: 'room.index',data: compact('rooms'));

}
}
