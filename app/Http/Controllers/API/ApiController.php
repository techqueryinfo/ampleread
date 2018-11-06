<?php

namespace App\Http\Controllers\API;
use App\Category;
use App\Book;
use App\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

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


    public function abebooks(Request $request, $abeKeyword='fiction', $abeMaxResults = 20){
        $abeClientKey = '477226ef-f890-4821-87c4-72ee63b82c64';
        // $abeKeyword = 'fiction';
        // $abeMaxResults = 20;
        $adminUsers = DB::table('users')
                      ->join('role_user', 'role_user.user_id', '=', 'users.id')
                      ->join('roles', 'role_user.role_id', '=', 'roles.id')->where('roles.name', 'admin')->first();

        
        $abeApiUrl = 'http://search2.abebooks.com/search?clientkey='.$abeClientKey.'&keyword='.$abeKeyword.'&maxresults='.$abeMaxResults;
        $xml_data = file_get_contents($abeApiUrl);


        $xml = new \SimpleXMLElement($xml_data, true);

        foreach ($xml->Book as $row)
        {
          $element =(array)$row;
          if($element['bookId']){
            $book = DB::table('books')->where('ext_book_id', $element['bookId'])->first();
            if(empty($book)){
              $requestData = array(
                'user_id' => $adminUsers->id,
                'ebooktitle'=>($element['title']) ? $element['title'] : '',
                'subtitle'=>($element['title']) ? $element['title'] : '',
                'publisher' => ($element['vendorName']) ? $element['vendorName'] : '',
                'type' => 'paid',
                'desc' => ($element['title']) ? $element['title'] : '',
                'ebook_logo' => ($element['catalogImage']) ? $element['catalogImage'] : '',
                'retailPrice' => ($element['totalListingPrice']) ? $element['totalListingPrice'] : '',
                'buyLink' =>($element['listingUrl']) ? $element['listingUrl'] : '',
                'asin' => ($element['isbn10']) ? $element['isbn10'] : '',
                'ext_book_id' => ($element['bookId']) ? $element['bookId'] : ''
              );
              Book::create($requestData);
            }
          }
        }
        $result = json_encode(array('status' => 200, 'response' => 'abebooks imported successfuly !'));
        exit;
    }


    public function cjbooks(Request $request, $cjKeyword='fiction', $cjMaxResults = 20){
      $cjWebsiteId= "8910566";
      // register for your developer's key here: http://webservices.cj.com/ (input dev key below)
      $CJ_DevKey= "00a210f8840b5aef309a846c376754b56aadce77ca858968ce18202ab8897eec8f3f39407054e6e4ceae79ae323ead67b967b53737807a67830ed971cae9152fc5/0dd559011c5f04afa760ca43e86408a03479bd2be23e1a5e0d1d21c862a41cd8f24e7656e74a2e89c127ef890fe538663c59108c0fe78b6fe2f858d890d041f9";
      $currency="USD";
      $advs="joined"; // results from (joined), (CIDs), (Empty String), (notjoined)
      // begin building the URL and GETting variables passed
      $targeturl="https://product-search.api.cj.com/v2/product-search?";
      $targeturl.="website-id=$websiteid";
      if (isset($cjKeyword))
      {
      $keywords = $cjKeyword;
      $keywords = urlencode($keywords);
      $targeturl.="&keywords=$keywords";
      }
      if (isset($cjMaxResults))
      {
      $maxresults = $cjMaxResults;
      $targeturl.="&records-per-page=".$maxresults;
      }

      $pperkeyword = 20;
      $targeturl = "https://product-search.api.cj.com/v2/product-search?website-id=".$websiteid."&keywords=".$keywords."&records-per-page=".$pperkeyword."&serviceable-area=US";

      // end building targeturl
      $ch = curl_init($targeturl);
      curl_setopt($ch, CURLOPT_POST, FALSE);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$CJ_DevKey)); // send development key
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $response = curl_exec($ch);
      $xml = new SimpleXMLElement($response);
      curl_close($ch);
      echo $xml;
      // if ($xml)
      // {
      // foreach ($xml-<span>></span>products-<span>></span>product as $item) {
      // $link = $item-<span>></span>xpath('buy-url');
      // $link = (string)$link[0];
      // $title = $item-<span>></span>xpath('name');
      // $title = (string)$title[0];
      // $imgURL = $item-<span>></span>xpath('image-url');
      // $imgURL = (string)$imgURL[0];
      // $price = $item-<span>></span>xpath('price');
      // $price = '
      // $'.number_format($price[0],2,'.',',');
      // $merchantname = $item-<span>></span>xpath('advertiser-name');
      // $merchantname = (string)$merchantname[0];
      // $description = $item-<span>></span>xpath('description');
      // $description = (string)$description[0];
      // if($link != "")
      // $results .="
      // $title
      // ".$description."
      // ".$price."
      // ";
      // }
      // }
      if ($results == '') { $results = "
      There are no available products at this time or no search parameters were specified. Please try again later.
      "; }
      print $results;
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
