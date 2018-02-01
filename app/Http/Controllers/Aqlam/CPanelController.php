<?php

namespace App\Http\Controllers\Aqlam;

use App\Model\Aqlam\Comment;
use App\Model\Aqlam\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
    function postEditForm ($id)
    {
        $getPost = Post::find($id);
        return view('aqlam.edit_post',array('getPost'=>$getPost));
    }
    function postEdit (Request $request)
    {
        $this->validate($request , array(
            'title'   => 'required',
            'content' => 'required'
        ));
        $updatePost = post::where('id',$request->input('post_id'))
            ->update(['title'=>$request->input('title'),'content'=>$request->input('content')]);
        if ($updatePost)
        {
            return redirect('/aqlam')->with('UpdateMassage','تم تعديل التدوينة');
        }
        return redirect('/aqlam')->with('UpdateMassage','لا يمكن تعديل التدوينة هنالك خطأ');
    }
}
