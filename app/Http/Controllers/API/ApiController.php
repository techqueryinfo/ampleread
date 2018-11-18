<?php

namespace App\Http\Controllers\API;
use App\Category;
use App\Book;
use App\Role;
use App\Models\User;
use App\Paid;
use App\PaidDiscount;
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


    public function abebooks(){
        $abeClientKey = '477226ef-f890-4821-87c4-72ee63b82c64';
        $abeKeyword = 'fiction';
        $abeMaxResults = 20;
        $adminUsers = DB::table('users')
                      ->join('role_user', 'role_user.user_id', '=', 'users.id')
                      ->join('roles', 'role_user.role_id', '=', 'roles.id')->where('roles.name', 'admin')->first();

        $categories = Category::where('status', 'Active')->where('parent', 0)->orWhere('parent', null)->where('is_delete', '=', 0)->get();
        
        foreach ($categories as $key => $value) {
          $abeKeyword = $value->name;
          $abeApiUrl = 'http://search2.abebooks.com/search?clientkey='.$abeClientKey.'&keyword='.$abeKeyword.'&maxresults='.$abeMaxResults;
          $xml_data = file_get_contents($abeApiUrl);


          $xml = new \SimpleXMLElement($xml_data, true);

          foreach ($xml->Book as $row)
          {
            $element =(array)$row;
            if($element['bookId']){
              $book = DB::table('books')->where('ebooktitle', $element['title'])->first();
              if(empty((array)$book)){
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
                $newBook = Book::create($requestData);

                $paidData = array(
                  'book_id'=>$newBook->id,
                  'store_name'=>'abebooks',
                  'link' => ($element['listingUrl']) ? $element['listingUrl'] : '',
                  'price' => ($element['totalListingPrice']) ? $element['totalListingPrice'] : '',
                );
                $pData = Paid::create($paidData);

                $paidDiscountData = array(
                  'book_id'=>$newBook->id,
                  'paid_ebook_id'=>$pData->id,
                  'discount'=>'0',
                  'additional_options' => 'paid',
                  'desc' => ($element['title']) ? $element['title'] : ''
                );
                PaidDiscount::create($paidDiscountData);
              }
            }
          }
        }
        $result = json_encode(array('status' => 200, 'response' => 'abebooks imported successfuly !'));
        exit;
    }


    public function cjbooks(Request $request, $cjKeyword='fiction', $cjMaxResults = 20){
      $cjWebsiteId= "8910566";
      $adminUsers = DB::table('users')
                    ->join('role_user', 'role_user.user_id', '=', 'users.id')
                    ->join('roles', 'role_user.role_id', '=', 'roles.id')->where('roles.name', 'admin')->first();
      // register for your developer's key here: http://webservices.cj.com/ (input dev key below)
      $CJ_DevKey= " 008af62e87369a214c3d0098c02df71f28a05cef378073e1645df4c6202a8868ab916e9e0e84b20f09b9acea1b7d9097f27569d5ffabc06cb23bf01df1ee69b773/008a594f398f4324a3a298557c004768de29ca5ce0052359e373279f99a6bee8756c7bfac403e07bbe1d56ae53c3e0cc26a91b77181bbafccaacc9f31c51efcc01";
      $currency="USD";
      $advs="joined"; // results from (joined), (CIDs), (Empty String), (notjoined)
      // begin building the URL and GETting variables passed
      $targeturl="https://product-search.api.cj.com/v2/product-search?";
      $targeturl.="website-id=$cjWebsiteId";
      $categories = Category::where('status', 'Active')->where('parent', 0)->orWhere('parent', null)->where('is_delete', '=', 0)->get();
      foreach ($categories as $ckey => $cvalue) {
        $cjKeyword = $cvalue->name;
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
        // end building targeturl
        $ch = curl_init($targeturl);
        curl_setopt($ch, CURLOPT_POST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$CJ_DevKey)); // send development key
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        $xml = new \SimpleXMLElement($response, true);
        curl_close($ch);

        if($xml->products && $xml->products->product){
          foreach ($xml->products->product as $key => $row) {
            
            $element =(array)$row;
            // echo $element['name']."<br>";
            if($element['name']){
              $book = DB::table('books')->where('ebooktitle', $element['name'])->first();
              if(empty((array)$book)){
                // echo "<br>========".$element['name']."<br>";
                $requestData = array(
                  'user_id' => $adminUsers->id,
                  'ebooktitle'=>($element['name']) ? $element['name'] : '',
                  'subtitle'=>($element['name']) ? $element['name'] : '',
                  'publisher' => '',
                  'type' => 'paid',
                  'desc' => ($element['description']) ? $element['description'] : '',
                  'ebook_logo' => ($element['image-url']) ? $element['image-url'] : '',
                  'retailPrice' => ($element['sale-price']) ? $element['sale-price'] : '',
                  'buyLink' =>($element['buy-url']) ? $element['buy-url'] : '',
                  'asin' => ($element['sku']) ? $element['sku'] : '',
                  'ext_book_id' => ''
                );

                $newBook = Book::create($requestData);

                $paidData = array(
                  'book_id'=>$newBook->id,
                  'store_name'=>'cj',
                  'link' => ($element['buy-url']) ? $element['buy-url'] : '',
                  'price' => ($element['sale-price']) ? $element['sale-price'] : '',
                );
                $pData = Paid::create($paidData);

                $paidDiscountData = array(
                  'book_id'=>$newBook->id,
                  'paid_ebook_id'=>$pData->id,
                  'discount'=>'0',
                  'additional_options' => 'paid',
                  'desc' => ($element['name']) ? $element['name'] : ''
                );
                PaidDiscount::create($paidDiscountData);
              }
            }
          }
        }
      }
      exit;
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
      // if ($results == '') { $results = "
      // There are no available products at this time or no search parameters were specified. Please try again later.
      // "; }
      // print $results;
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
