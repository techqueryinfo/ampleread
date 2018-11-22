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
use Exception;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $curl; 

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
        
        foreach ($categories as $ckey => $cvalue) {
          $abeKeyword = $cvalue->name;
          $abeApiUrl = 'http://search2.abebooks.com/search?clientkey='.$abeClientKey.'&keyword='.$abeKeyword.'&maxresults='.$abeMaxResults;
          $xml_data = file_get_contents($abeApiUrl);

          if($cvalue->parent == NULL || $cvalue->parent == 0){
            $categoryId =  $cvalue->id;
            $subCategoryId = null;
          }
          else
          {
            $categoryId =  $cvalue->parent;
            $subCategoryId = $cvalue->id; 
          }
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
                  'category'=>$categoryId,
                  'sub_category'=> $subCategoryId,
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


    public function cjbooks(Request $request, $cjMaxResults = 20){
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
        if($cvalue->parent == NULL || $cvalue->parent == 0){
          $categoryId =  $cvalue->id;
          $subCategoryId = null;
        }
        else
        {
          $categoryId =  $cvalue->parent;
          $subCategoryId = $cvalue->id; 
        }
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
                  'category'=>$categoryId,
                  'sub_category'=> $subCategoryId,
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
    }
    
    public function kobobooks(Request $request, $maxResults = 50){
      // echo "<pre>";maxResults
      $adminUsers = DB::table('users')
                  ->join('role_user', 'role_user.user_id', '=', 'users.id')
                  ->join('roles', 'role_user.role_id', '=', 'roles.id')->where('roles.name', 'admin')->first();  
      try {
        $kobo_api_token = $this->getKoboToken();
        if($kobo_api_token && $kobo_api_token->access_token){
          $kobo_apiToken = $kobo_api_token->access_token;

          $categories = Category::where('status', 'Active')->where('parent', 0)->orWhere('parent', null)->where('is_delete', '=', 0)->get();
          foreach ($categories as $ckey => $cvalue) {
            $koboKeyword = $cvalue->name;
            if($cvalue->parent == NULL || $cvalue->parent == 0){
              $categoryId =  $cvalue->id;
              $subCategoryId = null;
            }
            else
            {
              $categoryId =  $cvalue->parent;
              $subCategoryId = $cvalue->id; 
            }
            $parameters = ['keyword'=>$koboKeyword,'max'=>$maxResults];   
            $products = $this->koboProductSearch($parameters, $kobo_apiToken);  
            // print_r($products);
            if($products && $products['TotalPages'] > 0)
            {
              foreach ($products['item'] as $key => $element) {
                if($element['productname']){
                  $book = DB::table('books')->where('ebooktitle', $element['productname'])->first();

                  if(empty((array)$book)){
                    $requestData = array(
                      'user_id' => $adminUsers->id,
                      'ebooktitle'=>($element['productname']) ? $element['productname'] : '',
                      'subtitle'=>($element['productname']) ? $element['productname'] : '',
                      'category'=>$categoryId,
                      'sub_category'=> $subCategoryId,
                      'publisher' => '',
                      'type' => 'paid',
                      'desc' => ($element['description']['short']) ? $element['description']['short'] : '',
                      'ebook_logo' => ($element['imageurl']) ? $element['imageurl'] : '',
                      'retailPrice' => ($element['saleprice']) ? $element['saleprice'] : '',
                      'buyLink' =>($element['linkurl']) ? $element['linkurl'] : '',
                      'asin' => ($element['sku']) ? $element['sku'] : '',
                      'ext_book_id' => ''
                    );
                    $newBook = Book::create($requestData);

                    $paidData = array(
                      'book_id'=>$newBook->id,
                      'store_name'=>'Kobo Books',
                      'link' => ($element['linkurl']) ? $element['linkurl'] : '',
                      'price' => ($element['saleprice']) ? $element['saleprice'] : '',
                    );
                    $pData = Paid::create($paidData);

                    $paidDiscountData = array(
                      'book_id'=>$newBook->id,
                      'paid_ebook_id'=>$pData->id,
                      'discount'=>'0',
                      'additional_options' => 'paid',
                      'desc' => ($element['productname']) ? $element['productname'] : ''
                    );
                    PaidDiscount::create($paidDiscountData);
                  }
                }
              }
            }
          }
        }
      } catch (Exception $e) {
        print_r($e->getMessage());
      }
      exit;
    }

    /**
     * Convenience method to access Product Catalog Search Service
     * 
     * @param array $parameters GET request parameters to be appended to the url
     * @return array Commission Junction API response, converted to a PHP array
     * @throws Exception on cURL failure or http status code greater than or equal to 400
     */
    public function koboProductSearch(array $parameters = array(), $kobo_api_token) {
      $domain = "https://api.rakutenmarketing.com/%s/%s";
      if($kobo_api_token){
        $kobo_api_key = 'Bearer '.$kobo_api_token;
        return $this->koboApi("productsearch", "productsearch", $parameters, $domain, $kobo_api_key); 
      }
    }
    
    public function getKoboToken()
    {
        return $this->koboApiToken("token", "token", $parameters = array());
    }
    
    /**
     * Convenience method to access Commission Detail Service
     * 
     * @param array $parameters GET request parameters to be appended to the url
     * @return array Commission Junction API response, converted to a PHP array
     * @throws Exception on cURL failure or http status code greater than or equal to 400
     */
    private function commissionDetailLookup(array $parameters = array()) {
        throw new \Exception("Not implemented");
    }

    /**
     * Generic method to fire API requests at Commission Junctions servers
     * 
     * @param string $subdomain The subomdain portion of the REST API url
     * @param string $resource The resource portion of the REST API url (e.g. /v2/RESOURCE)
     * @param array $parameters GET request parameters to be appended to the url
     * @param string $version The version portion of the REST API url, defaults to v2
     * @return array Commission Junction API response, converted to a PHP array
     * @throws Exception on cURL failure or http status code greater than or equal to 400
     */
    public function koboApi($subdomain, $resource, array $parameters = array(), $domain, $api_key, $version = '1.0') {
        $ch = $this->getCurl();
        $url = sprintf($domain, $subdomain, $version, $resource);
        
        if (!empty($parameters))
            $url .= "?" . http_build_query($parameters);
        curl_setopt_array($ch, array(
            CURLOPT_URL  => $url,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/xml',
                'authorization: ' . $api_key,
            )
        ));
        $body = curl_exec($ch);
        $errno = curl_errno($ch);
        if ($errno !== 0) {
            throw new \Exception(sprintf("Error connecting to CommissionJunction: [%s] %s", $errno, curl_error($ch)), $errno);
        }
        
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_status >= 400) {
            throw new \Exception(sprintf("CommissionJunction Error [%s] %s", $http_status, strip_tags($body)), $http_status);
        }
        
        return json_decode(json_encode((array)simplexml_load_string($body)), true);
    }

    public function koboApiToken($subdomain, $resource, array $parameters = array(), $version = '1.0') {                                                                      
        $ch = curl_init('https://api.rakutenmarketing.com/token');                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=password&username=AmpleReads&password=AR2018**&scope=3570677");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                              
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Accept: */*',
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Basic VkV5Nm81ZlFGZkkzYkdUVjFwOHY1VGRYaGZVYTo4YkYxdnZfVXJ4TVhfbVdNU3FoTmNBWnNYcFlh',
            ));  
        $body = curl_exec($ch);
        $errno = curl_errno($ch);
        if ($errno !== 0) {
            throw new Exception(sprintf("Error connecting to CommissionJunction Token : [%s] %s", $errno, curl_error($ch)), $errno);
        }

        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_status >= 400) {
            throw new Exception(sprintf("CommissionJunction Error Token  [%s] %s", $http_status, strip_tags($body)), $http_status);
        }
        return json_decode($body);
    }

    
    /**
     * @return resource
     */
    public function getCurl() {
      $this->curl = curl_init();
      curl_setopt_array($this->curl, array(
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_SSL_VERIFYHOST => 2,
          CURLOPT_FOLLOWLOCATION => false,
          CURLOPT_MAXREDIRS      => 1,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CONNECTTIMEOUT => 10,
          CURLOPT_TIMEOUT        => 30,
      ));
      return $this->curl;
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
