<?php

namespace Forisa\Sso\Core;

use Exception;
use GuzzleHttp\Client;
use Forisa\Sso\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class SsoManager
{
    /**
     * Http Client
     *
     * @var \GuzzleHttp\Client
     */
    private $Client;

    public function __construct() {
        if ($this->Client === null) {
            $this->Client = new Client();
        }
    }

    protected function clientOptions(array $headers = []): array
    {
        return [
            'headers' => array_merge(
                [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json; charset=utf-8',
                    'Authorization' => 'Bearer ' . Session::get('sso.access_token'),
                ], $headers
            ),
            'timeout' => 300,
            'verify' => false,
            'verify_peer' => false,
            'verify_peer_name' => false,
            'http_errors' => false,
            'delay' => 0
        ];
    }

    public function generateDeviceId()
    {
        return bin2hex(openssl_random_pseudo_bytes (16));
    }

    public function redirect(Request $request)
    {
        if ($this->checkBySession()) {
            return redirect(config('forisasso.post_login_redirect_uri'));
        }
        $DeviceId = Session::has('sso.device_id') ? Session::get('sso.device_id'):Cookie::get('sso-device-id', $this->generateDeviceId());
        $queries = http_build_query([
            'AppCode' => base64_encode(config('forisasso.app_code')),
            'RedirectUrl' => route('sso.callback'),
            'DeviceId' => base64_encode($DeviceId),
        ]);
        if (filter_var($request->getHost(), FILTER_VALIDATE_IP) === false) {
            $HostUrl = config('forisasso.base_url');
        }else{
            $HostUrl = config('forisasso.base_ip');
        }
        return redirect($HostUrl . '/sso/login?' . $queries);

        // Session::put('sso.user', serialize($user));

        // Session::put('sso.id_token', $oidc->getIdToken());

        // Session::put('sso.access_token', $oidc->getAccessToken());
    }

    public function callback(Request $request)
    {
        $user = new User();
        $user->setAccessToken($request->AccessToken);
        $user->setEmployeeNo($request->EmployeeNo);
        $user->setDeviceId($request->DeviceId);
        $user->setEmployeeName($request->EmployeeName);
        $user->setEmail($request->Email);

        $this->setSSOData($user);

        return redirect(config('forisasso.post_login_redirect_uri'))->withCookie(cookie()->forever('sso-device-id', $request->DeviceId));
    }

    protected function setSSOData(User $user)
    {
        Session::put('sso.access_token', $user->getAccessToken());
        Session::put('sso.employee_no', $user->getEmployeeNo());
        Session::put('sso.device_id', $user->getDeviceId());
        Session::put('sso.employee_name', $user->getEmployeeName());
        Session::put('sso.email', $user->getEmail());
    }

    public function SsoLoginButton()
    {
        if ($this->checkBySession()) {
            return view('Sso::signout-button');
        }
        return view('Sso::signin-button');
    }

    public function logout()
    {
        // $accessToken = Session::get('sso.id_token');

        // Session::remove('sso');

        // Session::save();

        // $redirect = $request->getPostLogoutRedirectUri();

        // $oidc = new OpenIDConnectClient($request->getProvider(), $request->getClientId(), $request->getClientSecret());

        // if (strtolower(config('app.env')) != 'production' && strtolower(config('app.env')) != 'prod') {
        //     $oidc->setVerifyHost(false);
        //     $oidc->setVerifyPeer(false);
        // }

        // $oidc->signOut($accessToken, $redirect);

        Session::forget('sso');
        //TODO : revoke token

        return redirect(config('forisasso.post_logout_redirect_uri'))->with('error', 'Session Expired');
    }

    public function check(): bool
    {
        $Response = $this->Client->get(config('forisasso.api_url') . '/sso/checktoken', $this->ClientOptions());
        
        return $Response->getStatusCode() == 200;
    }

    /**
     * Check Logged In user By Session
     *
     * @return boolean
     */
    public function checkBySession(): bool
    {
        return Session::has('sso.access_token');
    }

    public function getUser()
    {
        $Response = $this->Client->get(config('forisasso.api_url') . '/sso/user', $this->ClientOptions());
        
        return $this->checkAPIResponse($Response);
    }

    /**
     * Undocumented function
     *
     * @param \Psr\Http\Message\ResponseInterface $Response
     * @return mixed
     */
    public function checkAPIResponse($Response)
    {
        if ($Response->getStatusCode() == 200) {
            $decoded = json_decode($Response->getBody()->getContents());
            return $decoded;
        }elseif ($Response->getStatusCode() == 401) {
            return $this->logout();
        }

        throw new Exception("SSO Server Error");
    }

    public function user(): ?User
    {
        return unserialize(Session::get('sso.user'));
    }

    public function set(User $user): void
    {
        Session::put('sso.user', serialize($user));
    }

    public function token(): ?string
    {
        return Session::get('sso.id_token');
    }

    public function accessToken(): ?string
    {
        return Session::get('sso.access_token');
    }
}
