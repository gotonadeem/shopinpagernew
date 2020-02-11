<?php
namespace App\Http\Controllers\Admin; //admin add
use App\Http\Requests;
use App\Http\Controllers\Controller;   // using controller class
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Brand;
use DB;
use URL;
use Excel;
use File;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    public function index()
    {
        return view("admin.brand.index");
    }
    public function getBrandData(Request $request)
    {
	
        $requestData = $_REQUEST;
        $columns = array(
            // column index  => database column name
            0 => 'brands.id',
            1 => 'brands.name',
            2 => 'brands.created_at',
        );
        $totalUsers = Brand::get()->count();
        $totalFiltered = $totalUsers;
        $users = Brand::select('brands.*')->orderBy('brands.id', 'desc');
        $searchString = str_replace("%", "zzempty", $requestData['search']['value']);
        $searchString = str_replace("'", "\'", $searchString);
        if (!empty($requestData['search']['value']))
        {
            $users=$users->where('name','LIKE','%'.$searchString.'%');
            $totalFiltered = Brand::where('name','LIKE','%'.$searchString.'%')->get()->count();
        }

        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];
        $users = $users->offset($offset)->limit($limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $data = array();
        $i = $offset;
        foreach ($users as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $item->name;
			$nestedData[] = ($item->images!="")?'<img src="' . URL::to('/') . '/public/admin/uploads/brand_icon/'.$item->images.'" height="100" width="150">':"";
            $date = strtotime($item->created_at);
            $nestedData[] = date('d-m-Y', $date);
            if($item->is_home==1){ $classs="on text-green"; $titles="active"; } else { $classs="off text-danger"; $titles="inactive"; }
			$isHomeLink = '<a onclick="return confirm(\'Are you sure?\')" href="' . URL::to('/') . '/admin/brand/is-home/'.$item->id.'" title="'.$titles.'"><i class="fa fa-toggle-'.$classs.'" aria-hidden="true" ></i></a>';
			$nestedData[] = $isHomeLink;
			
            if($item->status==1){ $class="on"; $title="active"; } else { $class="off"; $title="inactive"; }
            $deleteLink = '<a href="javascript:void(0);" onclick="deleteItem(' . $item->id . ',this)" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>';
            //$ViewLink = '<a href="' . URL::to('/') . '/admin/brand/view/'. $item->id .' " title="View"><i class="glyphicon glyphicon-eye-open"></i></a>';
            $editLink = '<a href="' . URL::to('/') . '/admin/brand/brand-edit/'. $item->id .' " title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>';
            $activateLink = '<a href="' . URL::to('/') . '/admin/brand/update-status/'.$item->id.'" title="'.$title.'"><i class="fa fa-toggle-'.$class.'" aria-hidden="true" ></i></a>';
            $nestedData[] = $activateLink ." | ".$editLink. ' | ' .$deleteLink;
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalUsers),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }
    function view($id=null)
    {
        $brand = Brand::where('id', $id)->first();
        return view('admin.brand.view')->with('brand', $brand);
    }
    public function add()
    {
        return view('admin.brand.add');
    }
    public function store(Request $request)
    {
        $sliderData = array(
            'name'     =>$request->input( 'name'),
        );
        $rules = array(
            'name'=>'required',
        )   ;
        $validator = Validator::make($sliderData,$rules);
        if ($validator->fails()) {
            return redirect('admin/brand/add-brand')->withInput()->withErrors($validator);
        }else{
            $brandData = $request->all();
            $brand = new Brand($brandData);
            $image = $request->file('images');
            $path_original=public_path() . '/admin/uploads/brand_icon';
            $file = $request->images;

            $photo_name = time() . '-' . $file->getClientOriginalName();
            $file->move($path_original, $photo_name);
            $brand->images = $photo_name;


            $brand->save();
            Session::flash('success_message', 'Brand has been added successfully');
            return redirect('/admin/brand/brand-list');
        }

    }
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit')->with(['brand'=>$brand]);
    }
    public function update($id, Request $request)
    {
        $brand = Brand::find($id);
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
            ], [
                'name.required' => 'This field is required.',
            ]);

        if ($validator->fails())
        {
            return redirect('admin/brand/brand-edit/'.$id)->withInput()->withErrors($validator);
        }
        else
        {
            if($brand) {
                $data =$request->all();
                if ($request->hasFile('images'))
                {
                    $path_original=public_path() . '/admin/uploads/brand_icon';
                    $file = $request->images;

                    $photo_name = time() . '-' . $file->getClientOriginalName();
                    $file->move($path_original, $photo_name);
                    $data['old_images'] = $photo_name;
                    if ($request->old_img != '') {
                        try {
                            unlink($path_original . $request->old_img);

                        } catch (\Exception $e) {
                        }
                    }
                }
                $update_data = Brand::find($brand->id)->fill($data);
                if($request->images){$update_data->images=$photo_name;}
                $update_data->update();
                Session::flash('success_message', 'Brand Successfully updated');
                return redirect('admin/brand/brand-list');
            }
        }
    }


    public function delete()
    {
        $brand = Brand::findOrFail($_POST['id']);
        if(!empty($brand->delete()))
        {
            Session::flash('success_message', 'Brand has been deleted successfully!');
        }
        else {
            Session::flash('error_message', 'Unable to delete the Brand');
        }
    }

    function update_status($id=null)
    {
        $response=DB::statement("UPDATE brands SET status =(CASE WHEN (status = 1) THEN '0' ELSE '1' END) where id = $id");
        if($response) {
            Session::flash('success_message', 'status has been updated successfully!');
        }
        else {
            Session::flash('error_message', 'Unable to update status');
        }
        return redirect('/admin/brand/brand-list');
    }
	
	function is_home($id=null)
    {
        $response=DB::statement("UPDATE brands SET is_home =(CASE WHEN (is_home = 1) THEN '0' ELSE '1' END) where id = $id");
        if($response) {
            Session::flash('success_message', 'status has been updated successfully!');
        }
        else {
            Session::flash('error_message', 'Unable to update status');
        }
        return redirect('/admin/brand/brand-list');
    }

    //END -------------------------------------------------//
}

?>