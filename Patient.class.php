<?php
/**
 * Brightree Patient Class
 * =====================
 *
 * This class fetchs patient information via the API provided by brightree.
 *
 * @package      BrightreeAPI
 * @license      http://www.gnu.org/licenses/gpl.txt GPL
 * @version      0.0.1-DEV
 * @author       Nick nick@finneganhealth.com
 */
class Patient
{
    /**
    * Login Details
    *
    * @var string
    */
    private $user = 'xxxxxxx';
    private $pass = 'xxxxxxx';
    /**
    * The WSDL File
    *
    * @var string
    */
    private $url = "https://path.to.wsdl/Service?wsdl";
    /**
     * The SOAP Endpoint
     *
     * @var string
     */
    private $wsdl = "https://path.to.endpoint/Service?wsdl";
    /**
     * Construct Method
     *
     * 
     * Returns the needed api connection string
     * 
     */
    public function __construct()
    {
        $this->connection = array(
            'login' => $this->user,
            'password' => $this->pass,
            'uri' => $this->url,
            'location' => $this->url,
            'trace' => 1
        );
    }
    /**
     * Generic Patient API Call
     *
     * @param string $call (Invokes a SOAP method)
     * 
     * @param array $query (builds soap query)
     */
    public function apiCall($call,$query)
    {
        $client     = new SoapClient($this->wsdl, $this->connection);
        $response 	= $client->$call($query);
        return $response;
    }
    /**
     * Create Patient API Call
     *
     * @param array Patient  
     *
     */
    public function PatientCreate($query)
    {
        $client     = new SoapClient($this->wsdl, $this->connection);
        $response 	= $this->apiCall->PatientCreate($query);
        $results 	= json_decode(json_encode($response), true);
        return $results;
    }
    /**
     * Brightree ID Patient API Call
     *
     * @param string $id 
     * 
     */    
    public function PatientFetchByBrightreeID($id)
    {
        $client     = new SoapClient($this->wsdl, $this->connection);
        $response 	= $client->PatientFetchByBrightreeID(array("BrightreeID" => $id));
        $responsearray    = json_decode(json_encode($response->PatientFetchByBrightreeIDResult->Items->Patient), true);
        return $responsearray;
    }
    /**
     * External ID Patient API Call
     *
     * @param string $id 
     * 
     */
    public function PatientFetchByExternalID($id)
    {
        $client     = new SoapClient($this->wsdl, $this->connection);
        $response = $this->apiCall->PatientFetchByExternalID(array("ExternalID" => $id));
        $responsearray    = json_decode(json_encode($response), true);
        return $responsearray;
    }
    /**
     * Get Patients by phone number
     *
     * @param: Number, SortParam, PageSize, Page 
     * 
     */    
    public function PatientPhoneNumberSearch($query)
    {
        $client          = new SoapClient($this->wsdl, $this->connection);
        $response = $client->PatientPhoneNumberSearch($query);
        $responsearray    = json_decode(json_encode($response), true);
        return $responsearray;
    }
    /**
     * Patient Add Marketing Referral
     * Used to add a referral to Patient
     *
     * @param: BrightreeID, ReferralBrightreeID
     * 
     * @return: BrightreeID
     */    
    public function PatientAddMarketingReferral($id)
    {
        $client          = new SoapClient($this->wsdl, $this->connection);
        $response = $client->PatientAddMarketingReferral(array("BrightreeID" => $id));
        $responsearray    = json_decode(json_encode($response), true);
        return $responsearray;
    }
    /**
     * Remove Patient Marketing Referral
     * Used to remove a referral to Patient
     *
     * @param: BrightreeID 
     * 
     */    
    public function PatientRemoveMarketingReferral($id)
    {
        $client          = new SoapClient($this->wsdl, $this->connection);
        $response = $client->PatientRemoveMarketingReferral(array("BrightreeID" => $id));
        $responsearray    = json_decode(json_encode($response), true);
        return $responsearray;
    }
    /**
     * Patient Search
     *
     * @param: Patient Info 
     * 
     */    
    public function PatientSearch($query)
    {
        $client          = new SoapClient($this->wsdl, $this->connection);
		$response = $client->PatientSearch($query);
        $responsearray    = json_decode(json_encode($response), true);
        return $responsearray;
    }
    /**
     * Patient Payor Add
     *
     * @param: PatientKey, PayorKey, PatientPayor 
     * 
     */    
    public function PatientPayorAdd($query)
    {
        $client          = new SoapClient($this->wsdl, $this->connection);
		$response = $client->PatientPayorAdd($query);
        $responsearray    = json_decode(json_encode($response), true);
        return $responsearray;
    }
    /**
     * Patient Payor Remove
     *
     * @param: BrightreeID 
     * 
     */    
    public function PatientPayorRemove($id)
    {
        $client          = new SoapClient($this->wsdl, $this->connection);
		$response = $client->PatientPayorRemove(array('brightreeID' => $id));
        $responsearray    = json_decode(json_encode($response), true);
        return $responsearray;
    }
    /**
     * Patient Payor Fetch
     *
     * @param: PatientKey, PayorKey 
     * 
     */    
    public function PatientPayorFetch($query)
    {
        $client          = new SoapClient($this->wsdl, $this->connection);
		$response = $client->PatientPayorFetch($query);
        $responsearray    = json_decode(json_encode($response), true);
        return $responsearray;
    }
    /**
     * Patient Payor Fetch ALL
     *
     * @param: PatientKey 
     * 
     */    
    public function PatientPayorFetchAll($patientkey)
    {
        $client          = new SoapClient($this->wsdl, $this->connection);
		$response = $client->PatientPayorFetchAll($patientkey);
        $responsearray    = json_decode(json_encode($response), true);
        return $responsearray;
    } 
    /**
     * Patient Payor Update
     *
     * @param:  BrightreeID, PatientPayor
     * 
     */    
    public function PatientPayorUpdate($query)
    {
        $client      = new SoapClient($this->wsdl, $this->connection);
		$response 	= $client->PatientPayorUpdate($query);
        $responsearray    = json_decode(json_encode($response), true);
        return $responsearray;
    }   
    /**
     * Patient Create Note
     *
     * @param:  PatientNote
     * 
     * @required: Subject(max 200 characters), Description(max 8000 Characters)
     *			  Status, Severity, Reason, State(usertaskstate), Patientkey
     *
     * @return BrightreeID
     */    
    public function PatientNoteCreate($query)
    {
        $client      = new SoapClient($this->wsdl, $this->connection);
		$response 	= $client->PatientNoteCreate($query);
        $responsearray    = json_decode(json_encode($response), true);
        return $responsearray;
    }
    /**
     * Patient Get Note By Patient
     *
     * @param:  BrightreeID of the Patient
     * 
     */    
    public function PatientNoteFetchByPatient($id)
    {
        $client     = new SoapClient($this->wsdl, $this->connection);
        $response   = $client->PatientNoteFetchByPatient(array('brightreeID' => $id));
        $responsearray = json_decode(json_encode($response), true);
        return $responsearray;
    }
    /**
     * Patient Get Note By Key
     *
     * @param:  BrightreeID of the Note
     * 
     */    
    public function PatientNoteFetchByKey($id)
    {
        $client     = new SoapClient($this->wsdl, $this->connection);
        $response   = $client->PatientNoteFetchByKey(array('brightreeID' => $id));
        $responsearray = json_decode(json_encode($response), true);
        return $responsearray;
    }
    /**
     * Patient Note Update
     *
     * @param:  BrightreeID of the Note
     * 
     * @required: Subject(max 200 characters), Description(max 8000 Characters)
     *			  Status, Severity, Reason, State(usertaskstate), Patientkey
     */    
    public function PatientNoteUpdate($query)
    {
        $client     = new SoapClient($this->wsdl, $this->connection);
        $response   = $client->PatientNoteUpdate($query);
        $responsearray = json_decode(json_encode($response), true);
        return $responsearray;
    }
	/**
     * Facility Get All Master Info
     *
     * @param:  none
     * 
     */    
    public function FacilityMasterInfoFetchAll()
    {
        $client     = new SoapClient($this->wsdl, $this->connection);
        $response   = $client->FacilityMasterInfoFetchAll();
        $responsearray = json_decode(json_encode($response), true);
        return $responsearray;
    }
	
    
}
