<?php

namespace App\Http\Controllers\Library;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Library\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Yaml\Tests\B;

class IndexController extends Controller
{
    function view ()
    {
        $getAllBookS = Book::paginate(20);
        return view('library.index',array('getAllBooks'=>$getAllBookS));
    }
    function addBook ()
    {
        $getCategories = DB::connection('mysql3')->table('Categories')->select('Category')->get();
        $booksNames = Book::select('BookName')->where('Volume',1)->get();
        return view('library.add_book',array('getCategories'=>$getCategories,'booksNames'=>$booksNames));
    }
    function uploadBook (Request $request)
    {
       $this->validate($request,[
            'title'=>'required',
            'category'=>'required',
            'book'=>'required|mimes:pdf'
        ]);
        $data = new Book;
        $data->BookName= $request->input('title');
        $data->AuthorID= $request->input('author');
        $data->CategoryID= $request->input('category');
        $data->Volume= $request->input('volume');
        $data->PublicationID= $request->input('publication');
        $data->save();
        $request->file('book')->storeAs('public',$data->id.'.pdf');
        return redirect('/library/add_book')->with('Message','تمت الاضافة');
    }
    function destroyBook (Request $request)
    {
        $delete = Book::where('No',$request->input('delete_book'));
        if($delete)
        {
            $deleteBook = Storage::delete('public/'.$request->input('delete_book').'.pdf');
            if ($deleteBook)
            {
                $delete->delete();
                return redirect('/library')->with('Message','تم حذف الكتاب');
            }
            return redirect('/library')->with('Message','لا يمكن حذف الكتاب');
        }
        else
        {
            return redirect('/library')->with('Message','لا يمكن حذف الكتاب');
        }
    }
}
