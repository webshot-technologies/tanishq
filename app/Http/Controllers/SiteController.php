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


    public function productChoose(Request $request){
   
//  dd($request);
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
            // dd($idToken);
            // dd($refreshToken);



        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        // Store userId and idToken , refresh token in session for use on every page
        session(['user_id' => $userId, 'id_token' => $idToken, 'refresh_token' => $refreshToken]);

       

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
                $client = new Client();
                $response = $client->get('https://firebase-wishlist-user-item.ismail-biswas.workers.dev/users/' . $userId . '/wishlist/share', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $idToken,
                        'Content-Type' => 'application/json',
                    ],
                    'timeout' => 30
                ]);
                
                $apiResult = json_decode($response->getBody(), true);
                $shareUrl = $apiResult['shareUrl'] ?? null;
                // fetching wishlist product details
                if ($shareUrl) {
                    $productResponse = $client->get($shareUrl, [
                        'headers' => [
                            'Content-Type' => 'application/json',
                        ],
                        'timeout' => 30
                    ]);
                    $productResult = json_decode($productResponse->getBody(), true);
                    // dd($productResult);
                    $products = $productResult['items'] ?? [];
                }
                $wishlistProductIds = array_column($products, 'id');
                



        // Example: $categoryPresence = ['necklace', 'bracelets']
        // Pass categoryPresence to recommended products view
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
    $idToken = session('id_token');
 $idToken = TokenService::getValidToken();
 
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
        // \Log::info('External API success', ['response' => $apiResult]);

        return response()->json($apiResult, $response->getStatusCode());

    } catch (\Exception $e) {
        \Log::error('Wishlist API error', [
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
    $idToken = $request->bearerToken();

    \Log::info('Remove from wishlist request', [
        'user_id' => $user_id,
        'sku' => $sku,
        'has_token' => !empty($idToken)
    ]);

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
        \Log::info('External API remove success', ['response' => $apiResult]);

        return response()->json($apiResult, $response->getStatusCode());

    } catch (\Exception $e) {
        \Log::error('Wishlist remove API error', [
            'error' => $e->getMessage(),
            'user_id' => $user_id,
            'sku' => $sku
        ]);

        return response()->json([
            'error' => 'Failed to remove from wishlist',
            'message' => $e->getMessage()
        ], 500);
    }
}

    public function viewWishlist() {
        $userId = Session::get('user_id');
        $products = [];
        
        // Get valid token (refresh if needed)
        $idToken = $this->getValidToken();
        // dd($idToken);
        
            try {
               
                //fetcing share-url  
                $client = new Client();
                $response = $client->get('https://firebase-wishlist-user-item.ismail-biswas.workers.dev/users/' . $userId . '/wishlist/share', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $idToken,
                        'Content-Type' => 'application/json',
                    ],
                    'timeout' => 30
                ]);
                
                $apiResult = json_decode($response->getBody(), true);
                $shareUrl = $apiResult['shareUrl'] ?? null;
                // fetching wishlist product details
                if ($shareUrl) {
                    $productResponse = $client->get($shareUrl, [
                        'headers' => [
                            'Content-Type' => 'application/json',
                        ],
                        'timeout' => 30
                    ]);
                    $productResult = json_decode($productResponse->getBody(), true);
                    // dd($productResult);
                    $products = $productResult['items'] ?? [];
                }
            } catch (RequestException $e) {
                
                $products = [];
                return redirect()->back();

            }


        return view('wishlist', compact('products'));
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
            // Update session with new tokens
            Session::put('id_token', $data['id_token'] ?? null);
            Session::put('refresh_token', $data['refresh_token'] ?? $refreshToken);
            
            Log::info('Token refreshed successfully');
            return $data['id_token'] ?? null;
            
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
        
        // Simple check - if idToken is missing but refreshToken exists, try to refresh
        if (!$idToken && $refreshToken) {
            Log::info('Attempting token refresh');
            return $this->refreshToken($refreshToken);
        }
        
        return $idToken;
    }

}
