<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Http;
use GuzzleHttp\Client;
use App\Services\TokenService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    /**
     * Send wishlist share email via Brevo SMTP/API
     */
    public function sendWishlistEmail(Request $request)
    {
        $type = $request->input('type');
        $shareUrl = $request->input('shareUrl');
        $email = $request->input('email');
        $fullname = $request->input('fullname');

        // Determine recipient and template params
        if ($type === 'self') {
            $recipientEmail = session('user_email'); // Make sure user_email is stored in session
            $senderName = session('username');
            $templateId = 6;
            $params = [
                'wishlistUrl' => $shareUrl,
                'first_name' => $senderName,
            ];
        } elseif ($type === 'other') {
            $recipientEmail = $email;
            $senderName = session('username');
            $recipientFullName = $fullname;
            $templateId = 7;
            $params = [
                'wishlistUrl' => $shareUrl,
                'first_name' => $senderName,
                'receiver_name' => $recipientFullName,
            ];
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid type'], 400);
        }

        // Use Brevo template ID and params for email content
        try {
            $client = new Client();
            $apiKey = env('BREVO_API_KEY');
            $response = $client->post('https://api.brevo.com/v3/smtp/email', [
                'headers' => [
                    'api-key' => $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([
                    'sender' => [
                        'name' => 'Mirrar',
                        'email' => env('MAIL_FROM_ADDRESS', 'noreply@mirrar.com'),
                    ],
                    'to' => [
                        ['email' => $recipientEmail],
                    ],
                    'templateId' => $templateId,
                    'params' => $params,
                ]),
            ]);
            $result = json_decode($response->getBody(), true);
            return response()->json(['success' => true, 'result' => $result]);
        } catch (\Exception $e) {
            Log::error('Brevo email send error', [
                'error' => $e->getMessage(),
                'recipient' => $recipientEmail,
                'type' => $type,
            ]);
            return response()->json(['success' => false, 'message' => 'Failed to send email'], 500);
        }
    }
    // Dislike a wishlist item (proxy for frontend to avoid CORS)
    public function dislikeWishlistItem(Request $request, $ownerId)
    {
        $sku = $request->input('sku');
        $refreshToken = Session::get('refresh_token');
       $idToken = $this->refreshToken($refreshToken);

        try {
            $client = new Client();
            $body = [
                'sku' => $sku,
            ];
            $response = $client->post(
                'https://firebase-wishlist-user-item.ismail-biswas.workers.dev/users/' . $ownerId . '/wishlist/items/dislike',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $idToken,
                        'Content-Type' => 'application/json',
                    ],
                    'body' => json_encode($body),
                ]
            );
            $apiResult = json_decode($response->getBody(), true);
            return response()->json($apiResult, $response->getStatusCode());
        } catch (\Exception $e) {
            Log::error('Wishlist dislike API error', [
                'error' => $e->getMessage(),
                'owner_id' => $ownerId,
                'sku' => $sku
            ]);
            return response()->json([
                'error' => 'Failed to dislike wishlist item',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    // Like a wishlist item (proxy for frontend to avoid CORS)
    public function likeWishlistItem(Request $request, $ownerId)
    {
        $sku = $request->input('sku');
        $idToken = $this->getValidToken();
       $refreshToken = Session::get('refresh_token');
       $idToken = $this->refreshToken($refreshToken);
        // $idToken = $this->refreshToken($refreshToken);
        try {
            $client = new Client();
            $body = [
                'sku' => $sku,
            ];



            $response = $client->post(
                'https://firebase-wishlist-user-item.ismail-biswas.workers.dev/users/' . $ownerId . '/wishlist/items/like',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $idToken,
                        'Content-Type' => 'application/json',
                    ],
                    'body' => json_encode($body),

                ]
            );
            $apiResult = json_decode($response->getBody(), true);
            return response()->json($apiResult, $response->getStatusCode());
        } catch (\Exception $e) {
            Log::error('Wishlist like API error', [
                'error' => $e->getMessage(),
                'owner_id' => $ownerId,
                'sku' => $sku
            ]);
            return response()->json([
                'error' => 'Failed to like wishlist item',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    // ...existing methods...

    /**
     * Return wishlist products HTML for AJAX refresh
     */
    public function wishlistPartial(Request $request)
    {
        $userId = session('user_id');
        // Fetch wishlist products for the user (same logic as main wishlist)
        $products = $this->getWishlistProducts($userId); // You may need to adjust this method name
        return view('partials.wishlist_products', compact('products'))->render();
    }


     /**
     * Fetch wishlist products for a user (used for AJAX partial refresh)
     */
    private function getWishlistProducts($userId)
    {
        $idToken = Session::get('id_token');
        $refreshToken = Session::get('refresh_token');
        $products = [];

        // Get valid token (refresh if needed)
        $idToken = $this->refreshToken($refreshToken);

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->get('https://firebase-wishlist-user-item.ismail-biswas.workers.dev/users/' . $userId . '/wishlist/share', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $idToken,
                    'Content-Type' => 'application/json',
                ],
                'timeout' => 30
            ]);
            $apiResult = json_decode($response->getBody(), true);
            $shareUrl = $apiResult['shareUrl'] ?? null;
            if ($shareUrl) {
                $productResponse = $client->get($shareUrl, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ],
                    'timeout' => 30
                ]);
                $productResult = json_decode($productResponse->getBody(), true);
                $products = $productResult['items'] ?? [];
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $products = [];
        }
        return $products;
    }

    // ...existing methods...


    public function productChoose(Request $request){

        // dd($request->all());

        $userData = [
            'phoneNumber'   => $request->input('phone'),
            'idToken'       => $request->input('id_token'),
            'username'      => $request->input('name'),
            'anonId'        => $request->input('user_id'),
        ];

        // Call external user creation API
        try {
            $client = new Client();
            $response = $client->post('https://firebase-wishlist-user-item.ismail-biswas.workers.dev/users', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([
                    "phoneNumber" => $userData['phoneNumber'],
                    "idToken"     => $userData['idToken'],
                    "username"    => $userData['username'],
                    "anonId"      => $userData['anonId']
                ]),
            ]);
            $apiResult = json_decode($response->getBody(), true);
            $userId = $apiResult['user_id'];
            $idToken = $apiResult['idToken'];
            $refreshToken = $request->refresh_token ?? null;

            $idToken = $this->getValidToken();

        } catch (\Exception $e) {
            return redirect()->route('home');
        }

        // Store userId and idToken , refresh token in session for use on every page
                session([
                    'user_id' => $userId,
                    'id_token' => $idToken,
                    'refresh_token' => $refreshToken,
                    'username' => $request->input('name'),
                    'token_created_at' => time(), // store current timestamp
                    'user_email' => $request->input('email'),
                ]);




        if ($request->submit_type === 'recommended_products') {

             // Prepare category mapping for recommended products
        $mainCategories = [
            'Necklaces' => ['choker-necklace', 'long-necklace', 'short-necklace'],
            'Rings' => ['rings', 'single-ring', 'toe-ring'],
            'Earrings' => ['earrings-stud', 'earrings-drops', 'ear-loops'],
            'Pendant Sets' => ['forehead-pendant', 'pendant'],
            'Chains' => ['chains'],
            'Bracelets' => ['bracelet', 'multiple-bangles', 'single-bangle'],
            'Mangalsutras' => ['mangalsutra'],
            'Sets' => ['sets', 'pendantsets', 'pendent set', 'hair-jewellery']
        ];

        $selectedPieces = explode(',', $request->input('jewellery_pieces', ''));
        $categoryPresence = [];
        foreach ($mainCategories as $cat => $pieces) {
            foreach ($pieces as $piece) {
                if (in_array($piece, $selectedPieces)) {
                    $categoryPresence[] = $cat;
                    break;
                }
            }
        }
            /// wishlist id
             //fetcing share-url
                // $client = new Client();
                // $response = $client->get('https://firebase-wishlist-user-item.ismail-biswas.workers.dev/users/' . $userId . '/wishlist/share', [
                //     'headers' => [
                //         'Authorization' => 'Bearer ' . $idToken,
                //         'Content-Type' => 'application/json',
                //     ],
                //     'timeout' => 30
                // ]);

                // $apiResult = json_decode($response->getBody(), true);
                // $shareUrl = $apiResult['shareUrl'] ?? null;
                // // fetching wishlist product details
                // if ($shareUrl) {
                //     $productResponse = $client->get($shareUrl, [
                //         'headers' => [
                //             'Content-Type' => 'application/json',
                //         ],
                //         'timeout' => 30
                //     ]);
                //     $productResult = json_decode($productResponse->getBody(), true);
                //     // dd($productResult);
                //     $products = $productResult['items'] ?? [];
                // }
                // $wishlistProductIds = array_column($products, 'id');




        // Fetch wishlist products for the user
        $wishlistProductIds = [];
        try {
            $client = new Client();
            $response = $client->get('https://firebase-wishlist-user-item.ismail-biswas.workers.dev/shared/wishlists/' . $userId, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'timeout' => 30
            ]);
            $result = json_decode($response->getBody(), true);
            $wishlistProductIds = array_column($result['items'] ?? [], 'sku');
        } catch (\Exception $e) {
            $wishlistProductIds = [];
        }
        // dd($wishlistProductIds);
        // Pass categoryPresence and wishlistProductIds to view
        return view('productList', compact('userId', 'idToken', 'categoryPresence', 'wishlistProductIds'));
        } elseif ($request->submit_type === 'full_catalogue') {
            return redirect()->route('category.list', compact('userId', 'idToken'));
        }
        // Default: show the productChoose view
        return view('categoryList', compact('userId', 'idToken'));

    }
    public function recommended_products()
    {
        return view('productList');
    }
    public function product_show()
    {
        return view('productList');
    }
    public function category_list(){
       return view('categoryList');
    }
    public function full_catalogue(){
           return view('productList');

    }
    public function product_list($slug)
    {

        if ($slug == 'all-products') {

            return view('categoryList');
        } elseif ($slug == 'full-catalogue') {
            // Logic to fetch full catalog products
            return view('categoryList');
        }

        return view('productList', ['slug' => $slug]);
    }
   public function addToWishlist(Request $request, $user_id) {
    $sku = $request->input('sku');
    $idToken = $this->getValidToken();

    // \Log::info('Wishlist request received', [
    //     'user_id' => $user_id,
    //     'sku' => $sku,
    //     'has_token' => !empty($idToken)

    // ]);

    try {
        $client = new Client();
            $body = [
                'sku' => $request->input('sku'),
                'variantThumbnails' =>$request->input('variantThumbnails'),
                'categoryKey' => $request->input('categoryKey'),
                'productTitle' => $request->input('productTitle'),
            ];
            $response = $client->post(
                'https://firebase-wishlist-user-item.ismail-biswas.workers.dev/users/' . $user_id . '/wishlist',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $idToken,
                        'Content-Type' => 'application/json',
                    ],
                    'body' => json_encode($body),
                    'timeout' => 30 // Add timeout
                ]
            );

        $apiResult = json_decode($response->getBody(), true);
        // Log::info('External API success', ['response' => $apiResult]);

        return response()->json($apiResult, $response->getStatusCode());

    } catch (\Exception $e) {
        Log::error('Wishlist API error', [
            'error' => $e->getMessage(),
            'user_id' => $user_id,
            'sku' => $sku
        ]);

        return response()->json([
            'error' => 'Failed to add to wishlist',
            'message' => $e->getMessage()
        ], 500);
    }
}

public function removeFromWishlist(Request $request, $user_id) {
    $sku = $request->input('sku');
    $idToken = $this->getValidToken();
    try {
        $client = new Client();
        $response = $client->delete(
            'https://firebase-wishlist-user-item.ismail-biswas.workers.dev/users/' . $user_id . '/wishlist',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $idToken,
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode(['sku' => $sku]),
                'timeout' => 30
            ]
        );

        $apiResult = json_decode($response->getBody(), true);

        return response()->json($apiResult, $response->getStatusCode());

    } catch (\Exception $e) {
        // \Log::error('Wishlist remove API error', [
        //     'error' => $e->getMessage(),
        //     'user_id' => $user_id,
        //     'sku' => $sku
        // ]);

        return response()->json([
            'error' => 'Failed to remove from wishlist',
            'message' => $e->getMessage()
        ], 500);
    }
}

    public function viewWishlist() {
    $userId = Session::get('user_id');

    $idToken = Session::get('id_token');
    $refreshToken = Session::get('refresh_token');
    $products = [];

    // Get valid token (refresh if needed)
    // $idToken = $this->refreshToken($refreshToken);
     $idToken = $this->getValidToken();

            try {

                $client = new Client();
                // $response = $client->get('https://firebase-wishlist-user-item.ismail-biswas.workers.dev/users/' . $userId . '/wishlist/share', [
                //     'headers' => [
                //         'Authorization' => 'Bearer ' . $idToken,
                //         'Content-Type' => 'application/json',
                //     ],
                //     'timeout' => 30
                // ]);
                // $apiResult = json_decode($response->getBody(), true);
                // dd($apiResult);


                $shareUrl ='https://firebase-wishlist-user-item.ismail-biswas.workers.dev/shared/wishlists/' . $userId;
               $shareId = $userId;             //

                if ($shareUrl) {
                    $productResponse = $client->get($shareUrl, [
                        'headers' => [
                            'Content-Type' => 'application/json',
                        ],
                        'timeout' => 30
                    ]);
                    $productResult = json_decode($productResponse->getBody(), true);

                    $products = $productResult['items'] ?? [];
                    // dd($products);
                }
            } catch (RequestException $e) {


                $products = [];
                return redirect()->route('home');

            }

            // recommendation products
    $recommendApiUrl = 'https://firebase-wishlist-user-item.ismail-biswas.workers.dev/wishlist/recommend/get';
    $recommendedProducts = [];
    try {
        $response = $client->post($recommendApiUrl, [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode([
                'wishlist-id' => $shareId,

            ]),
            'timeout' => 30
        ]);
        $data = json_decode($response->getBody(), true);

        if (isset($data['items'])) {
            // Filter out items without a valid categoryKey
            $recommendedProducts = array_filter($data['items'], function($item) {
                return isset($item['categoryKey']) && !empty($item['categoryKey']);
            });
        }
    } catch (\Exception $e) {
        // dd($e);
        $recommendedProducts = [];
    }

        // Determine if viewing own or shared wishlist
// dd($recommendedProducts);
      $isShared = 0;
        $username = session('username');
        // Slug for URL (lowercase, hyphenated)


        // $username_first = strtolower(preg_split('/[- ]/', $username)[0]);
        $wishlistOwner = ucfirst($username) . "'s";

        // dd($products);
        // for slug
        $username = strtolower(str_replace(' ', '-', trim($username)));
        // dd("sd");


        return view('wishlist', compact('products', 'shareId', 'isShared', 'username','wishlistOwner','recommendedProducts'));
    }

public function shareWishlist($username, $shareId){


    $client = new Client();
    $name = str_replace('-', ' ', $username);
    $name = ucwords($name);
    $wishlistOwner = $name . "'s";
    $user_slug = $username;
    $ownerId = $shareId;

    // wishlist products
    $shareurl = "https://firebase-wishlist-user-item.ismail-biswas.workers.dev/shared/wishlists/" . $shareId;
    $productResponse = $client->get($shareurl, [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'timeout' => 30
    ]);
    $productResult = json_decode($productResponse->getBody(), true);
    $products = $productResult['items'] ?? [];
//
    // dd($products);

    // recommendation products
    $recommendApiUrl = 'https://firebase-wishlist-user-item.ismail-biswas.workers.dev/wishlist/recommend/get';
    $recommendedProducts = [];
    try {
        $response = $client->post($recommendApiUrl, [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode([
                'wishlist-id' => $shareId,

            ]),
            'timeout' => 30
        ]);
        $data = json_decode($response->getBody(), true);

        if (isset($data['items'])) {
            // Filter out items without a valid categoryKey
            $recommendedProducts = array_filter($data['items'], function($item) {
                return isset($item['categoryKey']) && !empty($item['categoryKey']);
            });
        }
    } catch (\Exception $e) {

        $recommendedProducts = [];
    }

// Session::flush();



    $isShared = 1;


    return view('sharedWishlist', compact('products', 'wishlistOwner', 'shareId', 'isShared', 'ownerId', 'user_slug', 'recommendedProducts'));
}



// / Add these private methods for token handling
    private function refreshToken($refreshToken)
    {
        try {
            $client = new Client();
            $response = $client->post('https://firebase-wishlist-user-item.ismail-biswas.workers.dev/refresh', [ // Replace with your actual auth domain
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'token' => $refreshToken
                ],
                'timeout' => 30
            ]);

            $data = json_decode($response->getBody(), true);
            // dd($data);
            // Update session with new tokens and new timestamp
            Session::put('id_token', $data['idToken'] ?? null);
            Session::put('refresh_token', $data['refreshToken'] ?? $refreshToken);
            Session::put('token_created_at', time());

            // Log::info('Token refreshed successfully');
            return $data['idToken'] ?? null;

        } catch (\Exception $e) {
            Log::error('Token refresh failed', [
                'error' => $e->getMessage(),
                'refresh_token' => substr($refreshToken, 0, 20) . '...' // Log partial token for security
            ]);
            return null;
        }
    }

    private function getValidToken()
    {

        $idToken = Session::get('id_token');
        $refreshToken = Session::get('refresh_token');
        $tokenCreatedAt = Session::get('token_created_at');
        // If token is missing, try to refresh
        if (!$idToken && $refreshToken) {
            $newToken = $this->refreshToken($refreshToken);
            Session::put('token_created_at', time());
            return $newToken;
        }

        // If token is older than 3600 seconds (1 hour), refresh
        if ($tokenCreatedAt && (time() - $tokenCreatedAt > 3600) && $refreshToken) {

            $newToken = $this->refreshToken($refreshToken);
            Session::put('token_created_at', time());
            return $newToken;
        }


        return $idToken;
    }

    public function createUserAfterOtp(Request $request)
    {
        $username = $request->input('username');
        $phoneNumber = $request->input('phoneno');
        $idToken = $request->input('idToken');
        $ownername = $request->input('ownername');
        $owneruserid = $request->input('owneruserid');
        $shareId = $request->input('shareId');
        $refreshToken = $request->input('refreshToken');

        try {
            $client = new Client();
            $response = $client->post('https://firebase-wishlist-user-item.ismail-biswas.workers.dev/users', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([
                    "phoneNumber" => $phoneNumber,
                    "idToken"     => $idToken,
                    "username"    => $username,
                    "anonId"      => $owneruserid,
                ]),
            ]);
            $apiResult = json_decode($response->getBody(), true);
            // Store userId, idToken, refreshToken in session
            session([
                'user_id' => $apiResult['user_id'] ?? null,
                'id_token' =>  $idToken,
                'refresh_token' => $refreshToken,
                'username' => $username,
                'token_created_at' => time(),
                'owner_id' => $owneruserid,
                'owner_name' => $ownername,
                'shareId' => $shareId,
            ]);
            // If user_id matches owneruserid, redirect to wishlist page

            return response()->json(['success' => true, 'data' => $apiResult]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

//
    public function shared_full_catalogue( $username, $wishlist_id){
        // Fetch the shared wishlist items for the user

        $user_id = $wishlist_id;
        $username= $username;
        $wishlistId = $wishlist_id;

        session([
            'owner_id' => $user_id,
            'owner_name' => $username,
            'share_id' => $wishlist_id,
        ]);


        return view('sharedCatalogue', compact('user_id', 'username','wishlistId'));
    }



    public function recommendWishlistItem(Request $request)
    {
        $sku = $request->input('sku');
        $wishlistId = $request->input('wishlist-id');
        $variantThumbnails= $request->input('variantThumbnails');
        $categoryKey = $request->input('categoryKey');
        $productTitle = $request->input('productTitle');
        $idToken = session('id_token');
        $refreshToken = Session::get('refresh_token');
    // $products = [];

    // Get valid token (refresh if needed)
    $idToken = $this->refreshToken($refreshToken);
        try {
            $client = new Client();
            $body = [
                'sku' => $sku,
                'wishlist-id' => $wishlistId,
                'variantThumbnails' => $variantThumbnails,
                'categoryKey' => $categoryKey,
                'productTitle' => $productTitle,
            ];
            $response = $client->post(
                'https://firebase-wishlist-user-item.ismail-biswas.workers.dev/wishlist/recommend',
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                          'Authorization' => 'Bearer ' . $idToken,
                    ],

                    'body' => json_encode($body),
                ]
            );
            $apiResult = json_decode($response->getBody(), true);
            return response()->json($apiResult, $response->getStatusCode());
        } catch (\Exception $e) {
            Log::error('Wishlist recommend API error', [
                'error' => $e->getMessage(),
                'sku' => $sku,
                'wishlist_id' => $wishlistId,

            ]);
            return response()->json([
                'error' => 'Failed to recommend wishlist item',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get current user's wishlist items for synchronization
     * Returns array of SKUs that are currently in the user's wishlist
     */
    public function syncWishlist(Request $request)
    {
        $userId = Session::get('user_id');

        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $idToken = $this->getValidToken();

        if (!$idToken) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        try {
            $client = new Client();
            $shareUrl = 'https://firebase-wishlist-user-item.ismail-biswas.workers.dev/shared/wishlists/' . $userId;

            $response = $client->get($shareUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'timeout' => 30
            ]);

            $result = json_decode($response->getBody(), true);
            $items = $result['items'] ?? [];

            // Extract SKUs from wishlist items
            $skus = array_column($items, 'sku');

            return response()->json([
                'success' => true,
                'wishlist_skus' => $skus,
                'timestamp' => time()
            ]);

        } catch (\Exception $e) {
            Log::error('Wishlist sync error', [
                'error' => $e->getMessage(),
                'user_id' => $userId
            ]);

            return response()->json([
                'error' => 'Failed to sync wishlist',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}



