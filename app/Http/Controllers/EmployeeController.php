<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator; 

class EmployeeController extends Controller
{

  public function index(){

    $employees = Employee::orderBy('id','Asc')->paginate(10);
    return view('employee.list',['employees'=>$employees]);
  }

  public function create()
  {
    $employee = new Employee();
    return view('employee.create', ['employee' => $employee]);
  }


  public function store(Request $request){
    $validator = Validator::make($request->all(),[
      'name' => 'required',
      'gender' => 'required',
      'dob' => 'required',
      'address' => 'required',
      'hobbies' => 'required',
      'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    if ($validator->passes()) {

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->gender = $request->gender;
        $employee->dob = $request->dob;
        $employee->address = $request->address;
        $hobbies = implode(',', $request->input('hobbies', []));
        $employee->hobbies = $hobbies;
        $employee->save();

        if($request->image){
            $ext = $request->image->getClientOriginalExtension();
            $newFileName = time().'.'.$ext; 
            $request->image->move(public_path().'/uploads/employees/', $newFileName);
            $employee->image = $newFileName;
            $employee->save();
        }
    
        $request->session()->flash('success','Data Added Successfully.');
        return redirect()->route('employees.create');
    
    }
    else{
    return redirect()->route('employees.create')->withErrors($validator)->withInput();
    }
}
    public function edit($id){
        $employee = Employee::findOrFail($id);
  
        return view('employee.edit',['employee'=>$employee]);
    }

    public function update($id, Request $request){

      $validator = Validator::make($request->all(),[
        'name' => 'required',
        'gender' => 'required',
        'dob' => 'required',
        'address' => 'required',
        'hobbies' => 'required',
        'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
      if ($validator->passes()) {
  
          $employee =Employee::find($id);
          $employee->name = $request->name;
          $employee->gender = $request->gender;
          $employee->dob = $request->dob;
          $employee->address = $request->address;
          $hobbies = implode(',', $request->input('hobbies', []));
          $employee->hobbies = $hobbies;
          $employee->save();
  
          if($request->image){
              $oldImage = $employee->image;
              $ext = $request->image->getClientOriginalExtension();
              $newFileName = time().'.'.$ext; 
              $request->image->move(public_path().'/uploads/employees/', $newFileName);
              $employee->image = $newFileName;
              $employee->save();

              File::delete(public_path().'/uploads/employees/'.$oldImage);
          }
      
          $request->session()->flash('success','Data Updated Successfully.');
          return redirect()->route('employees.index');
      
      }
      else{
      return redirect()->route('employees.edit',$id)->withErrors($validator)->withInput();
      }

    }

    public function destroy($id, Request $request){
      $employee = Employee::findOrFail($id);
      File::delete(public_path().'/uploads/employees/'.$employee->image);
      $employee->delete();
      $request->session()->flash('success','Data Deleted Successfully.');
      return redirect()->route('employees.index');
    }

}