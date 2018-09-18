<?php

namespace App\Http\Controllers\API;
use App\Category;
use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //AIzaSyDi_CnpM-CapvdvYJVY0dLCA_0SZXWXEcU
        if(isset($_GET['key']))
        {
            if(isset($_GET['subject']))
            {
                $category = Category::where('category_slug', '=', $_GET['subject'])->first();
                //echo $category; die;
            }
            $client = new \GuzzleHttp\Client(); 
            try 
            {
                $res = $client->request('GET', 'https://www.googleapis.com/books/v1/volumes', [
                    'query' => [
                    'q' => isset($_GET['subject']) ? $_GET['subject'] : 'fiction',
                    'printType' =>  'books',
                    'subject'   => isset($_GET['subject']) ? $_GET['subject'] : 'fiction',
                    'filter'    => 'paid-ebooks',
                    //'startIndex'=> 40,
                    'maxResults'=> 40,
                    'key'       => $_GET['key']
                    ]
                ]);
                $res->getStatusCode(); //"200"
                $res->getHeader('content-type'); //'application/json; charset=utf8'
                $result = $res->getBody();
                $totalBooksInfo = json_decode($result, false);
                $books = $totalBooksInfo->items;
                foreach ($books as $book) 
                {
                    $requestData = array(
                        'user_id' => 2,
                        'ebooktitle'=>!empty($book->volumeInfo->title)?$book->volumeInfo->title:'',
                        'subtitle'=>!empty($book->volumeInfo->subtitle)?$book->volumeInfo->subtitle:'',
                        'publisher' => $book->volumeInfo->publisher,
                        'type' => 'paid',
                        'desc' => !empty($book->volumeInfo->description)?$book->volumeInfo->description:'',
                        'ebook_logo' => $book->volumeInfo->imageLinks->thumbnail,
                        'retailPrice' => $book->saleInfo->retailPrice->amount,
                        'buyLink' => $book->saleInfo->buyLink,
                        'pageCount' => !empty($book->volumeInfo->pageCount)?$book->volumeInfo->pageCount: 0,
                        'category' => 2
                    );
                    // Book::create($requestData);
                }
                //echo "<pre>";print_r($requestData);echo "</pre>";
                //die();
            } 
            catch (\GuzzleHttp\Exception\BadResponseException $e) 
            {
                $result = json_encode(array('status' => $e->getResponse()->getStatusCode(), 'response' => $e->getMessage()));
            }
        }
        else
        {
            $result = json_encode(array('status' => 500, 'response' => 'api key missing'));
        }
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
