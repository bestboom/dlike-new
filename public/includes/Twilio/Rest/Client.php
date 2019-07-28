<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest;

use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Client as HttpClient;
use Twilio\Http\CurlClient;
use Twilio\VersionInfo;

/**
 * A client for accessing the Twilio API.
 * 
 * @property \Twilio\Rest\Api api
 * @property \Twilio\Rest\Chat chat
 * @property \Twilio\Rest\IpMessaging ipMessaging
 * @property \Twilio\Rest\Lookups lookups
 * @property \Twilio\Rest\Monitor monitor
 * @property \Twilio\Rest\Pricing pricing
 * @property \Twilio\Rest\Taskrouter taskrouter
 * @property \Twilio\Rest\Trunking trunking
 * @property \Twilio\Rest\Api\V2010\AccountInstance account
 * @property \Twilio\Rest\Api\V2010\AccountList accounts
 * @property \Twilio\Rest\Api\V2010\Account\AddressList addresses
 * @property \Twilio\Rest\Api\V2010\Account\ApplicationList applications
 * @property \Twilio\Rest\Api\V2010\Account\AuthorizedConnectAppList authorizedConnectApps
 * @property \Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountryList availablePhoneNumbers
 * @property \Twilio\Rest\Api\V2010\Account\CallList calls
 * @property \Twilio\Rest\Api\V2010\Account\ConferenceList conferences
 * @property \Twilio\Rest\Api\V2010\Account\ConnectAppList connectApps
 * @property \Twilio\Rest\Api\V2010\Account\IncomingPhoneNumberList incomingPhoneNumbers
 * @property \Twilio\Rest\Api\V2010\Account\KeyList keys
 * @property \Twilio\Rest\Api\V2010\Account\MessageList messages
 * @property \Twilio\Rest\Api\V2010\Account\NewKeyList newKeys
 * @property \Twilio\Rest\Api\V2010\Account\NewSigningKeyList newSigningKeys
 * @property \Twilio\Rest\Api\V2010\Account\NotificationList notifications
 * @property \Twilio\Rest\Api\V2010\Account\OutgoingCallerIdList outgoingCallerIds
 * @property \Twilio\Rest\Api\V2010\Account\QueueList queues
 * @property \Twilio\Rest\Api\V2010\Account\RecordingList recordings
 * @property \Twilio\Rest\Api\V2010\Account\SandboxList sandbox
 * @property \Twilio\Rest\Api\V2010\Account\SigningKeyList signingKeys
 * @property \Twilio\Rest\Api\V2010\Account\SipList sip
 * @property \Twilio\Rest\Api\V2010\Account\ShortCodeList shortCodes
 * @property \Twilio\Rest\Api\V2010\Account\TokenList tokens
 * @property \Twilio\Rest\Api\V2010\Account\TranscriptionList transcriptions
 * @property \Twilio\Rest\Api\V2010\Account\UsageList usage
 * @property \Twilio\Rest\Api\V2010\Account\ValidationRequestList validationRequests
 * @method \Twilio\Rest\Api\V2010\AccountContext accounts(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\AddressContext addresses(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\ApplicationContext applications(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\AuthorizedConnectAppContext authorizedConnectApps(string $connectAppSid)
 * @method \Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountryContext availablePhoneNumbers(string $countryCode)
 * @method \Twilio\Rest\Api\V2010\Account\CallContext calls(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\ConferenceContext conferences(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\ConnectAppContext connectApps(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\IncomingPhoneNumberContext incomingPhoneNumbers(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\KeyContext keys(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\MessageContext messages(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\NotificationContext notifications(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\OutgoingCallerIdContext outgoingCallerIds(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\QueueContext queues(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\RecordingContext recordings(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\SandboxContext sandbox()
 * @method \Twilio\Rest\Api\V2010\Account\SigningKeyContext signingKeys(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\ShortCodeContext shortCodes(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\TranscriptionContext transcriptions(string $sid)
 */
class Client {
    const ENV_ACCOUNT_SID = "TWILIO_ACCOUNT_SID";
    const ENV_AUTH_TOKEN = "TWILIO_AUTH_TOKEN";

    protected $username;
    protected $password;
    protected $accountSid;
    protected $region;
    protected $httpClient;
    protected $_account;
    protected $_api = null;
    protected $_chat = null;
    protected $_ipMessaging = null;
    protected $_lookups = null;
    protected $_monitor = null;
    protected $_pricing = null;
    protected $_taskrouter = null;
    protected $_trunking = null;
    protected $_accounts = null;

    /**
     * Initializes the Twilio Client
     * 
     * @param string $username Username to authenticate with
     * @param string $password Password to authenticate with
     * @param string $accountSid Account Sid to authenticate with, defaults to
     *                           $username
     * @param string $region Region to send requests to, defaults to no region
     *                       selection
     * @param \Twilio\Http\Client $httpClient HttpClient, defaults to CurlClient
     * @param mixed[] $environment Environment to look for auth details, defaults
     *                             to $_ENV
     * @return \Twilio\Rest\Client Twilio Client
     * @throws ConfigurationException If valid authentication is not present
     */
    public function __construct($username = null, $password = null, $accountSid = null, $region = null, HttpClient $httpClient = null, $environment = null) {
        if (is_null($environment)) {
            $environment = $_ENV;
        }
        
        if ($username) {
            $this->username = $username;
        } else {
            if (array_key_exists(self::ENV_ACCOUNT_SID, $environment)) {
                $this->username = $environment[self::ENV_ACCOUNT_SID];
            }
        }
        
        if ($password) {
            $this->password = $password;
        } else {
            if (array_key_exists(self::ENV_AUTH_TOKEN, $environment)) {
                $this->password = $environment[self::ENV_AUTH_TOKEN];
            }
        }
        
        if (!$this->username || !$this->password) {
            throw new ConfigurationException("Credentials are required to create a Client");
        }
        
        $this->accountSid = $accountSid ?: $this->username;
        $this->region = $region;
        
        if ($httpClient) {
            $this->httpClient = $httpClient;
        } else {
            $this->httpClient = new CurlClient();
        }
    }

    /**
     * Makes a request to the Twilio API using the configured http client
     * Authentication information is automatically added if none is provided
     * 
     * @param string $method HTTP Method
     * @param string $uri Fully qualified url
     * @param string[] $params Query string parameters
     * @param string[] $data POST body data
     * @param string[] $headers HTTP Headers
     * @param string $username User for Authentication
     * @param string $password Password for Authentication
     * @param int $timeout Timeout in seconds
     * @return \Twilio\Http\Response Response from the Twilio API
     */
    public function request($method, $uri, $params = array(), $data = array(), $headers = array(), $username = null, $password = null, $timeout = null) {
        $username = $username ? $username : $this->username;
        $password = $password ? $password : $this->password;
        
        $headers['User-Agent'] = 'twilio-php/' . VersionInfo::string() .
                                 ' (PHP ' . phpversion() . ')';
        $headers['Accept-Charset'] = 'utf-8';
        
        if ($method == 'POST' && !array_key_exists('Content-Type', $headers)) {
            $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        }
        
        if (!array_key_exists('Accept', $headers)) {
            $headers['Accept'] = 'application/json';
        }
        
        if ($this->region) {
            list($head, $tail) = explode('.', $uri, 2);
            $uri = implode('.', array($head, $this->region, $tail));
        }
        
        return $this->getHttpClient()->request(
            $method,
            $uri,
            $params,
            $data,
            $headers,
            $username,
            $password,
            $timeout
        );
    }

    /**
     * Retrieve the Username
     * 
     * @return string Current Username
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Retrieve the Password
     * 
     * @return string Current Password
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Retrieve the AccountSid
     * 
     * @return string Current AccountSid
     */
    public function getAccountSid() {
        return $this->accountSid;
    }

    /**
     * Retrieve the Region
     * 
     * @return string Current Region
     */
    public function getRegion() {
        return $this->region;
    }

    /**
     * Retrieve the HttpClient
     * 
     * @return \Twilio\Http\Client Current HttpClient
     */
    public function getHttpClient() {
        return $this->httpClient;
    }

    /**
     * Set the HttpClient
     * 
     * @param \Twilio\Http\Client $httpClient HttpClient to use
     */
    public function setHttpClient(HttpClient $httpClient) {
        $this->httpClient = $httpClient;
    }

    /**
     * Access the Api Twilio Domain
     * 
     * @return \Twilio\Rest\Api Api Twilio Domain
     */
    protected function getApi() {
        if (!$this->_api) {
            $this->_api = new Api($this);
        }
        return $this->_api;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\AccountContext Account provided as the
     *                                               authenticating account
     */
    public function getAccount() {
        return $this->api->v2010->account;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\AccountList 
     */
    public function getAccounts() {
        return $this->api->v2010->accounts;
    }

    /**
     * @param string $sid Fetch by unique Account Sid
     * @return \Twilio\Rest\Api\V2010\AccountContext 
     */
    protected function contextAccounts($sid) {
        return $this->api->v2010->accounts($sid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\AddressList 
     */
    protected function getAddresses() {
        return $this->api->v2010->account->addresses;
    }

    /**
     * @param string $sid The sid
     * @return \Twilio\Rest\Api\V2010\Account\AddressContext 
     */
    protected function contextAddresses($sid) {
        return $this->api->v2010->account->addresses($sid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\ApplicationList 
     */
    protected function getApplications() {
        return $this->api->v2010->account->applications;
    }

    /**
     * @param string $sid Fetch by unique Application Sid
     * @return \Twilio\Rest\Api\V2010\Account\ApplicationContext 
     */
    protected function contextApplications($sid) {
        return $this->api->v2010->account->applications($sid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\AuthorizedConnectAppList 
     */
    protected function getAuthorizedConnectApps() {
        return $this->api->v2010->account->authorizedConnectApps;
    }

    /**
     * @param string $connectAppSid The connect_app_sid
     * @return \Twilio\Rest\Api\V2010\Account\AuthorizedConnectAppContext 
     */
    protected function contextAuthorizedConnectApps($connectAppSid) {
        return $this->api->v2010->account->authorizedConnectApps($connectAppSid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountryList 
     */
    protected function getAvailablePhoneNumbers() {
        return $this->api->v2010->account->availablePhoneNumbers;
    }

    /**
     * @param string $countryCode The country_code
     * @return \Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountryContext 
     */
    protected function contextAvailablePhoneNumbers($countryCode) {
        return $this->api->v2010->account->availablePhoneNumbers($countryCode);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\CallList 
     */
    protected function getCalls() {
        return $this->api->v2010->account->calls;
    }

    /**
     * @param string $sid Call Sid that uniquely identifies the Call to fetch
     * @return \Twilio\Rest\Api\V2010\Account\CallContext 
     */
    protected function contextCalls($sid) {
        return $this->api->v2010->account->calls($sid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\ConferenceList 
     */
    protected function getConferences() {
        return $this->api->v2010->account->conferences;
    }

    /**
     * @param string $sid Fetch by unique conference Sid
     * @return \Twilio\Rest\Api\V2010\Account\ConferenceContext 
     */
    protected function contextConferences($sid) {
        return $this->api->v2010->account->conferences($sid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\ConnectAppList 
     */
    protected function getConnectApps() {
        return $this->api->v2010->account->connectApps;
    }

    /**
     * @param string $sid Fetch by unique connect-app Sid
     * @return \Twilio\Rest\Api\V2010\Account\ConnectAppContext 
     */
    protected function contextConnectApps($sid) {
        return $this->api->v2010->account->connectApps($sid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\IncomingPhoneNumberList 
     */
    protected function getIncomingPhoneNumbers() {
        return $this->api->v2010->account->incomingPhoneNumbers;
    }

    /**
     * @param string $sid Fetch by unique incoming-phone-number Sid
     * @return \Twilio\Rest\Api\V2010\Account\IncomingPhoneNumberContext 
     */
    protected function contextIncomingPhoneNumbers($sid) {
        return $this->api->v2010->account->incomingPhoneNumbers($sid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\KeyList 
     */
    protected function getKeys() {
        return $this->api->v2010->account->keys;
    }

    /**
     * @param string $sid The sid
     * @return \Twilio\Rest\Api\V2010\Account\KeyContext 
     */
    protected function contextKeys($sid) {
        return $this->api->v2010->account->keys($sid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\MessageList 
     */
    protected function getMessages() {
        return $this->api->v2010->account->messages;
    }

    /**
     * @param string $sid Fetch by unique message Sid
     * @return \Twilio\Rest\Api\V2010\Account\MessageContext 
     */
    protected function contextMessages($sid) {
        return $this->api->v2010->account->messages($sid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\NewKeyList 
     */
    protected function getNewKeys() {
        return $this->api->v2010->account->newKeys;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\NewSigningKeyList 
     */
    protected function getNewSigningKeys() {
        return $this->api->v2010->account->newSigningKeys;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\NotificationList 
     */
    protected function getNotifications() {
        return $this->api->v2010->account->notifications;
    }

    /**
     * @param string $sid Fetch by unique notification Sid
     * @return \Twilio\Rest\Api\V2010\Account\NotificationContext 
     */
    protected function contextNotifications($sid) {
        return $this->api->v2010->account->notifications($sid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\OutgoingCallerIdList 
     */
    protected function getOutgoingCallerIds() {
        return $this->api->v2010->account->outgoingCallerIds;
    }

    /**
     * @param string $sid Fetch by unique outgoing-caller-id Sid
     * @return \Twilio\Rest\Api\V2010\Account\OutgoingCallerIdContext 
     */
    protected function contextOutgoingCallerIds($sid) {
        return $this->api->v2010->account->outgoingCallerIds($sid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\QueueList 
     */
    protected function getQueues() {
        return $this->api->v2010->account->queues;
    }

    /**
     * @param string $sid Fetch by unique queue Sid
     * @return \Twilio\Rest\Api\V2010\Account\QueueContext 
     */
    protected function contextQueues($sid) {
        return $this->api->v2010->account->queues($sid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\RecordingList 
     */
    protected function getRecordings() {
        return $this->api->v2010->account->recordings;
    }

    /**
     * @param string $sid Fetch by unique recording Sid
     * @return \Twilio\Rest\Api\V2010\Account\RecordingContext 
     */
    protected function contextRecordings($sid) {
        return $this->api->v2010->account->recordings($sid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\SandboxList 
     */
    protected function getSandbox() {
        return $this->api->v2010->account->sandbox;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\SandboxContext 
     */
    protected function contextSandbox() {
        return $this->api->v2010->account->sandbox();
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\SigningKeyList 
     */
    protected function getSigningKeys() {
        return $this->api->v2010->account->signingKeys;
    }

    /**
     * @param string $sid The sid
     * @return \Twilio\Rest\Api\V2010\Account\SigningKeyContext 
     */
    protected function contextSigningKeys($sid) {
        return $this->api->v2010->account->signingKeys($sid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\SipList 
     */
    protected function getSip() {
        return $this->api->v2010->account->sip;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\ShortCodeList 
     */
    protected function getShortCodes() {
        return $this->api->v2010->account->shortCodes;
    }

    /**
     * @param string $sid Fetch by unique short-code Sid
     * @return \Twilio\Rest\Api\V2010\Account\ShortCodeContext 
     */
    protected function contextShortCodes($sid) {
        return $this->api->v2010->account->shortCodes($sid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\TokenList 
     */
    protected function getTokens() {
        return $this->api->v2010->account->tokens;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\TranscriptionList 
     */
    protected function getTranscriptions() {
        return $this->api->v2010->account->transcriptions;
    }

    /**
     * @param string $sid Fetch by unique transcription Sid
     * @return \Twilio\Rest\Api\V2010\Account\TranscriptionContext 
     */
    protected function contextTranscriptions($sid) {
        return $this->api->v2010->account->transcriptions($sid);
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\UsageList 
     */
    protected function getUsage() {
        return $this->api->v2010->account->usage;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\ValidationRequestList 
     */
    protected function getValidationRequests() {
        return $this->api->v2010->account->validationRequests;
    }

    /**
     * Access the Chat Twilio Domain
     * 
     * @return \Twilio\Rest\Chat Chat Twilio Domain
     */
    protected function getChat() {
        if (!$this->_chat) {
            $this->_chat = new Chat($this);
        }
        return $this->_chat;
    }

    /**
     * Access the IpMessaging Twilio Domain
     * 
     * @return \Twilio\Rest\IpMessaging IpMessaging Twilio Domain
     */
    protected function getIpMessaging() {
        if (!$this->_ipMessaging) {
            $this->_ipMessaging = new IpMessaging($this);
        }
        return $this->_ipMessaging;
    }

    /**
     * Access the Lookups Twilio Domain
     * 
     * @return \Twilio\Rest\Lookups Lookups Twilio Domain
     */
    protected function getLookups() {
        if (!$this->_lookups) {
            $this->_lookups = new Lookups($this);
        }
        return $this->_lookups;
    }

    /**
     * Access the Monitor Twilio Domain
     * 
     * @return \Twilio\Rest\Monitor Monitor Twilio Domain
     */
    protected function getMonitor() {
        if (!$this->_monitor) {
            $this->_monitor = new Monitor($this);
        }
        return $this->_monitor;
    }

    /**
     * Access the Pricing Twilio Domain
     * 
     * @return \Twilio\Rest\Pricing Pricing Twilio Domain
     */
    protected function getPricing() {
        if (!$this->_pricing) {
            $this->_pricing = new Pricing($this);
        }
        return $this->_pricing;
    }

    /**
     * Access the Taskrouter Twilio Domain
     * 
     * @return \Twilio\Rest\Taskrouter Taskrouter Twilio Domain
     */
    protected function getTaskrouter() {
        if (!$this->_taskrouter) {
            $this->_taskrouter = new Taskrouter($this);
        }
        return $this->_taskrouter;
    }

    /**
     * Access the Trunking Twilio Domain
     * 
     * @return \Twilio\Rest\Trunking Trunking Twilio Domain
     */
    protected function getTrunking() {
        if (!$this->_trunking) {
            $this->_trunking = new Trunking($this);
        }
        return $this->_trunking;
    }

    /**
     * Magic getter to lazy load domains
     * 
     * @param string $name Domain to return
     * @return \Twilio\Domain The requested domain
     * @throws TwilioException For unknown domains
     */
    public function __get($name) {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        if(ucfirst($name)=='Sid'){ $name='AccountSid'; } 
        
        throw new TwilioException('Unknown domain ' . $name);
    }

    /**
     * Magic call to lazy load contexts
     * 
     * @param string $name Context to return
     * @param mixed[] $arguments Context to return
     * @return \Twilio\InstanceContext The requested context
     * @throws TwilioException For unknown contexts
     */
    public function __call($name, $arguments) {
        $method = 'context' . ucfirst($name);
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $arguments);
        }
        
        throw new TwilioException('Unknown context ' . $name);
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Client ' . $this->getAccountSid() . ']';
    }
}