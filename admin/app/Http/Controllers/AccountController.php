<?php

namespace App\Http\Controllers;

use App\Division;
use App\Profile;
use App\Section;
use App\Unit;
use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('login');
    }

    public function index()
    {
        $data = User::select(
            'profiles.*',
            'sections.name as section',
            'units.name as unit',
            'divisions.name as division'
        )
            ->join('profiles','profiles.id','=','users.prof_id')
            ->join('sections','sections.id','=','users.sec_id')
            ->leftJoin('units','units.id','=','users.unit_id')
            ->join('divisions','divisions.id','=','users.div_id')
            ->where("users.level",0)
            ->orderBy('profiles.lname','asc')
            ->get();

        return view('accounts.index',[
            'title' => 'User Accounts',
            'data' =>$data
        ]);
    }

    public function add()
    {
        return view('accounts.add',[
            'title' => 'Add Account',
            'data' => array()
        ]);
    }

    public function edit($id)
    {
        $data = User::select(
                'profiles.*',
                'users.username',
                'users.email',
                'users.sec_id',
                'users.unit_id'
            )
            ->join('profiles','profiles.id','=','users.prof_id')
            ->where('profiles.id',$id)
            ->first();
        return view('accounts.update',[
            'title' => 'Update Account',
            'data' => $data
        ]);
    }

    public function save(Request $req)
    {
        $match = array(
            'fname' => ucwords(mb_strtolower($req->fname)),
            'mname' => ucwords(mb_strtolower($req->mname)),
            'lname' => ucwords(mb_strtolower($req->lname)),
            'ext' => ucwords(mb_strtolower($req->ext)),
            'dob' => date('Y-m-d',strtotime($req->dob))
        );
        $profile = array(
            'sex' => $req->sex,
            'address' => ucwords(mb_strtolower($req->address)),
            'contact' => $req->contact,
            'blood_type' => strtoupper($req->blood_type),
            'hospital_id' => $req->hospital_id,
            'tin' => $req->tin,
            'gsis' => $req->gsis,
            'phic' => $req->phic,
            'pagibig' => $req->pagibig,
            'designation' => $req->designation,
            'e_fname' => ucwords(mb_strtolower($req->e_fname)),
            'e_mname' => ucwords(mb_strtolower($req->e_mname)),
            'e_lname' => ucwords(mb_strtolower($req->e_lname)),
            'e_address' => ucwords(mb_strtolower($req->e_address)),
            'e_contact' => $req->e_contact
        );

        $profile = Profile::updateOrCreate($match,$profile);
        $prof_id = $profile->id;

        $div_id = Section::find($req->section)->div_id;

        $match = array(
            'prof_id' => $prof_id
        );
        $user = array(
            'username' => $req->username,
            'password' => bcrypt($req->password),
            'email' => $req->email,
            'level' => 0,
            'unit_id' => $req->unit,
            'sec_id' => $req->section,
            'div_id' => $div_id
        );
        User::updateOrCreate($match,$user);

        return $profile['fname'].' '.$profile['lname'].' successfully added!';
    }

    public function update(Request $req)
    {
        $id = $req->prof_id;
        $profile = array(
            'fname' => ucwords(mb_strtolower($req->fname)),
            'mname' => ucwords(mb_strtolower($req->mname)),
            'lname' => ucwords(mb_strtolower($req->lname)),
            'ext' => ucwords(mb_strtolower($req->ext)),
            'dob' => date('Y-m-d',strtotime($req->dob)),
            'sex' => $req->sex,
            'address' => ucwords(mb_strtolower($req->address)),
            'contact' => $req->contact,
            'blood_type' => strtoupper($req->blood_type),
            'tin' => $req->tin,
            'gsis' => $req->gsis,
            'phic' => $req->phic,
            'pagibig' => $req->pagibig,
            'designation' => $req->designation,
            'e_fname' => ucwords(mb_strtolower($req->e_fname)),
            'e_mname' => ucwords(mb_strtolower($req->e_mname)),
            'e_lname' => ucwords(mb_strtolower($req->e_lname)),
            'e_address' => ucwords(mb_strtolower($req->e_address)),
            'e_contact' => $req->e_contact
        );



        Profile::where('id',$id)
            ->update($profile);

        $div_id = Section::find($req->section)->div_id;

        $user = array(
            'email' => $req->email,
            'level' => 0,
            'unit_id' => $req->unit,
            'sec_id' => $req->section,
            'div_id' => $div_id
        );

        if($req->password)
            $user['password'] = bcrypt($req->password);

        User::where('prof_id',$id)
            ->update($user);


        $check = self::checkUsername($req->username,$id);
        if($check){
            $return = 'userUpdateDenied';
        }else {
            $return = 'updated';
            $username['username'] =  $req->hospital_id;
            $hospitalId['hospital_id'] = $req->hospital_id;
            User::where('prof_id',$id)
                ->update($username);
            Profile::where('id',$id)->update($hospitalId);
        }

        return $return;
    }

    public function checkUsername($username,$id)
    {
        $check = User::where('username',$username)
            ->where('prof_id','!=',$id)
            ->count();

        if($check>0)
            return true;
        return false;
    }

    public function upload(Request $req)
    {
        $file = $_FILES['prof_pic'];

        if(!$file)
            return redirect()->back();

        $picture = self::uploadPicture($_FILES['prof_pic'],$req->hospital_id);
        Profile::where('id',$req->prof_id)
            ->update([
                'picture' => $picture
            ]);

        return redirect()->back();
    }

    public function uploadPicture($file,$name)
    {
        $path = realpath('upload/pictures');
        $thumbs_path = realpath('upload/thumbs');
        $size = getimagesize($file['tmp_name']);
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $new_name = $name.'.'.$ext;
        if($size==FALSE){
            $name = 'default.png';
        }else{
            //create thumb
            $src = $path.'/'.$new_name;
            $dest = $thumbs_path.'/'.$new_name;
            $desired_width = 250;

            //move uploaded file to a directory
            move_uploaded_file($file['tmp_name'],$path.'/'.$new_name);
            //$this->make_thumb($src, $dest, $desired_width,$ext);
            $new_ext = self::resize($desired_width,$dest,$src);
            $new_ext = self::resize(1000,$src,$src);
            $name = $name.'.'.$new_ext;
        }
        return $name;
    }

    public function resize($newWidth, $targetFile, $originalFile) {
        $info = getimagesize($originalFile);
        $mime = $info['mime'];
        switch ($mime) {
            case 'image/jpeg':
                $image_create_func = 'imagecreatefromjpeg';
                $image_save_func = 'imagejpeg';
                $new_image_ext = 'jpg';
                $new_name = $targetFile;
                break;
            case 'image/png':
                $image_create_func = 'imagecreatefrompng';
                $image_save_func = 'imagepng';
                $new_image_ext = 'png';
                $new_name = $targetFile.'.'.$new_image_ext;
                break;
            case 'image/gif':
                $image_create_func = 'imagecreatefromgif';
                $image_save_func = 'imagegif';
                $new_image_ext = 'gif';
                break;
            default:
                throw new Exception('Unknown image type.');
        }
        $img = $image_create_func($originalFile);
        list($width, $height) = getimagesize($originalFile);
        $newHeight = ($height / $width) * $newWidth;
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        $image_save_func($tmp, "$new_name");
        if (file_exists($new_name)&& $new_image_ext=='png') {
            unlink($new_name);
        }
        return $new_image_ext;
    }

    public function delete($id)
    {
        $count = Unit::where('head_id',$id)->count();
        if($count > 0)
            return redirect()->back()->with('status','unitHead');

        $count = Section::where('head_id',$id)->count();
        if($count > 0)
            return redirect()->back()->with('status','sectionHead');

        $count = Division::where('head_id',$id)->count();
        if($count > 0)
          return redirect()->back()->with('status','divisionHead');

        Profile::where('id',$id)->delete();
        User::where('prof_id',$id)->delete();

        return redirect('accounts')->with('status','deleted');
    }
}
