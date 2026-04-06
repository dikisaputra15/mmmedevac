<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Embassiees;
use App\Models\Provincesregion;
use App\Models\City;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MasterEmbessyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         if(request()->ajax()) {
            return datatables()->of(Embassiees::select('*')->orderBy('id', 'desc'))
            ->addColumn('created_at', function ($row) {
                // Format tanggal jadi dd-mm-yyyy HH:MM
                return Carbon::parse($row->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function($row){
                 $updateButton = '<a href="' . route('Embessydata.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                 $deleteButton = '<button class="btn btn-sm btn-danger delete-btn" data-id="'.$row->id.'">Delete</button>';

                  if ($row->Embessy_status) {
                        // Kalau status = true (publish), tombol jadi Unpublish
                        $statusButton = '<button class="btn btn-sm btn-warning status-btn" data-id="'.$row->id.'">Unpublish</button>';
                    } else {
                        // Kalau status = false (unpublish), tombol jadi Publish
                        $statusButton = '<button class="btn btn-sm btn-success status-btn" data-id="'.$row->id.'">Publish</button>';
                    }

                 return $updateButton." ".$deleteButton." ".$statusButton;
            })
            ->rawColumns(['action','created_at'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('pages.master.Embessy');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Provincesregion::orderByRaw('LOWER(provinces_region) ASC')->get();
        return view('pages.master.createEmbessy', [
            'provinces' => $provinces
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Embessy = new Embassiees();

         if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $randomName = Str::random(40) . '.' . $extension;

            // Simpan di folder 'images' di disk 'public'
            $path = $request->file('image')->storeAs('image/Embessy', $randomName, 'public');

            // Simpan path ke database
            $Embessy->image = 'storage/'.$path;

         }

        $Embessy->province_id = $request->input('province_id');
        $Embessy->city_id = $request->input('city');
        $Embessy->name_embassiees = $request->input('Embessy_name');
        $Embessy->location = $request->input('location');
        $Embessy->telephone = $request->input('telephone');
        $Embessy->fax = $request->input('fax');
        $Embessy->email = $request->input('email');
        $Embessy->website = $request->input('website');
        $Embessy->latitude = $request->input('latitude');
        $Embessy->longitude = $request->input('longitude');

        $Embessy->save();
        return redirect()->route('Embessydata.index')->with('success', 'Data Succesfully Save');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $Embessy = Embassiees::findOrFail($id);
        $provinces = Provincesregion::orderByRaw('LOWER(provinces_region) ASC')->get();
        $cities = City::where('province_id', $Embessy->province_id)->orderByRaw('LOWER(city) ASC')->get();
        return view('pages.master.editEmbessy', [
            'Embessy' => $Embessy,
            'provinces' => $provinces,
            'cities' => $cities
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Cari data airport berdasarkan ID
        $Embessy = Embassiees::findOrFail($id);

         // Update data
        $data = [
            'province_id' => $request->input('province_id'),
            'city_id' => $request->input('city'),
            'name_embassiees' => $request->input('Embessy_name'),
            'location' => $request->input('location'),
            'telephone' => $request->input('telephone'),
            'fax' => $request->input('fax'),
            'email' => $request->input('email'),
            'website' => $request->input('website'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ];

         if ($request->hasFile('image')) {
            $path = $request->file('image')->store('image/Embessy', 'public');

            // Hapus gambar lama jika ada
            if ($Embessy->image && Storage::disk('public')->exists($Embessy->image)) {
                Storage::disk('public')->delete($Embessy->image);
            }

            $data['image'] = 'storage/'.$path;

        }

         $Embessy->update($data);

         // Redirect dengan pesan sukses
        return redirect()->route('Embessydata.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Embassiees::findOrFail($id);

        if($role->delete()){
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully';
        }else{
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.';
        }

        return response()->json($response);
    }

    public function toggleStatus($id)
    {
        $Embessy = Embassiees::findOrFail($id);
        $Embessy->Embessy_status = $Embessy->Embessy_status ? 0 : 1; // toggle
        $Embessy->save();

        return response()->json([
            'success' => true,
            'status' => $Embessy->Embessy_status
        ]);
    }

    public function getCities($province_id)
    {
        $cities = City::where('province_id', $province_id)->get();
        return response()->json($cities);
    }
}
