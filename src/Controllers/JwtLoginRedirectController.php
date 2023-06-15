<?php
namespace Evometric\JwtLoginRedirect\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

function create_redirect_str($to, Request $request) {

    if(!str_starts_with($to, '/')) {
        $to = '/' . $to;
    }

    $param_kv_join = fn(string $k, string $v): string => "$k=$v"; // join each k[v] pair to a k=v string element
    $no_token_param_filter = fn($k): string => $k !== 'token';           // filter out the 'token' param
    $params = $request->query(); // all query params

    $params = array_filter($params, $no_token_param_filter, ARRAY_FILTER_USE_KEY); // lose the 'token'
    $query_str = '?' . implode("&", array_map($param_kv_join, array_keys($params), array_values($params))); // param elements, joined with '&' and with ? prefixed

    return $to . $query_str;
}

class JwtLoginRedirectController extends Controller
{
    public function get($to, Request $request) {
        $user = Auth::guard('jwt')->user();
        Auth::loginUsingId($user->id, $remember = true);
        return redirect(create_redirect_str($to, $request));
    }

    public function get_test($to, Request $request) {
        return response()->json(['to' => create_redirect_str($to, $request)]);
    }
}