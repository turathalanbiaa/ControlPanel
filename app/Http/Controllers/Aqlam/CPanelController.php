<?php

namespace App\Http\Controllers\Aqlam;

use App\Model\Aqlam\Comment;
use App\Model\Aqlam\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;

class CPanelController extends Controller
{
    function cPanel ()
    {
        $getPosts = Post::with('user','comments','rates')->orderBy('id','desc')->get();
        return view('aqlam.index',array('getPosts'=>$getPosts));
    }
    function view ($id)
    {
        $getPost = Post::with('user','comments')->find($id);
        $getComments = Comment::where('post_id',$id)->get();
        return view('aqlam.view_post',array('getPost'=>$getPost,'getComments'=>$getComments));
    }
    function commentDestroy (Request $request)
    {
       $id = $request->input('delete');
       $delete =  Comment::find($id);
        if ($delete)
        {
            $delete->delete();
            return redirect('/aqlam/view/'.$delete->post_id)->with('DeleteComment','تم حذف التعليق');
        }
        return redirect('/aqlam/view/'.$delete->post_id);
    }
    function postDestroy (Request $request)
    {
        $id = $request->input('delete_post');
        $delete = Post::find($id);
        if ($delete)
        {
            $delete->delete();
            return redirect('/aqlam/')->with('DeletePost','تم حذف التدوينة');
        }
        return redirect('/aqlam/');
    }
    function postConfirm (Request $request)
    {
        $id = $request->input('post_confirm');
        Post::where('id',$id)->update(['status'=>1]);
        return redirect('/aqlam')->with('post_Confirm','تمت الموافقة على التدوينة');
    }
}
