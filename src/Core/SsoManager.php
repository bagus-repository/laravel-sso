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

    /**
     * Guzzle options
     *
     * @param array $headers
     * @return array
     */
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

    /**
     * Generate unique device id
     *
     * @return void
     */
    protected function generateDeviceId()
    {
        return bin2hex(openssl_random_pseudo_bytes(16));
    }

    /**
     * Redirect to auth server
     *
     * @param Request $request
     * @return void
     */
    public function redirect(Request $request)
    {
        if (config('forisasso.check_token_type') == 'session' ? $this->checkBySession():$this->check()) {
            return redirect(config('forisasso.post_login_redirect_uri'));
        }
        $DeviceId = Session::has('sso.device_id') ? Session::get('sso.device_id'):Cookie::get('sso-device-id', $this->generateDeviceId());
        $queries = http_build_query([
            'AppCode' => base64_encode(config('forisasso.app_code')),
            'RedirectUrl' => route('sso.callback'),
            'DeviceId' => base64_encode($DeviceId),
            'At' => now()->isoFormat('X'),
        ]);
        if (filter_var($request->getHost(), FILTER_VALIDATE_IP) === false) {
            $HostUrl = config('forisasso.base_url');
        }else{
            $HostUrl = config('forisasso.base_ip');
        }
        return redirect($HostUrl . '/sso/login?' . $queries);
    }

    /**
     * get auth info from server
     *
     * @param Request $request
     * @return void
     */
    public function callback(Request $request)
    {
        $user = new User();
        $user->setEmployeeNo($request->EmployeeNo);
        $user->setDeviceId($request->DeviceId);
        $user->setEmployeeName($request->EmployeeName);
        $user->setEmail($request->Email);
        $user->setCompanyCode($request->CompanyCode);

        $this->setSSOToken($request->AccessToken);
        $this->setSSOUser($user);

        return redirect(config('forisasso.post_login_redirect_uri'))->withCookie(cookie()->forever('sso-device-id', $request->DeviceId));
    }

    /**
     * Set SSO Token
     *
     * @param string $token
     * @return void
     */
    protected function setSSOToken(string $token)
    {
        Session::put('sso.access_token', $token);
    }

    /**
     * Set SSO User
     *
     * @param User $user
     * @return void
     */
    protected function setSSOUser(User $user)
    {
        Session::put('sso.user', serialize($user));
    }

    /**
     * Generate Sso Button
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function SsoLoginButton()
    {
        if (config('forisasso.check_token_type') == 'session' ? $this->checkBySession():$this->check()) {
            return view('Sso::signout-button');
        }
        return view('Sso::signin-button');
    }

    /**
     * Logout SSO
     *
     * @param \Closure|null $beforeLogout
     * @return void
     */
    public function logout(\Closure $beforeLogout = null)
    {
        if ($beforeLogout !== null) {
            call_user_func($beforeLogout);
        }
        Session::forget('sso');
        //TODO : revoke token

        return redirect(config('forisasso.post_logout_redirect_uri'))->with('error', 'Session Expired');
    }

    /**
     * Check auth from SSO Server
     *
     * @return boolean
     */
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

    /**
     * Get Logged in SSO User from server
     *
     * @return mixed
     */
    public function getServerUser()
    {
        $Response = $this->Client->get(config('forisasso.api_url') . '/sso/user', $this->ClientOptions());
        
        return $this->checkAPIResponse($Response);
    }

    /**
     * Check SSO Response
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

    /**
     * Get SSO User
     *
     * @return User|null
     */
    public function user(): ?User
    {
        return unserialize(Session::get('sso.user'));
    }

    /**
     * Set SSO User
     *
     * @param User $user
     * @return void
     */
    public function setUser(User $user): void
    {
        Session::put('sso.user', serialize($user));
    }

    /**
     * Get SSO Token
     *
     * @return string|null
     */
    public function token(): ?string
    {
        return Session::get('sso.access_token');
    }
}
