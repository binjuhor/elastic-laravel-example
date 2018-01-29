<?php

namespace Picinside\Http\Controllers;

use Illuminate\Http\Request;

use Picinside\Items;

use Picinside\Itemrelations;

use Picinside\Iteminfo;

use Picinside\Taxonomy;

use Picinside\Taxrelations;

use Elasticsearch\ClientBuilder;


// use Elasticsearch\Elasticsearch;
// use Picinside\Elasticsearch\ClientBuilder;

class SearchController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }



    /**
     * This create view of items list
     * @return Illuminate\Http\Response
     */
    public function index()
    {
       return view('search.index');
    }


    /**
     * Index and reindex item info in elasticsearch
     * @param  integer $id id of item from database app
     * @param  string $message message for return status
     * @return string
     */
    public function indexElastic($id, $message = "Index success")
    {

        $client             = ClientBuilder::create()->build();
        $items              = Items::find($id)->toArray();
        $itemInfo           = Iteminfo::where('item_id','=', $id)->orderBy('created_at', 'desc')->first()->toArray();
        $params             = ['body'=>[]];
        $message            = $items['name']."- Index Success";
        $params['body'][]   = [
            "index"=>[
                "_index"    => "picinside",
                "_type"     => "themes",
                "_id"       => $id,
            ]
        ];
        $info = array(
            "sales"         => $itemInfo["sales"],
            "rate"          => $itemInfo["rate"],
            "sale_today"    => $itemInfo["salesdate"],
            "update"        => $itemInfo["upload_update"],
            "info_get"      => $itemInfo["updated_at"],
            "price"         => $itemInfo["price"]
        );
        $params['body'][] = array_merge($items, $info);
        $responses = $client->bulk($params);
        return $message;
    }

    /**
     * Search item via a keywords search all in item
     * @param  string $key keyword for item search
     * @return json result with keywords search
     */
    public function searchItems(Request $request)
    {
        $client = ClientBuilder::create()->build();
        $params =[
            "index"=>"picinside",
            "from"=>0,
            "size"=>500,
            "body"=>[
                "query"=>[
                    "match"=>[
                        "_all"=>$request['q']
                    ]
                ]
            ]
        ];

        $results    = $client->search($params);
        $data       = $results['hits']['hits'];
        // dd($results);
        return view('search.list', compact('data','results'));
    }


    /**
     * Search item via a keywords search all in item
     * @param  string $key keyword for item search
     * @return json result with keywords search
     */
    public function searchAdvance(Request $request)
    {
        $client     = ClientBuilder::create()->build();
        //Default search
        $params =[
            "index" =>"picinside",
            "type"  =>"themes",
            "from"  =>0,
            "size"  =>500,
            "body"  =>[
                "query"=>[
                    "match"=> [
                        "_all" => $request['q']
                    ],
                ]
            ]
        ];

        //Advance search
        if ($request["enable-advance"] != null)
        {
            if($request['search'] == null) $request['search'] = 'name';
            $params =[
                "index" => "picinside",
                "type"  => "themes",
                "from"  => 0,
                "size"  => 500,
                "body"  => [
                    "query" => [
                        "match" => [
                            $request['search'] => $request['q']
                        ],
                    ],
                    "sort" => [
                        "sales" => "desc"
                    ]

                ]
            ];
        }

        //Advance search
        if ($request["orderby-sales"] != null)
        {
            if($request['search'] == null) $request['search'] = 'name';
            $params =[
                "index" => "picinside",
                "type"  => "themes",
                "from"  => 0,
                "size"  => 500,
                "body"  => [
                    "query" => [
                        "match_all" => [],
                    ],
                    "sort" => [
                        "sales" => "desc"
                    ]

                ]
            ];
        }

        $results    = $client->search($params);
        $data       = $results['hits']['hits'];
        return view('search.tableajax', compact('data','results'));
    }
}
