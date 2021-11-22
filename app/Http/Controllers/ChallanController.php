<?php
namespace App\Http\Controllers;

use App\Models\Challan;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ChallanController extends Controller
{
    protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return $this->user
            ->challans()
            ->orderByDesc('id')
            ->get();
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate data
        $data = $request->only('studentname', 'studentid', 'challanid', 'grade', 'paymentdate', 'amount', 'status','image', 'payment_mode', 'payment_info');
        $validator = Validator::make($data, [
            'studentname' => 'required|string',
            'studentid' => 'required',
            'challanid' => 'required',
            'grade' => 'required',
            'paymentdate' => 'required',
            'amount' => 'required',
            'status' => 'required',
            'payment_mode' => 'required',
            'payment_info' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new product
        $product = $this->user->challans()->create([
            'studentname' => $request->studentname,
            'studentid' => $request->studentid,
            'challanid' => $request->challanid,
            'grade' => $request->grade,
            'paymentdate' => $request->paymentdate,
            'amount' => $request->amount,
            'status' => $request->status,
            'verify_image' => $request->image,
            'payment_mode' => $request->payment_mode,
            'payment_info' => $request->payment_info
        ]);

        //Product created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $challan = $this->user->challans()->find($id);
    
        if (!$challan) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, challan not found.'
            ], 400);
        }
    
        return $challan;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Challan  $challan
     * @return \Illuminate\Http\Response
     */
    public function edit(Challan $challan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Challan $challan)
    {
        //Validate data
        $data = $request->only('studentname', 'studentid', 'challanid', 'grade', 'paymentdate', 'amount', 'status','image', 'payment_mode', 'payment_info');
        $validator = Validator::make($data, [
            'studentname' => 'required|string',
            'studentid' => 'required',
            'challanid' => 'required',
            'grade' => 'required',
            'paymentdate' => 'required',
            'amount' => 'required',
            'status' => 'required',
            'verify_image' => 'required',
            'payment_mode' => 'required',
            'payment_info' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, update product
        $product = $product->update([
            'studentname' => $request->name,
            'studentid' => $request->sku,
            'challanid' => $request->price,
            'grade' => $request->quantity,
            'paymentdate' => $request->paymentdate,
            'amount' => $request->amount,
            'status' => $request->status,
            'verify_image' => $request->image,
            'payment_mode' => $request->payment_mode,
            'payment_info' => $request->payment_info
        ]);

        //Product updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'Challan updated successfully',
            'data' => $product
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Challan $challan)
    {
        $challan->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}